<?php

namespace Ceb\Http\Controllers;

use Ceb\Http\Controllers\Controller;
use Ceb\Models\Institution;
use Ceb\Repositories\Contribution\ContributionRepository as Contribution;
use Input;

class ContributionAndSavingsController extends Controller {

	private $contribution;
	function __construct(Contribution $contribution) {
		parent::__construct();
		$this->contribution = $contribution;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Institution $institution) {

		$institutionId = Input::get('institution');
		$institutionId = $institutionId ?: 1;
		$members = $institution->find($institutionId)->members;

		$institutions = $institution->lists('name', 'id');

		return view('contributionsandsavings.list', compact('members', 'institutions', 'institutionId'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		return view('contributionsandsavings.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
		$contribution = $this->contribution->findOrfail($id);

		return view('contributionsandsavings.create', compact('contribution'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {

		$contribution = $this->contribution->findOrfail($id);

		return view('contributionsandsavings.edit', compact('contribution'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		// Update
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {

	}
}
