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
     *
     * @return bool|string|void
     */
    public static function getView($view_name, $view_display)
    {
        $answer = '';
        $viewResults = views_get_view_result($view_name, $view_display);
        if (count($viewResults)) {
            $answer = views_embed_view($view_name, $view_display);
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