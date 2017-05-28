<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess;

use Dm\Util\ThemeHelper;
use Mekit\Drupal7\HookInterface;

/**
 * Class Page
 * @package Dm\Preprocess
 */
class Page implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::selectMenuForSecondaryNavigation($vars);
        self::setThemeHookSuggestions($vars);
        //krumo($vars);
    }


    /**
     * @param array $vars
     */
    private static function selectMenuForSecondaryNavigation(&$vars)
    {
        if (user_is_logged_in()) {
            $secondaryNav = menu_tree(variable_get('menu_secondary_links_source', 'user-menu'));
        } else {
            $secondaryNav = menu_tree('menu-anonymous-menu');
        }
        $vars['secondary_nav'] = $secondaryNav;
        $vars['secondary_nav']['#theme_wrappers'] = array('menu_tree__secondary');
    }

    /**
     * Unused - keeping it for future reference
     * @param array $vars
     */
    private static function setUpBreadcrumbs(&$vars)
    {
        //Default breadcrumbs
        $BC = menu_get_active_breadcrumb();

        //Special breadcrumbs for "blogposts" (not in NH)
        if (isset($vars["node"]) && isset($vars["node"]->type) && $vars["node"]->type == "blogpost") {
            $BC = [];
            $BC[] = l(t('Home'), '<front>');
            $BC[] = l(t('Articles'), 'node/7');
        }

        //dpm($BC);
        drupal_set_breadcrumb($BC);
    }

    /**
     * @param array $vars
     */
    private static function setThemeHookSuggestions(&$vars)
    {
        $nodeType = false;
        if (isset($vars["node"]->type)) {
            $nodeType = $vars["node"]->type;
        }
        $vars['theme_hook_suggestions'] = [];
        $vars['theme_hook_suggestions'][] = 'page__node';
        $vars['theme_hook_suggestions'][] = 'page__node__%';
        if ($nodeType) {
            $vars['theme_hook_suggestions'][] = 'page__node__' . $nodeType;
        }
    }

}