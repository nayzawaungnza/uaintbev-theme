<?php

get_header();

$class = '';
if (is_active_sidebar('uaintbev_sidebar')) {
    $class = 'col-xl-8';
} else {
    $class = 'col-xl-12';
}
    ?>
<section class="blogsingle bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="<?php echo $class; ?>">
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                <div class="blogsingle__bodycontent">
                    <?php the_content(); ?>
                </div>
                <?php ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <?php if (is_active_sidebar('uaintbev_sidebar')) : ?>
            <div class=" col-xl-4">
                <?php get_sidebar(); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>