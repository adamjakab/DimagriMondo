<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 12.24
 */

namespace Dm\OldHook\Preprocess\Node;

use Dm\OldHook\Hook;

/**
 *
 * Generic
 *
 * Class Node
 *
 * @package Mekit\Hook\Preprocess\Node
 */
class Node extends Hook
{
    /**
     * The main hook execution method
     *
     * @param array $vars
     */
    protected function execute(&$vars)
    {
        $this->setThemeHookSuggestions($vars);
        $this->addViewModeClass($vars);
    }
    
    /**
     * //reset to custom
     *
     * @param array $vars
     */
    protected function setThemeHookSuggestions(&$vars)
    {
        $vars['theme_hook_suggestions'] = [];
        $vars['theme_hook_suggestions'][] = 'node__' . $vars['nid'];
        $vars['theme_hook_suggestions'][] = 'node__' . $vars['view_mode'];
        $vars['theme_hook_suggestions'][] = 'node__' . $vars['view_mode'] . '__' . $vars['nid'];
        $vars['theme_hook_suggestions'][] = 'node__' . $vars['type'] . '__' . $vars['view_mode'];
        $vars['theme_hook_suggestions'][] = 'node__' . $vars['type'] . '__' . $vars['view_mode'] . '__' . $vars['nid'];
    }
    
    /**
     * @param array $vars
     */
    protected function addViewModeClass(&$vars)
    {
        $vars['classes_array'][] = 'node-' . $vars['view_mode'];
    }
}
