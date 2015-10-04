<?php
namespace Ceb\ViewComposers;

use Illuminate\Contracts\View\View;


/**
 * AccountViewComposer
 */
class AcccountNatureViewComposer {
	
	public $accountNature = ['PASSIF' => 'Passif','ACTIF'=>'Actif'];
	public function compose(View $view) {
		$view->with('accountNatures',$this->accountNature);
	}
}