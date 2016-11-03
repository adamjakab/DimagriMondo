<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 29/10/2016
 * Time: 18:03
 */

namespace Dm\Hook\Preprocess\Entity\Type\ParagraphsItem\Bundle;

use Dm\Hook\Hook;
use Dm\Hook\HookInterface;

class PImage extends Hook implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::formatByAlignment($vars);
        self::setThemeHookSuggestions($vars);
        //dpm($vars, "PARAGRAPHS ITEM P_IMAGE");
    }



    /**
     * left_block|Sinistra(block)
     * right_block|Destra(block)
     * center_block|Centrato(block)
     * left_inline|Sinistra(inline)
     * right_inline|Destra(inline)
     *
     * @param array $vars
     */
    private static function formatByAlignment(&$vars)
    {
        /** @var \stdClass $entity */
        $entity = isset($vars['elements']['#entity']) ? $vars['elements']['#entity'] : false;
        if(!isset($entity->field_alignment['und'][0]['value'])) {
            return;
        }

        $alignmentKey = $entity->field_alignment['und'][0]['value'];

        $parts = explode("_", $alignmentKey);
        if(!is_array($parts) || count($parts) != 2) {
            return;
        }

        $alignment = $parts[0];
        if(!in_array($alignment, ['left','right','center'])) {
            return;
        }

        $display = $parts[1];
        if(!in_array($display, ['block','inline'])) {
            return;
        }

        //dsm("ALIGNMENT: " . $alignment);
        //dsm("DISPLAY: " . $display);

        //classes for less
        if($display == 'block')
        {
            $vars["classes_array"][] = 'row';
        } else
        {
            $vars["classes_array"][] = 'col-md-6';//for now half-size only
            $vars["classes_array"][] = 'pull-' . $alignment;//for now half-size only
        }
        $vars["classes_array"][] = 'image--align--' . $alignment;
        $vars["classes_array"][] = 'image--display--' . $display;

        //values for tpl (structure)
        $vars["image--align"] = $alignment;
        $vars["image--display"] = $display;
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

        if(isset($vars["image--align"]) && isset($vars["image--display"])) {
            $vars['theme_hook_suggestions'][] = 'paragraphs_item__' . $bundle . '__' . $viewmode . '__' . $vars["image--align"] . '__' . $vars["image--display"];
        }
    }
}