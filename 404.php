<?php get_header(); ?>

<div class="fourzero overflow-hidden bg-white">
    <div class="container">
        <div class="section__wrapper">
            <div class="row justify-content-center g-4">
                <div class="col-lg-8 col-12">
                    <div class="fourzero__item text-center">
                        <div class="fourzero__thumb">
                            <?php 
                                // Display 404 image (use a dynamic path to the theme folder)
                                echo '<img src="' . get_template_directory_uri() . '/assets/img/404/404.png" alt="404 Error">';
                            ?>
                        </div>
                        <div class="fourzero__content">
                            <h2><?php esc_html_e( 'Oops! This Page Could Not Be Found', 'uaintbev' ); ?>
                            </h2>
                            <p><?php esc_html_e( 'We’re sorry, but we can’t seem to find the page you requested. This might be because you typed the web address incorrectly or the page has been moved.', 'uaintbev' ); ?>
                            </p>

                            <!-- Search Form -->
                            <form role="search" method="get" id="searchform"
                                action="<?php echo esc_url(home_url('/')); ?>">
                                <input type="text" placeholder="Search here" value="<?php echo get_search_query(); ?>"
                                    name="s" id="s">
                                <button type="submit"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                            </form>


                            <!-- Back to Home Button -->
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                class="custom-btn"><?php esc_html_e( 'Go Back to Home', 'uaintbev' ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>