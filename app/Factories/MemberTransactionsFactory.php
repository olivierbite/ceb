<?php 
namespace Ceb\Factories;

use Ceb\Models\Institution;
use Ceb\Models\Posting;
use Ceb\Models\Refund;
use Ceb\Traits\TransactionTrait;
use Ceb\Models\Contribution;
use DB;
use Illuminate\Support\Facades\Session;
use Sentry;
use Ceb\Models\User;

/**
 * Refund Factory
 */
class MemberTransactionsFactory {
	use TransactionTrait;

	/** Variable to  hold the object that are going to be injected */
	private $institution;

	function __construct(Institution $institution, Refund $refund, Posting $posting,User $member) {
		$this->institution = $institution;
		$this->refund = $refund;
		$this->posting = $posting;
		$this->member = $member;
	}

	/**
	 * Complete current transactions in contribution
	 *
	 * @return  bool
	 */
	public function complete(array $data) {

		$transactionId = $this->getTransactionId();
		
		// Start saving if something fails cancel everything
		Db::beginTransaction();
		$saveContibution = $this->saveContibutions($transactionId,$data);
		$savePosting = $this->savePostings($transactionId,$data);
         

		// Rollback the transaction via if one of the insert fails
		if (!$saveContibution || !$savePosting) {
			DB::rollBack();
			return false;
		}

		// Lastly, Let's commit a transaction since we reached here
		DB::commit();
		return true;

	}

	/**
	 * Saving contribution as per contribution factory
	 *
	 * @return bool
	 */
	private function saveContibutions($transactionId,$data = array()) {

			if (count($data) == 0 ) { // Provided data is empty we have nothing to do here
				flash()->error(trans('member.member_transaction_data_not_provided'));
				return false;
			}
			$charges = 0;
			if (isset($data['charges'])) {
				$charges = ($data['amount'] * (int) $data['charges']) / 100;
			}
			
			$contribution['transactionid']		= $transactionId;
			$contribution['month']				= date('Ym');
			$contribution['institution_id']		= $data['member']->institution_id;
			$contribution['amount']				= $data['amount'] - $charges;
			$contribution['state']				= 'Ancien';
			$contribution['year']				= date('Y');
			$contribution['contract_number']	= $this->getContributionContractNumber();
			$contribution['transaction_type']	= $this->getTransactionType($data['movement_type']);
			$contribution['transaction_reason']	= $data['operation_type'];
			$contribution['wording']			= $data['wording'];
			$contribution['adhersion_id']		= $data['member']->adhersion_id;
			$contribution['charged_amount']		= $charges;
			$contribution['charged_percentage']	= $data['charges'];
			
			//Remove unwanted column
			unset($contribution['id']);

			# try to save if it doesn't work then
			# exist the loop
			$newContribution = Contribution::create($contribution);
			if (!$newContribution) {
				return false;
			}
		return true;
	}

	/**
	 * Save posting to the database
	 * @param  STRING $transactionId UNIQUE TRANSACTIONID
	 * @return bool
	 */
	private function savePostings($transactionId,$data = array()) {

		if (count($data) == 0) { // Provided data is empty we have nothing to do here
			flash()->error(trans('member.member_transaction_data_not_provided'));
			return false;
		}
 		
 		$wording = $data['wording'];

		//Debiting....
		$debits = $this->accountAmount($data['debit_accounts'], $data['debit_amounts']);

		//Crediting
		$credits = $this->accountAmount($data['credit_accounts'], $data['credit_amounts']);

		// Let's again, make sure that accounting records are valid
		if (!$this->isValidPosting($debits,$credits)) {
			return false;
		}
        
        // We are good to go, attempt to save
        // debiting accounts and amount
        
		foreach ($debits as $accountId => $amount) {
			$results = $this->savePosting($accountId, $amount, $transactionId, 'debit', $journalId = 1,$wording,$cheque_number=null,$bank=null,$status='approved');
			if (!$results) {

				return false;
			}
		}

		// Debiting amount has been well saved,
		// Let's attempt to save credit account
		
		foreach ($credits as $accountId => $amount) {
			$results = $this->savePosting($accountId, $amount, $transactionId, 'credit', $journalId = 1,$wording,$cheque_number=null,$bank=null,$status='approved');
			if (!$results) {
				return false;
			}
		}

		// We are safe here
		return true;
	}

    
    /**
     * Get transaction type
     * @param  numeric $movement_type_id
     * @return string                  
     */
	public function getTransactionType($movement_type_id)
	{
		switch ($movement_type_id) {
			case 1:
				$transactionType = 'saving';
				break;
			case 2:
				$transactionType = 'withdrawal';
				break;
			default:
				$transactionType = 'Unknow';
				break;
		}
		return $transactionType;
	}

}