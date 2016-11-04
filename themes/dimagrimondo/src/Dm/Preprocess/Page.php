<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess;


use Mekit\Drupal7\HookInterface;

class Page implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::selectMenuForSecondaryNavigation($vars);
        self::setUpBreadcrumbs($vars);
        self::fixActiveBlogMenuItem($vars);
        //dpm($vars, "PAGE VARS");
    }


    /**
     * @param array $vars
     */
    private static function selectMenuForSecondaryNavigation(&$vars)
    {
        // Secondary nav.
        $vars['secondary_nav'] = FALSE;
        if ($vars['secondary_menu']) {
            if (user_is_logged_in()) {
                $secondaryNav = menu_tree(variable_get('menu_secondary_links_source', 'user-menu'));
            } else {
                $secondaryNav = menu_tree('menu-anonymous-menu');
            }
            if ($secondaryNav) {
                $vars['secondary_nav'] = $secondaryNav;
                $vars['secondary_nav']['#theme_wrappers'] = array('menu_tree__secondary');
            }
        }
    }

    /**
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
     * Any blogpost type node must be under "blog" menu item
     * @param array $vars
     */
    private static function fixActiveBlogMenuItem(&$vars)
    {
        $blogMenuItemId = 558;
        if (isset($vars["node"]) && isset($vars["node"]->type) && $vars["node"]->type == "blogpost") {
            //this makes changes to node-type-(type) body class - NO GOOD (find another way)
            //menu_set_active_item($vars['primary_nav'][$blogMenuItemId]['#href']);

        }
    }
}