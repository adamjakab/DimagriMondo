<?php
/**
 * Created by Adam Jakab.
 * Date: 20/10/16
 * Time: 9.50
 */

namespace Dm\Alter\Menu;

use Mekit\Drupal7\HookInterface;

class LocalTasks implements HookInterface
{
    /**
     * @param array $data
     * @param array $router_item
     * @param string $root_path
     */
    public static function execute(&$data, $router_item, $root_path)
    {
        self::blogPostAddButton($data);
        self::ensureCorrectTabsCount($data);
    }

    /**
     * must be set to correct count otherwise buttons don't show up
     * @param array $data
     */
    private static function ensureCorrectTabsCount(&$data)
    {
        if (isset($data['tabs'][0]['output'])) {
            $data['tabs'][0]['count'] = count($data['tabs'][0]['output']);
        }
    }

    /**
     * @param array $data
     */
    private static function blogPostAddButton(&$data)
    {
        if (user_access('create blogpost content')) {
            /** @var \stdClass $node */
            $node = menu_get_object();
            if ($node && isset($node->nid) && $node->nid == 7) {
                $title = '+ ' . t('Post');
                $ct = 'blogpost';

                $data['tabs'][0]['output'][] = array(
                    '#theme' => 'menu_local_task',
                    '#link' => array(
                        'title' => $title,
                        'href' => 'node/add/' . $ct,
                        'localized_options' => array(
                            'attributes' => array(
                                'title' => $title,
                            ),
                            'query' => array(
                                'parent' => $node->nid,
                                'destination' => 'node/' . $node->nid,
                            ),
                            'html' => TRUE,
                        ),
                    ),
                );
            }
        }
    }
}