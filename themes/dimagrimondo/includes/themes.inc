<?php

use Dm\Util\HookHelper;
use Dm\Exception\ThemeException;

/**
 * @return array
 */
function dimagrimondo_theme()
{
    $themePath = drupal_get_path('theme', 'dimagrimondo');
    return [
        'resource_folder' => [
            'template' => 'resource-folder',
            'pattern' => 'resource-folder__',
            'path' => $themePath,
            'variables' => [
                'title'                     => NULL,
                'icon'                      => NULL,
                'link'                      => NULL,
                'number_of_children'        => 0,
                'number_of_descendants'     => 0,
                'classes'                   => NULL,
                'attributes'                => NULL,
            ],
        ],
        'resource_file' => [
            'template' => 'resource-file',
            'pattern' => 'resource-file__',
            'path' => $themePath,
            'variables' => [
                'title'                     => NULL,
                'icon'                      => NULL,
                'preview'                   => NULL,
                'link'                      => NULL,
                'classes'                   => NULL,
                'attributes'                => NULL,
            ],
        ],
    ];
}

/**
 * Implements hook_preprocess_themehook()
function dimagrimondo_preprocess_resource_folder(&$vars)
{
    dpm($vars, "preprocessing RF");
}
*/

/**
 * Bootstrap theme wrapper function for the primary menu links.
 */
function dimagrimondo_menu_tree__primary($vars)
{
    return '<ul class="menu nav navbar-nav">' . $vars['tree'] . '</ul>';
}

/**
 * Bootstrap theme wrapper function for the secondary menu links.
 */
function dimagrimondo_menu_tree__secondary($vars)
{
    return '<ul class="menu nav navbar-nav secondary">' . $vars['tree'] . '</ul>';
}

/**
 * Implements theme_menu_link()
 * @param array $vars
 * @return mixed
 * @throws ThemeException
 */
function dimagrimondo_menu_link($vars)
{
    return HookHelper::executeGenericHook(['theme', 'menu', 'link'], [$vars]);
}