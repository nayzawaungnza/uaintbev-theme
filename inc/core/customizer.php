<?php
if (!function_exists('uaintbev_topbar_customize_register')) {
    function uaintbev_topbar_customize_register($wp_customize) {
        // Add Top Bar Section
        $wp_customize->add_section('uaintbev_topbar_section', [
            'title'    => __('Top Bar Options', 'uaintbev'),
            'priority' => 25,
        ]);

        // Add Phone Setting
        $wp_customize->add_setting('uaintbev_topbar_phone', [
            'default'           => '+041-982-3648',
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        $wp_customize->add_control('uaintbev_topbar_phone', [
            'label'   => __('Phone Number', 'uaintbev'),
            'section' => 'uaintbev_topbar_section',
            'type'    => 'text',
        ]);

        // Add Email Setting
        $wp_customize->add_setting('uaintbev_topbar_email', [
            'default'           => 'info@gmail.com',
            'sanitize_callback' => 'sanitize_email',
        ]);

        $wp_customize->add_control('uaintbev_topbar_email', [
            'label'   => __('Email Address', 'uaintbev'),
            'section' => 'uaintbev_topbar_section',
            'type'    => 'email',
        ]);

        // Add Address Setting
        $wp_customize->add_setting('uaintbev_topbar_address', [
            'default'           => '22 Vokte Street Building Melborn City',
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        $wp_customize->add_control('uaintbev_topbar_address', [
            'label'   => __('Address', 'uaintbev'),
            'section' => 'uaintbev_topbar_section',
            'type'    => 'text',
        ]);

        // Add Show/Hide Top Bar Setting
        $wp_customize->add_setting('uaintbev_show_topbar', [
            'default'           => true,
            'sanitize_callback' => 'wp_validate_boolean',
        ]);

        $wp_customize->add_control('uaintbev_show_topbar', [
            'label'   => __('Display Top Bar', 'uaintbev'),
            'section' => 'uaintbev_topbar_section',
            'type'    => 'checkbox',
        ]);
    }
    add_action('customize_register', 'uaintbev_topbar_customize_register');
}


/**
 * Theme Customizer: Social Options
 */
if (!function_exists('uaintbev_social_customize_register')) {
    function uaintbev_social_customize_register($wp_customize) {
        // Add Social Icons Section
        $wp_customize->add_section('uaintbev_social_icons_section', [
            'title'    => __('Social Options', 'uaintbev'),
            'priority' => 30,
        ]);

        // Add Settings and Controls
        $settings_controls = [
            'uaintbev_social_display' => [
                'label'    => __('Display Icons', 'uaintbev'),
                'type'     => 'checkbox',
                'default'  => false,
                'sanitize' => 'wp_validate_boolean',
            ],
            'social_title' => [
                'label'    => __('Title', 'uaintbev'),
                'type'     => 'text',
                'default'  => __('Follow Us', 'uaintbev'),
                'sanitize' => 'sanitize_text_field',
            ],
            'facebook_icon' => [
                'label'    => __('Facebook URL', 'uaintbev'),
                'type'     => 'url',
                'default'  => '',
                'sanitize' => 'esc_url_raw',
            ],
            'twitter_icon' => [
                'label'    => __('Twitter URL', 'uaintbev'),
                'type'     => 'url',
                'default'  => '',
                'sanitize' => 'esc_url_raw',
            ],
            'instagram_icon' => [
                'label'    => __('Instagram URL', 'uaintbev'),
                'type'     => 'url',
                'default'  => '',
                'sanitize' => 'esc_url_raw',
            ],
            'linkedin_icon' => [
                'label'    => __('LinkedIn URL', 'uaintbev'),
                'type'     => 'url',
                'default'  => '',
                'sanitize' => 'esc_url_raw',
            ],
            'youtube_icon' => [
                'label'    => __('YouTube URL', 'uaintbev'),
                'type'     => 'url',
                'default'  => '',
                'sanitize' => 'esc_url_raw',
            ],
        ];

        foreach ($settings_controls as $setting => $options) {
            $wp_customize->add_setting($setting, [
                'default'           => $options['default'],
                'sanitize_callback' => $options['sanitize'],
            ]);
            $wp_customize->add_control($setting, [
                'label'   => $options['label'],
                'section' => 'uaintbev_social_icons_section',
                'type'    => $options['type'],
            ]);
        }
    }
    add_action('customize_register', 'uaintbev_social_customize_register');
}
/**
 * Display Social Media Icons
 */
if (!function_exists('uaintbev_social')) {
    function uaintbev_social() {
        if (!get_theme_mod('uaintbev_social_display', false)) {
            return;
        }

        $social_links = [
            'facebook'  => get_theme_mod('facebook_icon', ''),
            'twitter'   => get_theme_mod('twitter_icon', ''),
            'instagram' => get_theme_mod('instagram_icon', ''),
            'linkedin'  => get_theme_mod('linkedin_icon', ''),
            'youtube'   => get_theme_mod('youtube_icon', ''),
        ];

        $social_title = get_theme_mod('social_title', __('Follow Us', 'uaintbev'));

        echo '<div class="right">';
        // if ($social_title) {
        //     echo '<h4>' . esc_html($social_title) . '</h4>';
        // }
        echo '<ul>';
        foreach ($social_links as $platform => $url) {
            if ($url) {
                printf(
                    '<li><a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s"><i class="fa-brands fa-%s"></i></a></li>',
                    esc_url($url),
                    ucfirst($platform),
                    esc_attr($platform)
                );
            }
        }
        echo '</ul>';
        echo '</div>';
    }
}


/**
 * Theme Customizer: WooCommerce Cart Options
 */
// if (!function_exists('uaintbev_cart_customize_register')) {
//     function uaintbev_cart_customize_register($wp_customize) {
//         // Add WooCommerce Options Section
//         $wp_customize->add_section('uaintbev_woocommerce_options_section', [
//             'title'    => __('WooCommerce Options', 'uaintbev'),
//             'priority' => 30,
//         ]);

//         // Add Settings and Controls
//         $wp_customize->add_setting('uaintbev_cart_display', [
//             'default'           => true,
//             'sanitize_callback' => 'wp_validate_boolean',
//         ]);
//         $wp_customize->add_control('uaintbev_cart_display', [
//             'label'    => __('Display Cart Icon', 'uaintbev'),
//             'section'  => 'uaintbev_woocommerce_options_section',
//             'type'     => 'checkbox',
//         ]);

//         $wp_customize->add_setting('uaintbev_cart_title', [
//             'default'           => __('Cart', 'uaintbev'),
//             'sanitize_callback' => 'sanitize_text_field',
//         ]);
//         $wp_customize->add_control('uaintbev_cart_title', [
//             'label'    => __('Cart Title', 'uaintbev'),
//             'section'  => 'uaintbev_woocommerce_options_section',
//             'type'     => 'text',
//         ]);

//         $wp_customize->add_setting('uaintbev_cart_page_link', [
//             'default'           => '',
//             'sanitize_callback' => 'esc_url_raw',
//         ]);
//         $wp_customize->add_control('uaintbev_cart_page_link', [
//             'label'    => __('Cart Page URL', 'uaintbev'),
//             'section'  => 'uaintbev_woocommerce_options_section',
//             'type'     => 'url',
//         ]);
//     }
//     add_action('customize_register', 'uaintbev_cart_customize_register');
// }

// /**
//  * Display WooCommerce Cart
//  */
// if (!function_exists('uaintbev_cart')) {
//     function uaintbev_cart() {
//         if (!get_theme_mod('uaintbev_cart_display', true)) {
//             return;
//         }

//         $cart_title = get_theme_mod('uaintbev_cart_title', __('Cart', 'uaintbev'));
//         $cart_url   = get_theme_mod('uaintbev_cart_page_link', wc_get_cart_url());

//         echo '<div class="header__cart">';
//         echo '<div class="carticon"><a href="' . esc_url($cart_url) . '"><i class="fa-light fa-basket-shopping"></i></a></div>';
//         echo '<div class="cart-details">';
//         echo '<div class="total">';
//         echo '<h6>' . esc_html($cart_title) . '</h6>';
//         echo '<p>' . WC()->cart->get_cart_subtotal() . '</p>';
//         echo '<a href="' . esc_url(wc_get_checkout_url()) . '" class="checkout-btn">' . __('Checkout', 'uaintbev') . '</a>';
//         echo '</div>';
//         echo '</div>';
//         echo '</div>';
//     }
// }

// if (class_exists('WooCommerce')) {
//     add_action('customize_register', 'uaintbev_cart_customize_register');
// }
/**
 * Theme Customizer: CTA Options
 */
if (!function_exists('uaintbev_cta_customize_register')) {
    function uaintbev_cta_customize_register($wp_customize) {
        // Add CTA Section
        $wp_customize->add_section('uaintbev_cta_icons_section', [
            'title'    => __('CTA Options', 'uaintbev'),
            'priority' => 30,
        ]);

        // Add Settings and Controls
        $settings_controls = [
            'uaintbev_cta_display' => [
                'label'    => __('Display CTA', 'uaintbev'),
                'type'     => 'checkbox',
                'default'  => false,
                'sanitize' => 'wp_validate_boolean',
            ],
            'button_title' => [
                'label'    => __('Button Title', 'uaintbev'),
                'type'     => 'text',
                'default'  => __('Explore Garden', 'uaintbev'),
                'sanitize' => 'sanitize_text_field',
            ],
            'button_url' => [
                'label'    => __('Button URL', 'uaintbev'),
                'type'     => 'url',
                'default'  => home_url('/contact.html'),
                'sanitize' => 'esc_url_raw',
            ],
        ];

        foreach ($settings_controls as $setting => $options) {
            $wp_customize->add_setting($setting, [
                'default'           => $options['default'],
                'sanitize_callback' => $options['sanitize'],
            ]);

            $wp_customize->add_control($setting, [
                'label'   => $options['label'],
                'section' => 'uaintbev_cta_icons_section',
                'type'    => $options['type'],
            ]);
        }
    }
    add_action('customize_register', 'uaintbev_cta_customize_register');
}

/**
 * Display CTA button
 */
if (!function_exists('uaintbev_cta')) {
    function uaintbev_cta() {
        if (!get_theme_mod('uaintbev_cta_display', false)) {
            return;
        }

        $button_title = get_theme_mod('button_title', __('Explore Garden', 'uaintbev'));
        $button_url = get_theme_mod('button_url', home_url('/contact'));

        if (!$button_title || !$button_url) {
            return; // Exit if title or URL is missing
        }

        echo '<div class="header__bottombtn d-xl-block d-none">';
        echo '<a href="' . esc_url($button_url) . '" class="custom-btn">' . esc_html($button_title) . '</a>';
        echo '</div>';
    }
}