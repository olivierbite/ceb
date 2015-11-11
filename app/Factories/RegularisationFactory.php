<?php 

namespace Ceb\Factories;

use Cartalyst\Sentry\Facades\Laravel\Sentry;
use Ceb\Models\Contribution;
use Ceb\Models\Loan;
use Ceb\Models\LoanRate;
use Ceb\Models\LoanRegulationsBackup;
use Ceb\Models\User;
use Illuminate\Support\Facades\DB;

/**
* Regularisaction Factory
*/
class RegularisationFactory
{
	
	function __construct(User $member,Contribution $contribution, Loan $loan,LoanRate $loanRate)
	{
		$this->member 		= $member;
		$this->contribution = $contribution;
		$this->loan			= $loan;
		$this->loanRate     = $loanRate;
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

		switch (strtolower($data['regularisationType'])) {
			case 'installments':
				return $this->regulateInstallaments($data,$member);
				break;
			case 'amount':
				return $this->regulateAmount($data,$member);
				break;
			case 'amount_installments':
				return $this->regulateAmount($data,$member);
				break;
			default:
				throw new Exception(trans('regularisation.unable_to_determine_which_kind_of_regularisation_you_want_to_perform'), 1);
				break;
		}

		// If we reach here it is because we have an error
		throw new Exception(trans('regularisation.error_occured_while_trying_to_complete_regularisation'), 1);
		
	}


	/**
	 * Regulare installements
	 * @param  string $value
	 * @return true / false;
	 */
	public function regulateInstallaments($data,$member)
	{
		$loanToRepay = $member->loan_balance;
		$numberOfInstallment = $member->remaining_tranches + $data['additional_installments'];
		$calculateLoanDetails = $this->getLoanDetails($numberOfInstallment, $loanToRepay);
		$administrationFees   = 0;

		// Let's remove administration fees if it was applied
		if (isset($data['administration_fees'])) {
			$administrationFees = $loanToRepay - ($loanToRepay * $data['administration_fees']);
			// Make sure we remove this administration fees
			$calculateLoanDetails['net_to_receive'] -= $administrationFees;
		}
        

		// Start saving if something fails cancel everything
		DB::beginTransaction();

		$toRegulateLoan 						 =  Loan::find((int) $data['loan_id']);

		// Start by doing backup
		LoanRegulationsBackup::unguard();
			$loanBackup = LoanRegulationsBackup::create($toRegulateLoan->toArray());
		LoanRegulationsBackup::reguard();

		$toRegulateLoan->movement_nature 		 = 'regularisation_'.$data['regularisationType'];
		$toRegulateLoan->interests 	     		 =	round($calculateLoanDetails['interests']);
		$toRegulateLoan->amount_received 	     =	round($calculateLoanDetails['net_to_receive']);
		$toRegulateLoan->monthly_fees 	     	 =	round($loanToRepay / $numberOfInstallment,0);
		$toRegulateLoan->tranches_number 		 =  $numberOfInstallment;
		$toRegulateLoan->user_id                 =  $this->user->id;
		$toRegulateLoan->urgent_loan_interests   =  $administrationFees;
		$toRegulateLoan->rate 					 =  $calculateLoanDetails['interest_rate'];
		$toRegulateLoan->reason                  =  'regularisation_'.$data['regularisationType'];

		$results = $toRegulateLoan->save();

		if ( $results == false) {
			throw new Exception(trans('regularisation.error_occured_while_trying_to_regulate_this_installment_regulation'), 1);		
		}

		// Now we can generate
		$toRegulateLoan->contract 				 =  generateContract($member,$toRegulateLoan->operation_type);
		$toRegulateLoan->save();

	    // Rollback the transaction via if one of the insert fails
		if (!$loanBackup  || !$results) {
			DB::rollBack();
			return false;
		}
		// Lastly, Let's commit a transaction since we reached here
		DB::commit();
		flash()->success(trans('regularisation.you_have_successfully_done_loan_installment_regulation'));
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
 