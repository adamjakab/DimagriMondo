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
 * Blog main page
 *
 * Class Node7
 * @package Dm\Preprocess\Node\Id
 */
class Node1 implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::injectContactForm($vars);
    }


    /**
     * ONLY IN TEASER - IN FULL we are using views injection module
     * @param array $vars
     */
    private static function injectContactForm(&$vars)
    {
        if ($vars['view_mode'] == 'full') {

            $contactFormView = false;
            $contactform_nid = 9;
            $contactNode = node_load($contactform_nid);
            if ($contactNode) {
                $contactFormView = node_view($contactNode);
            }

            if ($contactFormView) {
                $vars["content"]['contactForm'] = [
                    '#prefix' => '<div class="text-center margin-v-2">',
                    '#suffix' => '</div>',
                    '#weight' => 1,
                    'contactFormView' => $contactFormView,
                ];
            }

            //dpm($vars["content"]);
        }
    }
}