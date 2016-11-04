<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess\Node\Type;


use Mekit\Drupal7\HookInterface;

class ResourceFolder implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::addClasses($vars);
        self::setupChildView($vars);
        if ($vars['view_mode'] == 'child') {
            //dpm($vars["node"]);
        }
    }

    /**
     * @param array $vars
     */
    private static function setupChildView(&$vars)
    {
        if ($vars['view_mode'] == 'child') {
            $content = &$vars["content"];
            /** @var \stdClass $node */
            $node = $vars["node"];

            $classes_array = ['resource-folder'];
            $attributes_array = [];

            $icon = isset($content['field_icon']) ? $content['field_icon'] : false;
            $link = url('node/' . $vars["nid"]);
            $number_of_children = isset($content['elementcount']['#number_of_children'])
                ? $content['elementcount']['#number_of_children']
                : 0;
            $number_of_descendants = isset($content['elementcount']['#number_of_descendants'])
                ? $content['elementcount']['#number_of_descendants']
                : 0;
            $folderColorClass = isset($node->field_color_style[LANGUAGE_NONE][0]['value'])
                ? $node->field_color_style[LANGUAGE_NONE][0]['value']
                : '';

            if ($folderColorClass) {
                $classes_array[] = $folderColorClass;
            }

            $attributes_array['data-descendants'] = $number_of_descendants;


            $content["resource_folder"] =
                [
                    '#theme' => 'resource_folder',
                    '#weight' => -99,
                    '#title' => $content['title_field'],
                    '#icon' => $icon,
                    '#link' => $link,
                    '#number_of_children' => $number_of_children,
                    '#number_of_descendants' => $number_of_descendants,
                    '#classes' => implode(" ", $classes_array),
                    '#attributes' => drupal_attributes($attributes_array),
                ];

            unset($content['title_field']);
            unset($content['field_icon']);
        }
    }

    /**
     * @param array $vars
     */
    private static function addClasses(&$vars)
    {
        if ($vars['view_mode'] == 'child') {
            $vars['classes_array'][] = 'col-xs-6';
            $vars['classes_array'][] = 'col-sm-4';
            $vars['classes_array'][] = 'col-md-3';
            $vars['classes_array'][] = 'col-lg-2';
        }
    }

}