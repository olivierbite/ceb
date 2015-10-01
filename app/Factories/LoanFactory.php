<?php
namespace Ceb\Factories;
use Ceb\Models\Loan;
use Ceb\Models\Posting;
use Ceb\Models\User;
use Ceb\Traits\TransactionTrait;
use Datetime;
use DB;
use Illuminate\Support\Facades\Session;
use Sentry;
use Validator;

/**
 * This factory helps Contribution
 */
class LoanFactory {
	use TransactionTrait;
	protected $errors;
	/**
	 * Loan validadtion rules
	 * @var array
	 */
	protected $loanRules =  [
        'loan_to_repay' => 'required',
        'cheque_number' => 'required'
    ];

	function __construct(Session $session, User $member, Loan $loan, Posting $posting) {
		$this->session = $session;
		$this->member = $member;
		$this->loan = $loan;
		$this->posting = $posting;
	}

	/**
	 * Are the data we are trying to validator okay?
	 * @param  array $data
	 * @return bool this returns true if the data is valid
	 */
	public function isValidLoanData($data) {

		$validator = Validator::make($data,$this->loanRules);
		if($validator->fails()){
			$this->errors = implode($validator->errors()->all());
			return false;
		}
		// For us to reach here it's because the validation passed
		return true;
	}
	/**
	 * Add member to is going to receive loan
	 * @param integer $memberId ID of the member to add to the session
	 */
	function addMember($memberId) {
		$member = $this->member->find($memberId);

		// Detect if this member is not more than 6 months
		// as per de definition of CEB
		if (!$this->isEligeable($member)) {
			flash()->error(trans('loan.error_member_has_to_be_at_least_6_months_in_ceb'));
			return false;
		}

		Session::put('loan_member', $member);
		$this->updateCautionneur();
	}

	/**
	 * Get member who is going to receive the loan
	 * @return  get member information that are currently in the session
	 */
	function getMember() {
		return Session::get('loan_member', new $this->member);
	}

	/**
	 * Add loan input in the session
	 * @param  array  $data containing loan input data
	 * @return void
	 */
	public function addLoanInput(array $data) {
		// First get the existing loan inputs
		$loanInputsData = $this->getLoanInputs();

		// Add the submitted one before saving
		foreach ($data as $key => $value) {
			$loanInputsData[$key] = $value;
		}

		Session::put('loanInputs', $loanInputsData);
	}

	/**
	 * Remove one item in the loan input
	 */
	public function removeLoanInput($arrayKey)
	{
		// First get the existing loan inputs
		$loanInputsData = $this->getLoanInputs();

		// Add the submitted one before saving
		foreach ($loanInputsData as $key => $value) {
			if ($key == $arrayKey) {
				unset($loanInputsData[$key]);
				break;
			}
		}
		Session::put('loanInputs', $loanInputsData);
	}

	/**
	 * Get current loan input fields
	 * @return array
	 */
	public function getLoanInputs() {
		return Session::get('loanInputs', []);
	}
	/**
	 * Set new cautionneur
	 * @param array $cautionneur
	 */
	public function setCautionneur(array $cautionneur) {
		$arrayKey = array_keys($cautionneur)[0];
		$cautionneurId = array_values($cautionneur)[0];
		$cautionneurs = $this->getCautionneurs();

		$cautionneurs[$arrayKey] = $this->member->findByAdhersion($cautionneurId);

		if ($cautionneurs[$arrayKey] == null) {
			flash()->error(trans('loan.adhersion_number_you_are_looking_for_cannot_be_found'));
			// Nothing to do here
			return false;
		}
		// Make sure the selected cautionneur is not
		// same as the member
		if ($cautionneurs[$arrayKey]->id == $this->getMember()->id) {
			flash()->error(trans('loan.cautionneur_should_not_be_the_same_as_the_member_requesting_loan'));
			return false;
		}
		// Add this to loan input
		$this->addLoanInput([$arrayKey=>$cautionneurs[$arrayKey]->id]);

		flash()->success(trans('loan.cautionneur_has_been_added_successfully'));
		Session::put('cautionneurs', $cautionneurs);
	}

	/**
	 * Remove cautionneur from the sessoin
	 * @param  string $cautionneur
	 * @return mixed
	 */
	public function removeCautionneur($cautionneur) {
		$cautionneurs = $this->getCautionneurs();
		// Remove the cautionneur
		unset($cautionneurs[$cautionneur]);
        $this->removeLoanInput($cautionneur);
		flash()->success(trans('loan.cautionneur_removed_successfully'));
		Session::put('cautionneurs', $cautionneurs);
	}

	/**
	 * Make sure cautionneur are not same as the
	 * Selected member
	 *
	 */
	public function updateCautionneur() {
		$cautionneurs = $this->getCautionneurs();

		foreach ($cautionneurs as $key => $cautionneur) {
			if ($cautionneur->id == $this->getMember()->id) {
				unset($cautionneurs[$key]);
			}
		}
		Session::put('cautionneurs', $cautionneurs);
	}
	/**
	 * Get cautionneurs set
	 * @return  array of cautionneur
	 */
	public function getCautionneurs() {
		return Session::get('cautionneurs', []);
	}

	/**
	 * Setting the debit accounts and their value
	 *
	 * @param void
	 */
	public function setDebitsAccounts(array $debits, array $amounts) {
		Session::put('debitaccounts', $this->accountAmount($debits, $amounts));
	}
	/**
	 * Get the debit accounts
	 * @return array of debit account and their amount
	 */
	public function getDebitAccounts() {
		return Session::get('debitaccounts', []);
	}

	/**
	 * Setting Credit accounts in the sessions
	 * @param array $credits contains the IDs of the accounts to be credited
	 * @param array $amounts contains the amount of money to be credited per account
	 *
	 * @return void
	 */
	public function setCreditAccounts(array $credits, array $amounts) {
		Session::put('creditaccounts', $this->accountAmount($credits, $amounts));
	}

	/**
	 * Get the credit accounts and their correspondent amount
	 * @return array of the credit account and their correspondent amount
	 */
	public function getCreditAccounts() {
		return Session::get('creditaccounts', []);
	}

	/**
	 * Remove credit accounts from the sessoin
	 * @return void
	 */
	public function removeCreditAccounts() {
		Session::forget('creditaccounts');
	}
	/**
	 * Remote debit accounts and their amount from the session
	 * @return void
	 */
	public function removeDebitAccounts() {
		Session::forget('debitaccounts');
	}

	public function setOperationType($operation_type)
	{
		return Session::set('operation_type', $operation_type);
	}
	/**
	 * Get the operation type of this loan
	 * @return string the operation type of this loan
	 */
	public function getOperationType() {
		return isset($this->getLoanInputs()['operation_type'])?$this->getLoanInputs()['operation_type']:'ordinary_loan';
	}

	/**
	 * Complete current loan transaction
	 * @return bool
	 */
	public function complete() {

		// 1. First record the loan
		$transactionId = $this->getTransactionId();
		$this->calculateLoanDetails();

		// Start saving if something fails cancel everything
		Db::beginTransaction();

		// 1. Save loans first
		$saveLoan = $this->saveLoan($transactionId);

		// 2. Debit and credit accounts
		$savePosting = $this->savePostings($transactionId);
		// Rollback the transaction via if one of the insert fails
		if (!$saveLoan || !$savePosting) {
			DB::rollBack();
			return false;
		}
		// Lastly, Let's commit a transaction since we reached here
		DB::commit();
        
        $contractId = $this->makeContract($saveLoan);
		// Since we are done let's make sure everything is cleaned fo
		// the next transaction
		$this->clearAll();
		return $contractId;

	}

	/**
	 * Generate contract 
	 * @param  loanId $value 
	 * @return view   
	 */
	public function makeContract($loan)
	{
		// Refresh the member information
		$member = $this->member->find($this->getMember()->id);
	    $loan = $this->loan->find($loan->id);	
		$operation_type = $this->getOperationType();

		switch ($operation_type) {
			case (strpos($operation_type,'ordinary_loan') !== FALSE):
			     // Ordinary loan
				 $contract = view('reports.contracts_loan_ordinary', compact('member'))->render();
				break;
			case 'special_loan':
				// Special loan	
			    $contract = view('reports.contracts_loan_special', compact('member'))->render();
				break;
			case 'social_loan':
				// Social loan.			
			    $contract = view('reports.contracts_loan_social', compact('member'))->render();
				break;
			default:
				// Could not detect the contract
				$contracts = 'Unable to determine the contract type';
				break;
		}

		$loan->contract = $contract;
		$loan->save();		
		return $loan->id;
	}

	/**
	 * Save loan in postings for the accounting purpose
	 * @param  string $transactionid unique transactionId
	 * @return bool
	 */
	public function saveLoan($transactionid) {
		// First refresh the data and validate them
		// if the data are not validated we will recieve false
		if (!$this->calculateLoanDetails(true)) {
			// We have nothing to do here, First return false with
			// Error that says information provided is not correct
			 flash()->error(trans('loan.loan_information_seem_not_to_be_correct').' because '.$this->errors);
			// dd($errors);

			return false;
		}

		// If we reach here it means data are valid, therefore let's try
		// to continue processing the saving activity
		$inputs = $this->getLoanInputs();

		$member = $this->getMember();

		// Prepare information to be saved in the database
		$data['transactionid'] = $transactionid;
		$data['loan_contract'] = $this->getContributionContractNumber();
		$data['adhersion_id'] = $member->adhersion_id;
		$data['movement_nature'] = 'Giving out loan';
		$data['operation_type'] = $this->getOperationType();
		$data['letter_date'] = $this->getLetterDate();
		$data['right_to_loan'] = $inputs['right_to_loan'];
		$data['wished_amount'] = $inputs['wished_amount'];
		$data['loan_to_repay'] = $inputs['loan_to_repay'];
		$data['interests'] = $inputs['interests'];
		$data['InteretsPU'] = 0;
		$data['amount_received'] = $inputs['amount_received'];
		$data['tranches_number'] = $this->getTranschesNumber();
		$data['monthly_fees'] = $inputs['monthly_fees'];
		$data['cheque_number'] = $inputs['cheque_number'];
		$data['bank_id'] = isset($inputs['bank_id']) ? $inputs['bank_id'] : 'BK';
		$data['security_type'] = 0;
		$data['cautionneur1'] = isset($inputs['cautionneur1']) ? $inputs['cautionneur1'] : null;
		$data['cautionneur2'] = isset($inputs['cautionneur2']) ? $inputs['cautionneur2'] : null;
		$data['average_refund'] = 0;
		$data['amount_refounded'] = 0;
		$data['comment'] = 'No comment so far';
		$data['special_loan_contract_number'] = 0;
		$data['remaining_tranches'] = isset($inputs['tranches_number']) ? $inputs['tranches_number'] : 1;
		$data['special_loan_tranches'] = 0;
		$data['special_loan_interests'] = 0;
		$data['special_loan_amount_to_receive'] = 0;
		$data['user_id'] = Sentry::getUser()->id;

		return $this->loan->create($data);
	}

	/**
	 * Save posting to the database
	 * @param  STRING $transactionId UNIQUE TRANSACTIONID
	 * @return bool
	 */
	private function savePostings($transactionId) {

		// Start by validating the information we
		// are about to svae in our database
		if (!$this->isValidPosting()) {
			return false;
		}

		//Debiting....
		$debits = $this->getDebitAccounts();

		foreach ($debits as $accountId => $amount) {
			$results = $this->savePosting($accountId, $amount, $transactionId, 'Debit', $journalId = 1);
			if (!$results) {

				return false;
			}
		}

		//Crediting
		$credits = $this->getCreditAccounts();
		foreach ($credits as $accountId => $amount) {
			$results = $this->savePosting($accountId, $amount, $transactionId, 'Credit', $journalId = 1);
			if (!$results) {
				return false;
			}
		}
		// We are safe here
		return true;
	}

	/**
	 * Get number of installment to pay
	 * @return [type] [description]
	 */
	private function getTranschesNumber() {
		$loanInputs = $this->getLoanInputs();
		return $numberOfInstallment = isset($loanInputs['tranches_number']) ? $loanInputs['tranches_number'] : 1;

	}
	/**
	 * Get the letter date
	 * @return date if it's not available we assume today was the letter day
	 */
	private function getLetterDate() {
		return isset($inputs['letter_date']) ? $inputs['letter_date'] : date('Y-m-d');
	}
	/**
	 * Get loan interest
	 * @return float
	 */
	public function getInterestRate() {
		$numberOfInstallment = $this->getTranschesNumber();
		if ($numberOfInstallment > 0 && $numberOfInstallment <= 12) {return 3.4;}
		if ($numberOfInstallment > 12 && $numberOfInstallment <= 24) {return 3.6;}
		if ($numberOfInstallment > 24 && $numberOfInstallment <= 36) {return 4.1;}
		if ($numberOfInstallment > 36 && $numberOfInstallment <= 48) {return 4.3;}
		if ($numberOfInstallment>48 && $numberOfInstallment<=60 ) {return 4.8;}		
		if ($numberOfInstallment>60 && $numberOfInstallment<=72 ) {return 5;}
	}
	/**
	 * Calculate loan details
	 * @return mixed
	 */
	public function calculateLoanDetails($validation = false) {

		$loanDetails = $this->getLoanInputs();
		if ($validation && ($this->isValidLoanData($loanDetails) == false)) {
			// We have nothing to calculate therefore
			// let's just return false
			return false;
		}
      
		$loanToRepay = isset($loanDetails['loan_to_repay'])?$loanDetails['loan_to_repay']:0;
		$interestRate = $this->getInterestRate();
		$numberOfInstallment = $this->getTranschesNumber();
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

		$interests = ($loanToRepay * ($interestRate * $numberOfInstallment)) / (1200 + ($interestRate * $numberOfInstallment));

		$netToReceive = $loanToRepay - $interests;

		// Update fields
		$this->addLoanInput(['right_to_loan' => round(($loanToRepay * 2.5), 0)]);
		$this->addLoanInput(['wished_amount' => round(($loanToRepay * 2.5), 0)]);
		$this->addLoanInput(['interests' => round($interests, 0)]);
		$this->addLoanInput(['net_to_receive' => round($netToReceive, 0)]);
		$this->addLoanInput(['monthly_fees' => round(($loanToRepay / $numberOfInstallment), 0)]);
		$this->addLoanInput(['adhersion_id' => $this->getMember()->adhersion_id]);

		// Add cautionneur
		foreach ($this->getCautionneurs() as $key => $value) {
			$this->addLoanInput([$key => $value->id]);
		}
        
		return true;
		// If loan to pay is less or equal to the
		// Contributions then hide the caution section

	}

	/**
	 * Cancel all activity by clearing session
	 * @return void
	 */
	public function cancel() {
		$this->clearAll();
	}

	/**
	 * Check if this person we are trying to give
	 * Loan is eligeable for it
	 * @param  User    $user member Object
	 * @return boolean    determine if he is eligeable or not
	 */
	private function isEligeable(User $user) {
		// Check if the member has an age
		// of 6 months in CEB
		$dateDifference = date_diff($user->created_at, new Datetime);
		// Get the difference in months
		$interval = $dateDifference->format('%m');

		// Check if the months are at least 6 configured to 1 for the
		// Development purpose
		return $interval >= 1;
	}

	/**
	 * Validate if the accounts and amount per accounts
	 * are valid before saving them in the database
	 * @return boolean
	 */
	private function isValidPosting() {
		$debits = $this->getDebitAccounts();
		$credits = $this->getCreditAccounts();

		// First check if the sum of both credits
		// and Debits has same sum of amount so that
		// we can make sure that this double entry is balanced
		if (array_sum($credits) != array_sum($debits)) {
			// just exit because we have nothing to do here...
			flash()->error(trans('loan.debits_and_credits_amount_must_be_equal'));
			return false;
		}

		// Let's check if the user is trying to debit and credit
		// Same account, which is not allowed as per account laws

		if (empty(count(array_diff_key($debits, $credits)))) {
			flash()->error(trans('loan.it_is_not_allowed_to_credit_and_debit_same_account_please_correct_and_try_again'));
			return false;
		}
		// Ahwii ! time to read the bible, let's exit here wi
		// Good news
		return true;
	}
	/**
	 * Remove member from the session
	 * @return [type]
	 */
	public function clearMember() {
		Session::forget('loan_member');
	}
	/**
	 * Clear all things in the session that are related to the loan
	 */
	private function clearAll() {
		$this->clearMember();
		Session::forget('loanInputs');
		Session::forget('cautionneurs');
		Session::forget('creditaccounts');
		Session::forget('debitaccounts');
		Session::forget('completionStatus');
	}
}