<?php
/**
 * Created by Adam Jakab.
 * Date: 15/09/16
 * Time: 16.53
 */

namespace Dm\OldHook\Preprocess\Node;

class DierreProduct extends Node{
  /**
   * Id of the node where we have the webform to ask for info about product
   * @var int
   */
  protected $productInfoNodeId = 15212;
  
  /**
   * The map identifying fields to be considered as the same between node and taxonomy term for Product Family
   * node field -> term field
   * @var array
   */
  protected $nodeToFamilyFieldMap = [
      'field_title_h1' => 'field_title_h1',
      'field_title_h2' => 'field_title_h2',
      'body' => 'description_field',
      'field_structure_text_field' => 'field_structure_text_field',
      'field_finishing' => 'field_finishing',
  ];
  
  /**
   * The main hook execution method
   *
   * @param array $vars
   */
  protected function execute(&$vars)
  {
      parent::execute($vars);
      $this->mapFamilyFieldsFromTaxonomyTerm($vars);
      $this->addProductInfoRequestContactForm($vars);
  }
  
  /**
   * Each product has a field called 'field_group' which (if set) identifies the family of the product
   * Family is a taxonomy term and holds values common to all family members like description, pdf to download, etc.
   * These fields on the node are also available so if they are set we use the values set on the node
   * otherwise we use that of the family taxonomy term
   *
   * @param array $vars
   */
  protected function mapFamilyFieldsFromTaxonomyTerm(&$vars){
    // Administrator
    $admin = FALSE;
    global $user;
    if (isset($user->roles[3])){
      $admin = TRUE;
    }

    // Bail out if no Family is set
    if(!isset($vars['node']->field_group[LANGUAGE_NONE][0]['tid'])) {
      return;
    }
    
    // Why only full?
    if ($vars['view_mode'] == 'full'){
      $node = $vars['node'];
      $lang = $this->getCurrentLanguageCode();
      $tid = $node->field_group[LANGUAGE_NONE][0]['tid'];
      $term = taxonomy_term_load($tid);
      if($term){
        $term_view = taxonomy_term_view($term);

        // Debud override
        $d_override= array();

        // Loop che sostituisce i campi della tassonomia se il campo nel nodo non ha valori
        foreach($this->nodeToFamilyFieldMap as $nodeFieldName => $termFieldName){
          //node has specific override value - leave it alone
          if(isset($node->$nodeFieldName[$lang][0])) {
            //dsm("NODE OVERRIDE($nodeFieldName)!");
            $d_override[$nodeFieldName] = array(
              '#markup' => 'Salvato nel nodo',
            );
            continue;
          }
          //term does not have this field or it has no value(sanity check)
          if(!isset($term_view[$termFieldName])) {
            //dsm("NO TERM VALUE($nodeFieldName)!");
            $d_override[$nodeFieldName] = array(
              '#markup' => 'Salvato nel nodo',
            );
            continue;
          }
          $vars['content'][$nodeFieldName] = $term_view[$termFieldName];
          $d_override[$nodeFieldName] = array(
            '#markup' => 'Ereditato da ' . $term->name,
          );
        }

        if ($admin){
          $opt = array(
            'attributes' => array(
              'class' => array('btn', 'btn-default', 'btn-xs'),
            ),
          );
          $vars['content']['debug'] = array(
            '#prefix' => '<div class="well margin-v-1">',
            '#suffix' => '</div>',
            'title' => array(
              '#markup' => '<h2 class="margin-t-0">Debug campi [' . $lang . ']</h2>',
            ),
            'edit' => array(
              '#markup' => l('Edit family', 'taxonomy/term/' . $term->tid . '/edit', $opt),
            ),
          );

          $vars['content']['debug']['fields'] = array(
            '#prefix' => '<ul class="margin-t-1">',
            '#suffix' => '</ul>',
          );
          foreach ($d_override as $key => $value) {
            $vars['content']['debug']['fields'][$key] = array(
              '#prefix' => '<li>',
              '#suffix' => '</li>',
              '#markup' => '<strong>' . $key . '</strong> - ' . $value['#markup'],
            );
          }

        }
        //@todo: add edit button for taxonomy term
        //dpm($term_view, "TV");
      }
    }
  }
    
    
  /**
   * Product Contact info form
   *
   * @param array $vars
   */
  protected function addProductInfoRequestContactForm(&$vars){
    if ($vars['view_mode'] == 'full'){
      $form = node_load($this->productInfoNodeId);
      $vars['content']['form'] = array(
        'node' => node_view($form, 'teaser'),
      );
    }
  }
}