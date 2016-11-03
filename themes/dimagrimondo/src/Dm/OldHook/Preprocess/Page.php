<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 12.04
 */

namespace Dm\OldHook\Preprocess;

use Dm\OldHook\Hook;
use Dm\Util\HookHelper;

class Page extends Hook
{
    /**
     * The main hook execution method
     *
     * @param array $vars
     */
    public function execute(&$vars)
    {
        $this->removeMissingContentWarning($vars);
        $this->setIsPageVariable($vars);
        //$this->fixBreadcrumbs ($vars);
        //$this->fix_menu_active_preprocess_page ($vars);
        $this->fix_menu_labels_multilang($vars);
    }
    
    protected function setIsPageVariable(&$vars)
    {
        $vars['is_page'] = isset($vars['node']);
    }
    
    /**
     * //removing missing content warning
     *
     * @param array $vars
     */
    protected function removeMissingContentWarning(&$vars)
    {
        if (isset($vars['page']['content']['system_main']['default_message']))
        {
            unset($vars['page']['content']['system_main']['default_message']);
        }
    }
    
    /**
     * Fixing breadcrumbs for special cases
     *
     * @param array $vars
     */
    protected function fixBreadcrumbs(&$vars)
    {
        $breadcrumb_urls = [
            'it' => [
                "security_door"           => "prodotti/porte-di-sicurezza",
                "door_panelling"          => "prodotti/rivestimenti",
                "internal_door"           => "prodotti/porte-per-interni",
                "door_subframe"           => "prodotti/controtelai",
                "external_closure_system" => "prodotti/serramenti-per-esterni",
                "up_and_over_door"        => "prodotti/portoni-per-garage",
                "fireproof_door"          => "prodotti/tagliafuoco",
                "multipurpose_door"       => "prodotti/multifunzione",
                "door_lock"               => "prodotti/serrature",
                "safe"                    => "prodotti/casseforti",
            ],
            'en' => [
                "security_door"           => "products/security-doors",
                "door_panelling"          => "products/door-panelling",
                "internal_door"           => "products/internal-doors",
                "door_subframe"           => "products/door-subframe",
                "external_closure_system" => "products/external-closure-system",
                "up_and_over_door"        => "products/up-and-over-door",
                "fireproof_door"          => "products/fireproof-door",
                "multipurpose_door"       => "products/multipurpose-door",
                "door_lock"               => "products/door-lock",
                "safe"                    => "products/safe",
            ],
        ];
        $language = $vars['language']->language;
        $product_link = $language == 'en' ? 'products' : 'prodotti';
        
        if (isset($vars['node']))
        {
            $node = $vars['node'];
            
            if ($node->type == 'security_door')
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                $bcs[] = l(t('Security Doors'), $breadcrumb_urls[$language]['security_door']);
                drupal_set_breadcrumb($bcs);
            }
            if ($node->type == 'internal_door')
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                $bcs[] = l(t('Internal Doors'), $breadcrumb_urls[$language]['internal_door']);
                drupal_set_breadcrumb($bcs);
            }
            if ($node->type == 'door_panelling')
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                $bcs[] = l(t('Door Panelling'), $breadcrumb_urls[$language]['door_panelling']);
                drupal_set_breadcrumb($bcs);
            }
            if ($node->type == 'door_subframe')
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                $bcs[] = l(t('Door Subframe'), $breadcrumb_urls[$language]['door_subframe']);
                drupal_set_breadcrumb($bcs);
            }
            if ($node->type == 'external_closure_system')
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                $bcs[] = l(t('External Closure System'), $breadcrumb_urls[$language]['external_closure_system']);
                drupal_set_breadcrumb($bcs);
            }
            if ($node->type == 'up_and_over_door')
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                $bcs[] = l(t('Up and Over Door'), $breadcrumb_urls[$language]['up_and_over_door']);
                drupal_set_breadcrumb($bcs);
            }
            if ($node->type == 'fireproof_door')
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                $bcs[] = l(t('Fireproof Door'), $breadcrumb_urls[$language]['fireproof_door']);
                drupal_set_breadcrumb($bcs);
            }
            if ($node->type == 'multipurpose_door')
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                $bcs[] = l(t('Multipurpose Door'), $breadcrumb_urls[$language]['multipurpose_door']);
                drupal_set_breadcrumb($bcs);
            }
            if ($node->type == 'door_lock')
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                $bcs[] = l(t('Door Lock'), $breadcrumb_urls[$language]['door_lock']);
                drupal_set_breadcrumb($bcs);
            }
            if ($node->type == 'safe')
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                $bcs[] = l(t('Safe'), $breadcrumb_urls[$language]['safe']);
                drupal_set_breadcrumb($bcs);
            }
        }
        else
        {
            if (isset($vars['page']['#views_contextual_links_info']['views_ui']['view']->tag)
                && preg_match("#product_listing#",
                              $vars['page']['#views_contextual_links_info']['views_ui']['view']->tag)
            )
            {
                $bcs = [];
                $bcs[] = t('Home');
                $bcs[] = l(t('Products'), $product_link);
                if (isset($vars['page']['#views_contextual_links_info']['views_ui']['view']->display['default']->display_options['title']))
                {
                    $bcs[] =
                        t($vars['page']['#views_contextual_links_info']['views_ui']['view']->display['default']->display_options['title']);
                }
                drupal_set_breadcrumb($bcs);
            }
        }
    }
    
    /**
     * @param $vars
     */
    protected function fix_menu_active_preprocess_page(&$vars)
    {
        $node_types = [
            "security_door",
            "door_panelling",
            "internal_door",
            "door_subframe",
            "external_closure_system",
            "up_and_over_door",
            "fireproof_door",
            "multipurpose_door",
            "door_lock",
            "safe",
        ];
        if (isset($vars['node']->type) && in_array($vars['node']->type, $node_types))
        {
            
            if (isset($vars["node"]->nid))
            {
                $nid = $vars["node"]->nid;
                $alias = drupal_get_path_alias("node/$nid");
                $alias_array = explode('/', $alias);
                
                $temp_alias = $alias_array[0] . '/' . $alias_array[1];
                $path = current_path();
                $path_alias = drupal_lookup_path('alias', $path);
                $language_menu_urls = [
                    'it' => [
                        "prodotti/porte-di-sicurezza"     => 3953,
                        "prodotti/rivestimenti"           => 3960,
                        "prodotti/porte-per-interni"      => 3958,
                        "prodotti/controtelai"            => 3955,
                        "prodotti/serramenti-per-esterni" => 3961,
                        "prodotti/portoni-per-garage"     => 3959,
                        "prodotti/tagliafuoco"            => 3963,
                        "prodotti/multifunzione"          => 3967,
                        "prodotti/serrature"              => 3962,
                        "prodotti/casseforti"             => 3954,
                    ],
                    'en' => [
                        "products/security-doors"          => 3953,
                        "products/door-panelling"          => 3960,
                        "products/internal-doors"          => 3958,
                        "products/door-subframe"           => 3955,
                        "products/external-closure-system" => 3961,
                        "products/up-and-over-door"        => 3959,
                        "products/fireproof-door"          => 3963,
                        "products/multipurpose-door"       => 3967,
                        "products/door-lock"               => 3962,
                        "products/safe"                    => 3954,
                    ],
                ];
                $current_language = $vars['language']->language;
                foreach ($language_menu_urls as $language_url_key => &$language_url_value)
                {
                    if ($current_language == $language_url_key)
                    {
                        foreach ($language_url_value as $key => &$url)
                        {
                            if (drupal_match_path($key, $temp_alias) || drupal_match_path($key, $path_alias))
                            {
                                menu_set_active_item($vars['primary_nav'][3145]['#href']);
                                $vars['primary_nav'][3145]['#below'][$url]['#attributes']['class'][] =
                                    'active-trail active';
                            }
                        }
                    }
                }
            }
        }
    }
    
    protected function fix_menu_labels_multilang(&$vars)
    {
        foreach ($vars['primary_nav'] as &$item)
        {
            if (isset($item["#title"]))
            {
                $old_value = $item["#title"];
                $item["#title"] = t($old_value);
                if (isset($item["#below"]) && count($item["#below"]) > 0)
                {
                    foreach ($item["#below"] as &$below)
                    {
                        if (isset($below["#title"]))
                        {
                            $old_value_below = $below["#title"];
                            $below["#title"] = t($old_value_below);
                        }
                    }
                }
            }
        }
    }
}