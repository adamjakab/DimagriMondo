<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Preprocess;

use Mekit\Drupal7\HookInterface;

class UserProfile implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::setThemeHookSuggestions($vars);
        self::prepareContent($vars);
        dpm($vars, "UP");
    }

    /**
     * @param array $vars
     */
    private static function prepareContent(&$vars)
    {
        if (isset($vars['field_facebook'][0]['value'])) {
            if (!empty($vars['field_facebook'][0]['value'])) {
                $profile = $vars['field_facebook'][0]['value'];
                $fb = 'https://www.facebook.com/' . $profile;
                $text = '<i class="fa fa-facebook-square" aria-hidden="true"></i>';
                $link = l($text, $fb, ['absolute' => true, 'html' => true]);
                $vars['user_profile']['group_links']['field_facebook'][0]['#markup'] = $link;

            }
        }


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