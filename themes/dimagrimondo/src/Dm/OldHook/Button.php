<?php
/**
 * Created by Adam Jakab.
 * Date: 27/07/15
 * Time: 13.10
 */

namespace Dm\OldHook;


class Button extends Hook
{

	public function execute($vars) {
		$element = $vars['element'];
		$label = $element['#value'];
		element_set_attributes($element, array('id', 'name', 'value', 'type'));

		// Tasto di invio form (webform, salva)
		if (isset($element['#attributes']['id'])){
			// webform aggiunge l'id del nodo in aggiunta all'id del form
			$id = substr($element['#attributes']['id'], 0, 11);
			if ($id == 'edit-submit'){
				if (!array_search('btn-primary', $element['#attributes']['class'])){
					$element['#attributes']['class'][] = 'btn-primary';
				}
			}
		}
		// Tasto delete
		if (isset($element['#attributes']['id'])){
			if ($element['#attributes']['id'] == 'edit-delete'){
				$element['#attributes']['class'] = array('btn','btn-default','form-submit');
			}
		}

		// If a button type class isn't present then add in default.
		$button_classes = array(
			'btn-default',
			'btn-primary',
			'btn-success',
			'btn-info',
			'btn-warning',
			'btn-danger',
			'btn-link',
		);

		$class_intersection = array_intersect($button_classes, $element['#attributes']['class']);

		if (empty($class_intersection)) {
			$element['#attributes']['class'][] = 'btn-default';
		}

		// Add in the button type class.
		$element['#attributes']['class'][] = 'form-' . $element['#button_type'];

		// This line break adds inherent margin between multiple buttons.
		return '<button' . drupal_attributes($element['#attributes']) . '>' . $label . "</button>\n";
	}
}