<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess;

use Dm\Util\ThemeHelper;
use Dm\Util\UserHelper;
use Mekit\Drupal7\HookInterface;

/**
 * Class UserProfile
 * @package Dm\Preprocess
 */
class UserProfile implements HookInterface
{
    /** @var  \stdClass */
    private static $currentUser;

    /** @var  \stdClass */
    private static $requestedUser;


    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::setupUsers($vars);

        self::setThemeHookSuggestions($vars);

        if (UserHelper::isUserAClient(self::$requestedUser)) {
            self::prepareContentClient($vars);
        } else {
            self::prepareContentCoach($vars);
        }
        //dpm(self::$currentUser, "CU");
        //dpm(self::$requestedUser, "RU");
    }

    /**
     * @param array $vars
     */
    private static function prepareContentCoach(&$vars)
    {
        /* This is what we use in template to render*/
        $profile = &$vars["user_profile"];

        /** @var \stdClass $user */
        $user = self::$requestedUser;

        //add something like: my clients
    }


    /**
     * @param array $vars
     */
    private static function prepareContentClient(&$vars)
    {
        /* This is what we use in template to render*/
        $profile = &$vars["user_profile"];

        /** @var \stdClass $user */
        $user = self::$requestedUser;

        if (UserHelper::areTheseUsersTheSame(self::$currentUser, self::$requestedUser)) {
            $message = 'Ciao ' . $user->name . ',';
        } else {
            $message = 'Pagina profilo dell\'utente: ' . $user->name;
        }

        $profile["messages"] = [
            '#markup' => $message,
        ];


        //render all displays of view "user_resources"
        $displays = ThemeHelper::getViewOutputForAllDisplays('user_resources');
        $profile["user_resources"] = [];

        /** @var array $display */
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
    }


    /**
     * setting THS for each role ordered by weight!
     * @param array $vars
     */
    private static function setThemeHookSuggestions(&$vars)
    {
        $orderedRoles = UserHelper::getOrderedRolesForUser(self::$requestedUser);

        $vars['theme_hook_suggestions'] = [];
        foreach ($orderedRoles as $role) {
            $vars['theme_hook_suggestions'][] = 'user_profile__role_' . $role;
        }
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