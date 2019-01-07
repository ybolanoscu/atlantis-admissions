<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//wc_get_template( 'archive-product.php' );

get_header();

$stdClass = new stdClass();
$devyai_options = get_option('devyai_options', $stdClass);
if (is_string($devyai_options)) {
    $devyai_options = unserialize($devyai_options);
} else {
    $devyai_options = new stdClass();
}
$post = get_post($devyai_options->template_base);

if ($post) {
    $content = $post->post_content;
    $content = _q($content);
    $content = apply_filters('the_content', $content);
    echo $content;
}

get_footer();