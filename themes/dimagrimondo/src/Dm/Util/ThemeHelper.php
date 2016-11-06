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
     * @return string
     */
    public static function getCurrentThemePath()
    {
        return drupal_get_path('theme', $GLOBALS['theme']);
    }

    /**
     * Gets a view by name and display
     *
     * @param string $view_name
     * @param string $view_display
     * @param array $args
     *
     * @return bool|string|void
     */
    public static function getView($view_name, $view_display, array $args = [])
    {
        $answer = '';
        $funcArgs = array_merge([$view_name, $view_display], $args);
        //$viewResults = views_get_view_result($view_name, $view_display);
        $viewResults = call_user_func_array('views_get_view_result', $funcArgs);
        if (count($viewResults)) {
            //$answer = views_embed_view($view_name, $view_display);
            $answer = call_user_func_array('views_embed_view', $funcArgs);
        }

        return $answer;
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