<?php
/**
 * Created by Adam Jakab.
 * Date: 14/06/16
 * Time: 15.34
 */

namespace Dm\OldHook\Preprocess\Node;

class InternalDoor extends DierreProduct
{
    /**
     * The main hook execution method
     *
     * @param array $vars
     */
    public function execute(&$vars)
    {
        parent::execute($vars);
        $this->formatDimensions($vars);
    }
    
    
    
    protected function formatDimensions(&$vars)
    {
        if ($vars['view_mode'] == 'full')
        {
            
            // Luce lunghezza nominale
            if (isset($vars['content']['field_standard_width']))
            {
                $w = $vars['content']['field_standard_width'][0]['#markup'];
                $w = preg_replace("/[^0-9]/", " ", $w);
                $vars['content']['field_standard_width'] = array(
                    '#prefix' => '<ul class="field_standard_width small">',
                    '#suffix' => '</ul>',
                    '#markup' => '<li><p><strong>Luce lunghezza nominale</strong></p>' . $w . ' mm' . '</li>',
                );
            }
            
            // Luce altezza nominale
            if (isset($vars['content']['field_standard_height']))
            {
                $h = $vars['content']['field_standard_height'][0]['#markup'];
                $h = preg_replace("/[^0-9]/", " ", $h);
                $vars['content']['field_standard_height'] = array(
                    '#prefix' => '<ul class="field_standard_height small">',
                    '#suffix' => '</ul>',
                    '#markup' => '<li><p><strong>Luce altezza nominale</strong></p>' . $h . ' mm' . '</li>',
                );
            }
            
            // Spessore muro
            if (isset($vars['content']['field_wall_thickness']))
            {
                $h = $vars['content']['field_wall_thickness'][0]['#markup'];
                $h = preg_replace("/[^0-9]/", " ", $h);
                $vars['content']['field_wall_thickness'] = array(
                    '#prefix' => '<ul class="field_wall_thickness small">',
                    '#suffix' => '</ul>',
                    '#markup' => '<li><p><strong>Spessore muro</strong></p>' . $h . ' mm' . '</li>',
                );
            }
            
        }
    }
    
}