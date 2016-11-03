<?php
/**
 * Created by Adam Jakab.
 * Date: 04/09/15
 * Time: 18.00
 */

namespace Dm\OldHook\Menu;

use Dm\OldHook\Hook;

class Link extends Hook
{
  protected $allowManagementDropdowns = true;
  /**
   * The main hook execution method
   * @param array $vars
   * @return string
   */
  public function execute($vars) {
    return $this->renderLink($vars);
  }

  /**
   * Re-allow management menu to have dropdowns
   * @see sites/all/themes/bootstrap/theme/menu/menu-link.func.php
   *
   * @param array $vars
   * @return string
   */
  protected function renderLink($vars) {
    $element = $vars['element'];
    $sub_menu = '';
    if ($element['#below']) {
      if (($element['#original_link']['menu_name'] == 'management') && $this->allowManagementDropdowns) {
        $sub_menu = drupal_render($element['#below']);
      }
      elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
        // Add our own wrapper.
        unset($element['#below']['#theme_wrappers']);
        $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
        // Generate as standard dropdown.
        $element['#title'] .= ' <span class="caret"></span>';
        $element['#attributes']['class'][] = 'dropdown';
        $element['#localized_options']['html'] = TRUE;

        // Set dropdown trigger element to # to prevent inadvertant page loading
        // when a submenu link is clicked.
        $element['#localized_options']['attributes']['data-target'] = '#';
        $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
        $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
      }
    }
    // On primary navigation menu, class 'active' is not set on active menu item.
    // @see https://drupal.org/node/1896674
    if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
      $element['#attributes']['class'][] = 'active';
    }
    $output = l($element['#title'], $element['#href'], $element['#localized_options']);
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
  }

}