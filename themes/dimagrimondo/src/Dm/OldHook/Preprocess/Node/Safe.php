<?php
/**
 * Created by Adam Jakab.
 * Date: 14/06/16
 * Time: 15.34
 */

namespace Dm\OldHook\Preprocess\Node;

/**
 * Class Safe
 *
 * @package Mekit\Hook\Preprocess\Node
 */
class Safe extends DierreProduct
{
    /**
     * The main hook execution method
     *
     * @param array $vars
     */
    public function execute(&$vars)
    {
        parent::execute($vars);
    }
    
}