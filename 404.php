<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
    <div class="container">
        <div class="row">
            <section class="error-404 not-found padding_top_40 padding_bottom_40">
                <header class="page-header">
                    <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'atlantis'); ?></h1>
                </header>
                <div class="page-content">
                    <p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'atlantis'); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </section>
        </div>
    </div>
<?php get_footer();