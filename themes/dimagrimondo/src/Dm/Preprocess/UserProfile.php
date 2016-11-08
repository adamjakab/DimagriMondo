<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess;

use Dm\Util\ThemeHelper;
use Mekit\Drupal7\HookInterface;

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

        if (self::isUserAClient(self::$requestedUser)) {
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

        if (self::areTheseUsersTheSame(self::$currentUser, self::$requestedUser)) {
            $message = 'Ciao ' . $user->name . ',';
        } else {
            $message = 'Pagina profilo dell\'utente: ' . $user->name;
        }

        $profile["messages"] = [
            '#markup' => $message,
        ];
        
        
        //$displays = ThemeHelper::getViewOutputForAllDisplays('user_resources');
        //dpm($displays, "DISPLAYS");
        

        $profile["user_resources"] = [
            $profile["videos"] = [
                '#prefix' => '<div class="row suggested_videos"><div class="col-md-12">',
                '#suffix' => '</div></div>',
                'title' => [
                    '#prefix' => '<h3>',
                    '#suffix' => '</h3>',
                    '#markup' => 'Video suggeriti'
                ],
                'description' => [
                    '#prefix' => '<p>',
                    '#suffix' => '</p>',
                    '#markup' => 'Qualche video selezionato per te.'
                ],
                'content' => [
                    '#markup' => ThemeHelper::getViewDisplayOutput('user_resources', 'block_video'),
                ],
            ],
            $profile["prices"] = [
                '#prefix' => '<div class="row suggested_videos"><div class="col-md-12">',
                '#suffix' => '</div></div>',
                'title' => [
                    '#prefix' => '<h3>',
                    '#suffix' => '</h3>',
                    '#markup' => 'Prezzi pacchetti'
                ],
                'description' => [
                    '#prefix' => '<p>',
                    '#suffix' => '</p>',
                    '#markup' => 'Prezzi, durata e modalità di pagamento'
                ],
                'content' => [
                    '#markup' => ThemeHelper::getViewDisplayOutput('user_resources', 'block_prices'),
                ],
            ],
        ];
    }


    /**
     * setting THS for each role ordered by weight!
     * @param array $vars
     */
    private static function setThemeHookSuggestions(&$vars)
    {
        $orderedRoles = self::getOrderedRolesForUser(self::$requestedUser);

        $vars['theme_hook_suggestions'] = [];
        foreach ($orderedRoles as $role) {
            $vars['theme_hook_suggestions'][] = 'user_profile__role_' . $role;
        }
    }

    /**
     * For now anyone who is not a coach(rid=4) is a client
     *
     * @param \stdClass $user1
     * @param \stdClass $user2
     * @return bool
     */
    private static function areTheseUsersTheSame($user1, $user2)
    {
        return is_object($user1)
        && is_object($user2)
        && isset($user1->uid)
        && isset($user2->uid)
        && $user1->uid == $user2->uid;
    }

    /**
     * For now anyone who is not a coach(rid=4) is a client
     *
     * @param \stdClass $user
     * @return bool
     */
    private static function isUserAClient($user)
    {
        $orderedRoles = self::getOrderedRolesForUser($user);
        if (!in_array(4, $orderedRoles)) {
            $answer = true;
        } else {
            $answer = false;
        }
        return $answer;
    }

    /**
     * @param \stdClass $user
     * @return array
     */
    private static function getOrderedRolesForUser($user)
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