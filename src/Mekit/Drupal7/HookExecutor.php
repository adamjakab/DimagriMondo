<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 11.02
 */

namespace Mekit\Drupal7;

use Mekit\Drupal7\Exception\HookException;
use Stringy\StaticStringy as S;

/**
 * Class HookExecutor
 *
 * @package Mekit\Drupal7
 */
class HookExecutor
{
    /** @var string */
    protected static $hooksNameSpaceRoot = '';

    /**
     * Set the namespace root from where classes will be autoloaded
     * This, normally, will be the uppercased name of the theme
     * Final '\' is required
     *
     * @param string $hooksNameSpaceRoot
     */
    public static function setHooksNameSpaceRoot(string $hooksNameSpaceRoot)
    {
        HookExecutor::$hooksNameSpaceRoot = $hooksNameSpaceRoot;
    }


    /**
     * Executes a series of hooks on Nodes
     *
     * @param array $hookNameParts
     * @param array $arguments
     *
     * @throws HookException
     */
    public static function executeNodeHooks(array $hookNameParts, array $arguments = [])
    {
        HookExecutor::executeGenericHook($hookNameParts, $arguments);
        if (isset($arguments[0]['node'])) {
            /** @var \stdClass $node */
            $node = $arguments[0]['node'];

            //Execute a hook for a specific node type
            if (isset($node->type)) {
                $hookNamePartsType = array_merge($hookNameParts, ['type', $node->type]);
                HookExecutor::executeGenericHook($hookNamePartsType, $arguments, true);
            }

            //Execute a hook for a specific node id
            if (isset($node->nid)) {
                $hookNamePartsId = array_merge($hookNameParts, ['id', 'node' . $node->nid]);
                HookExecutor::executeGenericHook($hookNamePartsId, $arguments, true);
            }
        }
    }

    /**
     * Executes a series of hooks on Fields
     *
     * @param array $hookNameParts
     * @param array $arguments
     *
     * @throws HookException
     */
    public static function executeFieldHooks(array $hookNameParts, array $arguments = [])
    {
        HookExecutor::executeGenericHook($hookNameParts, $arguments);

        //Execute a hook for a specific type
        if (isset($arguments[0]['element']['#field_type'])) {
            $type = $arguments[0]['element']['#field_type'];
            $hookNamePartsType = array_merge($hookNameParts, ['type', $type]);
            HookExecutor::executeGenericHook($hookNamePartsType, $arguments, true);
        }
    }

    /**
     * Executes a series of hooks on Entities
     *
     * @param array $hookNameParts
     * @param array $arguments
     *
     * @throws HookException
     */
    public static function executeEntityHooks(array $hookNameParts, array $arguments = [])
    {
        HookExecutor::executeGenericHook($hookNameParts, $arguments);

        //Execute a hook for a specific type
        if (isset($arguments[0]['entity_type'])) {
            $type = $arguments[0]['entity_type'];
            $hookNamePartsType = array_merge($hookNameParts, ['type', $type]);
            HookExecutor::executeGenericHook($hookNamePartsType, $arguments, true);

            //Execute a hook for a specific paragraphs bundle
            if ($type == 'paragraphs_item') {
                if (isset($arguments[0]['elements']['#bundle'])) {
                    $bundle = $arguments[0]['elements']['#bundle'];
                    $hookNamePartsBundle = array_merge($hookNameParts, ['paragraphs', 'bundle', $bundle]);
                    HookExecutor::executeGenericHook($hookNamePartsBundle, $arguments, true);
                }
            }
        }
    }

    /**
     * @param array $hookNameParts
     * @param array $arguments
     * @param bool $ignoreExceptions
     * @param bool $debug
     *
     * @return mixed
     *
     * @throws HookException
     */
    public static function executeGenericHook(array $hookNameParts, array $arguments = [], $ignoreExceptions = false,
                                              $debug = false)
    {
        $answer = false;
        try {
            $answer = HookExecutor::callHookExecute($hookNameParts, $arguments);
        } catch (HookException $e) {
            if (!$ignoreExceptions) {
                throw $e;
            }
            if ($debug) {
                dsm("Hook Execution Error: " . $e->getMessage());
            }
        }

        return $answer;
    }

    /**
     * @param array $hookNameParts
     * @param array $arguments
     *
     * @return mixed
     */
    private static function callHookExecute(array $hookNameParts, array $arguments = [])
    {
        $hookClassPath = HookExecutor::resolveToClassPath($hookNameParts);

        return call_user_func_array([$hookClassPath, "execute"], $arguments);
    }

    /**
     * @param array $hookNameParts
     *
     * @return string
     * @throws HookException
     */
    private static function resolveToClassPath(array $hookNameParts)
    {
        if (!count($hookNameParts)) {
            throw new HookException("Empty array provided!");
        }

        foreach ($hookNameParts as &$hookNamePart) {
            $hookNamePart = S::upperCamelize($hookNamePart);
        }

        $hookClassPath = HookExecutor::$hooksNameSpaceRoot . implode("\\", $hookNameParts);

        if (!class_exists($hookClassPath)) {
            throw new HookException("Class '" . $hookClassPath . "' does not exist!");
        }

        $implementClass = 'Mekit\Drupal7\HookInterface';
        if (!in_array($implementClass, class_implements($hookClassPath))) {
            throw new HookException("Class($hookClassPath) must implement $implementClass!");
        }

        return $hookClassPath;
    }
}