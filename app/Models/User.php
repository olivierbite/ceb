<?php

namespace Ceb\Models;

use Cartalyst\Sentry\Groups\GroupInterface;
use Cartalyst\Sentry\Users\Eloquent\User as SentinelModel;
use Ceb\Models\Contribution;
use Ceb\Models\Loan;
use Ceb\Models\Setting;
use Ceb\Traits\LogsActivity;
use Exception;
use Fenos\Notifynder\Notifable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\LogsActivityInterface;
use Vinkla\Hashids\Facades\Hashids;

class User extends SentinelModel {

	use Notifable;

	use LogsActivity;

	use SoftDeletes;

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
	protected $dates = ['created_at','deleted_at']; //, 'date_of_birth', 'updated_at'

	/**
	 * Wished amount percentage
	 * @var float
	 */
	protected $rightToLoanPercentage = 2.5;

	/**
	 *  Refund fees
	 * @var integer
	 */
	public $refund_fee = 0;
	
	/**
	 * Minimum months a user needs to have before having a loan.
	 * @var 
	 */
	protected $minimumMonthsToLoan;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	public $fillable = [
		'adhersion_id',
		'district',
		'province',
		'institution_id',
		'service',
		'termination_date',
		'first_name',
		'last_name',
		'password',
		'date_of_birth',
		'sex',
		'member_nid',
		'nationality',
		'email',
		'telephone',
		'monthly_fee',
		'photo',
		'signature',
		'employee_id',
	];

	/**
	 * The Eloquent group model.
	 *
	 * @var string
	 */
	protected static $groupModel = 'Cartalyst\Sentry\Groups\Eloquent\Group';

	/**
	 * The user groups pivot table name.
	 *
	 * @var string
	 */
	protected static $userGroupsPivot = 'users_groups';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Entry point for our model
	 * @param Setting $setting 
	 */
	function __construct() {
		$this->rightToLoanPercentage = Setting::keyValue('loan.wished.amount');
		$this->minimumMonthsToLoan   = Setting::keyValue('loan.member.minimum.months');
	}
	 /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $keyword)
    {
	 return $query->where('first_name', 'LIKE', '%' . $keyword . '%')
		            ->orWhere('last_name', 'LIKE', '%' . $keyword . '%')
		            ->orWhere('email', 'LIKE', '%' . $keyword . '%')
		            ->orWhere('member_nid', 'LIKE', '%' . $keyword . '%')
		            ->orWhere('adhersion_id', 'LIKE', '%' . $keyword . '%');
	}

	/** 
	 * Get member names
	 * @return string 
	 */
	public function names() {
		return $this->first_name . ' ' . $this->last_name;
	}

	/**
	 * Get latest ordinary loan for this member
	 * @return -1 if the user is not eligible for  loan to regulate
	 * @return  1 if the user can only regulate installments
	 * @return  2 if the user can regulate both installments and amount <=>
	 */
	public function getLoanToRegulateAttribute()
	{
		$loan = $this->loans()->isOrdinary()->IsNotUmergency()->first();
		// If not have active loan we have nothing to do here
		if ($this->hasActiveLoan() == false || is_null($loan)) {
			return -1;
		}

		// Can regulate echeance
		if ($loan->loan_to_repay >= $loan->right_to_loan) {

			return 1;
		}

		// Can regulate amount
		if ($loan->loan_to_repay < $loan->right_to_loan) {
			return 2;
		}

		return -1;
	}	

	/**
	 * Member institution
	 * @return Ceb\Models\Institution
	 */
	public function institution() {
		return $this->belongsTo('Ceb\Models\Institution');
	}

	/**
	 * Attornies for this memebr
	 * @return object attorney
	 */
	public function attornies()
	{
		return $this->hasMany('Ceb\Models\Attorney');
	}
	/**
	 * Get the contributions for the Member.
	 */
	public function contributions() {
		return $this->hasMany('Ceb\Models\Contribution', 'adhersion_id', 'adhersion_id');
	}

	/**
	 * Get the monthly fees inventory for the Member.
	 */
	public function monthlyFeeInventories() {
		return $this->hasMany('Ceb\Models\MemberMontlyFeeLog', 'adhersion_id', 'adhersion_id');
	}

	/**
	 * Get member loans
	 */
	public function loans() {
		return $this->hasMany('Ceb\Models\Loan', 'adhersion_id', 'adhersion_id');
	}
	/**
	 * Member refunds
	 * @return Objects contains all refunds by this memebr
	 */
	public function refunds() {
		return $this->hasMany('Ceb\Models\Refund', 'adhersion_id', 'adhersion_id');
	}

	/**
	 * Member CAUTIONS
	 * @return Objects contains all people this member cautioned or were their cautionneur
	 */
	public function cautions() {
		return $this->hasMany('Ceb\Models\MemberLoanCautionneur', 'cautionneur_adhresion_id', 'adhersion_id');
	}
    
    /**
	 * Member who cautioned this members
	 * @return Objects contains all people who were cautionneur for this member
	 */
	public function cautioned() {
		return $this->hasMany('Ceb\Models\MemberLoanCautionneur', 'member_adhersion_id', 'adhersion_id');
	}

	/**
	 * Member who cautioned this members
	 * @return Objects contains all refunds by this memebr
	 */
	public function getCautionedMeAttribute() {
		return $this->cautioned()->active()->get();
	}

    /**
     * Get caution amount attributes
     * @return [type] [description]
     */
    public function getCautionAmountAttribute()
    {
    	return $this->cautions->sum('amount');
    }

    /**
     * Get caution refunded amount attributes
     * @return 
     */
    public function getCautionRefundedAttribute()
    {
    	return $this->cautions->sum('refunded_amount');
    }
    
    /** Get caution balance */
    public function getCautionBalanceAttribute()
    {
    	return $this->caution_amount - $this->caution_refunded;
    }

    /**
     * Relationship with leaves
     * @return  leave object
     */
    public function leaves()
    {
        return $this->hasMany('Ceb\Models\Leave');
    }

    /**
     * Get total refund attribute
     * @return [type] [description]
     */
    public function getTotalRefundsAttribue()
    {
    	return $this->totalRefunds();
    }

	/**
	 * Get total refunds by this member;
	 * @return numeric
	 */
	public function totalRefunds() {
		return $this->refunds()->sum('amount');
	}

	/**
	 * total_refunds attribute
	 * @return  
	 */
	public function getTotalRefundsAttribute()
	{
		return $this->refunds()->sum('amount');
	}

	/**
	 * Get the total amount of contribution
	 */
	public function totalContributions() {
		$saving = $this->contributions()->isSaving()->sum('amount');
		$withdrawal = $this->contributions()->isWithdrawal()->sum('amount');

		return (int) $saving - $withdrawal;
	}

	/**
	 * Get the total amount of contribution attributes
	 * 
	 */
	public function getTotalContributionAttribute() {
		return $this->totalContributions();
	}
	/**
	 * Get the loan balance
	 * @return numeric
	 */
	public function loanBalance() {
		$balance = 0;		
		if ($this->has_active_loan) {
			$balance = $this->totalLoans() - $this->totalRefunds();
		}

		if($this->has_active_emergency_loan){
			$balance = abs($balance - $this->active_emergency_loan->emergency_balance);
		}

		return $balance;
	}

	/**
	 * Check if this person has Ceb minimum loan months
	 * @return 
	 */
	public function scopeEligible($query)
	{
		return $query->where('created_at','<=',DB::raw('DATE_SUB(now(), INTERVAL '.env('LOAN_MINIMUM_MONTHS',6).' MONTH)'));
	}

	/**
	 * loan_balance attribute
	 * @return numeric
	 */
	public function getLoanBalanceAttribute()
	{
		return $this->loanBalance();
	}

	/**
	 * Get remaining payment installment
	 * 
	 * @return int number of remaining installment
	 */
	public function remainingInstallment()
	{
		$installments = 0;
		try
		{
			
			if ($this->has_active_loan) {
				$loan_balance = $this->loanBalance();
				
				// Get monthly fee that is supposed to be paid by this member
				$monthly_fee  = $this->loanMonthlyFees();//$this->latestLoan()->monthly_fees;
				// No active loan therefore remaining installment is 0
				$installments = $loan_balance / $monthly_fee;
				return round($installments);
			}

			// Add emergency loan if we have it
			// if ($this->has_active_emergency_loan) {
			// 	$emergency_loan = $this->active_emergency_loan;
			// 	$emergency_loan_refund = $emergency_loan->emergency_refund;
			// 	$emergency_balance     = $emergency_loan->emergency_balance;
			// 	$emergencyLoanAmount = $emergency_balance + $emergency_loan_refund;
			// 	$emergency_monthly_fee = $emergency_loan->monthly_fees;
			// 	$emergency_installments = $emergency_balance / $emergency_monthly_fee;

			// 	// Remove emergency loan since we have added it in total loans
			// 	// and to recalculations for the installments
			// 	$loan_balance -= ($emergency_balance);
			// 	// $monthly_fee  -=$emergency_monthly_fee;
			// 	// If we have already paid for this loan, then don't count 
			// 	// the refund for the emergency loan, so that we can be 
			// 	// more accurate on the installments 
				
			// 	// Add the emergency loan balance for us to be able to balance
			// 	// the installments
			// 	$installments = $loan_balance / $monthly_fee;
				
			// 	// Add the difference of emergency loan installments 
			// 	// if installments are < than emergency loan installments
			// 	if ($installments < $emergency_installments) {
			// 		$installments += abs($installments - $emergency_installments);
			// 	}
			// }
		}
		catch(Exception $e)
		{
			Log::critical($e->getMessage());
		}
		
		return intval(floor($installments));
	}

	/**
	 * Get current active cautions
	 * @return [type] [description]
	 */
	public function getCurrentCautionsAttribute()
	{
		return $this->cautions()->active()->get();
	}
	/**
	 * Get the remaining tranches for this member
	 * @return  number
	 */
	public function getRemainingTranchesAttribute()
	{
		return $this->remainingInstallment();
	}
	/**
	 * Determine if this member has active Loan
	 *
	 * @return  bool
	 */
	public function hasActiveLoan() {
		return $this->loanBalance() > 0;
	}

    
	/**
	 * Check if a user has active loan
	 * @return  bool
	 */
	public function getHasActiveLoanAttribute()
	{
		return ($this->totalLoans() - $this->totalRefunds())  > 0;
	}

	/**
	 * Get Right to loan
	 */
	public function generalRightToLoan() 
	{
		return $this->total_contribution * $this->rightToLoanPercentage;
	}
	/**
	 * general_right_to_loan attributes
	 * 		
	 * @return number
	 */
	public function getGeneralRightToLoanAttribute()
	{
		return $this->totalContributions() * $this->rightToLoanPercentage;
	}

	/**
	 * Right to loan considering loan
	 * @param  string $value
	 * @return 
	 */
	public function rightToLoan()
	{
		// If this member has active loan, as we calculate 
		// Amount to loan that he is eligeable for we 
		// need to consider right to loan a member
		// had before we give him this loan
		$latestLoan = $this->latestLoan();
		$contributions 		= $this->contributions();

		if ($this->loan_to_regulate !==-1 and strpos($latestLoan->operation_type,'ordinary_loan') !== false) {
			return $latestLoan->right_to_loan - $latestLoan->loan_to_repay;
		}
		

		// Since this member has active loan, let's determine
		// what is his right loan as of previous loan
		// Then deduct the loan he was given
		return  $this->totalContributions() * $this->rightToLoanPercentage;
	}

	/**
	 * right_to_loan_attribute
	 * @return 
	 */
	public function getRightToLoanAttribute()
	{

		return $this->rightToLoan();
	}
    
    public function getLatestOrdinaryLoanAttribute()
    {
    	return $this->loans()->isOrdinary()->isNotUmergency()->orderBy('id','DESC')->first();
    }
	/**
	 * Determine if this member still have right to loan
	 * 
	 * @return boolean 
	 */
	public function getHasMoreRightToLoanAttribute()
	{
		$loan = $this->latest_ordinary_loan;
		
		if (is_null($loan)) {
			return false;
		}

		return $loan->loan_to_repay < $loan->right_to_loan;
	}

	/**
	 * Get remaining amount right to loan attribute
	 * @return numeric
	 */
	public function getRemainingRightToLoanAttribute()
	{
	  	// Get latest ordinary loan
	  	$loan = $this->latest_ordinary_loan;
	  	return $loan->right_to_loan - $loan->right_to_loan;
	}

	/**
	 * Get total loan attribute
	 * @return numeric
	 */
	public function getTotalLoanAttribute()
	{
		return $this->totalLoans();
	}

	/**
	 * total Loan that user has taken
	 * @return  numeric
	 */
	public function totalLoans() {
		return $this->loans()->approved()->sum('loan_to_repay');
	}

	public function loanSumRelation()
	{
	    return $this->hasMany('Ceb\Models\Loan', 'adhersion_id', 'adhersion_id')->selectRaw('adhersion_id, sum(loan_to_repay) as loan_to_repay')
	    	->where('status','approved')
	        ->groupBy('adhersion_id');
	}

	public function getLoanSumAttribute()
	{
		$sumLoan = $this->loanSumRelation;
	    return $sumLoan->isEmpty() ? 0:
	        intval($sumLoan->first()->loan_to_repay) ;
	}

	public function refundSumRelation()
	{
	    return $this->hasMany('Ceb\Models\Refund', 'adhersion_id', 'adhersion_id')->selectRaw('adhersion_id, sum(amount) as refund')
	        ->groupBy('adhersion_id');
	}

	public function getRefundSumAttribute()
	{
		$sumRefund = $this->refundSumRelation;
	    return $sumRefund->isEmpty() ? 0:
	        intval($sumRefund->first()->refund) ;
	}

	/**
	 * Determine if this user has active emergency Loan
	 * @return boolean 
	 */
	public function getHasActiveEmergencyLoanAttribute()
	{
		$emergencyLoan = $this->loans()->isNotPaidUmergency()->orderBy('id','desc')->first();

		if (is_null($emergencyLoan)) {
			return false;
		}
		return $emergencyLoan->exists;
	}

	/**
	 * Get active emergency loan
	 * @return 
	 */
	public function getActiveEmergencyLoanAttribute()
	{
		return $this->loans()->isNotPaidUmergency()->orderBy('id','desc')->first();
	}

	    /**
     * Get emergency loan
     * @param  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getEmergencyMonthlyFeeAttribute()
    {
        /** Make sure this is a valid emergency loan before proceeding */
        $monthly_fee = 0;
        try
        {
        	if($this->has_active_emergency_loan)
        	{
        		$monthly_fee =  $this->active_emergency_loan->monthly_fees;
        	}
        	
    	}
        catch(Exception $e){
        	Log::critical($e->getMessage());
        } 

        return $monthly_fee;
    }

	/**
	 * Get member loan monthly fees that
	 * He is supposed to pay
	 * @return numeric with the fees this member need to pay
	 */
	public function loanMonthlyFees() {
		    $monthly_fee = 0;		
		    
		    try
			{
				if ($this->has_active_loan && !is_null($latest=$this->latestLoan())) {
					$monthly_fee = $latest->monthly_fees;
				}

			// 	// If we have emergency loan, check if this emergency
			// 	// loan is not the one being returned
			//  	if ($this->has_active_emergency_loan) {

			//  	// If this one is an emergency loan, then reset 
			//  	// monthly loan to zero.
			// 	if ($this->active_emergency_loan->id == $latest->id) {
			// 		return $mon;
			// 	}
			// }
			// // If this latest loan is not ordinary loan, then check if this member
			// // has taken an ordinary loan which is not paid yet and add monthly
			// // fees to the ordinary loan 
			// // try
			// // {
			// 	// Get latest loan  details
			// 	$latest_ordinary_loan = $this->latest_ordinary_loan;
                
			// 	// Check if we have latest active ordinary loan that is not yet paid
			// 	// We need to add previous monthly fees, since this loan is either
   //              // social loan or special loan 
                
   //              if ($latest_ordinary_loan->id != $latest->id && !$latest_ordinary_loan->isFullPaid()) {
                	
   //              	$monthly_fee+=$latest_ordinary_loan->monthly_fees;

   //              }
               
			}
			catch(\Exception $ex)
			{
				Log::alert($ex);
			}
			// if ($this->hasActiveEmergencyLoan) {
			// 	$monthly_fee+= $this->active_emergency_loan->monthly_fees;
			// }
			
        
   // //      if ($this->remainingInstallment() < 2) {
   // //      	return $this->loan_balance;
   // //      }
		return $monthly_fee;	
	}

	public function getLoanMontlyFeeAttribute()
	{
		return $this->loanMonthlyFees();
	}
	/**
	 * Get latest Loan that this member has gotten
	 * @return user Object
	 */
	public function latestLoan() {
		return $this->loans()->isNotUmergency()->isNotReliquant()->approved()->orderBy('id', 'desc')->first();
	}

	/**
	 * Get latest Loan that this member has gotten
	 * @return user Object
	 */
	public function latestLoanWithEmergency() {
		return $this->loans()->isNotReliquant()->approved()->orderBy('id', 'desc')->first();
	}	

	/**
	 * Get latest loan attribute
	 * @return  
	 */
	public function getLatestLoanAttribute()
	{
		return $this->latestLoan();
	}
	/**
	 * Find a member by his adhersion ID
	 * @param  integer $adhersionId member adhersion number
	 * @return this
	 */
	public function findByAdhersion($adhersionId) {
		return $this->where('adhersion_id', $adhersionId)->first();
	}

	/**
     * A sure method to generate a unique adhersionId 
     *
     * @return string
     */
    public function generateAdhersionID()
    {
    	$max = self::where('email','<>','admin@admin.com')->max('adhersion_id');
	    $max = substr($max, 4);
        do {
            $max++;
			$newAdhersionNumber = '2007'.($max);
        } // Already in the DB? Fail. Try again
        while (self::adhersionIdExists($newAdhersionNumber));

        return $newAdhersionNumber;
    }

	 /**
     * Checks whether a adhersionid exists in the database or not
     *
     * @param $key
     * @return bool
     */
    private function adhersionIdExists($adhersionId)
    {
        $adhersionId = self::where('adhersion_id', '=', $adhersionId)->limit(1)->count();

        if ($adhersionId > 0) return true;

        return false;
    }

	/**
	 * Find member by adhresion
	 * @param   $query        
	 * @param   $adhersion_id 
	 * @return query builder
	 */
	public function scopeByAdhersion($query,$adhersion_id)
	{
		return $query->where('adhersion_id',$adhersion_id);		
	}

	/**
	 * Get member who has left
	 * @param  $query 
	 * @return  
	 */
	public function scopeHasLeft($query)
	{
		return $query->whereNotNull('termination_date');
	}

	/**
	 * Get member who are active
	 * @param  $query 
	 * @return 
	 */
	public function scopeIsActive($query)
	{
		return $query->whereNull('termination_date');
	}

	
	/**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst($value);
    }
    /**
     * Set the user's last name.
     *
     * @param  string  $value
     * @return string
     */
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }  

    /**
     * Set the member's password
     * @param string $value 
     */
    public function setPasswordAttribute($value)
    {
    	$this->attributes['password'] = crypt('Test1234','');
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getEmployeeIdAttribute($value)
    {
        return is_null($value) ? trans('general.not_available') :  ucfirst($value);
    }

    /**
     * Get name attributes
     * @return  string
     */
    public function getNamesAttribute()
    {
    	return $this->first_name .' '.$this->last_name;
    }

    /**
     * Get institution attribute
     * @return  
     */
    public function getInstitutionNameAttribute()
    {
    	return $this->institution->name;
    }
    /**
     * Use a mutator to derive the appropriate hash for this user
     *
     * @return mixed
     */
    public function getHashAttribute()
    {
        return Hashids::encode($this->id);
    }

    /**
	 * See if the user is in the given group.
	 *
	 * @param \Cartalyst\Sentry\Groups\GroupInterface  $group
	 * @return bool
	 */
	public function inGroup(GroupInterface $group)
	{
		foreach ($this->getGroups() as $_group)
		{
			if ($_group->getId() == $group->getId())
			{
				return true;
			}
		}

		return false;
	}

		/**
	 * Returns an array of groups which the given
	 * user belongs to.
	 *
	 * @return array
	 */
	public function getGroups()
	{
		if ( ! $this->userGroups)
		{
			$this->userGroups = $this->groups()->get();
		}

		return $this->userGroups;
	}

	/**
	 * Returns the relationship between users and groups.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function groups()
	{
		return $this->belongsToMany(static::$groupModel, static::$userGroupsPivot);
	}

	/**
	 * See if a group has access to the passed permission(s).
	 *
	 * If multiple permissions are passed, the group must
	 * have access to all permissions passed through, unless the
	 * "all" flag is set to false.
	 *
	 * @param  string|array  $permissions
	 * @param  bool  $all
	 * @return bool
	 */
	public function scopeHasRight($query,$permissions)
	{
		// If this user has the right, then pass the query otherwise
		// Fail the query intentionally 	
		
		if ($this->hasAccess($permissions) == true) {
			return $query->where(DB::raw('1=1'));
		}

		// Fail this query scope because this person does not have the right
	    return $query->where(DB::raw('1=2'));
	}



	/**
	 * Validates the user and throws a number of
	 * Exceptions if validation fails.
	 *
	 * @return bool
	 * @throws \Cartalyst\Sentry\Users\LoginRequiredException
	 * @throws \Cartalyst\Sentry\Users\PasswordRequiredException
	 * @throws \Cartalyst\Sentry\Users\UserExistsException
	 */
	public function validate()
	{
		if ( ! $login = $this->getLoginName() )
		{
			throw new LoginRequiredException("A login is required for a user, none given.");
		}

		if ( ! $password = $this->getPasswordName())
		{
			throw new PasswordRequiredException("A password is required for user [$login], none given.");
		}

		// Check if the user already exists
		$query = $this->newQuery();
		$persistedUser = $query->where($this->getLoginName(), '=', $login)->first();

		if ($persistedUser and $persistedUser->getId() != $this->getId())
		{
			throw new UserExistsException("A user already exists with login [$login], logins must be unique for users.");
		}

		return true;
	}

}
