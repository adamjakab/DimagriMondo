<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 12.51
 */

namespace Dm\OldHook\Preprocess;


use Dm\OldHook\Hook;

class Image extends Hook
{
	/**
	 * The main hook execution method
	 * @param array $vars
	 */
	public function execute(&$vars) {
		//adding responsice class to all images
		$vars['attributes']['class'][] = 'img-responsive';
	}
}