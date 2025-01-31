<?php echo get_template_part('inc/uaintbev-load'); ?>
<?php get_template_part('inc/head'); ?>
<main <?php if (is_front_page()) : ?>data-bg-color="#00160A" <?php endif; ?>>
    <?php if(is_front_page()){ ?>
    <?php //get_template_part('inc/uaintbev-slider'); ?>
    <?php }else{ ?>
    <?php get_template_part('inc/template/breadcrumb'); ?>
    <?php } ?>

</main>