<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Hook\Preprocess;

use Dm\Hook\Hook;
use Dm\Hook\HookInterface;

class Node extends Hook implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        //dpm($vars, "NODE VARS");
    }
}