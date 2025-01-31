<?php
// Register the custom navigation menu widget
function ua_int_bev_register_navigation_widget() {
    register_widget('UA_Int_Bev_Navigation_Widget');
    register_widget('UA_Int_Bev_Recent_Post_Widget');
    register_widget('UA_Bev_Gallery_Widget');
    register_widget('UA_Int_Bev_Social_Widget');
    register_widget('UA_Int_Bev_About_Widget');
    register_widget('UA_Int_Bev_Popular_Post_Widget');
    register_widget('UA_Int_Bev_Search_Widget');
}
add_action('widgets_init', 'ua_int_bev_register_navigation_widget');

// Define the Widget Class
class UA_Int_Bev_Navigation_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'ua_int_bev_navigation', // Base ID
            __('UA Int Bev Navigation Menu', 'uaintbev'), // Name
            array('description' => __('A custom widget to display a navigation menu.', 'uaintbev')) // Args
        );
    }

    // Frontend display of the widget
    public function widget($args, $instance) {
        echo $args['before_widget'];
    
        // Title
        $title = !empty($instance['title']) ? $instance['title'] : __('Navigation Menu', 'uaintbev');
        //echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
    
        // Display the menu
        if (!empty($instance['menu_id'])) {
            $menu_items = wp_get_nav_menu_items($instance['menu_id']);
    
            if ($menu_items) {
                echo '<div class="footer__link">';
                echo '<h6>' . esc_html($title) . '</h6>';
                echo '<ul>';
                foreach ($menu_items as $menu_item) {
                    echo '<li>';
                    echo '<i class="fa-solid fa-leaf"></i> ';
                    echo '<a href="' . esc_url($menu_item->url) . '">' . esc_html($menu_item->title) . '</a>';
                    echo '</li>';
                }
                echo '</ul>';
                echo '</div>';
            }
        } else {
            echo '<p>' . __('Please select a menu in the widget settings.', 'uaintbev') . '</p>';
        }
    
        echo $args['after_widget'];
    }
    

    // Backend widget form
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Navigation Menu', 'uaintbev');
        $menu_id = !empty($instance['menu_id']) ? $instance['menu_id'] : '';

        // Get all menus
        $menus = wp_get_nav_menus();
        ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uaintbev'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('menu_id'); ?>"><?php _e('Select Menu:', 'uaintbev'); ?></label>
    <select class="widefat" id="<?php echo $this->get_field_id('menu_id'); ?>"
        name="<?php echo $this->get_field_name('menu_id'); ?>">
        <option value=""><?php _e('Select a menu', 'uaintbev'); ?></option>
        <?php foreach ($menus as $menu) : ?>
        <option value="<?php echo esc_attr($menu->term_id); ?>" <?php selected($menu_id, $menu->term_id); ?>>
            <?php echo esc_html($menu->name); ?>
        </option>
        <?php endforeach; ?>
    </select>
</p>
<?php
    }

    // Save widget form values
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['menu_id'] = (!empty($new_instance['menu_id'])) ? sanitize_text_field($new_instance['menu_id']) : '';
        return $instance;
    }
}

// Register the recent post with thumbnail  widget



// Define the custom widget class
class  UA_Int_Bev_Recent_Post_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'ua_int_bev_recent_post', // Base ID
            __('UA Recent Post with Thumbnail', 'uaintbev'), // Name
            array('description' => __('A custom widget to display recent posts with thumbnails', 'uaintbev')) // Args
        );
    }

    // Frontend display of the widget
    public function widget($args, $instance) {
        echo $args['before_widget'];
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent Posts', 'uaintbev');
        if (!empty($instance['title'])) {
            //echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Widget content
        $query_args = array(
            'posts_per_page' => !empty($instance['number']) ? $instance['number'] : 5,
            'post_status' => 'publish',
        );

        $recent_posts = new WP_Query($query_args);

        if ($recent_posts->have_posts()) {
            echo '<div class="footer__news">';
            echo '<h6>' . esc_html($title) . '</h6>';
            echo '<ul>';
            while ($recent_posts->have_posts()) {
                $recent_posts->the_post();
                echo '<li>';
                echo '<div class="thumb imghover">';
                if (has_post_thumbnail()) {
                    echo '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('alt' => get_the_title())) . '</a>';
                } else {
                    echo '<a href="' . get_permalink() . '"><img src="' . esc_url(get_template_directory_uri() . '/assets/img/placeholder.png') . '" alt="placeholder"></a>';
                }
                echo '</div>';
                echo '<div class="text">';
                echo '<h6><a href="' . get_permalink() . '">' . get_the_title() . '</a></h6>';
                echo '<p>' . get_the_date('d F Y') . '</p>';
                echo '</div>';
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
            wp_reset_postdata();
        } else {
            echo '<p>' . __('No posts found.', 'uaintbev') . '</p>';
        }

        echo $args['after_widget'];
    }

    // Backend widget form
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Recent Posts', 'uaintbev');
        $number = !empty($instance['number']) ? $instance['number'] : 5;
        ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uaintbev'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
<p>
    <label
        for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'uaintbev'); ?></label>
    <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>"
        name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1"
        value="<?php echo esc_attr($number); ?>">
</p>
<?php
    }

    // Save widget form values
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? absint($new_instance['number']) : 5;

        return $instance;
    }
}

// Define the custom gallery widget class
class UA_Bev_Gallery_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'ua_bev_gallery_widget', // Base ID
            __('UA int Bev Gallery', 'ua'), // Name
            array('description' => __('A custom widget to display a photo gallery.', 'ua')) // Args
        );
    }

    // Frontend display of the widget
    public function widget($args, $instance) {
        echo $args['before_widget'];
        $title = !empty($instance['title']) ? $instance['title'] : __('Photo Gallery', 'uaintbev');
        if (!empty($instance['title'])) {
            //echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Widget content (gallery HTML structure)
        ?>
<div class="footer__photo">
    <h6><?php echo !empty($instance['title']) ? esc_html($instance['title']) : __('Photo Gallery', 'ua'); ?></h6>
    <div class="allphoto">
        <?php for ($i = 1; $i <= 6; $i++) : ?>
        <?php if (!empty($instance["image_$i"])) : ?>
        <div class="item imghover">
            <a href="#"><img src="<?php echo esc_url($instance["image_$i"]); ?>" alt="Gallery Image"></a>
            <div class="inneritem go-up">
                <div class="upitem search">
                    <a href="<?php echo esc_url($instance["image_$i"]); ?>" data-rel="lightcase:myCollection">
                        <i class="fa-sharp fa-regular fa-eye"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>
<?php

        echo $args['after_widget'];
    }

    // Backend widget form
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Photo Gallery', 'ua');

        // Display title field
        ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ua'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
<?php

        // Display fields for 6 image URLs
        for ($i = 1; $i <= 6; $i++) {
            $image = !empty($instance["image_$i"]) ? $instance["image_$i"] : '';
            ?>
<p>
    <label for="<?php echo $this->get_field_id("image_$i"); ?>"><?php printf(__('Image %d URL:', 'ua'), $i); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id("image_$i"); ?>"
        name="<?php echo $this->get_field_name("image_$i"); ?>" type="text" value="<?php echo esc_url($image); ?>">
</p>
<?php
        }
    }

    // Save widget form values
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';

        for ($i = 1; $i <= 6; $i++) {
            $instance["image_$i"] = (!empty($new_instance["image_$i"])) ? esc_url_raw($new_instance["image_$i"]) : '';
        }

        return $instance;
    }
}

//Register Social Media Widget
class UA_Int_Bev_Social_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'ua_int_bev_social_widget',
            __('UA Int Bev Social', 'ua'),
            array('description' => __('Displays social media links', 'ua'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget']; ?>
<div class="footer__about">
    <h6><?php echo !empty($instance['title']) ? esc_html($instance['title']) : __('Follow Us', 'ua'); ?></h6>
    <div class="text">
        <div class="allsocialicon">

            <ul>
                <?php if (!empty($instance['facebook_url_link'])) : ?>
                <li><a href="<?php echo esc_url($instance['facebook_url_link']); ?>" target="_blank"><i
                            class="fa-brands fa-facebook-f"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($instance['twitter_url_link'])) : ?>
                <li><a href="<?php echo esc_url($instance['twitter_url_link']); ?>" target="_blank"><i
                            class="fa-brands fa-twitter"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($instance['linkedin_url_link'])) : ?>
                <li><a href="<?php echo esc_url($instance['linkedin_url_link']); ?>" target="_blank"><i
                            class="fa-brands fa-linkedin-in"></i></a></li>
                <?php endif; ?>
                <?php if (!empty($instance['instagram_url_link'])) : ?>
                <li><a href="<?php echo esc_url($instance['instagram_url_link']); ?>" target="_blank"><i
                            class="fa-brands fa-instagram"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Follow Us', 'ua');
        $facebook_url_link = !empty($instance['facebook_url_link']) ? $instance['facebook_url_link'] : '';
        $twitter_url_link = !empty($instance['twitter_url_link']) ? $instance['twitter_url_link'] : '';
        $linkedin_url_link = !empty($instance['linkedin_url_link']) ? $instance['linkedin_url_link'] : '';
        $instagram_url_link = !empty($instance['instagram_url_link']) ? $instance['instagram_url_link'] : ''; ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ua'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('facebook_url_link'); ?>"><?php _e('Facebook URL:', 'ua'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('facebook_url_link'); ?>"
        name="<?php echo $this->get_field_name('facebook_url_link'); ?>" type="url"
        value="<?php echo esc_url($facebook_url_link); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('twitter_url_link'); ?>"><?php _e('Twitter URL:', 'ua'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('twitter_url_link'); ?>"
        name="<?php echo $this->get_field_name('twitter_url_link'); ?>" type="url"
        value="<?php echo esc_url($twitter_url_link); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('linkedin_url_link'); ?>"><?php _e('LinkedIn URL:', 'ua'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('linkedin_url_link'); ?>"
        name="<?php echo $this->get_field_name('linkedin_url_link'); ?>" type="url"
        value="<?php echo esc_url($linkedin_url_link); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('instagram_url_link'); ?>"><?php _e('Instagram URL:', 'ua'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('instagram_url_link'); ?>"
        name="<?php echo $this->get_field_name('instagram_url_link'); ?>" type="url"
        value="<?php echo esc_url($instagram_url_link); ?>">
</p>
<?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['facebook_url_link'] = (!empty($new_instance['facebook_url_link'])) ? esc_url_raw($new_instance['facebook_url_link']) : '';
        $instance['twitter_url_link'] = (!empty($new_instance['twitter_url_link'])) ? esc_url_raw($new_instance['twitter_url_link']) : '';
        $instance['linkedin_url_link'] = (!empty($new_instance['linkedin_url_link'])) ? esc_url_raw($new_instance['linkedin_url_link']) : '';
        $instance['instagram_url_link'] = (!empty($new_instance['instagram_url_link'])) ? esc_url_raw($new_instance['instagram_url_link']) : '';
        return $instance;
    }
}

// Register the custom navigation menu widget
class UA_Int_Bev_About_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'ua_int_bev_about_widget', // Base ID
            __('UA Int Bev About', 'ua'), // Name
            array('description' => __('Displays an About Us section with an image and text.', 'ua')) // Args
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget']; ?>
<div class="footer__about">
    <h6><?php echo !empty($instance['title']) ? esc_html($instance['title']) : __('About Us', 'ua'); ?></h6>
    <div class="text">
        <?php if (!empty($instance['image_url'])) : ?>
        <img src="<?php echo esc_url($instance['image_url']); ?>"
            alt="<?php echo !empty($instance['image_alt']) ? esc_attr($instance['image_alt']) : ''; ?>">
        <?php endif; ?>
        <p><?php echo !empty($instance['description']) ? esc_html($instance['description']) : __('We believe that boutique practices are better placed to respond quickly to our clients, offering bespoke service.', 'ua'); ?>
        </p>
    </div>
</div>
<?php echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('About Us', 'ua');
        $image_url = !empty($instance['image_url']) ? $instance['image_url'] : '';
        $image_alt = !empty($instance['image_alt']) ? $instance['image_alt'] : '';
        $description = !empty($instance['description']) ? $instance['description'] : __('We believe that boutique practices are better placed to respond quickly to our clients, offering bespoke service.', 'ua'); ?>

<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'ua'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('image_url'); ?>"><?php _e('Image URL:', 'ua'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('image_url'); ?>"
        name="<?php echo $this->get_field_name('image_url'); ?>" type="url" value="<?php echo esc_url($image_url); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('image_alt'); ?>"><?php _e('Image Alt Text:', 'ua'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('image_alt'); ?>"
        name="<?php echo $this->get_field_name('image_alt'); ?>" type="text"
        value="<?php echo esc_attr($image_alt); ?>">
</p>
<p>
    <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:', 'ua'); ?></label>
    <textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>"
        name="<?php echo $this->get_field_name('description'); ?>"
        rows="4"><?php echo esc_textarea($description); ?></textarea>
</p>
<?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['image_url'] = (!empty($new_instance['image_url'])) ? esc_url_raw($new_instance['image_url']) : '';
        $instance['image_alt'] = (!empty($new_instance['image_alt'])) ? sanitize_text_field($new_instance['image_alt']) : '';
        $instance['description'] = (!empty($new_instance['description'])) ? sanitize_textarea_field($new_instance['description']) : '';
        return $instance;
    }
}

//Popular Post Widget
class UA_Int_Bev_Popular_Post_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'ua_int_bev_popular_post_widget', // Base ID
            'UA Int Bev Popular Post', // Widget Name
            array('description' => __('Display Most Popular Posts', 'uaintbev')) // Description
        );
    }

    // Frontend Display of Widget
    public function widget($args, $instance) {
        echo $args['before_widget']; // Before widget HTML

        // Start Widget HTML
        ?>
<div class="blogsingle__popularpost">
    <div class="sideallheading">
        <h6>Most Popular Post</h6>
    </div>
    <div class="postitem">
        <ul>
            <?php
                    // Query popular posts
                    $popular_posts = new WP_Query(array(
                        'posts_per_page' => 4, 
                        'orderby' => 'comment_count', // Order by most commented (can be changed)
                        'order' => 'DESC'
                    ));
                    if ($popular_posts->have_posts()) :
                        while ($popular_posts->have_posts()) : $popular_posts->the_post();
                    ?>
            <li>
                <div class="thum imghover">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                            alt="<?php the_title(); ?>">
                    </a>
                </div>
                <div class="content">
                    <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                    <span><?php the_date(); ?></span>
                </div>
            </li>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </ul>
    </div>
</div>
<?php

        echo $args['after_widget']; // After widget HTML
    }

    // Backend Form (optional)
    public function form($instance) {
        // You can add form elements here if needed
    }

    // Update Widget Settings (optional)
    public function update($new_instance, $old_instance) {
        // Process widget options
        return $new_instance;
    }
}

//Search Widget
class UA_Int_Bev_Search_Widget extends WP_Widget {
    
    // Constructor for the widget class
    function __construct() {
        parent::__construct(
            'ua_int_bev_search_widget', // Base ID for the widget
            'UA Int Bev Search', // Widget Title
            array('description' => __('Display a search bar with customizable heading.', 'uaintbev')) // Widget Description
        );
    }

    // Display the widget on the frontend
    public function widget($args, $instance) {
        // Get the dynamic heading text from the widget settings
        $heading_text = !empty($instance['heading_text']) ? $instance['heading_text'] : __('Search Your Keywords', 'uaintbev');
        
        // Start the widget HTML
        echo $args['before_widget']; // Before widget HTML (typically handles wrapping divs)

        ?>
<div class="blogsingle__search">
    <div class="sideallheading">
        <h6><?php echo esc_html($heading_text); ?></h6> <!-- Display dynamic heading text -->
    </div>
    <div class="search-area">
        <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="text" name="s" placeholder="search here" value="<?php echo get_search_query(); ?>">
            <div class="icon">
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<?php

        // End the widget HTML
        echo $args['after_widget']; // After widget HTML (typically closing divs)
    }

    // Backend form to manage widget options (customize heading text)
    public function form($instance) {
        $heading_text = isset($instance['heading_text']) ? $instance['heading_text'] : '';
        ?>
<p>
    <label for="<?php echo $this->get_field_id('heading_text'); ?>"><?php _e('Heading Text:', 'uaintbev'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('heading_text'); ?>"
        name="<?php echo $this->get_field_name('heading_text'); ?>" type="text"
        value="<?php echo esc_attr($heading_text); ?>" />
</p>
<?php
    }

    // Update widget settings (save the heading text)
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['heading_text'] = !empty($new_instance['heading_text']) ? strip_tags($new_instance['heading_text']) : '';
        return $instance;
    }
}