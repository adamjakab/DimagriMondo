<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess\Node\Type;


use Mekit\Drupal7\HookInterface;

class Blogpost implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::setClasses($vars);
        self::addAdditionalInfo($vars);


        /** @var \stdClass $node */
       // $node = $vars['node'];
        //dpm($node);


    }


    /**
     * @param $vars
     *
     * <div class="field field-name-field-post-category field-type-taxonomy-term-reference field-label-above">
     * </div>
     */
    private static function addAdditionalInfo(&$vars)
    {
        if ($vars['view_mode'] == 'full') {

            /** @var \stdClass $user */
            $user = user_load($vars["uid"]);

            /** @var \stdClass $node */
            $node = $vars['node'];

            /*dpm($vars["content"]['group_info']);*/

            if($user){
                //dpm($user,"USER");

                if(isset($vars["display_submitted"]) && $vars["display_submitted"])
                {
                    $vars["content"]['group_info']["author"] = [
                        '#prefix' => '<div class="field field-custom field-custom-author field-label-above col-sm-3 col-xs-6">',
                        '#suffix' => '</div>',
                        '#weight' => -1,
                        'content' => [
                            'label' => [
                                '#prefix' => '<div class="field-label">',
                                '#suffix' => '</div>',
                                '#markup' => t('Author') . ':',
                            ],
                            'value' => [
                                '#prefix' => '<div class="field-item">',
                                '#suffix' => '</div>',
                                '#markup' => $user->name_field[LANGUAGE_NONE][0]['value'],
                            ],
                        ],
                    ];
                }
                //?? user profile pic
                //.$vars['user_picture']
            }

            if($node)
            {
                //$articleDate =  format_date($node->created, 'medium');
                $articleDate =  format_date($node->changed, 'date_only');
                $vars["content"]['group_info']["article_date"] = [
                    '#prefix' => '<div class="field field-custom field-custom-article-date field-label-above col-sm-3 col-xs-6">',
                    '#suffix' => '</div>',
                    '#weight' => -1,
                    'content' => [
                        'label' => [
                            '#prefix' => '<div class="field-label">',
                            '#suffix' => '</div>',
                            '#markup' => t('Date') . ':',
                        ],
                        'value' => [
                            '#markup' =>  $articleDate,
                        ],
                    ],
                ];
            }

            //dpm($vars);
        }
    }

    /**
     * @param $vars
     */
    private static function setClasses(&$vars)
    {
        if ($vars['view_mode'] == 'child') {
            $vars['classes_array'][] = 'col-sm-6';
            $vars['classes_array'][] = 'col-md-4';
        }
    }
}