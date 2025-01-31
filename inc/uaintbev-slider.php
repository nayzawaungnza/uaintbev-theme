<?php
// Query slider posts
$slider_query = new WP_Query(array(
    'post_type'      => 'slider',
    'posts_per_page' => 1, // Adjust as needed
));

// Check if there are any posts
if ($slider_query->have_posts()) :
    while ($slider_query->have_posts()) : $slider_query->the_post();

    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'slider-thumbnail');

        // Get custom field values
        $slider_url = get_post_meta(get_the_ID(), 'slider_url', true);
        $slider_button_text = get_post_meta(get_the_ID(), 'slider_button_text', true);
        ?>

<!-- Banner area start -->
<section class="banner-1 banner-1__space overflow-hidden" data-bg-color="#001C0D">
        <div class="container">
            <div class="banner-1__shapes">
                <div class="big-shape big-shape-3" data-parallax='{"scale": 200, "smoothness": 15}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="910" height="912" viewBox="0 0 910 912" fill="none">
                        <path opacity="0.4" d="M0 0L910 910L0 911.39V0Z" fill="#00160A"/>
                    </svg>
                </div>

                <div class="small-shape small-shape-1" data-parallax='{"y": -200, "x": 300, "smoothness": 15}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="519" height="519" viewBox="0 0 519 519" fill="none">
                        <path d="M518.873 259.436L259.438 0L0.00179011 259.436L259.438 518.871L518.873 259.436Z" fill="#00D563"/>
                    </svg>
                </div>

                <div class="big-shape big-shape-2" data-parallax='{"y": 300, "smoothness": 15}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="1854" height="1854" viewBox="0 0 1854 1854" fill="none">
                        <path d="M1853.98 926.992L926.992 0L0.00043509 926.992L926.992 1853.98L1853.98 926.992Z" fill="#00D563"/>
                    </svg>
                </div>

                <div class="big-shape big-shape-1" data-parallax='{"y": -20, "scale": 1.3, "smoothness": 15}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="1854" height="1854" viewBox="0 0 1854 1854" fill="none">
                        <path d="M1853.98 926.992L926.992 0L0.00043509 926.992L926.992 1853.98L1853.98 926.992Z" fill="#001C0D"/>
                    </svg>
                </div>

                <div class="big-shape big-shape-4" data-parallax='{"y": 800, "smoothness": 15}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="910" height="912" viewBox="0 0 910 912" fill="none">
                        <path opacity="0.4" d="M910 0L-5.44725e-06 910L910 911.39V0Z" fill="#484949"/>
                    </svg>
                </div>

                <div class="small-shape small-shape-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="519" height="185" viewBox="0 0 519 185" fill="none">
                        <path d="M518.904 259.436L259.469 0L0.0330401 259.436L259.469 518.871L518.904 259.436Z" fill="#0D2216"/>
                    </svg>
                </div>

                <div class="small-shape small-shape-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="594" height="594" viewBox="0 0 594 594" fill="none">
                        <path d="M593.236 296.619L296.617 0L-0.0015627 296.619L296.617 593.238L593.236 296.619Z" fill="#0D2216"/>
                    </svg>
                </div>

                <div class="small-shape small-shape-4" data-parallax='{"y": 100, "smoothness": 15}'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="594" height="594" viewBox="0 0 594 594" fill="none">
                        <path d="M593.236 296.619L296.617 0L-0.0015627 296.619L296.617 593.238L593.236 296.619Z" fill="#00D563"/>
                    </svg>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9">
                     <div class="banner-1__content" data-parallax='{"scale": 1.5, "y":300, "smoothness": 15}'>
                         <h1 class="mb-25 wow fadeIn animated" data-wow-delay=".1s"><?php the_title(); ?></h1>
                         <div class="description mb-30 wow fadeIn animated" data-wow-delay=".3s">
                            <p class="mb-0"><?php the_content(); ?></p>
                         </div>
                         <?php if($slider_url) { ?>
                         <a href="<?php echo esc_url($slider_url); ?>" class="rs-btn btn-hover-white wow fadeIn animated" data-wow-delay=".5s"><?php echo esc_html($slider_button_text); ?></a>
                         <?php }?>
                        </div>
                </div>
                <div class="col-xl-6 col-lg-5 col-md-4 col-sm-3">
                    <div class="banner-1__media">
                        <img data-parallax='{"scale": 1.5, "y":100, "smoothness": 15}' src="<?php echo esc_url($thumbnail_url); ?>" alt="image not Found">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner area end -->


            
    <?php
    endwhile;

    // Reset post data
    wp_reset_postdata();
else :
    // No posts found
    echo 'No slider posts found.';
endif;
?>
