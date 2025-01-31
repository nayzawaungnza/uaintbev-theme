<?php
// Function to register the custom post type
function uaintbev_slider_post_type() {
    $labels = array(
        'name'               => _x('Sliders', 'post type general name', 'uaintbev'),
        'singular_name'      => _x('Slider', 'post type singular name', 'uaintbev'),
        'menu_name'          => _x('Sliders', 'admin menu', 'uaintbev'),
        'name_admin_bar'     => _x('Slider', 'add new on admin bar', 'uaintbev'),
        'add_new'            => _x('Add New', 'slider', 'uaintbev'),
        'add_new_item'       => __('Add New Slider', 'uaintbev'),
        'new_item'           => __('New Slider', 'uaintbev'),
        'edit_item'          => __('Edit Slider', 'uaintbev'),
        'view_item'          => __('View Slider', 'uaintbev'),
        'all_items'          => __('All Sliders', 'uaintbev'),
        'search_items'       => __('Search Sliders', 'uaintbev'),
        'parent_item_colon'  => __('Parent Sliders:', 'uaintbev'),
        'not_found'          => __('No sliders found.', 'uaintbev'),
        'not_found_in_trash' => __('No sliders found in Trash.', 'uaintbev'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'slider'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-images-alt',
        'supports'           => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('slider', $args);
}

add_action('init', 'uaintbev_slider_post_type');

// Add custom fields to the post editor screen
function uaintbev_slider_custom_fields() {
    add_meta_box(
        'slider_custom_fields',
        'Slider Custom Fields',
        'render_slider_custom_fields',
        'slider',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'uaintbev_slider_custom_fields');

// Render the custom fields in the meta box
function render_slider_custom_fields($post) {
    // Retrieve current values or set defaults
    $slider_url = get_post_meta($post->ID, 'slider_url', true);
    $slider_button_text = get_post_meta($post->ID, 'slider_button_text', true);
    ?>
<label for="slider_url">Slider URL:</label>
<input type="text" name="slider_url" id="slider_url" value="<?php echo esc_attr($slider_url); ?>"
    style="width: 100%;" />

<label for="slider_button_text">Button Text:</label>
<input type="text" name="slider_button_text" id="slider_button_text"
    value="<?php echo esc_attr($slider_button_text); ?>" style="width: 100%;" />
<?php
}

// Save the custom field values
function save_slider_custom_fields($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['slider_url'])) {
        update_post_meta($post_id, 'slider_url', sanitize_text_field($_POST['slider_url']));
    }

    if (isset($_POST['slider_button_text'])) {
        update_post_meta($post_id, 'slider_button_text', sanitize_text_field($_POST['slider_button_text']));
    }
}

add_action('save_post', 'save_slider_custom_fields');

//Add Service Post Type, Taxonomy and Custom Fields
// Register Custom Post Type for Services
function register_services_post_type() {
    $labels = [
        'name'                  => 'Services',
        'singular_name'         => 'Service',
        'menu_name'             => 'Services',
        'name_admin_bar'        => 'Service',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Service',
        'new_item'              => 'New Service',
        'edit_item'             => 'Edit Service',
        'view_item'             => 'View Service',
        'all_items'             => 'All Services',
        'search_items'          => 'Search Services',
        'not_found'             => 'No Services found',
        'not_found_in_trash'    => 'No Services found in Trash',
    ];

    $args = [
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'rewrite'               => ['slug' => 'services'],
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon'             => 'dashicons-editor-table',
    ];

    register_post_type('service', $args);

    // Register Custom Taxonomy for Service Categories
    $taxonomy_labels = [
        'name'                  => 'Service Categories',
        'singular_name'         => 'Service Category',
        'search_items'          => 'Search Categories',
        'all_items'             => 'All Categories',
        'parent_item'           => 'Parent Category',
        'parent_item_colon'     => 'Parent Category:',
        'edit_item'             => 'Edit Category',
        'update_item'           => 'Update Category',
        'add_new_item'          => 'Add New Category',
        'new_item_name'         => 'New Category Name',
        'menu_name'             => 'Categories',
    ];

    $taxonomy_args = [
        'labels'                => $taxonomy_labels,
        'hierarchical'          => true,
        'public'                => true,
        'rewrite'               => ['slug' => 'service-category'],
    ];

    register_taxonomy('service_category', ['service'], $taxonomy_args);
}
add_action('init', 'register_services_post_type');

// Add Meta Boxes for Custom Fields
function add_service_meta_boxes() {
    add_meta_box(
        'service_details',
        'Service Details',
        'render_service_meta_box',
        'service',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_service_meta_boxes');

// Render the Meta Box
function render_service_meta_box($post) {
    // Retrieve current values for the fields
    $pdf_url = get_post_meta($post->ID, '_pdf_url', true);
    $pdf_description = get_post_meta($post->ID, '_pdf_description', true);
    $embedded_field = get_post_meta($post->ID, '_embedded_field', true);
    $icon = get_post_meta($post->ID, '_icon', true);

    // Security nonce field
    wp_nonce_field('save_service_meta', 'service_meta_nonce');
    ?>
<p>
    <label for="pdf_url">PDF URL:</label><br>
    <input type="url" id="pdf_url" name="pdf_url" value="<?php echo esc_attr($pdf_url); ?>" style="width:100%;" />
</p>
<p>
    <label for="pdf_description">PDF Description:</label><br>
    <textarea id="pdf_description" name="pdf_description" rows="4"
        style="width:100%;"><?php echo esc_textarea($pdf_description); ?></textarea>
</p>
<p>
    <label for="embedded_field">Embedded Field:</label><br>
    <textarea id="embedded_field" name="embedded_field" rows="4"
        style="width:100%;"><?php echo esc_textarea($embedded_field); ?></textarea>
</p>
<p>
    <label for="icon">Icon URL:</label><br>
    <input type="text" id="icon" name="icon" value="<?php echo esc_attr($icon); ?>" style="width:100%;" />
</p>
<?php
}

// Save Meta Box Data
function save_service_meta($post_id) {
    // Verify nonce
    if (!isset($_POST['service_meta_nonce']) || !wp_verify_nonce($_POST['service_meta_nonce'], 'save_service_meta')) {
        return;
    }

    // Avoid auto-save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Save fields
    if (isset($_POST['pdf_url'])) {
        update_post_meta($post_id, '_pdf_url', sanitize_text_field($_POST['pdf_url']));
    }
    if (isset($_POST['pdf_description'])) {
        update_post_meta($post_id, '_pdf_description', sanitize_textarea_field($_POST['pdf_description']));
    }
    if (isset($_POST['embedded_field'])) {
        update_post_meta($post_id, '_embedded_field', sanitize_textarea_field($_POST['embedded_field']));
    }
    if (isset($_POST['icon'])) {
        update_post_meta($post_id, '_icon', sanitize_text_field($_POST['icon']));
    }
}
add_action('save_post', 'save_service_meta');


// FAQs Custom Post Type
function register_faq_post_type() {
    $labels = [
        'name'               => _x('FAQs', 'Post Type General Name', 'uaintbev'),
        'singular_name'      => _x('FAQ', 'Post Type Singular Name', 'uaintbev'),
        'menu_name'          => __('FAQs', 'uaintbev'),
        'name_admin_bar'     => __('FAQ', 'uaintbev'),
        'add_new_item'       => __('Add New FAQ', 'uaintbev'),
        'edit_item'          => __('Edit FAQ', 'uaintbev'),
        'new_item'           => __('New FAQ', 'uaintbev'),
        'view_item'          => __('View FAQ', 'uaintbev'),
        'all_items'          => __('All FAQs', 'uaintbev'),
        'search_items'       => __('Search FAQs', 'uaintbev'),
        'not_found'          => __('No FAQs found.', 'uaintbev'),
        'not_found_in_trash' => __('No FAQs found in Trash.', 'uaintbev'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-editor-help', // FAQ-style icon
        'supports'           => ['title', 'editor', 'revisions', 'thumbnail', 'excerpt', 'comments'],
        'rewrite'            => ['slug' => 'faqs'],
        'show_in_rest'       => true, // Enable Gutenberg editor
    ];

    register_post_type('faq', $args);
}
add_action('init', 'register_faq_post_type');

function add_faq_taxonomy() {
    $labels = [
        'name'              => _x('FAQ Categories', 'taxonomy general name', 'uaintbev'),
        'singular_name'     => _x('FAQ Category', 'taxonomy singular name', 'uaintbev'),
        'search_items'      => __('Search FAQ Categories', 'uaintbev'),
        'all_items'         => __('All FAQ Categories', 'uaintbev'),
        'parent_item'       => __('Parent Category', 'uaintbev'),
        'parent_item_colon' => __('Parent Category:', 'uaintbev'),
        'edit_item'         => __('Edit FAQ Category', 'uaintbev'),
        'update_item'       => __('Update FAQ Category', 'uaintbev'),
        'add_new_item'      => __('Add New FAQ Category', 'uaintbev'),
        'new_item_name'     => __('New FAQ Category Name', 'uaintbev'),
        'menu_name'         => __('FAQ Categories', 'uaintbev'),
    ];

    $args = [
        'hierarchical'      => true, // Like categories
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'faq-category'],
    ];

    register_taxonomy('faq_category', ['faq'], $args);
}
add_action('init', 'add_faq_taxonomy');

// Teams Custom Post Type
function register_team_post_type() {
    $labels = [
        'name'               => _x('Teams', 'Post Type General Name', 'uaintbev'),
        'singular_name'      => _x('Team Member', 'Post Type Singular Name', 'uaintbev'),
        'menu_name'          => __('Teams', 'uaintbev'),
        'name_admin_bar'     => __('Team Member', 'uaintbev'),
        'add_new_item'       => __('Add New Team Member', 'uaintbev'),
        'edit_item'          => __('Edit Team Member', 'uaintbev'),
        'new_item'           => __('New Team Member', 'uaintbev'),
        'view_item'          => __('View Team Member', 'uaintbev'),
        'all_items'          => __('All Team Members', 'uaintbev'),
        'search_items'       => __('Search Team Members', 'uaintbev'),
        'not_found'          => __('No Team Members found.', 'uaintbev'),
        'not_found_in_trash' => __('No Team Members found in Trash.', 'uaintbev'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'rewrite'            => ['slug' => 'teams'],
        'show_in_rest'       => true, // Enable Gutenberg editor
    ];

    register_post_type('team', $args);
}
add_action('init', 'register_team_post_type');

function team_custom_fields() {
    add_meta_box(
        'team_details_meta_box', // ID
        'Team Member Details',   // Title
        'team_custom_fields_callback', // Callback
        'team',                  // Post Type
        'normal',                // Context
        'high'                   // Priority
    );
}
add_action('add_meta_boxes', 'team_custom_fields');

function team_custom_fields_callback($post) {
    // Retrieve current values
    $position = get_post_meta($post->ID, '_team_position', true);
    $company = get_post_meta($post->ID, '_team_company', true);
    $responsibility = get_post_meta($post->ID, '_team_responsibility', true);
    $experience = get_post_meta($post->ID, '_team_experience', true);
    $email = get_post_meta($post->ID, '_team_email', true);
    $phone = get_post_meta($post->ID, '_team_phone', true);
    $fax = get_post_meta($post->ID, '_team_fax', true);
    $facebook = get_post_meta($post->ID, '_team_facebook', true);
    $twitter = get_post_meta($post->ID, '_team_twitter', true);
    $instagram = get_post_meta($post->ID, '_team_instagram', true);
    $linkedin = get_post_meta($post->ID, '_team_linkedin', true);

    // Display input fields
    ?>
<p>
    <label for="team_position">Position:</label>
    <input type="text" id="team_position" name="team_position" value="<?php echo esc_attr($position); ?>"
        class="widefat">
</p>
<p>
    <label for="team_company">Company:</label>
    <input type="text" id="team_company" name="team_company" value="<?php echo esc_attr($company); ?>" class="widefat">
</p>
<p>
    <label for="team_responsibility">Responsibility:</label>
    <textarea id="team_responsibility" name="team_responsibility"
        class="widefat"><?php echo esc_textarea($responsibility); ?></textarea>
</p>
<p>
    <label for="team_experience">Experience:</label>
    <input type="text" id="team_experience" name="team_experience" value="<?php echo esc_attr($experience); ?>"
        class="widefat">
</p>
<p>
    <label for="team_email">Email:</label>
    <input type="email" id="team_email" name="team_email" value="<?php echo esc_attr($email); ?>" class="widefat">
</p>
<p>
    <label for="team_phone">Phone:</label>
    <input type="text" id="team_phone" name="team_phone" value="<?php echo esc_attr($phone); ?>" class="widefat">
</p>
<p>
    <label for="team_fax">Fax:</label>
    <input type="text" id="team_fax" name="team_fax" value="<?php echo esc_attr($fax); ?>" class="widefat">
</p>
<h4>Social Media Links</h4>
<p>
    <label for="team_facebook">Facebook:</label>
    <input type="url" id="team_facebook" name="team_facebook" value="<?php echo esc_attr($facebook); ?>"
        class="widefat">
</p>
<p>
    <label for="team_twitter">Twitter:</label>
    <input type="url" id="team_twitter" name="team_twitter" value="<?php echo esc_attr($twitter); ?>" class="widefat">
</p>
<p>
    <label for="team_instagram">Instagram:</label>
    <input type="url" id="team_instagram" name="team_instagram" value="<?php echo esc_attr($instagram); ?>"
        class="widefat">
</p>
<p>
    <label for="team_linkedin">LinkedIn:</label>
    <input type="url" id="team_linkedin" name="team_linkedin" value="<?php echo esc_attr($linkedin); ?>"
        class="widefat">
</p>
<?php
}

function save_team_custom_fields($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save fields
    if (isset($_POST['team_position'])) {
        update_post_meta($post_id, '_team_position', sanitize_text_field($_POST['team_position']));
    }
    if (isset($_POST['team_company'])) {
        update_post_meta($post_id, '_team_company', sanitize_text_field($_POST['team_company']));
    }
    if (isset($_POST['team_responsibility'])) {
        update_post_meta($post_id, '_team_responsibility', sanitize_textarea_field($_POST['team_responsibility']));
    }
    if (isset($_POST['team_experience'])) {
        update_post_meta($post_id, '_team_experience', sanitize_text_field($_POST['team_experience']));
    }
    if (isset($_POST['team_email'])) {
        update_post_meta($post_id, '_team_email', sanitize_email($_POST['team_email']));
    }
    if (isset($_POST['team_phone'])) {
        update_post_meta($post_id, '_team_phone', sanitize_text_field($_POST['team_phone']));
    }
    if (isset($_POST['team_fax'])) {
        update_post_meta($post_id, '_team_fax', sanitize_text_field($_POST['team_fax']));
    }
    if (isset($_POST['team_facebook'])) {
        update_post_meta($post_id, '_team_facebook', esc_url_raw($_POST['team_facebook']));
    }
    if (isset($_POST['team_twitter'])) {
        update_post_meta($post_id, '_team_twitter', esc_url_raw($_POST['team_twitter']));
    }
    if (isset($_POST['team_instagram'])) {
        update_post_meta($post_id, '_team_instagram', esc_url_raw($_POST['team_instagram']));
    }
    if (isset($_POST['team_linkedin'])) {
        update_post_meta($post_id, '_team_linkedin', esc_url_raw($_POST['team_linkedin']));
    }
}
add_action('save_post', 'save_team_custom_fields');

//Projects Custom Post Type
function register_project_post_type() {
    $labels = array(
        'name'               => 'Projects',
        'singular_name'      => 'Project',
        'menu_name'          => 'Projects',
        'name_admin_bar'     => 'Project',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Project',
        'new_item'           => 'New Project',
        'edit_item'          => 'Edit Project',
        'view_item'          => 'View Project',
        'all_items'          => 'All Projects',
        'search_items'       => 'Search Projects',
        'parent_item_colon'  => 'Parent Projects:',
        'not_found'          => 'No projects found.',
        'not_found_in_trash' => 'No projects found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'projects'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-admin-multisite',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'         => array('project_category'),
    );

    register_post_type('project', $args);

    // Register "Project Category" taxonomy
    register_taxonomy(
        'project_category',
        'project',
        array(
            'labels'       => array(
                'name'          => 'Project Categories',
                'singular_name' => 'Project Category',
                'search_items'  => 'Search Project Categories',
                'all_items'     => 'All Project Categories',
                'parent_item'   => 'Parent Project Category',
                'parent_item_colon' => 'Parent Project Category:',
                'edit_item'     => 'Edit Project Category',
                'update_item'   => 'Update Project Category',
                'add_new_item'  => 'Add New Project Category',
                'new_item_name' => 'New Project Category Name',
                'menu_name'     => 'Project Categories',
            ),
            'hierarchical' => true,
            'show_ui'      => true,
            'show_admin_column' => true,
            'query_var'    => true,
            'rewrite'      => array('slug' => 'project-category'),
        )
    );
}
add_action('init', 'register_project_post_type');

function add_project_meta_boxes() {
    add_meta_box(
        'project_information',
        'Project Information',
        'project_information_meta_box_callback',
        'project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_project_meta_boxes');

function project_information_meta_box_callback($post) {
    // Retrieve current values
    $project_year = get_post_meta($post->ID, '_project_year', true);
    $client = get_post_meta($post->ID, '_project_client', true);
    $square_meters = get_post_meta($post->ID, '_project_square_meters', true);
    $location = get_post_meta($post->ID, '_project_location', true);
    $project_value = get_post_meta($post->ID, '_project_value', true);

    // Display fields
    ?>
<p>
    <label for="project_year">Project Year:</label>
    <input type="text" id="project_year" name="project_year" value="<?php echo esc_attr($project_year); ?>"
        class="widefat">
</p>
<p>
    <label for="project_client">Client:</label>
    <input type="text" id="project_client" name="project_client" value="<?php echo esc_attr($client); ?>"
        class="widefat">
</p>
<p>
    <label for="project_square_meters">Square Meters:</label>
    <input type="number" id="project_square_meters" name="project_square_meters"
        value="<?php echo esc_attr($square_meters); ?>" class="widefat">
</p>
<p>
    <label for="project_location">Location:</label>
    <input type="text" id="project_location" name="project_location" value="<?php echo esc_attr($location); ?>"
        class="widefat">
</p>
<p>
    <label for="project_value">Project Value:</label>
    <input type="text" id="project_value" name="project_value" value="<?php echo esc_attr($project_value); ?>"
        class="widefat">
</p>
<?php
}

function save_project_information_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save fields
    $fields = [
        '_project_year' => 'project_year',
        '_project_client' => 'project_client',
        '_project_square_meters' => 'project_square_meters',
        '_project_location' => 'project_location',
        '_project_value' => 'project_value',
    ];

    foreach ($fields as $meta_key => $post_key) {
        if (isset($_POST[$post_key])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$post_key]));
        }
    }
}
add_action('save_post', 'save_project_information_meta');

//Testimonials Custom Post Type
function register_testimonial_post_type() {
    $labels = array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'menu_name'          => 'Testimonials',
        'name_admin_bar'     => 'Testimonial',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Testimonial',
        'new_item'           => 'New Testimonial',
        'edit_item'          => 'Edit Testimonial',
        'view_item'          => 'View Testimonial',
        'all_items'          => 'All Testimonials',
        'search_items'       => 'Search Testimonials',
        'parent_item_colon'  => 'Parent Testimonials:',
        'not_found'          => 'No testimonials found.',
        'not_found_in_trash' => 'No testimonials found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonials'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-testimonial',
        'supports'           => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'register_testimonial_post_type');

function add_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        'Testimonial Details',
        'testimonial_details_meta_box_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_testimonial_meta_boxes');

function testimonial_details_meta_box_callback($post) {
    // Retrieve current values
    $role = get_post_meta($post->ID, '_testimonial_role', true);
    $rating = get_post_meta($post->ID, '_testimonial_rating', true);

    // Display fields
    ?>
<p>
    <label for="testimonial_role">Role:</label>
    <input type="text" id="testimonial_role" name="testimonial_role" value="<?php echo esc_attr($role); ?>"
        class="widefat">
</p>
<p>
    <label for="testimonial_rating">Rating (1 to 5):</label>
    <input type="number" id="testimonial_rating" name="testimonial_rating" value="<?php echo esc_attr($rating); ?>"
        min="1" max="5" class="widefat">
</p>
<?php
}

function save_testimonial_details_meta($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save fields
    if (isset($_POST['testimonial_role'])) {
        update_post_meta($post_id, '_testimonial_role', sanitize_text_field($_POST['testimonial_role']));
    }

    if (isset($_POST['testimonial_rating'])) {
        $rating = intval($_POST['testimonial_rating']);
        if ($rating >= 1 && $rating <= 5) {
            update_post_meta($post_id, '_testimonial_rating', $rating);
        }
    }
}
add_action('save_post', 'save_testimonial_details_meta');


function create_brand_post_type() {
    // Register the custom post type
    register_post_type('brand', [
        'labels' => [
            'name'               => __('Brands', 'uaintbev'),
            'singular_name'      => __('Brand', 'uaintbev'),
            'add_new'            => __('Add New Brand','uaintbev'),
            'add_new_item'       => __('Add New Brand','uaintbev'),
            'edit_item'          => __('Edit Brand','uaintbev'),
            'new_item'           => __('New Brand','uaintbev'),
            'view_item'          => __('View Brand','uaintbev'),
            'search_items'       => __('Search Brands','uaintbev'),
            'not_found'          => __('No brands found','uaintbev'),
            'not_found_in_trash' => __('No brands found in Trash','uaintbev'),
            'all_items'          => __('All Brands','uaintbev'),
        ],
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'brands',],
        'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'       => true, // Enable Gutenberg support
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-store',
    ]);
}

function create_brand_taxonomy() {
    // Register the custom taxonomy
    register_taxonomy('brand_category', 'brand', [
        'labels' => [
            'name'              => __('Brand Categories', 'uaintbev'),
            'singular_name'     => __('Brand Category', 'uaintbev'),
            'search_items'      => __('Search Brand Categories', 'uaintbev'),
            'all_items'         => __('All Brand Categories', 'uaintbev'),
            'parent_item'       => __('Parent Brand Category', 'uaintbev'),
            'parent_item_colon' => __('Parent Brand Category:', 'uaintbev'),
            'edit_item'         => __('Edit Brand Category', 'uaintbev'),
            'update_item'       => __('Update Brand Category', 'uaintbev'),
            'add_new_item'      => __('Add New Brand Category', 'uaintbev'),
            'new_item_name'     => __('New Brand Category Name', 'uaintbev'),
            'menu_name'         => __('Brand Categories', 'uaintbev'),
        ],
        'hierarchical'      => true, // True for categories, false for tags
        'show_in_rest'      => true, // Enable Gutenberg editor support
        'rewrite'           => ['slug' => 'brand-category'],
    ]);
}

// Hook into the init action to register both the post type and taxonomy
add_action('init', 'create_brand_post_type');
add_action('init', 'create_brand_taxonomy');

?>