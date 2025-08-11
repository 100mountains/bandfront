<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<!-- CSS moved to css/thankyou.css -->
<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/css/thankyou.css' ); ?>">

<div class="woocommerce-order">
<?php if ( $order && ! $order->has_status( 'failed' ) ) : ?>
    <div class="thankyou-celebration">
        <div class="floating-notes">
            <div class="note">🎵</div>
            <div class="note">🎶</div>
            <div class="note">🎼</div>
            <div class="note">🎤</div>
        </div>
        <div class="thankyou-content">
            <h1 class="celebration-title">Thank You!</h1>
            <p class="celebration-subtitle">
                Your music is ready to download
                <span class="heart-animation">❤️</span>
                <span class="heart-animation">🎵</span>
                <span class="heart-animation">❤️</span>
            </p>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) . 'downloads/' ); ?>" class="download-cta">
                Access Your Music
            </a>
            <p style="margin-top: 1rem; opacity: 0.8; font-size: 0.9rem;" class="pulse">
                🎧 High-quality audio files • Multiple formats • Instant access
            </p>
        </div>
    </div>
<?php else : ?>
    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
        <?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?>
    </p>
    <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
        <a href="<?php echo esc_url( $order ? $order->get_checkout_payment_url() : wc_get_cart_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
        <?php if ( is_user_logged_in() ) : ?>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
        <?php endif; ?>
    </p>
<?php endif; ?>
</div>