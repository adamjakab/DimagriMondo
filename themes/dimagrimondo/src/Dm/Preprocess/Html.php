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
        self::addGoogleFonts($vars);
        self::setThemeHookSuggestions($vars);
        self::setMultipageBackground($vars);
        self::addMultipageAssets($vars);
        //krumo($vars);
    }

    private static function addMultipageAssets(&$vars)
    {
        if (ThemeHelper::getNodeTypeFromHtmlVars($vars) != "multipage") {return;}
        drupal_add_js(ThemeHelper::getCurrentThemePath().'/assets/turnjs/turn.js');
        drupal_add_js(ThemeHelper::getCurrentThemePath().'/js/multipage.js');
        //krumo($vars);
    }

    private static function setMultipageBackground(&$vars)
    {
        if (ThemeHelper::getNodeTypeFromHtmlVars($vars) != "multipage") {return;}
        $node = ThemeHelper::getNodeFromHtmlVars($vars);
        $bgImage = $node["field_single_image"][0];
        $imageStyle = $bgImage["#image_style"];
        $imageUri = $bgImage["#item"]["uri"];
        $styledImageUri = image_style_url($imageStyle, $imageUri);
        $vars["attributes_array"]["style"][] = "background-image: url($styledImageUri);";
    }

    private static function addGoogleFonts($vars)
    {
        if (ThemeHelper::getNodeTypeFromHtmlVars($vars) == "multipage") {return;}
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
        //krumo($vars);
        $nodeType = ThemeHelper::getNodeTypeFromHtmlVars($vars);


        if ($nodeType) {
            $vars['theme_hook_suggestions'][] = 'html__node__' . $nodeType;
        }
        if (isset($vars["is_admin"]) && $vars["is_admin"]) {
            $vars['theme_hook_suggestions'][] = 'html__node__' . $nodeType . '__admin';
        }
    }
}