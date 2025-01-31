<?php
// Fetch the thumbnail URL for the current post with a fallback if no thumbnail exists
$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'breadcrumb-thumbnail') ?: get_template_directory_uri() . '/assets/img/pageheader/bg.jpg'; 
?>

<!-- Start banner section -->
<section class="pageheader overflow-hidden" style="background-image: url(<?php echo esc_url($thumbnail_url); ?>);">
    <div class="container">
        <div class="pageheader__content">

            <!-- Handle search results -->
            <?php if (get_search_query()) : ?>
            <h2 class="uaintbev-white">Search Results for "<?php echo get_search_query(); ?>"</h2>
            <?php endif; ?>

            <!-- Handle 404 error page -->
            <?php if (is_404()) : ?>
            <h2 class="uaintbev-white">Page Not Found</h2>
            <?php endif; ?>

            <!-- Handle archive pages (category, tag, date-based archives) -->
            <?php if (is_archive()) : ?>
            <h2 class="uaintbev-white archive "><?php echo get_the_archive_title(); ?></h2>
            <?php endif; ?>

            <!-- Handle archive pages (category, tag, date-based archives) -->

            <!-- Handle single post pages -->
            <?php if (is_single()) : ?>
            <h2 class="uaintbev-white"><?php echo get_the_title(); ?></h2>
            <?php endif; ?>

            <!-- Handle page pages -->
            <?php if (is_page()) : ?>
            <h2 class="uaintbev-white"><?php echo get_the_title(); ?></h2>
            <?php endif; ?>


            <!-- Breadcrumb navigation -->
            <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    </li>

                    <!-- Handle archive breadcrumb for category or tag pages -->
                    <?php if (is_category() || is_tag() || is_date() || is_author() || is_tax() || is_archive()) : ?>
                    <li>
                        <a
                            href="<?php echo esc_url(get_category_link(get_queried_object_id())); ?>"><?php echo single_cat_title(); ?></a>
                    </li>
                    <?php endif; ?>

                    <!-- Handle search query in breadcrumbs -->
                    <?php if (get_search_query()) : ?>
                    <li class="active" aria-current="page">
                        Search Results
                    </li>
                    <?php endif; ?>

                    <!-- Handle 404 page breadcrumb -->
                    <?php if (is_404()) : ?>
                    <li class="active" aria-current="page">
                        Page Not Found
                    </li>
                    <?php endif; ?>

                    <!-- Display current post or archive title -->
                    <?php if (is_single() || is_page()) : ?>
                    <li class="active" aria-current="page">
                        <?php echo get_the_title(); ?>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</section>
<!-- End banner section -->