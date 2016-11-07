<?php
/**
 * Common defines and functions
 */

use Mekit\Drupal7\HookExecutor;

/**
 * Setting namespace root for HookExecutor using the name of the current theme
 * like 'mytheme' -> 'Mytheme\'
 */
HookExecutor::setHooksNameSpaceRoot('Dm\\');
