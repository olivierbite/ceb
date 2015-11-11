<?php 

namespace Ceb\Factories;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Ceb\Models\Contribution;
use Ceb\Models\Loan;
use Ceb\Models\LoanRate;
use Ceb\Models\LoanRegulationsBackup;
use Ceb\Models\Posting;
use Ceb\Models\User;
use Ceb\Traits\TransactionTrait;
use Exception;
use Illuminate\Support\Facades\DB;

/**
* Regularisaction Factory
*/
class RegularisationFactory
{
	use TransactionTrait;
	
	function __construct(User $member,Contribution $contribution, Loan $loan,LoanRate $loanRate,Posting $posting)
	{
		$this->member 		= $member;
		$this->contribution = $contribution;
		$this->loan			= $loan;
		$this->loanRate     = $loanRate;
		$this->posting 		= $posting;
		$this->user 		= Sentry::getUser();
	}

	/**
	 * Complete regularisationi process
	 * @param  array  $data
	 * @return true / false
	 */
	public function complete(array $data)
	{
		$member = $this->member->byAdhersion($data['adhersion_id'])->first();

		if (is_null($member)) {
			throw new Exception(trans('member.member_doesnot_exist'), 1);
		}

		return $this->regulateLoan($data,$member);
		
	}


	/**
	 * Regulare installements
	 * @param  string $value
	 * @return true / false;
	 */
	public function regulateLoan($data,$member)
	{
		$loanToRepay = $member->loan_balance;
		/** If we have loan to repay, then this is regulation for amount */
		if(isset($data['loan_to_repay']) && (strpos(strtolower($data['regularisationType']),'amount') !==false) ) {
			$loanToRepay +=$data['loan_to_repay'];
		}

		$numberOfInstallment = $member->remaining_tranches;
		/** If we have installments in the regulationtype then  we assume this has to deal with installment */
		if (isset($data['additional_installments']) && (strpos(strtolower($data['regularisationType']),'installments') !==false)) {
		    $numberOfInstallment +=$data['additional_installments'];
		}

		$calculateLoanDetails = $this->getLoanDetails($numberOfInstallment, $loanToRepay);
		$administrationFees   = 0;

		// Let's remove administration fees if it was applied
		if (isset($data['administration_fees'])) {
			$administrationFees = $loanToRepay - ($loanToRepay * $data['administration_fees']);
			// Make sure we remove this administration fees
			$calculateLoanDetails['net_to_receive'] -= $administrationFees;
		}
        
        $transactionId = $this->getTransactionId();

		// Start saving if something fails cancel everything
		DB::beginTransaction();

		$toRegulateLoan 						 =  Loan::find((int) $data['loan_id']);

		// Start by doing backup
		LoanRegulationsBackup::unguard();
			$backup = $toRegulateLoan->toArray();
			unset($backup['id']);
			$loanBackup = LoanRegulationsBackup::create($backup);
		LoanRegulationsBackup::reguard();

		$toRegulateLoan->movement_nature 		 = 'regularisation_'.$data['regularisationType'];
		$toRegulateLoan->interests 	     		 =	round($calculateLoanDetails['interests']);
		$toRegulateLoan->amount_received 	     =	round($calculateLoanDetails['net_to_receive']);
		$toRegulateLoan->monthly_fees 	     	 =	round($loanToRepay / $numberOfInstallment,0);
		$toRegulateLoan->tranches_number 		 =  $numberOfInstallment;
		$toRegulateLoan->user_id                 =  $this->user->id;
		$toRegulateLoan->transactionid 			 = 	$toRegulateLoan->transactionid.'_'.$data['regularisationType'];
		$toRegulateLoan->urgent_loan_interests   =  $administrationFees;
		$toRegulateLoan->rate 					 =  $calculateLoanDetails['interest_rate'];
		$toRegulateLoan->reason                  =  'regularisation_'.$data['regularisationType'];
		$toRegulateLoan->comment   				 =  $data['wording'];
		$toRegulateLoan->contract 				 =  '';

		if(isset($data['loan_to_repay']) && (strpos(strtolower($data['regularisationType']),'amount') !==false) ) {
			$toRegulateLoan->loan_to_repay       =  $loanToRepay;
			$toRegulateLoan->right_to_loan      -=  $loanToRepay;

			dd($data['loan_to_repay']);
			// Record accounting too
			$posting = $this->savePostings($toRegulateLoan->transactionid,$data);

			// Fail this transaction if the posting didn't go well.
			if (!$posting) {
				DB::rollBack();
				return false;
				}
		}

		$results = $toRegulateLoan->save();

		
	    // Rollback the transaction via if one of the insert fails
		if (!$loanBackup  || !$results) {
			DB::rollBack();
			return false;
		}

		// Lastly, Let's commit a transaction since we reached here
		DB::commit();

		return true;
	}


	/**
	 * Save posting to the databasee
	 * @param  STRING $transactionId UNIQUE TRANSACTIONID
	 * @return bool
	 */
	public function savePostings($transactionId,$data) {
		// Start by validating the information we
		// are about to svae in our database
		// Debiting amount
		$debits = $this->accountAmount($data['debit_accounts'],$data['debit_amounts']);

		$wording = $data['wording'];
		$cheque_number=$data['cheque_number'];
		$bank=$data['bank_id'];

		foreach ($debits as $accountId => $amount) {
			$results = $this->savePosting($accountId, $amount, $transactionId, 'Debit', $journalId = 1,$wording,$cheque_number,$bank);
			if (!$results) {
				return false;
			}
		}

		//Crediting
		$credits = $this->accountAmount($data['credit_accounts'],$data['credit_amounts']);

		foreach ($credits as $accountId => $amount) {

			$results = $this->savePosting($accountId, $amount, $transactionId, 'Credit', $journalId = 1,$wording,$cheque_number,$bank);
			if (!$results) {
				return false;
			}
		}
		// We are safe here
		return true;
	}

	/**
	 * Get new loan details after calculations
	 * ==========================================================================================
	 * Interest formular
	 * =================
	 * The formular to calculate interests at ceb is as following
	 * I =  P *(TI * N)
	 *     ------------
	 *     1200 + (TI*N)
	 *
	 * Where :   I : Interest
	 *           P : Amount to Repay
	 *           TI: Interest Rate
	 *           N : Montly payment
	 * LoanToRepay * (InterestRate*NumberOfInstallment) / 1200 +(InterestRate*NumberOfInstallment)
	 * ============================================================================================
	 * @param  numeric $numberOfInstallment number of installment to pay
	 * @param  numeric $loanToRepay         amount to pay
	 * @return array                      
	 */
	public function getLoanDetails($numberOfInstallment,$loanToRepay)
	{
		// Interest formular
		// The formular to calculate interests at ceb is as following
		// I =  P *(TI * N)
		//     ------------
		//     1200 + (TI*N)
		//
		// Where :   I : Interest
		//           P : Amount to Repay
		//           TI: Interest Rate
		//           N : Montly payment
		// LoanToRepay * (InterestRate*NumberOfInstallment) / 1200 +(InterestRate*NumberOfInstallment)


		// Get number of installement
		$interestRate = (float) $this->loanRate->rate($numberOfInstallment,$numberOfInstallment);

		$interests = ($loanToRepay * ($interestRate * $numberOfInstallment)) / (1200 + ($interestRate * $numberOfInstallment));

		return [
			'net_to_receive' => $loanToRepay - $interests,
			'interests'		 => $interests,
			'interest_rate'  => $interestRate,

		];
	}
}
 