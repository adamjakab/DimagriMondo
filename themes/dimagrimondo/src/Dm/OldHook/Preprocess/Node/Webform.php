<?php
/**
 * Created by Adam Jakab.
 * Date: 14/06/16
 * Time: 15.34
 */

namespace Dm\OldHook\Preprocess\Node;

/**
 * Class Webform
 *
 * @package Mekit\Hook\Preprocess\Node
 */
class Webform extends Node
{
  /**
   * The main hook execution method
   * @param array $vars
   */
  public function execute(&$vars) {
    parent::execute($vars);
    if ($vars['nid'] == 15212){
      $this->alterTitle($vars);
    }
    
  }

  protected function alterTitle(&$vars){
    if ($vars['view_mode'] == 'teaser'){
      $node = menu_get_object();
      if($node){
        $product_title = field_view_field('node', $node, 'title_field');
        if (isset($vars['content']['title_field'][0]['#markup'])){
          $title = $vars['content']['title_field'][0]['#markup'];
          $vars['content']['title_field'][0]['#markup'] = '<h3>' . $title . ' su ' . $product_title[0]['#markup'] . '</h3>';
        }
      }
    }
  }

}

//// this is for your developer information and shows you the
//    // structure of the form array
//    if ($form_id != "webform_client_form_15212") {
//        return;
//    }
//    $nodeid=false;
//    $alias = '';
//    if (arg(0) == 'node' && is_numeric(arg(1))) {
//        $nodeid = arg(1);
//    }
//    if($nodeid==false){
//        return;
//    }
//    $node= node_load($nodeid);
//    $options = array('absolute' => TRUE);
//    $url = url('node/' . $node->nid, $options);
//    $form["submitted"]["title_webform"]["#markup"]="<h5>Chiedi informazioni su ". $node->title."</h5>";
//    $form["submitted"]["nome_nodo"]["#value"]=$node->title;
// // Node ID
//    $form["submitted"]["indirizzo_web"]["#value"]=$url;//