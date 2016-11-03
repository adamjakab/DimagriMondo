<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 29/10/2016
 * Time: 17:48
 */

namespace Dm\Hook\Preprocess\Entity\Type;

use Dm\Hook\Hook;
use Dm\Hook\HookInterface;

class ParagraphsItem extends Hook implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        //dpm($vars['elements'], "PARAGRAPHS ITEM");
    }
}
