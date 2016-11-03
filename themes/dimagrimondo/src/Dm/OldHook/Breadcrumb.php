<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 13.10
 */

namespace Dm\OldHook;


class Breadcrumb extends Hook
{

	public function execute($vars) {
	  $output = '';
	  $breadcrumb = $vars['breadcrumb'];


	  // Determine if we are to display the breadcrumb.
	  $bootstrap_breadcrumb = theme_get_setting('bootstrap_breadcrumb');
	  if (($bootstrap_breadcrumb == 1 || ($bootstrap_breadcrumb == 2 && arg(0) == 'admin')) && !empty($breadcrumb)) {
		$output = theme('item_list', array(
		  'attributes' => array(
			'class' => array('breadcrumb'),
		  ),
		  'items' => $breadcrumb,
		  'type' => 'ol',
		));
		$output = '<div class="label-breadcrumb">' . $output . '</div>';
	  }

	  return $output;
	}
}

