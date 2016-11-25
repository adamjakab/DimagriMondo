<?php

use Mekit\Drupal7\Exception\ThemeException;
use Mekit\Drupal7\HookExecutor;


/**
 * Implements hook_preprocess_html()
 * @param array $vars
 * @throws ThemeException
 */
function dimagrimondo_preprocess_html(&$vars)
{
    HookExecutor::executeGenericHook(['preprocess', 'html'], [&$vars]);
}

/**
 * Implements hook_preprocess_page()
 * @param array $vars
 * @throws ThemeException
 */
function dimagrimondo_preprocess_page(&$vars)
{
    HookExecutor::executeGenericHook(['preprocess', 'page'], [&$vars]);
    if (drupal_is_front_page()) {
        HookExecutor::executeGenericHook(['preprocess', 'front'], [&$vars]);
    }
}

/**
 * Implements hook_preprocess_node()
 * @param array $vars
 * @throws ThemeException
 */
function dimagrimondo_preprocess_node(&$vars)
{
    HookExecutor::executeNodeHooks(['preprocess', 'node'], [&$vars]);
}

/**
 * Implements hook_preprocess_field()
 * @param array $vars
 */
function dimagrimondo_preprocess_field(&$vars)
{
    HookExecutor::executeFieldHooks(['preprocess', 'field'], [&$vars]);
}

/**
 * Implements hook_preprocess_paragraphs_items()
 * @param $vars
 */
function dimagrimondo_preprocess_paragraphs_items(&$vars)
{
    HookExecutor::executeGenericHook(['preprocess', 'paragraphs_items'], [&$vars]);
}

/**
 * Implements hook_preprocess_entity()
 * @param array $vars
 * @throws ThemeException
 */
function dimagrimondo_preprocess_entity(&$vars)
{
    HookExecutor::executeEntityHooks(['preprocess', 'entity'], [&$vars]);
}

/**
 * Implements hook_preprocess_user_profile()
 * @param array $vars
 * @throws ThemeException
 */
function dimagrimondo_preprocess_user_profile(&$vars)
{
    HookExecutor::executeUserProfileHooks(['preprocess', 'user_profile'], [&$vars]);
}

/**
 * Generic node(all types) edit form hook
 * @param array $form
 * @param array $form_state
 * @throws ThemeException
 */
function dimagrimondo_form_node_form_alter(&$form, $form_state)
{
    HookExecutor::executeGenericHook(['alter', 'form', 'node_edit'], [&$form, $form_state]);
}

/**
 * Form specific alter hook
 * @param array $form
 * @param array $form_state
 * @param string $form_id
 * @throws ThemeException
 */
function dimagrimondo_form_alter(&$form, &$form_state, $form_id)
{
    HookExecutor::executeGenericHook(['alter', 'form', 'id', $form_id], [&$form, $form_state], true);
}


/**
 * Form specific alter hook
 * @param array $data
 * @param array $router_item
 * @param string $root_path
 * @throws ThemeException
 */
function dimagrimondo_menu_local_tasks_alter(&$data, $router_item, $root_path)
{
    HookExecutor::executeGenericHook(['alter', 'menu', 'local_tasks'], [&$data, $router_item, $root_path]);
}




/*
 * OLD HOOKS:
function dimagrimondo_menu_local_tasks($vars)
function dimagrimondo_menu_local_task($vars)
function dimagrimondo_links($vars)
function dimagrimondo_button($vars)
function dimagrimondo_breadcrumb($vars)//
function dimagrimondo_preprocess_block(&$vars)
function dimagrimondo_preprocess_taxonomy_term(&$vars)
function dimagrimondo_preprocess_views_exposed_form(&$vars)
function dimagrimondo_views_pre_render(&$view)
function dimagrimondo_contextual_links_view_alter(&$element, $items)
function dimagrimondo_menu_tree__devel(&$vars)
function dimagrimondo_preprocess_menu_link(&$vars)
function dimagrimondo_menu_tree__primary(&$vars)
*/