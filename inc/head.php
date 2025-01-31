<!-- start header section here -->
<div class="header header--headerpage2">
    <?php if (get_theme_mod('uaintbev_show_topbar', true)): ?>
    <div class="header__top header__top--toppage2 bg-white">
        <div class="container-xl container-fluid">
            <div class="header__topcontent header__topcontent--topcontentpage2">
                <div class="left">
                    <ul>
                        <?php if ($phone = get_theme_mod('uaintbev_topbar_phone', '+041-982-3648')): ?>
                        <li>
                            <div class="icon">
                                <i class="fa-solid fa-square-phone"></i>
                            </div>
                            <div class="text">
                                <p><?php echo esc_html($phone); ?></p>
                            </div>
                        </li>
                        <?php endif; ?>

                        <?php if ($email = get_theme_mod('uaintbev_topbar_email', 'info@gmail.com')): ?>
                        <li>
                            <div class="icon">
                                <i class="fa-sharp fa-regular fa-envelope-open"></i>
                            </div>
                            <div class="text">
                                <p><?php echo esc_html($email); ?></p>
                            </div>
                        </li>
                        <?php endif; ?>

                        <?php if ($address = get_theme_mod('uaintbev_topbar_address', '22 Vokte Street Building Melborn City')): ?>
                        <li>
                            <div class="icon">
                                <i class="fa-sharp fa-solid fa-location-dot"></i>
                            </div>
                            <div class="text">
                                <p><?php echo esc_html($address); ?></p>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <?php if (function_exists('uaintbev_social')) {
                    uaintbev_social();
                } ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="header__bottom bg-white">
        <div class="container-xl container-fluid">
            <div class="row align-items-center">
                <div class="col-6 col-xl-2">

                    <div class="left">
                        <?php uaintbev_logo(); ?>

                    </div>
                </div>
                <div class="col-6 col-xl-10">
                    <div class="right">
                        <div class="header__nav target">
                            <?php uaintbev_mobile_logo(); ?>

                            <?php uaintbev_navigation_menu(); ?>

                        </div>
                        <?php // uaintbev_cart(); ?>


                        <?php if (function_exists('uaintbev_cta')) {
                                    uaintbev_cta();
                                } ?>

                        <div class="ellepsis d-xl-none">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div class="bar d-xl-none d-block">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  header section here -->