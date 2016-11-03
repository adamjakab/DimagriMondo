<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 12.51
 */

namespace Dm\OldHook\Preprocess;


use Dm\OldHook\Hook;

class Field extends Hook
{
    /**
     * The main hook execution method
     * @param array $vars
     */
    public function execute (&$vars)
    {

        if ($vars['element']['#field_type'] == 'link_field') {
            $this->linkFieldPreProcess ($vars);
        }
    }


    /*
     *
     */
    protected function linkFieldPreProcess (&$vars)
    {
        drupal_add_js ("sites/all/themes/dierre/js/products_display.js");
    }


    /**
     * Add line breaks to plain text textareas.
     * @param array $vars
     */
    protected function addLineBreaksToPlainText (&$vars)
    {
        /*
        if ($vars['element']['#field_type'] == 'text_long'){
            //dpm($vars['element']);
            if (isset($vars['element']['#items'][0]['format'])) {
                if ($vars['element']['#items'][0]['format'] == null) {
                    if (isset($vars['element']['#formatter'])){
                        array_unshift($vars['theme_hook_suggestions'], 'field__' . $vars['element']['#field_type'] . '__' . $vars['element']['#formatter']);
                    }
                }
            } else {
                if (isset($vars['element']['#formatter'])){
                    array_unshift($vars['theme_hook_suggestions'], 'field__' . $vars['element']['#field_type'] . '__' . $vars['element']['#formatter']);
                }

                if(isset( $vars['items'][0]['#markup'])) {
                    $vars['items'][0]['#markup'] = nl2br($vars['items'][0]['#markup']);
                }

            }
        }
        */
    }

    /**
     * //custom suggestions
     * @param array $vars
     */
    protected function setThemeHookSuggestions (&$vars)
    {
        //array_unshift($vars['theme_hook_suggestions'], 'field__' . $vars['element']['#field_type']);
        //dpm ($vars['theme_hook_suggestions'], "FIELD THEME HS");
    }
}