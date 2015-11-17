<?php

namespace Ceb\Http\Controllers;

use Ceb\Factories\RegularisationFactory;
use Ceb\Http\Controllers\Controller;
use Ceb\Http\Requests;
use Ceb\Http\Requests\RegularisationRequest;
use Ceb\Models\Loan;
use Ceb\Models\User;
use Ceb\ViewComposers\RegularisactionViewComposer;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class RegularisationController extends Controller
{
    function __construct(Loan $loan, User $member,RegularisactionViewComposer $regularisations) {
        $this->loan = $loan;
        $this->member = $member;
        $this->regularisationsTypes = $regularisations->getregularisationTypes();
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {   
        $id = null;
        $regularisationstype = null;
        if (old('member_id')) {
            $id = old('member_id');
            $regularisationstype = old('regularisationType');
        }
        return $this->show($id,$regularisationstype);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id = null,$regularisationType = null)
    {
           // First check if the user has the permission to do this
            if (!$this->user->hasAccess('regularisation.index')) {
                flash()->error(trans('Sentinel::users.noaccess'));
                return redirect()->back();
            }
      // First check if the user has the permission to do this
        if (!$this->user->hasAccess('regularisation.view')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing regularisation');

        $regularisationType = is_null($regularisationType) ? $this->getregularisationType() : $regularisationType;

        ////////////////////////////////////////////////////////////////////
        // If we cannot determine the regulation type then show dashboard //
        ////////////////////////////////////////////////////////////////////
        
        if (array_key_exists($regularisationType,$this->regularisationsTypes) == false) {
            return redirect()->route('regularisation.types');
        }

        // dd($regularisationType);
        $member = null;
        $loan   = null;
        $rightToLoan        = null;
       // If passed id is not null and it is numeric try to get the member
       if (!is_null($id) && is_numeric($id)) 
       {  

        $member =  $this->member->findOrFail($id);
        $loan  = $member->latestLoan();
          // dd($member);
        $rightToLoan = $member->more_right_to_loan_amount;

 
        if ($member->has_active_loan == false) {
            flash()->warning(trans('regularisation.this_member_doesnot_have_loan_to_regulate'));
            $member = null;
            $loan   = null;
            $rightToLoan = null;
        }

        ///////////////////////////////////////////////////////////////////////
        // If this member has 0 right to loan then we cannot regulate amount //
        ///////////////////////////////////////////////////////////////////////

        if ($rightToLoan == 0 && (strpos(strtolower($regularisationType),'amount') !==false) ) {
            flash()->warning(trans('regularisation.this_member_has_0_remaining_right_to_loan'));
        }
       }
       return view('regularisation.index',compact('loan','member','regularisationType','rightToLoan'));
    }

    /**
     * Regulating a loan
     * @param  RegularisationRequest $request 
     * @param  $loanid  
     * @return                
     */
    public function regulate(Request $request,RegularisationFactory  $regularisationFactory)
    {
       
       /**
        * Check if the user has the right to do this first
        */
       if (array_key_exists($request->get('regularisationType'),$this->regularisationsTypes) == false)
       {
          flash()->warning(trans('general.we_could_not_determine_what_you_are_looking_for'));
          return redirect()->route('regularisation.types');
       }

       if ($request->get('regularisationType') == 'installments' ) { 
               // First check if the user has the permission to do this
            if (!$this->user->hasAccess('regularisation.installments')) {
                flash()->error(trans('Sentinel::users.noaccess'));
                return redirect()->back();
            }
       }
      
      elseif ($request->get('regularisationType') == 'amount' ) { 
               // First check if the user has the permission to do this
            if (!$this->user->hasAccess('regularisation.amount')) {
                flash()->error(trans('Sentinel::users.noaccess'));
                return redirect()->back();
            }
       }

       elseif ($request->get('regularisationType') == 'amount_installments' ) { 
               // First check if the user has the permission to do this
            if (!$this->user->hasAccess('regularisation.amount.installments')) {
                flash()->error(trans('Sentinel::users.noaccess'));
                return redirect()->back();
            }
       }


        $rules = $this->rules($request->all());
        $data  = $this->all($request->all());

        $validator = Validator::make($data,$rules);

        if ($validator->fails()) {
            return redirect()->route('regularisation.index')
                        ->withErrors($validator)
                        ->withInput();;
        }

       if ($regularisationFactory->complete($request->all())) {
           flash()->success(trans('regulation.completed_'.$request->get('regularisationType').'_regulation_successfully'));
       }
       else
       {
           flash()->error(trans('regulation.could_not_complete_'.$request->get('regularisationType').'_regularisation_because_an_error_has_occured'));
       }
       return redirect()->route('regularisation.types');
    }


    /**
     * Show types of regularisation
     * @return view
     */
    public function regurationTypes()
    {
        return view('regularisation.regularisationstype');
    }

    /**
     * Determine loan type
     * 
     * @return string
     */
    private function getregularisationType()
    {
        $previousUrl = explode('/',URL::previous());
        
        // Determine which regularisation  type
        $regularisationType = request()->segment(3);

        if (is_null($regularisationType) ) {
             if (!empty(old('regularisationType'))) {
                return old('regularisationType');
             }
             elseif (request()->has('regularisationType') &&  !empty(request()->get('regularisationType'))) {
                 return  request()->get('regularisationType');
             }
             else
             {
                foreach ($previousUrl as $key => $value) {
                     if (array_key_exists($value,$this->regularisationsTypes) == true) {
                        return $value;
                    }
                }
             }
        }

        return $regularisationType;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($attributes)
    {
        $attributes = $this->all($attributes);

       
        $rightToLoan = 0 ;
        $member      = null;

        if (isset($attributes['adhersion_id'])) {
          $member = $this->member->findByAdhersion($attributes['adhersion_id']);
        }

        if (!is_null($member)) {
          $rightToLoan = $attributes['member']['right_to_loan'];
        }


      $validations = [
          'adhersion_id'          =>  'required|min:4',
          'loan_id'               =>  'required|numeric',
          'regularisationType'    =>  'required|min:3',
          'wording'               =>  'required|min:6',
        ];
      
       /**
       * If this regularisation needs to deal with installments
       */
       if (strpos(strtolower($attributes['regularisationType']), 'installments')  !== false ) { 
          $validations['additional_installments'] = 'required|numeric|min:1';
       }

      /**
       * If this regularisation needs to deal with money
       */
      if (strpos(strtolower($attributes['regularisationType']), 'amount')  !== false ) { 
        $validations['loan_to_repay']         =  'required|numeric|max:'.$rightToLoan;
        $validations['cheque_number']         =  'required|alpha_dash|min:5';
        $validations['bank_id']               =  'required|min:1';
        $validations['accounting_amount']     =  'required|confirmed|numeric|min:'.$attributes['loan_to_repay'];
        $validations['loanaccountamount']     =  'required|confirmed|numeric';
        $validations['accounts']              =  'confirmed';
      }

      //Continue with Rule validation
      return  $validations;
    }

    /**
     * Modifying input before validation
     * @return array
     */
    public function all($attributes)
    {
        /** We don't have to continue if regularisation type is installment */
        if (strtolower($attributes['regularisationType']) === 'installments') {
            return $attributes;
        }

        // Modify or Add new array key/values
        // ==================================
        // Make sure these fields are numeric
         $attributes['loan_to_repay']  = isset($attributes['loan_to_repay'])?  intval($attributes['loan_to_repay']):null ;

         if ($attributes['loan_to_repay'] > 0 ) {
            // Validating account amount
            $attributes['accounting_amount'] = array_sum($attributes['debit_amounts']);
            $attributes['accounting_amount_confirmation'] = array_sum($attributes['credit_amounts']);
            
            // Validate total amount vs Account amount   
            $attributes['loanaccountamount'] = $attributes['loan_to_repay'];
            $attributes['loanaccountamount_confirmation'] = $attributes['accounting_amount_confirmation'];

            // Validate bank
            $attributes['bank'] = $attributes['bank_id'];
        
         

            // Validate the input accounts 
            $accounts = array_intersect($attributes['credit_accounts'], $attributes['debit_accounts']);
            if (count($accounts) > 0) {    
                $attributes['accounts']              = count($accounts);
                $attributes['accounts_confirmation'] = 0;
            }
        }

        // Format/sanitize data here
        return $attributes;
    }
}
