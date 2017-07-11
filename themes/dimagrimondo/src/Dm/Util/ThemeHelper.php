<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 11.02
 */

namespace Dm\Util;

class ThemeHelper
{


    /**
     * This is a special method for vars passed from html preprocess hook
     * @param $vars
     * @return bool|string
     */
    public static function getNodeTypeFromHtmlVars($vars)
    {
        $answer = false;
        if($node = self::getNodeFromHtmlVars($vars))
        {
            $answer = $node["#bundle"];
        }

        return $answer;
    }

    /**
     * This is a special method for vars passed from html preprocess hook
     * @param $vars
     * @return bool|array
     */
    public static function getNodeFromHtmlVars($vars)
    {
        $answer = false;
        if(isset($vars['page']['content']['system_main']['nodes']))
        {
            $nodes = $vars['page']['content']['system_main']['nodes'];
            foreach($nodes as $node)
            {
                if(is_array($node) && isset($node["#bundle"]))
                {
                    $answer = $node;
                }
            }
        }

        return $answer;
    }

    /**
     * @param string $view_name
     * @param array  $args
     *
     * @return array
     */
    public static function getViewOutputForAllDisplays($view_name, array $args = [])
    {
        $answer = [];
        $view = views_get_view($view_name);
        if($view)
        {
            /**
             * @var string $key
             * @var \stdClass $display
             */
            foreach ($view->display as $viewdisplay)
            {
                if ($viewdisplay->display_plugin != 'default')
                {
                    $answer[$viewdisplay->id] = [
                        "id" => $viewdisplay->id,
                        "title" => $viewdisplay->display_title,
                        "description" => $viewdisplay->display_options['display_description'],
                        "output" => self::getViewDisplayOutput($view_name, $viewdisplay->id, $args),
                    ];
                }
            }
        }

        return $answer;
    }

    /**
     * Gets a view by name and display
     *
     * @param string $view_name
     * @param string $view_display
     * @param array $args
     *
     * @return bool|string
     */
    public static function getViewDisplayOutput($view_name, $view_display, array $args = [])
    {
        $answer = '';
        $funcArgs = array_merge([$view_name, $view_display], $args);
        $viewResults = call_user_func_array('views_get_view_result', $funcArgs);
        if (count($viewResults)) {
            $answer = call_user_func_array('views_embed_view', $funcArgs);
        }

        return $answer;
    }

    /**
     * @return string
     */
    public static function getCurrentThemePath()
    {
        return drupal_get_path('theme', $GLOBALS['theme']);
    }

    /**
     * @return string
     */
    public static function getCurrentLanguageCode()
    {
        global $language;

        return $language->language;
    }
}