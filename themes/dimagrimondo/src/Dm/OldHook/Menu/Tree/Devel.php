<?php
/**
 * Created by Luca Cattaneo.
 * Date: 13/05/16
 * Time: 13:00
 * Unused.. ;)
 */

namespace Dm\OldHook\Menu\Tree;


use Dm\OldHook\Hook;

class Devel extends Hook
{
	/**
	 * The main hook execution method
	 * @param array $vars
   * @return string
	 */
	public function execute(&$vars) {
		return '<ul class="menu-devel">' . $vars['tree'] . '</ul>';
	}
}

