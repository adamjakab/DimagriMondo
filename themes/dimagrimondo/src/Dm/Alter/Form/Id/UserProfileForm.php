<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 25/11/2016
 * Time: 00:08
 */

namespace Dm\Alter\Form\Id;

use Dm\Util\UserHelper;
use Mekit\Drupal7\HookInterface;

/**
 * Class UserProfileForm
 * @package Dm\Alter\Form\Id
 */
class UserProfileForm implements HookInterface
{
    /**
     * @param array $form
     * @param array $form_state
     */
    public static function execute(&$form, $form_state)
    {
        self::limitAccess($form);
        dpm($form);
    }


    /**
     * @param array $form
     */
    private static function limitAccess(&$form)
    {
        if (UserHelper::isUserAClient(UserHelper::getCurrentUser())) {
            $form['field_social_links']['#access'] = false;
        }
    }
}