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

class RegularisationController extends Controller
{
    function __construct(Loan $loan, User $member,RegularisactionViewComposer $regularisations) {
        $this->loan = $loan;
        $this->member = $member;
        $this->regularisationsTypes = $regularisations->getRegularisationTypes();
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->show(null);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id = null)
    {
          // First check if the user has the permission to do this
        if (!$this->user->hasAccess('regularisation.view')) {
            flash()->error(trans('Sentinel::users.noaccess'));

            return redirect()->back();
        }

        // First log 
        Log::info($this->user->email . ' is viewing regularisation');
        
        $previousUrl = new Collection(explode('/',URL::previous()));
    
        // Determine which regularisation  type
        if (is_null($regularisationType = request()->segment(3))) {
            $regularisationType = strtolower($previousUrl->last());
        }

        ////////////////////////////////////////////////////////////////////
        // If we cannot determine the regulation type then show dashboard //
        ////////////////////////////////////////////////////////////////////

        if (!array_key_exists($regularisationType,$this->regularisationsTypes)) {
            return redirect()->route('regularisation.types');
        }

        $member = null;
        $loan   = null;
       // If passed id is not null and it is numeric try to get the member
       if (!is_null($id) && is_numeric($id)) 
       {  
        $member =  $this->member->findOrFail($id);
        $loan  = $member->latestLoan();
        $rightToLoan = $member->right_to_loan;

        if ($member->has_active_loan == false) {
            flash()->warning(trans('regularisation.this_member_doesnot_have_loan_to_regulate'));
            return redirect()->back();
        }

        ///////////////////////////////////////////////////////////////////////
        // If this member has 0 right to loan then we cannot regulate amount //
        ///////////////////////////////////////////////////////////////////////

        if ($rightToLoan == 0 && (strpos(strtolower($regularisationType),'amount') !==false) ) {
            flash()->warning(trans('regularisation.this_member_has_0_remaining_right_to_loan'));
            return redirect()->back();
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
    public function update(RegularisationRequest $request,RegularisationFactory  $regularisationFactory,$loanid)
    {
        try {
            $regularisationFactory->complete($request->all());
        } catch (Exception $e) {
            flash()->error($e->getMessage());
        }

        return $this->index();
    }


    /**
     * Show types of regularisation
     * @return view
     */
    public function regurationTypes()
    {
        return view('regularisation.regularisationstype');
    }
}
