<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 20/10/2016
 * Time: 23:28
 */

namespace Dm\Preprocess\Node\Id;


use Mekit\Drupal7\HookInterface;

/**
 * Program: BASIC
 *
 * Class Node97
 * @package Dm\Preprocess\Node\Id
 */
class Node97 implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::injectFrontPageConent($vars);
    }

    /**
     * @param array $vars
     */
    private static function injectFrontPageConent(&$vars)
    {
        if ($vars['view_mode'] == 'child') {
            $vars['content']['heart'] = [
                '#prefix' => '<div class="text-center">',
                '#suffix' => '</div>',
                '#markup' => '<i class="fa fa-heartbeat" aria-hidden="true"></i>',
                '#weight' => -99,
            ];
        }
    }
}