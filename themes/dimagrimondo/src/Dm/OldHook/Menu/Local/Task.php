<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 10.53
 */

namespace Dm\OldHook\Menu\Local;

use Dm\OldHook\Hook;

class Task extends Hook
{
	/**
	 * The main hook execution method
	 * @param array $vars
	 * @return string
	 */
	public function execute($vars) {
		$link = $vars['element']['#link'];
		$link_text = $link['title'];

		if (!empty($vars['element']['#active'])) {
	    $link['localized_options']['attributes']['class'][] = 'active';
	  }

		$link['localized_options']['attributes']['class'][] = 'btn';
		$link['localized_options']['attributes']['class'][] = 'btn-default';

		return l($link_text, $link['href'], $link['localized_options']) . "\n";
	}
}