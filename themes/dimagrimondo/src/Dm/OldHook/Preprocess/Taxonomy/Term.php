<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 14.11
 */

namespace Dm\OldHook\Preprocess\Taxonomy;


use Dm\OldHook\Hook;

class Term extends Hook
{

	/**
	 * @param array $vars
	 */
	public function execute(&$vars) {
        $this->modifyDoorSpecShutterForOwlCarousel($vars);
	}


    protected function modifyDoorSpecShutterForOwlCarousel(&$taxItem) {
        if($taxItem['view_mode'] == 'owl_carousel_display') {

            $taxItem['classes_array'] = ['item'];

            $imagePath = $taxItem['field_img_main'][0]['uri'];

            $imageMarkup = theme('image_style',
                                 array(
                                     'style_name' => 'thumbnail',
                                     'path' => $imagePath,
                                     'getsize' => TRUE,
                                     'attributes' => array('class' => 'thumb'))//'width' => '150', 'height' => '162'
            );

            $markup = $imageMarkup;
            $taxItem['content']['#markup'] = $markup;
        }
    }

}