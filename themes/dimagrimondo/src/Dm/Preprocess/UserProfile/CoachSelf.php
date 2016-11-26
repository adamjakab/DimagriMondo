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
 * This is coach looking at his own profile
 *
 * Class CoachSelf
 * @package Dm\Preprocess\UserProfile
 */
class CoachSelf extends UserProfile
{

    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        parent::execute($vars);
        self::prepareContent($vars);

        //dpm(self::$requestedUser, "UP-COACH-SELF");
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
        $profile["coach_info"]['#groups']['group_profile_info']->label = 'La tua upline';




    }

}