<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess;


use Mekit\Drupal7\HookInterface;

/**
 * Class Entity
 * @package Dm\Preprocess
 */
class Entity implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        //dpm($vars, "ENTITY VARS");
    }
}