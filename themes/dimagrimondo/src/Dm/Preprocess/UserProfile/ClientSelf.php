<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 26/11/2016
 * Time: 00:07
 */

namespace Dm\Preprocess\UserProfile;

use Dm\Util\ThemeHelper;
use Dm\Util\UserHelper;

/**
 * This is client looking at his own profile
 *
 * Class ClientSelf
 * @package Dm\Preprocess\UserProfile
 */
class ClientSelf extends UserProfile
{

    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        parent::execute($vars);
        self::prepareContent($vars);

        //dpm(self::$requestedUser, "UP-CLIENT-SELF");
    }

    /**
     * @param array $vars
     */
    private static function prepareContent(&$vars)
    {
        /* This is what we use in template to render*/
        $profile = &$vars["user_profile"];

        //Profile edit link
        $profile["group_profile_info"]["edit_link"] = self::getProfileEditLink();

        //UPLINE
        $profile["coach_info"] = self::getUsersCoachView();
        $profile["coach_info"]['#groups']['group_profile_info']->label = 'Il tuo coach';


        /*
        //render all displays of view "user_resources"
        $displays = ThemeHelper::getViewOutputForAllDisplays('user_resources');
        $profile["user_resources"] = [];

        /** @var array $display * /
        foreach ($displays as $displayId => $display) {
            $content = [
                '#prefix' => '<div class="row suggested_videos"><div class="col-md-12">',
                '#suffix' => '</div></div>',
                'title' => [
                    '#prefix' => '<h3>',
                    '#suffix' => '</h3>',
                    '#markup' => $display["title"],
                ],
                'description' => [
                    '#prefix' => '<p>',
                    '#suffix' => '</p>',
                    '#markup' => $display["description"],
                ],
                'content' => [
                    '#markup' => $display["output"],
                ],
            ];
            $profile["user_resources"][$displayId] = $content;
        }
        */
    }

}