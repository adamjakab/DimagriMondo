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
    /** @var  boolean */
    private static $isClient;

    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::setIsClient($vars);
        self::setThemeHookSuggestions($vars);

        self::prepareContent($vars);
        //dpm($vars, "UP");
    }

    /**
     * @param array $vars
     */
    private static function prepareContent(&$vars)
    {
        /* This is what we use in template to render*/
        $profile = &$vars["user_profile"];

        /** @var \stdClass $user */
        $user = $vars["user"];

        /* Global user is missing custom fields so we need to load it explicitly */
        /** @var \stdClass $currUser */
        $currentUser = user_load($user->uid);


        $profile["messages"] = ['#markup' => 'Ciao ' . $user->name . ','];

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
                    '#markup' => ThemeHelper::getView('user_resources', 'block_video'),
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
                    '#markup' => ThemeHelper::getView('user_resources', 'block_prices'),
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
        /** @var \stdClass $user */
        $user = $vars["user"];
        $orderedRoles = self::getOrderedRolesForUser($user);

        $vars['theme_hook_suggestions'] = [];
        foreach ($orderedRoles as $role) {
            $vars['theme_hook_suggestions'][] = 'user_profile__role_' . $role;
        }
    }

    /**
     * @param array $vars
     */
    private static function setIsClient(&$vars)
    {
        /** @var \stdClass $user */
        $user = $vars["user"];
        self::$isClient = self::isUserAClient($user);
        $vars["#is_client"] = self::$isClient;
    }

    /**
     * For now anyone ho is not a coach(rid=4) is a client
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
}