<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess\Node\Type;


use Mekit\Drupal7\HookInterface;

class ResourceFile implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::checkAccess($vars);
        self::addClasses($vars);
        self::setupChildView($vars);
    }

    /**
     * @param array $vars
     */
    private static function checkAccess(&$vars)
    {
        if ($vars['view_mode'] == 'full') {
            //dpm($vars);
        }

        //$node = $vars["node"];
        //$access = node_access("view", $node);
        //dsm("Access(".$node->nid."): " . ($access?"Y":"N"));
    }


    /**
     * @param array $vars
     */
    private static function setupChildView(&$vars)
    {
        if ($vars['view_mode'] == 'child') {
            $content = &$vars["content"];
            $icon = self::generateIconForFile($vars);
            $preview = self::generatePreviewForFile($vars);
            $link = url('node/' . $vars["nid"]);

            $content["resource_file"] =
                [
                    '#theme' => 'resource_file',
                    '#weight' => -99,
                    '#title' => $content['title_field'],
                    '#icon' => $icon,
                    '#preview' => $preview,
                    '#link' => $link,
                ];

            unset($content['title_field']);
            unset($content['field_icon']);
        }
    }

    /**
     * @param array $vars
     * @return array
     */
    private static function generatePreviewForFile($vars)
    {
        $answer = [];
        $previewElement = false;
        $PI = false;

        if (isset($vars["node"]->field_paragraphs_resource[LANGUAGE_NONE][0]['value'])) {
            $PI = paragraphs_item_load($vars["node"]->field_paragraphs_resource[LANGUAGE_NONE][0]['value']);
        }

        if ($PI) {
            switch ($PI->bundle) {
                case "p_image":
                    if (isset($PI->field_single_image[LANGUAGE_NONE][0])) {
                        $previewElement = ['#item' => $PI->field_single_image[LANGUAGE_NONE][0]];
                    }
                    break;
            }
        }

        if ($previewElement) {
            $previewElement['#theme'] = 'image_formatter';
            $previewElement['#image_style'] = 'resource_preview';
            //
            $answer['#prefix'] = '<div class="preview">';
            $answer['#suffix'] = '</div>';
            $answer["preview"] = $previewElement;
        }

        return $answer;
    }

    /**
     * @param array $vars
     * @return array
     */
    private static function generateIconForFile($vars)
    {
        $answer = [];

        $typeToIconMap = [
            'unknown' => 'question',
            'p_text' => 'font',
            'p_image' => 'paint-brush',
            'p_pdf' => 'file-pdf-o',
            'p_video' => 'video-camera',
            'p_url' => 'link',
        ];

        $type = 'unknown';
        if (isset($vars['field_resource_type']['und'][0]['value'])) {
            $type = $vars['field_resource_type']['und'][0]['value'];
        }
        $type = array_key_exists($type, $typeToIconMap) ? $type : 'unknown';

        $answer['#theme'] = 'icon';
        $answer['#bundle'] = 'fontawesome';
        $answer['#icon'] = $typeToIconMap[$type];
        $answer['#attributes'] = [];
        $answer['#prefix'] = '<div class="type-icon">';
        $answer['#suffix'] = '</div>';

        return $answer;
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