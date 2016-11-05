<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess;

use Mekit\Drupal7\HookInterface;

class ParagraphsItems implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::setThemeHookSuggestions($vars);
        //dpm($vars, "PARAGRAPHS VARS");//['theme_hook_suggestions']
    }

    /**
     * @param array $vars
     */
    private static function setThemeHookSuggestions(&$vars)
    {
        $vars['theme_hook_suggestions'] = [];
        $vars['theme_hook_suggestions'][] = 'paragraphs_items__' . $vars['element']['#field_name'];
        $vars['theme_hook_suggestions'][] = 'paragraphs_items__' . $vars['element']['#field_name'] . '__' . $vars['view_mode'];
    }

}
