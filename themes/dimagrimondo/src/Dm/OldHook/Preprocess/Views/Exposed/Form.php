<?php
/**
 * Created by Adam Jakab.
 * Date: 18/03/16
 * Time: 11.52
 */

namespace Dm\OldHook\Preprocess\Views\Exposed;

use Dm\OldHook\Hook;
use Dm\Util\ThemeHelper;

class Form extends Hook {
    /**
     * The main hook execution method
     * @param array $vars
     */
    public function execute(&$vars) {
        $this->addFiltersJs($vars);
        $this->fixAdvancedWidgetLabels($vars);
    }
    
    /**
     * @param array $vars
     */
    protected function addFiltersJs(&$vars)
    {
        $themePath = ThemeHelper::getCurrentThemePath();
        drupal_add_js($themePath . '/js/view-filters.js', ['group' => JS_LIBRARY, 'weight' => 2]);
    }
    
    /**
     * Normal and Advanced filters are differentiated by Label
     * as they contain '(advanced)' text
     *
     * @param array $vars
     */
    protected function fixAdvancedWidgetLabels(&$vars)
    {
        $pattern = '#\(advanced\)#i';
        foreach ($vars['widgets'] as $widget) {
            if(!isset($widget->advanced)) {
                $widget->advanced = FALSE;
            }
            if ($widget->label) {
                $label = $widget->label;
                if (preg_match($pattern, $label)) {
                    //dpm($widget, "ADVANCED WIDGET");
                    $widget->advanced = TRUE;
                    $widget->label = preg_replace($pattern, "", $label);
                }
            }
        }
    }
}