<?php
/*
*Template Name: Functions
*uaintbev functions and definitions
*
*/

function uaintbev_theme_customize_register($wp_customize) {
    // Add first logo setting and control
    $wp_customize->add_setting('uaintbev_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'uaintbev_logo', array(
        'label' => __('uaintbev Logo', 'uaintbev'),
        'section' => 'title_tagline',
        'settings' => 'uaintbev_logo',
    )));

    // Add second logo setting and control
    $wp_customize->add_setting('uaintbev_white_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'uaintbev_white_logo', array(
        'label' => __('uaintbev White Logo', 'text-domain'),
        'section' => 'title_tagline',
        'settings' => 'uaintbev_white_logo',
    )));
}

add_action('customize_register', 'uaintbev_theme_customize_register');



//acton hook
function theme_setup(){
add_theme_support('title_tag');
add_theme_support('custom-logo');

add_theme_support('woocommerce');
add_theme_support(
    'html5',
    array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    )
);

}
add_action('after_setup_theme','theme_setup');

//action hook example
        
       
        
//filter hook example
function custom_excerpt_length(){
    return 15;
}
add_filter('excerpt_lenght','custom_excerpt_length');
//add css and js using action hook
require_once( get_template_directory().'/inc/core/cpt.php');
require_once( get_template_directory().'/inc/core/navmenu-walker.php');
require_once get_template_directory() . '/inc/core/theme-functions.php';
require_once get_template_directory() . '/inc/core/widget.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/core/customizer.php';

/**
 * Custom template tags for this theme.
 */
//require get_template_directory() . '/inc/core/template-tags.php';

//wp_enqueue_script() or wp_enqueue_style()
function uaintbev_theme_scripts(){
wp_enqueue_style('uaintbev-stylesheet', get_stylesheet_uri());
wp_enqueue_style('fontawasome-stylesheet', get_template_directory_uri().'/assets/css/fontawasome.css');
wp_enqueue_style('swiper-bundle-stylesheet', get_template_directory_uri().'/assets/css/swiper-bundle.min.css');

wp_enqueue_style('odometer-stylesheet', get_template_directory_uri().'/assets/css/odometer.css');
wp_enqueue_style('lightcase-stylesheet', get_template_directory_uri().'/assets/css/lightcase.css');
wp_enqueue_style('bootstrap-stylesheet', get_template_directory_uri().'/assets/css/bootstrap.min.css');

wp_enqueue_style('main-stylesheet', get_template_directory_uri().'/assets/css/style.css');

wp_enqueue_script('jquery-script',get_template_directory_uri().'/assets/js/jquery.js', array('jquery'), null, true);
wp_enqueue_script('bootstrap-script',get_template_directory_uri().'/assets/js/bootstrap.bundle.min.js', array('jquery'), null, true);

wp_enqueue_script('swiper-script',get_template_directory_uri().'/assets/js/swiper-bundle.min.js', array('jquery'), null, true);
wp_enqueue_script('odometer-script',get_template_directory_uri().'/assets/js/odometer.js', array('jquery'), null, true);

wp_enqueue_script('isotope-script',get_template_directory_uri().'/assets/js/isotope.pkgd.min.js', array('jquery'), null, true);
wp_enqueue_script('lightcase-script',get_template_directory_uri().'/assets/js/lightcase.js', array('jquery'), null, true);
wp_enqueue_script('viewport-jquery-script',get_template_directory_uri().'/assets/js/viewport.jquery.js', array('jquery'), null, true);
wp_enqueue_script('main-script',get_template_directory_uri().'/assets/js/custom.js', array('jquery'), null, true);

}
add_action('wp_enqueue_scripts','uaintbev_theme_scripts');

function uaintbev_favicon(){
    $site_icon_url = get_site_icon_url();
    if($site_icon_url){
        echo '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url($site_icon_url) . '">' . PHP_EOL;

    }
}
add_action('wp_head','uaintbev_favicon');

//register navigation menu
function register_uaintbev_menu(){
    register_nav_menus(
        array(
            'uaintbev-header-menu' => __('uaintbev Header Menu', 'uaintbev'),
            'uaintbev-footer-menu' => __('uaintbev Footer Menu', 'uaintbev'),
        )
    );
}
add_action('init','register_uaintbev_menu');

function register_uaintbev_widgets(){
    register_sidebar(
        array(
            'id' => 'uaintbev_sidebar',
            'name' => __('UA int Bev Sidebar', 'uaintbev'),
            'description' => __('A short description of the sidebar.', 'uaintbev'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
        )
        );
}
add_action('widgets_init','register_uaintbev_widgets');

function uaintbev_register_footer_widgets() {
    // Register footer widget areas
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => "Footer Widget $i",
            'id'            => "footer-widget-$i",
            'before_widget' => '<div class="footer-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h6 class="widget-title">',
            'after_title'   => '</h6>',
        ));
    }
}
add_action('widgets_init', 'uaintbev_register_footer_widgets');


function copyright_text_customize_register($wp_customize) {
    // Add a section to the Customizer for footer settings
    $wp_customize->add_section('footer_settings', array(
        'title'    => __('Footer Settings', 'uaintbev'),
        'priority' => 120,
    ));

    // Add a setting for the copyright text
    $wp_customize->add_setting('footer_copyright_text', array(
        'default'   => '', // Default value if no custom text is set
        'sanitize_callback' => 'sanitize_text_field', // Sanitize user input
    ));

    // Add the control for the copyright text field
    $wp_customize->add_control('footer_copyright_text', array(
        'label'    => __('Copyright Text', 'uaintbev'),
        'section'  => 'footer_settings',
        'settings' => 'footer_copyright_text',
        'type'     => 'text', // Input field for text
    ));
}
add_action('customize_register', 'copyright_text_customize_register');


// Enable SVG file uploads
function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'allow_svg_upload');

add_theme_support('post-thumbnails');

add_image_size('slider-thumbnail', 1300, 800, true);

add_image_size('breadcrumb-thumbnail', 1920, 500, true);
flush_rewrite_rules();

// Function to track post views
function track_post_views($post_id) {
    if (is_single()) {
        // Check if the post view count is already stored in post meta
        $view_count = get_post_meta($post_id, 'post_view_count', true);

        // If no view count exists, initialize it to 0
        if (!$view_count) {
            $view_count = 0;
        }

        // Increment the view count
        $view_count++;

        // Update the view count in the post meta
        update_post_meta($post_id, 'post_view_count', $view_count);
    }
}

// Hook to track views when a single post is viewed
add_action('wp_head', 'track_post_views');


function uaintbev_pagination() {
    // Define pagination settings
    $args = array(
        'prev_text' => '<i class="fa-solid fa-angles-left"></i>',
        'next_text' => '<i class="fa-solid fa-angles-right"></i>',
        'type' => 'array',  // This ensures the pagination items are returned as an array
    );

    // Get pagination items
    $pagination = paginate_links($args);

    if ($pagination) {
        echo '<div class="pagi d-xl-block d-none">';
        echo '<div class="pagi-inner">';
        echo '<ul>';

        // Previous page link
        echo '<li>';
        echo '<a href="' . get_previous_posts_page_link() . '"><i class="fa-solid fa-angles-left"></i></a>';
        echo '</li>';

        // Pagination links
        foreach ($pagination as $page) {
            echo '<li>' . $page . '</li>';
        }

        // Next page link
        echo '<li>';
        echo '<a href="' . get_next_posts_page_link() . '"><i class="fa-solid fa-angles-right"></i></a>';
        echo '</li>';

        echo '</ul>';
        echo '</div>';
        echo '</div>';
    }
}
function uaintbev_check_required_plugins() {
    // List of required plugins
    $required_plugins = [
        [
            'name'     => 'Elementor',
            'slug'     => 'elementor/elementor.php',
            'download' => 'https://downloads.wordpress.org/plugin/elementor.latest-stable.zip',
        ],
        [
            'name'     => 'Contact Form 7',
            'slug'     => 'contact-form-7/wp-contact-form-7.php',
            'download' => 'https://downloads.wordpress.org/plugin/contact-form-7.latest-stable.zip',
        ],
        [
            'name'     => 'UA Int Bev Core',
            'slug'     => 'uaintbev-core/uaintbev-core.php',
            'download' => get_template_directory_uri() . '/plugins/uaintbev-core.zip', // Adjust path
        ],
    ];

    $inactive_plugins = [];

    // Check plugin status
    foreach ($required_plugins as $plugin) {
        if (!is_plugin_active($plugin['slug'])) {
            $inactive_plugins[] = $plugin;
        }
    }

    // Display admin notice if plugins are inactive
    if (!empty($inactive_plugins)) {
        add_action('admin_notices', function () use ($inactive_plugins) {
            echo '<div class="notice notice-warning is-dismissible">';
            echo '<p><strong>The following plugins are required for this theme:</strong></p>';
            echo '<ul>';
            foreach ($inactive_plugins as $plugin) {
                echo '<li>';
                echo esc_html($plugin['name']);
                echo ' - <a href="' . esc_url($plugin['download']) . '">Download</a>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        });
    }
}
add_action('admin_init', 'uaintbev_check_required_plugins');

?>