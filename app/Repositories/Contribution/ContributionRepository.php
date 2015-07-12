<?php
namespace Ceb\Repositories\Contribution;

use Ceb\Models\Contribution;

/**
 * Contribution Repository
 */
class ContributionRepository {
	protected $contribution;
	function __construct(Contribution $contribution) {
		$this->contribution = $contribution;
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
}