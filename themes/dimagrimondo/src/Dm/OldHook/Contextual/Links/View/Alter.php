<?php
namespace Dm\OldHook\Contextual\Links\View;

use Dm\OldHook\Hook;

class Alter extends Hook
{
  /**
   * Modifies the 'Edit view' contextual link title by adding the name of the view to it
   * @param array $element
   * @param array $items
   */
  public function execute(&$element, $items) {
      if(isset($element['#links']['views-ui-edit'])) {
        $viewName = '???';
        if(isset($element['#element']['#views_contextual_links_info']['views_ui']['view']->human_name)) {
          $viewName = $element['#element']['#views_contextual_links_info']['views_ui']['view']->human_name;
        }
        $element['#links']['views-ui-edit']['title'] .= '(' . $viewName . ')';
      }
  }
}