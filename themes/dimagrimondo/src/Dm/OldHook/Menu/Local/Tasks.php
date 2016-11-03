<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 10.53
 */

namespace Dm\OldHook\Menu\Local;

use Dm\OldHook\Hook;

class Tasks extends Hook
{

	/**
	 * The main hook execution method
	 * @param array $vars
	 * @return string
	 */
	public function execute($vars) {
		$output = '';

		if (!empty($vars['primary'])) {
			$vars['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
			$vars['primary']['#prefix'] .= '<div class="tabs--primary">';
			$vars['primary']['#suffix'] = '</div>';
			$output .= drupal_render($vars['primary']);
		}

		if (!empty($vars['secondary'])) {
			$vars['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
			$vars['secondary']['#prefix'] .= '<ul class="tabs--secondary pagination pagination-sm">';
			$vars['secondary']['#suffix'] = '</ul>';
			$output .= drupal_render($vars['secondary']);
		}

		return $output;
	}
}