<?php 

namespace Ceb\Factories;

use Ceb\Models\DefaultAccount;
use Ceb\Models\Institution;
use Ceb\Models\MemberLoanCautionneur;
use Ceb\Models\Posting;
use Ceb\Models\Refund;
use Ceb\Models\User;
use Ceb\Traits\TransactionTrait;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Sentry;

/**
 * Refund Factory
 */
class RefundFactory {
	use TransactionTrait;

	/** Variable to  hold the object that are going to be injected */
	private $institution;

	function __construct(Institution $institution, Refund $refund, Posting $posting,User $member,MemberLoanCautionneur $memberLoanCautionneur) {
		$this->institution = $institution;
		$this->refund = $refund;
		$this->posting = $posting;
		$this->member = $member;
		$this->memberLoanCautionneur = $memberLoanCautionneur;
	}

	/**
	 * Set members by institutions
	 * @param integer $institutionId
	 */
	public function setByInsitution($institutionId = 1) {
		// Do we have some savings ongoing ?
		if (Session::has('refundMembers')) {
			// We have things in the session
			// Clear the session befor continuing
			$this->clearAll();
		}

		// Get the institution by its id
		// $members = $this->institution->with('members')->find((int) $institutionId)->membersWithLoan();
		$members = User::with(['loanSumRelation','refundSumRelation'])->where('institution_id',(int)$institutionId)->get();
		
		$membersWithNoLoan = [];
		/** Make sure we only get member with loan */
		foreach ($members as $member) {
			if ($member->refund_sum >= $member->loan_sum) {
				continue;
			}
			
			$monthly_fees =  $member->loan_montly_fee;
			// Even if we have active loan but if the loan balance is 
			// less than the 
			if ($member->total_loan - $member->total_refunds < 0 ) {
				$monthly_fees = 0;
			}

	        // Make sure amount is numeric
	        $member->refund_fee = (int)  $monthly_fees + $member->emergency_monthly_fee;
			$membersWithNoLoan[] = $member;
		}
	
		$this->setRefundMembers($membersWithNoLoan);
	}

	/**
	 * Set members
	 * @param integer $memberId
	 *
	 * @return bool
	 */
	public function setMember($memberId)
	{
		$member = $this->member->with('loans')->findOrFail($memberId);

		if (!$member->hasActiveLoan()) {
			flash()->error(trans('member.this_member_doesnot_have_active_loan'));
			return false;
		}

        $monthly_fees =  $member->loan_montly_fee;
		// Even if we have active loan but if the loan balance is 
		// less than the 
		if ($member->total_loan - $member->total_refunds < 0 ) {
			$monthly_fees = 0;
		}

        // Make sure amount is numeric
        $member->refund_fee = (int)  $monthly_fees + $member->emergency_monthly_fee;
        
		$members[] = $member;
		$this->setRefundMembers($members);
		return true;
	}

	/**
	 * Update a single monthly contribution for a given uses
	 * @param  [type] $adhersion_number [description]
	 * @param  [type] $newValue         [description]
	 * @return [type]                   [description]
	 */
	public function updateRefundFee($adhersion_number, $newFee) {
		// First get what is in the session now
		$users = $this->getRefundMembers();

        $users = array_map( function($user) use($adhersion_number, $newFee)
        		{
	        	// If we need to  update this key then update it before returning
	        	if ($user->adhersion_id == (int) $adhersion_number) {
	        		 $user->refund_fee = $newFee;
	        	}

        	return $user;
        },$users);


		// Now we are ready to go
		return $this->setRefundMembers($users);
	}

	/**
	 * Complete current transactions in refund
	 *
	 * @return  bool
	 */
	public function complete() {

		$transactionId = $this->getTransactionId(); // Generating unique transactionid

		// Start saving if something fails cancel everything
		DB::beginTransaction();

		$saveRefund = $this->saveRefund($transactionId);

		$savePosting = $this->savePostings($transactionId);
		// Rollback the transaction via if one of the insert fails
		if (!$saveRefund || !$savePosting) {
			DB::rollBack();

			flash()->error(trans('refund.error_occured_during_the_processes_of_registering_refund_please_try_again'));
			return false;
		}

		// Lastly, Let's commit a transaction since we reached here
		DB::commit();
		// Remove everything from the session
		$this->clearAll();
		flash()->success(trans('refund.refun_transaction_sucessfully_registered'));
		return $transactionId;

	}

	/**
	 * Saving refunds in the database
	 * @param  [type] $transactionId [description]
	 * @return [type]                [description]
	 */
	private function saveRefund($transactionId) {
		# Get data in the factory
		$refundMembers = $this->getRefundMembers();
		$month = $this->getMonth();
		$contractNumber = $this->getContributionContractNumber();
		$month = $this->getMonth();

		foreach ($refundMembers as $refundMember) {
			
			$loan  = $refundMember->latestLoan();
			
			// if this member has active emergency loan, remove the normal amount to refund
			// without emergency loan and then the rest save it as emergency loan refund 
			// so that we can record how much money on emergency loan has been paid
			// back by this member
			
			if ($refundMember->HasActiveEmergencyLoan) {
				// Get the monthly fees and add it here
				$emergencyLoan = $refundMember->loans()->isNotPaidUmergency()->orderBy('updated_at','DESC')->first();

				if (empty($emergencyLoan) == false) {

					// We have umergency loan, let's determine how much money to record as pay back
					$emergencyMonthlyFee = $emergencyLoan->EmergencyMonthlyFee;
					$emergencyLoanRefundFee = $refundMember->refund_fee - $emergencyMonthlyFee;
					
					// Determine exact amount to record as emergency payback
					$emergencyLoanRefundFee  = $refundMember->loan_montly_fee - $emergencyLoanRefundFee;

					// Amount refunded has included the emergency loan then record it
					if ($emergencyLoanRefundFee > 0 ) {
					 	$emergencyLoan->emergency_refund += $emergencyLoanRefundFee;
					 	$emergencyLoan->emergency_balance -= $emergencyLoanRefundFee;
					 	// If we cannot save this operation let's fail the entire transaction
					 	if (!$emergencyLoan->save()) {
					 		return false;
					 	}
					 } 
				}

			}
		

			$refund['adhersion_id']		= $refundMember->adhersion_id;
			$refund['contract_number']	= $loan->loan_contract;
			$refund['month']			= $this->getMonth() ?:'N/A';
			$refund['amount']			= $refundMember->refund_fee;
			$refund['tranche_number']	= $loan->tranches_number;
			$refund['transaction_id']	= $transactionId;
			$refund['member_id']		= $refundMember->id;
			$refund['user_id']			= Sentry::getUser()->id;
			$refund['loan_id']			= $loan->id;
			$refund['wording']			= $this->getWording();
			$refund['refund_type']		= $this->getRefundType();

			# try to save if it doesn't work then
			# exist the loop
			$newRefund = $this->refund->create($refund);
			if (!$newRefund) {
				return false;
			}


			// If the loan we are paying for has cautionneur, then make sure
			// We are update our member cautionneur table by adding the
			// amount paid by this member to the refund amount as long 
			// as cautionneur still have a balance
			
			$loanCautions = $this->memberLoanCautionneur
								 ->byTransaction($loan->transactionid)
								 ->byAdhersion($refundMember->adhersion_id)
								 ->byLoanId($loan->id)
								 ->Active()
								 ->get();


            // If we have cautionneurs then divide equally the amount of 
            // money to deposit on each person as be current payment
            // before we record it.								 

			if (!$loanCautions->isEmpty()) {	
            	$cautionneurAmount  = $newRefund->amount / $loanCautions->count();

            	// Ilitarate all cautions and save them one by one
            	foreach ($loanCautions as $loanCaution) {
            		// First get the loan balance, and if we want to pay more than
            		// the remaining balance, let it be exact the remaining 
            		// balance as per law we only need to set what the 
            		// cautionneur has issued out.
            		
            		if ($cautionneurAmount > $loanCaution->balance) {
            			$loanCaution->refunded_amount  += $loanCaution->balance;
            		}
            		else
            		{
            			$loanCaution->refunded_amount += $cautionneurAmount;
            		}

            		// If we cannot save then fail this transaction

            		if (!$loanCaution->save()) {
            			return false;
            		}

            	}
			}

		}

		return true;
	}

	/**
	 * Save posting to the database
	 * @param  STRING $transactionId UNIQUE TRANSACTIONID
	 * @return bool
	 */
	private function savePostings($transactionId) {

		// First prepare data to use for the debit account
		// Once are have debited(deducted data) then we can
		// Credit the account to be credited
		$posting['transactionid'] = $transactionId;
		$posting['account_id'] = $this->getDebitAccount();
		$posting['journal_id'] = 1; // We assume per default we are using journal 1
		$posting['asset_type'] = null;
		$posting['amount'] = $this->getTotalRefunds();
		$posting['user_id'] = Sentry::getUser()->id;
		$posting['account_period'] = date('Y');
		$posting['transaction_type'] = 'debit';
		$posting['wording']			 = $this->getWording();
		$posting['status']			 = 'approved';

		// Try to post the debit before crediting another account
		$debiting = $this->posting->create($posting);


		// Change few data for crediting
		// Then try to credit the account too
		$posting['transaction_type'] = 'credit';
		$posting['account_id'] = $this->getCreditAccount();

		$crediting = $this->posting->create($posting);

		if (!$debiting || !$crediting) {
			return false;
		}
		// Ouf time to go to bed now
		return true;
	}
	/**
	 * Get Total Refunds fees
	 * @return decimal montly fees
	 */
	public function getTotalRefunds() {
		$sum = 0;
		$members = $this->getRefundMembers();
		foreach ($members as $member) {
			$sum += $member->refund_fee;
		}
		return $sum;
	}

	/**
	 * Remove one member from current contribution session
	 * 
	 * @param  numeric $memberId
	 * @return void
	 */
	public function removeMember($adhersion_number)
	{
      $adhersion_number = (int) $adhersion_number;

      $members = $this->getRefundMembers();

      $filtered = array_filter($members, function($member) use($adhersion_number){
      	 if ($member['adhersion_id'] == $adhersion_number) {
	  	  	 flash()->warning($member['first_name'].' '.$member['last_name'].'('.$adhersion_number.')'.trans('refund.has_been_removed_from_current_contribution_session'));
	  	  	return false;
	  	  }

	  	  return $member;
      });


	  $this->setRefundMembers($filtered);	
	}

	/**
	 * Set members who are about to refund
	 * @param array $members
	 */
	public function setRefundMembers(array $members) {
		Session::put('refundMembers', $members);
	}
	/**
	 * Get members who are refunding
	 * @return array
	 */
	public function getRefundMembers() {
		return Session::get('refundMembers', []);
	}

	/**
	 * Remove members who are refunding from the session
	 * @return void
	 */
	public function removeRefundMembers() {
		Session::forget('refundMembers');
	}

	public function setRefundType($refundType)
	{
		Session::put('refundType', $refundType);
	}

	public function getRefundType()
	{
		return Session::get('refundType',null);
	}

	public function removeRefundType()
	{
		Session::forget('refundType');
	}
	/**
	 * Set Month of transactions
	 * @param string composed by  $month and Year
	 */
	public function setMonth($month) {
		Session::put('refundMonth', $month);
	}
	/**
	 * Get the stoed month in the session
	 * @return [type] [description]
	 */
	public function getMonth() {
		return Session::get('refundMonth');
	}

	/**
	 * Remove refund month from the session
	 * @return void
	 */
	public function removeMonth() {
		Session::forget('refundMonth');
	}
	/**
	 * Set debit account ID
	 * @param integer $accountid
	 */
	public function setDebitAccount($accountid) {
		Session::put('refundDebitAccount', $accountid);
	}
	/**
	 * Set Credit account
	 * @param  $accountid
	 */
	public function setCreditAccount($accountid) {
		Session::put('refundCreditAccount', $accountid);
	}
	/**
	 * get Debit account
	 * @return numeric account ID
	 */
	public function getDebitAccount() {

		$defaultDebitAccount	=  DefaultAccount::with('accounts')->debit()->refundsIndividual()->first()->accounts->first();

		// If we have many members then it's not individual refund
		// Let's change the default account
		if (count($this->getRefundMembers()) > 1) {
			$defaultDebitAccount	=  DefaultAccount::with('accounts')->debit()->RefundsBatch()->first()->accounts->first();
		}

		return Session::get('refundDebitAccount', $defaultDebitAccount->id);
	}
	/**
	 * Get Credit Account
	 * @return numeric unique
	 */
	public function getCreditAccount() {

		$defaultCreditAccount	=  DefaultAccount::with('accounts')->credit()->refundsIndividual()->first()->accounts->first();
		// If we have many members then it's not individual refund
		// Let's change the default account
		if (count($this->getRefundMembers()) > 1) {
			$defaultDebitAccount	=  DefaultAccount::with('accounts')->credit()->refundsBatch()->first()->accounts->first();
		}

		return Session::get('refundCreditAccount', $defaultCreditAccount->id);
	}
	/**
	 * Remove debit account
	 * @return void
	 */
	public function removeDebitAccount() {
		Session::forget('refundDebitAccount');
	}
	/**
	 * Remove credit account from the session
	 * @return void
	 */
	public function removeCreditAccount() {
		Session::forget('refundCreditAccount');
	}
	/**
	 * Set the institution
	 * @param mixed $institutionId
	 */
	public function setInstitution($institutionId) {
		 Session::put('refundInstitution', $institutionId);
	}
	/**
	 * get the current Refund institutions
	 * @return ID
	 */
	public function getInstitution() {
		return Session::get('refundInstitution'); // We assume institution 1 is dhe default one
	}
	/**
	 * Remove institution from the session
	 * @return void
	 */
	public function removeInstitution() {
		Session::forget('refundInstitution');
	}
/**
	 * Set wording for the current contribution
	 * 
	 * @param void
	 */
	public function setWording($wording)
	{
		Session::put('refund_wording', $wording);
	}

	/**
	 * Get wording for current contributionsession
	 * 
	 * @return string
	 */
	public function getWording()
	{
		return Session::get('refund_wording', null);
	}

	/**
	 * Remove wording from the session
	 * @return [type] [description]
	 */
	public function forgetWording()
	{
		Session::forget('refund_wording');
	}
	/**
	 * Cancel transaction that is ongoin
	 * @return  void
	 */
	public function cancel() {
		$this->clearAll();
	}

	/**
	 * Remove all things from the session;
	 * @return [type] [description]
	 */
	private function clearAll() {
		$this->removeRefundMembers();
		$this->removeMonth();
		$this->removeInstitution();
		$this->removeDebitAccount();
		$this->removeCreditAccount();
		$this->forgetWording();
		$this->removeRefundType();
	}

}