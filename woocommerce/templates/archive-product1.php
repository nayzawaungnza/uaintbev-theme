<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( have_posts() ) : ?>
<div class="woocommerce-products">
    <div class="row">
        <?php while ( have_posts() ) : the_post(); ?>
        <?php
                global $product;
                ?>
        <div class="col-md-6 col-xl-4">
            <div class="shop-item">
                <div class="shop-item__thumbnail">
                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                        <?php echo woocommerce_get_product_thumbnail(); ?>
                    </a>
                    <div class="shop-item__actions">
                        <a href="<?php echo esc_url( wc_get_gallery_image_html( $product->get_image_id() ) ); ?>"
                            data-rel="lightcase" class="shop-action">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                        <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="shop-action">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </div>
                </div>
                <div class="shop-item__details">
                    <div class="shop-item__rating">
                        <?php if ( $average = $product->get_average_rating() ) : ?>
                        <?php echo wc_get_rating_html( $average ); ?>
                        <?php endif; ?>
                    </div>
                    <h6 class="shop-item__name">
                        <a
                            href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
                    </h6>
                    <span class="shop-item__price">
                        <?php echo $product->get_price_html(); ?>
                    </span>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
<?php else : ?>
<p><?php esc_html_e( 'No products were found matching your selection.', 'woocommerce' ); ?></p>
<?php endif; ?>