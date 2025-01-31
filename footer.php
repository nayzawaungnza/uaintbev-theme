<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>

<!-- Footer area start -->
<section class="footer overflow-hidden">
    <div class="footer__top">
        <div class="container">
            <div class="row g-4">
                <div class="col-sm-6 col-lg-3">
                    <!-- Footer Widget Area 1 -->
                    <?php if (is_active_sidebar('footer-widget-1')) : ?>

                    <?php dynamic_sidebar('footer-widget-1'); ?>

                    <?php else : ?>
                    <div class="footer__about">
                        <h6><?php esc_html_e('About Us', 'uaintbev'); ?></h6>
                        <p><?php esc_html_e('Add content to this widget in Appearance > Widgets.', 'uaintbev'); ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <!-- Footer Widget Area 2 -->
                    <?php if (is_active_sidebar('footer-widget-2')) : ?>

                    <?php dynamic_sidebar('footer-widget-2'); ?>

                    <?php else : ?>
                    <div class="footer__link">
                        <h6><?php esc_html_e('Quick Links', 'uaintbev'); ?></h6>
                        <ul>
                            <li><i class="fa-solid fa-leaf"></i><a
                                    href="#"><?php esc_html_e('Sample Link 1', 'uaintbev'); ?></a></li>
                            <li><i class="fa-solid fa-leaf"></i><a
                                    href="#"><?php esc_html_e('Sample Link 2', 'uaintbev'); ?></a></li>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <!-- Footer Widget Area 3 -->
                    <?php if (is_active_sidebar('footer-widget-3')) : ?>

                    <?php dynamic_sidebar('footer-widget-3'); ?>

                    <?php else : ?>
                    <div class="footer__news">
                        <h6><?php esc_html_e('Recent News', 'uaintbev'); ?></h6>
                        <p><?php esc_html_e('Add recent news or blog posts here.', 'uaintbev'); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <!-- Footer Widget Area 4 -->
                    <?php if (is_active_sidebar('footer-widget-4')) : ?>

                    <?php dynamic_sidebar('footer-widget-4'); ?>

                    <?php else : ?>
                    <div class="footer__photo">
                        <h6><?php esc_html_e('Photo Gallery', 'uaintbev'); ?></h6>
                        <p><?php esc_html_e('Add your photo gallery here.', 'uaintbev'); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <p>
            <i class="fa-regular fa-copyright"></i>
            <?php
        $custom_copyright = get_theme_mod('footer_copyright_text'); // Get custom text from the Customizer
        if ($custom_copyright) {
            echo esc_html($custom_copyright); // Display custom text if set
        } else {
            // Fallback to default text if no custom text is set
            printf(
                esc_html__('Copyright %1$s %2$s. All Rights Reserved.', 'uaintbev'),
                date('Y'), // Current year
                get_bloginfo('name') // Site name
            );
        }
        ?>
        </p>
    </div>
</section>
<!-- Footer area end -->
<a href="@#" class="scrollToTop" style="bottom: -30%; opacity: 0; transition: 0.5s;">
    <i class="fa-solid fa-arrow-up-long"></i>
    <span class="pluse_1"></span>
    <span class="pluse_2"></span>
</a>
<?php wp_footer(); ?>

</body>

</html>