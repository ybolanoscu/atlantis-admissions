<?php
/**
 * The sidebar containing the main widget area
 */

if (!is_active_sidebar('homepage-boxes')) {
    return;
}
?>

<div class="col" aria-label="<?php esc_attr_e('Homepage Boxes', 'atlantis'); ?>">
    <div class="row">
        <?php dynamic_sidebar('homepage-boxes'); ?>
    </div>
</div><!-- #secondary -->
