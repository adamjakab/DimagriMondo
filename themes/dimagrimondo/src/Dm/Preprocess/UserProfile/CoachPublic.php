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
 * This is someone looking at the coach's profile
 *
 * Class CoachPublic
 * @package Dm\Preprocess\UserProfile
 */
class CoachPublic extends UserProfile
{

    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        parent::execute($vars);
        self::prepareContent($vars);

        //dpm(self::$requestedUser, "UP-COACH-PUBLIC");
    }

    /**
     * @param array $vars
     */
    private static function prepareContent(&$vars)
    {
        /* This is what we use in template to render*/
        $profile = &$vars["user_profile"];

        /** @var \stdClass $user */
        $user = self::$requestedUser;

        //add something like: my clients
    }

}