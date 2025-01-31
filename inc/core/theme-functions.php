<?php 
/*************************************************************************************************************************
*
* Common functions after v1.0
*
* Author: Nay Zaw Aung
*************************************************************************************************************************/
//uaintbev Logo
if (!function_exists('uaintbev_logo')) {
    function uaintbev_logo() {
        // Fetch the custom logo URL from theme mods
        $uaintbev_logo = get_theme_mod('uaintbev_logo');

        if ($uaintbev_logo) {
            echo '<div class="header__logo">
                    <a href="' . esc_url(home_url('/')) . '">
                        <img src="' . esc_url($uaintbev_logo) . '" alt="' . esc_attr(get_bloginfo('name')) . '" />
                    </a>
                  </div>';
        } else {
            // Optional: Fallback if no logo is set
            echo '<div class="header__logo">
                    <a href="' . esc_url(home_url('/')) . '">
                        <span>' . esc_html(get_bloginfo('name')) . '</span>
                    </a>
                  </div>';
        }
    }
}


if (!function_exists('uaintbev_mobile_logo')) {
    function uaintbev_mobile_logo() {
        $uaintbev_white_logo = get_theme_mod('uaintbev_white_logo');

        if ($uaintbev_white_logo) {

			echo '<div class="mobilelogo d-xl-none d-block">';
			echo '<a href="' . esc_url(home_url('/')) . '">';
			echo '<img src="' . esc_url($uaintbev_white_logo) . '" alt="' . get_bloginfo('name') . '">';
			echo '</a></div>';

        }
    }
}
//uaintbev Menu

if (!function_exists('uaintbev_navigation_menu')) {
	function uaintbev_navigation_menu($type = ""){
		// if(empty($type)){
		// 	$navclass= '';
		// }else{
		// 	$navclass= 'mean-menu';
		// }
	  $defaults = array(
	      'theme_location'  => 'uaintbev-header-menu',
		  'container'      => 'div',          // The container element, can be 'nav' or 'div'
		  'container_class'=> 'mainactive activescroll',  // Add the container class as per your HTML
		  'menu_class'     => '',  
	      'walker'          => (class_exists('uaintbev_walker_nav_menu'))? new uaintbev_walker_nav_menu($type): ''
	  );
	  if (has_nav_menu( 'uaintbev-header-menu' )) {
	    wp_nav_menu( $defaults );
	  }
	}
}




?>