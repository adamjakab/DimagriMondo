<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess;

use Mekit\Drupal7\HookInterface;

/**
 * Class Front
 * @package Dm\Preprocess
 */
class Front implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::removeNoContentMessage($vars);
        
        self::addBlockDimagrimondo($vars);
        self::addBlockPrograms($vars);
        //dpm($vars, "FRONT VARS");
    }
    
    /**
     * @param array $vars
     */
    private static function addBlockDimagrimondo(&$vars)
    {
        $nodeId = 8;
        $node = node_load($nodeId);
        $nodeView = node_view($node, "teaser");
        $vars['page']['wide_bottom']['system_main']['dimagrimondo'] = [
            '#prefix' => '<div class="container-fluid">',
            '#suffix' => '</div>',
            'node' => $nodeView,
        ];
    }

    /**
     * @param array $vars
     */
    private static function addBlockPrograms(&$vars)
    {
        $nodeId = 96;
        $node = node_load($nodeId);
        $nodeView = node_view($node, "teaser");
        $vars['page']['wide_bottom']['system_main']['programs'] = [
            '#prefix' => '<div class="container-fluid">',
            '#suffix' => '</div>',
            'node' => $nodeView,
        ];
    }

    
    /**
     * @param array $vars
     */
    private static function removeNoContentMessage(&$vars)
    {
        unset($vars['page']['content']['system_main']['default_message']);
    }
}