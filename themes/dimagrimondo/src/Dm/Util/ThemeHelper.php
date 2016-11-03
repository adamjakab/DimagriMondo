<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 11.02
 */

namespace Dm\Util;

use Dm\Exception\ThemeException;

class ThemeHelper
{
    /**
     * @return string
     */
    public static function getCurrentThemePath()
    {
        return drupal_get_path('theme', HookHelper::$themeName);
    }
}