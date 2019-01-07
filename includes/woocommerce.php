<?php add_filter('woocommerce_product_get_price', 'atlantis_product_get_price', 99, 2);

/**
 * @param $price
 * @param WC_Product $product
 * @return int
 */
function atlantis_product_get_price($price, $product)
{
    if (!$price)
        return 0;
    return $price;
}

add_filter('woocommerce_get_price_html', 'atlantis_product_free_price', 10, 2);

function atlantis_product_free_price($price, $product)
{
    if ($price == wc_price(0.00))
        return translate('FREE', 'atlantis');
    else
        return $price;
}
