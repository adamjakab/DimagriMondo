<?php
/**
 * Created by Luca Cattaneo.
 * Date: 13/05/16
 * Time: 13:00
 * Unused.. ;)
 */

namespace Dm\OldHook\Preprocess\Menu;


use Dm\OldHook\Hook;

class Link extends Hook
{
	/**
	 * The main hook execution method
	 * @param array $vars
	 */
	public function execute(&$vars) {
    $this->add_btn_classes($vars);
	}

  private function add_btn_classes(&$vars){
    if (isset($vars['element']['#original_link']['menu_name'])){
      if ($vars['element']['#original_link']['menu_name'] == 'devel'){
        $vars['element']['#localized_options']['attributes']['class'][] = 'btn';
        $vars['element']['#localized_options']['attributes']['class'][] = 'btn-xs';
        $vars['element']['#localized_options']['attributes']['class'][] = 'btn-default';
      }
    }
  }
}