<?php
namespace Ceb\ViewComposers;

use Illuminate\Contracts\View\View;

/**
 * AccountViewComposer
 */
class RefundTypesViewComposer {
	public $refundTypes = [
					'refund_by_banque'				=> 'refund_by_banque',
					'refund_by_salaire'				=> 'refund_by_salaire',
					'refund_by_epargne'				=> 'refund_by_epargne',
					'refund_by_cautionneur'			=> 'refund_by_cautionneur',
					'refund_by_decompte_final'		=> 'refund_by_decompte_final',
					'refund_by_relicats'			=> 'refund_by_relicats',
					'refund_by_interets_retournes'	=> 'refund_by_interets_retournes',
					'refund_by_interets_annuels'	=> 'refund_by_interets_annuels',
					];

	public function compose(View $view) {
		$view->with('refundTypes',$this->refundTypes);
	}
}