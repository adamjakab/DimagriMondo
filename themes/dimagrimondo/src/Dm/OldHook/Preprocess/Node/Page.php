<?php
/**
 * Created by Adam Jakab.
 * Date: 14/06/16
 * Time: 15.34
 */

namespace Dm\OldHook\Preprocess\Node;

/**
 * Class Page
 *
 * @package Mekit\Hook\Preprocess\Node
 */
class Page extends Node
{
  /**
   * The main hook execution method
   * @param array $vars
   */
  public function execute(&$vars) {
    parent::execute($vars);
    $this->doSomething($vars);
  }

  protected function doSomething(&$vars)
  {
    //dsm("BELLA STORIA!");
  }

}