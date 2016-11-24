<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 29/10/2016
 * Time: 17:48
 */

namespace Dm\Preprocess\Entity\Type;


use Mekit\Drupal7\HookInterface;

class ParagraphsItem implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::setThemeHookSuggestions($vars);
        //dpm($vars['elements'], "PARAGRAPHS ITEM");
    }


    /**
     * @param $vars
     */
    private static function setThemeHookSuggestions(&$vars)
    {
        $bundle = $vars['elements']['#bundle'];
        $viewmode = $vars['elements']['#view_mode'];

        $vars['theme_hook_suggestions'] = [];
        $vars['theme_hook_suggestions'][] = 'paragraphs_item';
        $vars['theme_hook_suggestions'][] = 'paragraphs_item__' . $bundle;
        $vars['theme_hook_suggestions'][] = 'paragraphs_item__' . $bundle . '__' . $viewmode;
    }
}
