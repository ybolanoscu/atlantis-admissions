<?php
/**
 * The sidebar containing the body widget area
 */

if ( ! is_active_sidebar( 'atlantis-body' ) ) {return;} ?>
<?php dynamic_sidebar( 'atlantis-body' ); ?>
