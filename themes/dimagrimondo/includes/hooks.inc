<?php

use Dm\Util\HookHelper;
use Dm\Exception\ThemeException;

/**
 * Implements hook_preprocess_page()
 * @param array $vars
 * @throws ThemeException
 */
function dimagrimondo_preprocess_page(&$vars) {
    HookHelper::executeGenericHook(['preprocess', 'page'], [&$vars]);
}

/**
 * Implements hook_preprocess_html()
 * @param array $vars
 * @throws ThemeException
 */
function dimagrimondo_preprocess_html(&$vars)
{
    HookHelper::executeGenericHook(['preprocess', 'html'], [&$vars]);
}

/**
 * Implements hook_preprocess_node()
 * @param array $vars
 */
function dimagrimondo_preprocess_node(&$vars)
{
    HookHelper::executeNodeHooks(['preprocess', 'node'], [&$vars]);
}

/**
 * Implements hook_preprocess_entity()
 * @param array $vars
 */
function dimagrimondo_preprocess_entity(&$vars)
{
    HookHelper::executeEntityHooks(['preprocess', 'entity'], [&$vars]);
}

/**
 * Generic node(all types) edit form hook
 * @param array $form
 * @param array $form_state
 */
function dimagrimondo_form_node_form_alter(&$form, $form_state)
{
    //@todo: we need camelize for 'node_edit' key to become NodeEdit
    HookHelper::executeGenericHook(['alter', 'form', 'node_edit'], [&$form, $form_state]);
}

/**
 * Form specific alter hook
 * @param array $form
 * @param array $form_state
 * @param string $form_id
 */
function dimagrimondo_form_alter(&$form, &$form_state, $form_id)
{
    HookHelper::executeGenericHook(['alter', 'form', 'id', $form_id], [&$form, $form_state], true);
}


/**
 * Form specific alter hook
 * @param array $data
 * @param array $router_item
 * @param string $root_path
 */
function dimagrimondo_menu_local_tasks_alter(&$data, $router_item, $root_path)
{
    HookHelper::executeGenericHook(['alter', 'menu', 'local_tasks'], [&$data, $router_item, $root_path]);
}


/*
 * OLD HOOKS:
function dimagrimondo_menu_link($vars)
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