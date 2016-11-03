<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 14.14
 */

namespace Dm\Hook;

/**
 * All Hook classes must extend this class
 * Class Hook
 * @package Mekit\Hook
 */
class Hook {

    /**
     * Gets a view by name and display
     *
     * @param $view_name
     * @param $view_display
     * @param $arg
     *
     * @return bool|string|void
     */
    protected static function getView($view_name, $view_display, $arg){
        $answer = '';
        $viewResults = views_get_view_result($view_name, $view_display, $arg);
        if (count($viewResults)){
            $answer = views_embed_view($view_name, $view_display, $arg);
        }
        return $answer;
    }

    /**
     * @return string
     */
    protected static function getCurrentLanguageCode()
    {
        global $language;
        return $language->language;
    }


}