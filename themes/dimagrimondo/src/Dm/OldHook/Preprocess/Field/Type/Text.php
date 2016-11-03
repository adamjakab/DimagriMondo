<?php
/**
 * Created by Adam Jakab.
 * Date: 26/01/16
 * Time: 17.55
 */

namespace Dm\OldHook\Preprocess\Field\Type;

use Dm\OldHook\Hook;

class Text extends Hook
{
    /**
     * The main hook execution method
     * @param array $vars
     */
    public function execute(&$vars) {

    }



    /**
     * Add line breaks to plain text textareas.
     * @param array $vars
     */
    protected function addLineBreaksToPlainText(&$vars) {
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

}