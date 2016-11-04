<?php
/**
 * Common defines and functions
 */

use Mekit\Drupal7\HookExecutor;
use Mekit\Drupal7\Exception\ThemeException;

/**
 * Setting namespace root for HookExecutor using the name of the current theme
 * like 'mytheme' -> 'Mytheme\'
 */
HookExecutor::setHooksNameSpaceRoot(ucfirst(strtolower($GLOBALS['theme'])) . '\\');
