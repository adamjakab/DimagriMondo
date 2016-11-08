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
     * @return bool|string|void
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
    public static function getCurrentLanguageCode()
    {
        global $language;

        return $language->language;
    }
}