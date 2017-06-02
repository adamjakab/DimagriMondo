<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess;


use Dm\Util\ThemeHelper;
use Mekit\Drupal7\HookInterface;

class Html implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::addGoogleFonts();
        self::setThemeHookSuggestions($vars);

        //krumo($vars);
    }


    private static function addGoogleFonts()
    {
        $fonts = array(
            0 => 'http://fonts.googleapis.com/css?family=Montserrat:400,700',
            1 => 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,300,400,600',
        );

        foreach ($fonts as $key => $css) {
            drupal_add_css($css, array('type' => 'external'));
        }
    }

    /**
     * @param array $vars
     */
    private static function setThemeHookSuggestions(&$vars)
    {
        $nodeType = ThemeHelper::getNodeTypeFromHtmlVars($vars);

        if ($nodeType) {
            $vars['theme_hook_suggestions'][] = 'html__node__' . $nodeType;
        }

    }
}