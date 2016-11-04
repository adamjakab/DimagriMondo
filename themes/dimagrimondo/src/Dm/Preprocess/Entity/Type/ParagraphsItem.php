<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 29/10/2016
 * Time: 17:48
 */

namespace Dm\Preprocess\Entity\Type;


use Mekit\Drupal7\HookInterface;

class ParagraphsItem implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        //dpm($vars['elements'], "PARAGRAPHS ITEM");
    }
}
