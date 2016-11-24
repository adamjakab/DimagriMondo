<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 25/11/2016
 * Time: 00:17
 */

namespace Dm\Util;

/**
 * Class UserHelper
 * @package Dm\Util
 */
class UserHelper
{
    const USER_ROLE_ANONYMOUS = 1;
    const USER_ROLE_REGISTERED = 2;
    const USER_ROLE_BLOGGER = 3;
    const USER_ROLE_COACH = 4;
    const USER_ROLE_RESMAN = 6;

    /**
     * @return \stdClass
     */
    public static function getCurrentUser()
    {
        return $GLOBALS['user'];
    }

    /**
     * @param \stdClass $user
     * @return array
     */
    public static function getOrderedRolesForUser($user)
    {
        $answer = [];
        $roles = user_roles(true);
        foreach ($roles as $rid => $roleName) {
            if (user_has_role($rid, $user)) {
                $answer[] = $rid;
            }
        }
        return $answer;
    }

    /**
     * For now anyone who is not a coach(rid=4) is a client
     *
     * @param \stdClass $user
     * @return bool
     */
    public static function isUserAClient($user)
    {
        $orderedRoles = self::getOrderedRolesForUser($user);
        if (!in_array(self::USER_ROLE_COACH, $orderedRoles)) {
            $answer = true;
        } else {
            $answer = false;
        }
        return $answer;
    }

    /**
     * compare two users
     *
     * @param \stdClass $user1
     * @param \stdClass $user2
     * @return bool
     */
    public static function areTheseUsersTheSame($user1, $user2)
    {
        return is_object($user1)
        && is_object($user2)
        && isset($user1->uid)
        && isset($user2->uid)
        && $user1->uid == $user2->uid;
    }
}