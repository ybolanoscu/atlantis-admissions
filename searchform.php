<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<?php $unique_id = esc_attr(uniqid('search-form-')); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="<?php echo $unique_id; ?>">
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'twentyseventeen'); ?></span>
    </label>
    <input type="search" id="<?php echo $unique_id; ?>" class="search-field input-sm form-control" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'twentyseventeen'); ?>" value="<?php echo get_search_query(); ?>" name="s"/>
    <div class="padding_top_10">
        <button type="submit" class="search-submit btn btn-default"><i class="fa fa-search"></i> <span class="screen-reader-text"><?php echo _x('Search', 'submit button', 'atlantis'); ?></span></button>
    </div>
</form>
