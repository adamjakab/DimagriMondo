<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 12.51
 */

namespace Dm\OldHook\Preprocess;


use Dm\OldHook\Hook;

class Block extends Hook
{
	/**
	 * The main hook execution method
	 * @param array $vars
	 */
	public function execute(&$vars) {
		$this->processBeans($vars);
	}

	/**
	 * @param array $vars
	 */
	protected function processBeans(&$vars) {
		$block = $vars['block'];
		if ($block->module == 'bean') {
			$vars['title_attributes_array']['class'][] = 'text-center';
			$vars['title_attributes_array']['class'][] = 'spazio-50';
		}
	}
}