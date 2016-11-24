<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess\Node\Type;


use Mekit\Drupal7\HookInterface;

class Page implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::addClasses($vars);
        self::colorEmotionalTitle($vars);
    }

    /**
     * @param $vars
     */
    private static function colorEmotionalTitle(&$vars)
    {
        if (isset($vars['content']['field_title_emotional'][0]['#markup'])) {
            $text = $vars['content']['field_title_emotional'][0]['#markup'];
            $noColoring = false; //$vars['is_front']
            if (!$noColoring) {
                $color = '#000000';
                if (isset($vars['field_color_1'][LANGUAGE_NONE][0]['rgb']) && !empty($vars['field_color_1'][LANGUAGE_NONE][0]['rgb'])) {
                    $color = $vars['field_color_1'][LANGUAGE_NONE][0]['rgb'];
                }
                $text = str_replace(['[', ']'], ['<span class="colored" style="color:' . $color . ';">', '</span>'], $text);
            } else {
                //remove only
                $text = str_replace(['[', ']'], ['<span class="colored">', '</span>'], $text);
            }
            $vars['content']['field_title_emotional'][0]['#markup'] = $text;
        }
    }

    /**
     * @param $vars
     */
    private static function addClasses(&$vars)
    {
        if ($vars['view_mode'] == 'child') {
            $vars['classes_array'][] = 'col-sm-12';
            $vars['classes_array'][] = 'col-md-6';
            $vars['classes_array'][] = 'col-lg-3';
        }
    }

}