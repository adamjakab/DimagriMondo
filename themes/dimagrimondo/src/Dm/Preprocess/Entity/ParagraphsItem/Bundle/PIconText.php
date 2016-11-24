<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 29/10/2016
 * Time: 18:03
 */

namespace Dm\Preprocess\Entity\ParagraphsItem\Bundle;

use Mekit\Drupal7\HookInterface;

/**
 * Class PIconText
 * @package Dm\Preprocess\Entity\ParagraphsItem\Bundle
 */
class PIconText implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::addColorInfo($vars);
        self::addCircleInfo($vars);
        //krumo($vars, "PARAGRAPHS ITEM P_IMAGE");
    }

    /**
     * @param array $vars
     */
    private static function addCircleInfo(&$vars)
    {
        /** @var \stdClass $entity */
        $entity = isset($vars['elements']['#entity']) ? $vars['elements']['#entity'] : false;
        if (!isset($entity->field_yes_no[LANGUAGE_NONE][0]['value'])) {
            return;
        }

        $drawCircle = (int)$entity->field_yes_no[LANGUAGE_NONE][0]['value'] == 1;
        if ($drawCircle) {
            $vars["classes_array"][] = 'draw-circle';
        }
    }

    /**
     * @param array $vars
     */
    private static function addColorInfo(&$vars)
    {
        /** @var \stdClass $entity */
        $entity = isset($vars['elements']['#entity']) ? $vars['elements']['#entity'] : false;
        if (!isset($entity->field_color_style[LANGUAGE_NONE][0]['value'])) {
            return;
        }

        $colorStyle = $entity->field_color_style[LANGUAGE_NONE][0]['value'];
        $vars["classes_array"][] = $colorStyle;
    }
}