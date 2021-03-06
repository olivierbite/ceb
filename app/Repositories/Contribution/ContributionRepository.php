<?php
namespace Ceb\Repositories\Contribution;

use Ceb\Factories\ContributionFactory;
use Ceb\Models\AssetType;
use Ceb\Models\Contribution;
use Ceb\Models\Posting;
use Ceb\Traits\TransactionTrait;
use DB;
use Sentry;

/**
 * Contribution Repository
 */
class ContributionRepository {
	use TransactionTrait;
	/** @var  hosts the instance of contribution model */
	protected $contribution;
	function __construct(Contribution $contribution, AssetType $assetType, ContributionFactory $contributionFactory) {
		$this->contribution = $contribution;
		$this->assetType = $assetType;
		$this->contributionFactory = $contributionFactory;
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param $data
	 *
	 * @return BaseResponse
	 */
	public function store($data) {
		return $this->constribution->store($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param $data
	 *
	 * @return BaseResponse
	 */
	public function update($data) {
		return $this->contribution->update($data);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return BaseResponse
	 */
	public function destroy($id) {
		$this->contribution->findOrfail($id);
		return $this->contribution->delete();
	}

	/**
	 * Return all the registered users
	 *
	 * @return Collection
	 */
	public function all() {
		return $this->contribution->all();
	}

	public function paginate($page = 10) {
		return $this->contribution->paginate($page);
	}
	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  mixed $identifier
	 *
	 * @return \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveById($identifier) {
		return $this->contribution->findOrfail($identifier);
	}

	/**
	 * Complete current transactions in contribution
	 *
	 * @return  bool
	 */
	public function complete() {
		$transactionId = $this->getTransactionId();
		// Start saving if something fails cancel everything
		Db::beginTransaction();
		$saveContibution = $this->saveContibutions($transactionId);
		$savePosting = $this->savePostings($transactionId);

		// Rollback the transaction via if one of the insert fails
		if (!$saveContibution || !$savePosting) {
			DB::rollBack();
			return false;
		}

		// Lastly, Let's commit a transaction since we reached here
		DB::commit();
		return $transactionId;

	}

	/**
	 * Saving contribution as per contribution factory
	 *
	 * @return bool
	 */
	private function saveContibutions($transactionId) {

		# Get data in the factory
		$contributions = $this->contributionFactory->getConstributions()->toArray();
		$month = $this->contributionFactory->getMonth();
		$fullTransactions = true;

		$memberWithoutFees = 0;
		foreach ($contributions as $contribution) {
			if (empty($contribution['monthly_fee'])) {
				$memberWithoutFees++;
				continue;
			}

			$contribution['transactionid'] = $transactionId;
			$contribution['month'] = $month;
			$contribution['institution_id'] = $contribution['institution_id'];
			$contribution['amount'] = $contribution['monthly_fee'];
			$contribution['state'] = 'Ancien';
			$contribution['year'] = date('Y');
			$contribution['contract_number'] = $this->getContributionContractNumber();
			$contribution['transaction_type'] = 'saving';
			$contribution['transaction_reason'] = 'Montly contribution for the month of '.$month.' of the year '.$contribution['year'];
			$contribution['wording']       = $this->contributionFactory->getWording();
			//Remove unwanted column
			unset($contribution['id']);

			# try to save if it doesn't work then
			# exist the loop
			$newContribution = Contribution::create($contribution);
			if (!$newContribution) {
				return false;
			}

		}

		if (!empty($memberWithoutFees)) {
			flash()->warning(count($memberWithoutFees). trans('contribution.members_could_not_contribute_because_they_have_0_fee'));
		}
		return true;
	}

	/**
	 * Save posting to the database
	 * @param  STRING $transactionId UNIQUE TRANSACTIONID
	 * @return bool
	 */
	private function savePostings($transactionId) {

		$debitAccount = $this->contributionFactory->getDebitAccount();
		$creditAccount = $this->contributionFactory->getCreditAccount();
		
		// First prepare data to use for the debit account
		// Once are have debited(deducted data) then we can
		// Credit the account to be credited
		$posting['transactionid'] = $transactionId;
		$posting['account_id'] = $debitAccount;
		$posting['journal_id'] = 1; // We assume per default we are using journal 1
		$posting['asset_type'] = null;
		$posting['amount'] = $this->contributionFactory->total();
		$posting['user_id'] = Sentry::getUser()->id;
		$posting['account_period'] = date('Y');
		$posting['transaction_type'] = 'Debit';

		// Try to post the debit before crediting another account
		$debiting = Posting::create($posting);

		// Change few data for crediting
		// Then try to credit the account too
		$posting['transaction_type'] = 'Credit';
		$posting['account_id'] = $creditAccount;

		$crediting = Posting::create($posting);

		if (!$debiting || !$crediting) {
			
			return false;
		}
		// Ouf time to go to bed now
		return true;
	}
}