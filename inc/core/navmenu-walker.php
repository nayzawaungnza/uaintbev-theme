<?php

if (!class_exists('uaintbev_walker_nav_menu')) {
    class uaintbev_walker_nav_menu extends Walker_Nav_Menu {public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
	
		// Remove unwanted classes like 'menu-item', 'menu-item-type-post_type', etc.
		$classes = array_diff($classes, array(
			'menu-item', 'menu-item-type-post_type', 'menu-item-object-page', 
			'current-menu-ancestor', 'current_page_ancestor'
		));
	
		// Add the 'active' class if the item is the current menu item
		if (in_array('current-menu-item', $classes)) {
			$classes[] = 'active';  // Add 'active' class to the item
		}
	
		// Join classes, apply filters, and escape them
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
	
		// Prepare the attributes for the <a> tag
		$attributes = '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
	
		$item_output = $args->before;
		$item_output .= '<a' . $attributes;
	
		// Add 'active' class to the <a> tag if the item is the current menu item
		if (in_array('current-menu-item', $classes)) {
			$item_output .= ' class="active"';
		}
	
		$item_output .= '>';
		$item_output .= apply_filters('the_title', $item->title, $item->ID);
		$item_output .= '</a>';
		$item_output .= $args->after;
	
		// Output the final <li> and <a> tag
		$output .= $indent . '<li' . $class_names . '>' . $item_output;
	}
	
    }
}
?>