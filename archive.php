<?php
get_header(); // Include the header

$class = '';
if (is_active_sidebar('uaintbev_sidebar')) {
    $class = 'col-xl-8';  // Main content area gets 8 columns if the sidebar is active
} else {
    $class = 'col-xl-12'; // Main content area gets 12 columns if the sidebar is not active
}
?>

<section class="blogsingle bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="<?php echo $class; ?>">
                <div class="row">
                    <!-- Main content section -->
                    <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                    <div class="col-md-6">
                        <div class="blog__item">
                            <div class="blog__inner blog__inner--innerblogpage">
                                <div class="thumb">
                                    <!-- Post Thumbnail -->
                                    <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                                    <?php else : ?>
                                    <a href="<?php the_permalink(); ?>"><img src="assets/img/home-2/blog/img1.jpg"
                                            alt="Default Image"></a>
                                    <?php endif; ?>
                                </div>
                                <div class="content bg-white">
                                    <div class="text">
                                        <ul>
                                            <li><a href="blog.html#"><i
                                                        class="fa-solid fa-user"></i><?php the_author(); ?></a></li>
                                            <li><a href="blog.html#"><i
                                                        class="fa-regular fa-eye"></i><?php echo track_post_views(get_the_ID()); ?></a>
                                            </li>
                                            <li><a href="blog.html#"><i class="fa-solid fa-message"></i>11 Comment</a>
                                            </li>
                                        </ul>
                                        <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                    </div>
                                    <div class="blogbtn">
                                        <a href="<?php the_permalink(); ?>" class="custom-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>

                    <!-- Pagination -->
                    <div class="pagination-container">
                        <?php
                            the_posts_pagination(array(
                                'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
                                'next_text' => '<i class="fa-solid fa-angle-right"></i>',
                            ));
                        ?>
                    </div>

                    <?php else : ?>
                    <p>No posts found in this archive.</p>
                    <?php endif; ?>
                </div>
            </div>

            <?php if (is_active_sidebar('uaintbev_sidebar')) : ?>
            <div class="col-xl-4">
                <!-- Sidebar Section -->
                <?php get_sidebar(); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); // Include the footer ?>