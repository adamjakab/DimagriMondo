<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Hook\Alter\Form;

use Dm\Hook\Hook;
use Dm\Hook\HookInterface;

/**
 * Class NodeEdit
 *
 * @package Dm\Hook\Alter\Form
 */
class NodeEdit extends Hook implements HookInterface
{
    /**
     * @param array $form
     * @param array $form_state
     */
    public static function execute(&$form, $form_state)
    {
        self::limitAccess($form);
        //dpm($form);
    }



    /**
     * @param array $form
     */
    private static function limitAccess(&$form)
    {
        global $user;
        if ($user->uid != 1) {
            // Not admin
            $form['options']['promote']['#access'] = false;
            $form['options']['sticky']['#access'] = false;
            $form['revision_information']['#access'] = false;
        }
    }
}
