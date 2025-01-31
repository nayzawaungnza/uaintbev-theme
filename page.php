<?php

get_header();

    ?>
<section class="blogsingle bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-xl-12 col-md-12">
                <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                <div class="blogsingle__bodycontent">
                    <?php the_content(); ?>
                </div>
                <?php ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
<?php get_footer(); ?>