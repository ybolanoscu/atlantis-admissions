<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}

wc_print_notices();

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce'));
    return;
}

?>
<div style="background:#efeef4" class="container">

    <form name="checkout" method="post" class="checkout woocommerce-checkout p-2"
          action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

        <div class="container row m-0 p-0">
            <?php if ($checkout->get_checkout_fields()) : ?>

                <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                <div class="col2-set" id="customer_details">
                    <div class="col-1 col-xs-12 col-md-6">
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>

                    <div class="col-2 col-xs-12 col-md-6">

                        <?php do_action('woocommerce_checkout_shipping'); ?>

                        <?php do_action('woocommerce_checkout_before_order_review'); ?>

                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <div class="card checkout mt-3">
                                <div class="card-header bg-primary-default">
                                    <p>
                                        <i class="float-left fa fa-shopping-cart fa-2x">&nbsp;</i><?php _e('Your order', 'woocommerce'); ?>
                                    </p>
                                </div>
                                <div class="card-block">
                                    <?php do_action('woocommerce_checkout_order_review'); ?>
                                </div>
                            </div>
                        </div>

                        <?php do_action('woocommerce_checkout_after_order_review'); ?>
                    </div>
                </div>

                <?php do_action('woocommerce_checkout_after_customer_details'); ?>

            <?php endif; ?>

        </div>

    </form>

</div>
<script>
    setTimeout(function () {
        var iframes = Array.from(document.getElementsByTagName('iframe'));
        iframes.forEach(function(item,index){
            item.style.width='100%';
        });
    },1500);

</script>
<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
