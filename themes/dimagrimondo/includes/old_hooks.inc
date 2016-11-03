<?php

die("KO");

use Dm\Util\HookHelper;
use Dm\Exception\ThemeException;

/**
 * Overrides theme_menu_link()
 * @param array $vars
 * @return string
 */
function dimagrimondo_menu_link($vars)
{
//  return HookHelper::executeHook(__FUNCTION__, [$vars]);
}

/**
 * Overrides theme_menu_local_tasks()
 *
 * @param array $vars
 *
 * @return mixed
 * @throws ThemeException
 */
function dimagrimondo_menu_local_tasks($vars)
{
//	return HookHelper::executeHook(__FUNCTION__, [$vars]);
}

/**
 * Overrides theme_menu_local_task()
 *
 * @param array $vars
 *
 * @return mixed
 * @throws ThemeException
 */
function dimagrimondo_menu_local_task($vars)
{
//	return HookHelper::executeHook(__FUNCTION__, [$vars]);
}

/**
 * Implements hook_links()
 *
 * @param array $vars
 *
 * @return mixed
 * @throws ThemeException
 */
function dimagrimondo_links($vars)
{
//	return HookHelper::executeHook(__FUNCTION__, [$vars]);
}

/**
 * @param array $vars
 *
 * @return mixed
 * @throws ThemeException
 */
function dimagrimondo_button($vars)
{
//	return HookHelper::executeHook(__FUNCTION__, [$vars]);
}

/**
 * Overrides theme_breadcrumb().
 *
 * @param array $vars
 *
 * @return mixed
 * @throws ThemeException
 */
function dimagrimondo_breadcrumb($vars)
{
//  return HookHelper::executeHook(__FUNCTION__, [$vars]);
}

/**
 * Implements hook_preprocess_page()
 *
 * @param array $vars
 *
 * @throws ThemeException
 */
function dimagrimondo_preprocess_page(&$vars)
{
//	HookHelper::executeHook(__FUNCTION__, [&$vars]);
}

/**
 * Implements hook_preprocess_node()
 *
 * @param array $vars
 *
 * @throws ThemeException
 */
function dimagrimondo_preprocess_node(&$vars)
{
    /*
  $type = isset($vars["type"]) ? $vars["type"] : false;
  if($type) {
    //convert "internal_door" -> "InternalDoor" otherwise it would look for ...\Internal\Door
    $typeParts = array_filter(explode("_", $type));
    $typeParts = array_map('ucfirst', $typeParts);
    $type = implode("", $typeParts);
    HookHelper::executeHook(__FUNCTION__ . '_' . $type, [&$vars]);
  }
   */
}

/**
 * Implements hook_preprocess_field()
 *
 * @param array $vars
 *
 * @throws ThemeException
 */
function dimagrimondo_preprocess_field(&$vars)
{
//	HookHelper::executeHook(__FUNCTION__, [&$vars]);
}

/**
 * Implements hook_preprocess_image()
 *
 * @param array $vars
 *
 * @throws ThemeException
 */
function dimagrimondo_preprocess_image(&$vars)
{
//	HookHelper::executeHook(__FUNCTION__, [&$vars]);
}

/**
 * Implements hook_preprocess_block()
 *
 * @param array $vars
 *
 * @throws ThemeException
 */
function dimagrimondo_preprocess_block(&$vars)
{
//	HookHelper::executeHook(__FUNCTION__, [&$vars]);
}

/**
 * Implements hook_preprocess_toolbar()
 *
 * @param array $vars
 *
 * @throws ThemeException
 */
function dimagrimondo_preprocess_toolbar(&$vars)
{
//	HookHelper::executeHook(__FUNCTION__, [&$vars]);
}

/**
 * Implements hook_preprocess_taxonomy_term()
 *
 * @param array $vars
 *
 * @throws ThemeException
 */
function dimagrimondo_preprocess_taxonomy_term(&$vars)
{
//    HookHelper::executeHook(__FUNCTION__, [&$vars]);
}

/**
 * Implements hook_preprocess_views_exposed_form()
 *
 * @param array $view
 *
 * @throws ThemeException
 */
function dimagrimondo_preprocess_views_exposed_form(&$vars)
{
//    HookHelper::executeHook(__FUNCTION__, [&$vars]);
}


/**
 * Implements hook_views_pre_render()
 *
 * @param array $view
 *
 * @throws ThemeException
 */
function dimagrimondo_views_pre_render(&$view)
{
//  HookHelper::executeHook(__FUNCTION__, [&$view]);
}

/**
 * Implements hook_contextual_links_view_alter()
 * Modifies the 'Edit view' contextual link title by adding the name of the view to it
 * @param array $element
 * @param array $items
 */
function dimagrimondo_contextual_links_view_alter(&$element, $items)
{
//  HookHelper::executeHook(__FUNCTION__, [&$element, $items]);
}

/**
 * Implements hook_menu_tree__devel()
 *
 * @param array $vars
 *
 * @throws ThemeException
 */
function dimagrimondo_menu_tree__devel(&$vars)
{
//  return HookHelper::executeHook(__FUNCTION__, [&$vars]);
}

/**
 * Implements hook_preprocess_menu_link();
 *
 * @param array $vars
 *
 * @throws ThemeException
 */
function dimagrimondo_preprocess_menu_link(&$vars)
{
//  return HookHelper::executeHook(__FUNCTION__, [&$vars]);
}

/**
 * To do: spostare in SRC
 */
function dimagrimondo_menu_tree__primary(&$vars)
{
//  return $vars['tree'];
}