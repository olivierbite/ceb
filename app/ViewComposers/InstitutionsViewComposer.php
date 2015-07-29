<?php
namespace Ceb\ViewComposers;

use Ceb\Models\Institution;
use Illuminate\Contracts\View\View;

/**
 * institutionViewComposer
 */
class InstitutionsViewComposer {
	public $institution;
	function __construct(Institution $institution) {
		$this->institution = $institution;
	}
	public function compose(View $view) {
		$view->with('institutions', $this->institution->lists('name', 'id'));
	}
}