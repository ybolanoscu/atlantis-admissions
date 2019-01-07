<?php
/**
 * The sidebar containing the main widget area
 */

if (!is_active_sidebar('sidebar-shop'))
    return;
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e('Shop Sidebar', 'atlantis'); ?>">
    <?php dynamic_sidebar('sidebar-shop'); ?>
</aside>
