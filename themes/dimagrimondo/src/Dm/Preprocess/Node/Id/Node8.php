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
 * Chi Siamo
 *
 * Class Node7
 * @package Dm\Preprocess\Node\Id
 */
class Node8 implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::injectFacebookPage($vars);
    }


    /**
     * ONLY IN TEASER - IN FULL we are using views injection module
     * @param array $vars
     */
    private static function injectFacebookPage(&$vars)
    {
        if ($vars['view_mode'] == 'full') {
            btn_social_inject_js_for('facebook_page');

            $fbp = '<div class="fb-page" data-href="https://www.facebook.com/DimagriMondo" data-tabs="timeline" 
            data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                <blockquote cite="https://www.facebook.com/DimagriMondo" class="fb-xfbml-parse-ignore">
                    <a href="https://www.facebook.com/DimagriMondo">DimagriMondo</a>
                </blockquote>
            </div>';

            /*
            $vars["content"]["content_reloaded"] = [
                'b1' => [
                    '#prefix' => '<div class="col-md-8">',
                    '#suffix' => '</div>',
                    'bits' => [
                        'title' => $vars["content"]['field_title_emotional'],
                        'maincontent' => $vars["content"]['field_paragraphs'],
                    ],
                ],
                'b2' => [
                    '#prefix' => '<div class="col-md-4 text-center margin-v-2">',
                    '#suffix' => '</div>',
                    '#markup' => $fbp,
                ],
            ];
            unset($vars["content"]['field_title_emotional']);
            unset($vars["content"]['field_paragraphs']);
            */
            $vars["content"]['facebook_page'] = [
                '#prefix' => '<div class="text-center margin-v-2">',
                '#suffix' => '</div>',
                '#weight' => 99,
                '#markup' => $fbp,
            ];


            //dpm($vars["content"]);
        }
    }
}