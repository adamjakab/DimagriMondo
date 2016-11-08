<?php
/**
 * Created by PhpStorm.
 * User: Adi
 * Date: 20/10/2016
 * Time: 23:28
 */

namespace Dm\Preprocess\Node\Id;

use Dm\Util\ThemeHelper;
use Mekit\Drupal7\HookInterface;

/**
 * Blog main page
 *
 * Class Node7
 * @package Dm\Preprocess\Node\Id
 */
class Node7 implements HookInterface
{
    /**
     * @param array $vars
     */
    public static function execute(&$vars)
    {
        self::injectLatestArticlesView($vars);
        self::addSameH($vars);
    }

    /**
     * @param array $vars
     */
    private static function addSameH(&$vars)
    {
        $selector = 'ul.row.article-list';
        add_same_h_by_selector($selector);
    }

    /**
     * ONLY IN TEASER - IN FULL we are using views injection module
     * @param array $vars
     */
    private static function injectLatestArticlesView(&$vars)
    {
        if ($vars['view_mode'] == 'teaser') {
            $res = ThemeHelper::getViewDisplayOutput('blog_latest_articles', 'block');
            if ($res) {
                $vars["content"]["blog_articles"] = [
                    '#prefix' => '<div class="blog_articles">',
                    '#suffix' => '</div>',
                    '#markup' => $res,
                    '#weight' => 50,
                ];
            }
        }
    }
}