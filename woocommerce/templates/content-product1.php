<?php
/**
 * Single Product Template for WooCommerce
 */

defined('ABSPATH') || exit;

get_header('shop'); ?>

<div class="shopdetails overflow-hidden bg-white">
    <div class="container">
        <div class="section__wrapper shopdetails__wrapper">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="shopdetails__leftinner">
                        <div class="productsdetails2 overflow-hidden swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                global $product;
                                $attachment_ids = $product->get_gallery_image_ids();
                                if ($attachment_ids) {
                                    foreach ($attachment_ids as $attachment_id) {
                                        $image_url = wp_get_attachment_image_url($attachment_id, 'full');
                                        ?>
                                <div class="swiper-slide">
                                    <div class="shopdetails__innerthumb">
                                        <img src="<?php echo esc_url($image_url); ?>"
                                            alt="<?php echo esc_attr(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)); ?>">
                                    </div>
                                </div>
                                <?php
                                    }
                                } else {
                                    echo '<p>No gallery images found.</p>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="productsdetails1 overflow-hidden swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                if ($attachment_ids) {
                                    foreach ($attachment_ids as $attachment_id) {
                                        $thumb_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');
                                        ?>
                                <div class="swiper-slide">
                                    <div class="shopdetails__smallthumb">
                                        <img src="<?php echo esc_url($thumb_url); ?>"
                                            alt="<?php echo esc_attr(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)); ?>">
                                    </div>
                                </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shopdetails__content">
                        <h5><?php the_title(); ?></h5>
                        <h6>Price:<span><?php echo $product->get_price_html(); ?></span></h6>
                        <div class="rating">
                            <p>Rating:</p>
                            <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                            <a href="#reviews"> (<?php echo $product->get_review_count(); ?> customer reviews) </a>
                        </div>
                        <p><?php echo apply_filters('the_content', get_the_content()); ?></p>

                        <ul>
                            <li><i class="fa-sharp fa-solid fa-square-check"></i> Feature 1</li>
                            <li><i class="fa-sharp fa-solid fa-square-check"></i> Feature 2</li>
                            <li><i class="fa-sharp fa-solid fa-square-check"></i> Feature 3</li>
                            <li><i class="fa-sharp fa-solid fa-square-check"></i> Feature 4</li>
                        </ul>

                        <div class="countadd">
                            <div class="cart-plus-minus">
                                <div class="dec qtybutton">-</div>
                                <input class="cart-plus-minus-box" type="text" name="quantity" value="1">
                                <div class="inc qtybutton">+</div>
                            </div>
                            <form action="#">
                                <input type="text" placeholder="Discount Code">
                            </form>
                            <?php woocommerce_template_single_add_to_cart(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('shop'); ?>