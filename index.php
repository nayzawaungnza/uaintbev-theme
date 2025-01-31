<?php get_header(); ?>
<section class="post-area">
    <?php
//Loop
if (have_posts()) :
    while (have_posts()) :
       the_post();
?>
    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <div class="post-meta">
            Post on: <?php the_date(); ?> at <?php the_time(); ?>
        </div>
    </article>

    <?php
    endwhile;
endif;
?>
</section>
<?php get_sidebar(); 
?>
<?php get_footer(); ?>