<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess\UserProfile;

use Dm\Util\ThemeHelper;
use Dm\Util\UserHelper;
use Mekit\Drupal7\HookInterface;

/**
 * This class is not executed directly, rather it is extended by more specific classes in same ns
 *
 * Class UserProfile
 * @package Dm\Preprocess
 */
class UserProfile implements HookInterface
{
    /** @var  \stdClass */
    protected static $currentUser;

    /** @var  \stdClass */
    protected static $requestedUser;

    /**
     * @param array $vars
     */
    protected static function execute(&$vars)
    {
        self::setupUsers($vars);
        self::setThemeHookSuggestions($vars);
    }

    /**
     * @param array $vars
     */
    private static function setThemeHookSuggestions(&$vars)
    {
        /* Is user looking at his own profile? */
        $self = UserHelper::areTheseUsersTheSame(self::$currentUser, self::$requestedUser) ? 'self' : 'public';

        /* Requested user is a client or a coach? */
        $roleName = UserHelper::isClientUser(self::$requestedUser) ? 'client' : 'coach';

        /* Only one suggestion */
        $vars['theme_hook_suggestions'] = [
            'user_profile__' . $roleName . '__' . $self,
        ];
    }

    /**
     * @param array $vars
     */
    private static function setupUsers(&$vars)
    {
        self::$currentUser = $vars["user"];
        if (isset($vars['elements']['#account'])) {
            self::$requestedUser = $vars['elements']['#account'];
        }
    }
}