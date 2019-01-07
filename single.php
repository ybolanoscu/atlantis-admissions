<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>
    <div class="container padding_bottom_40 padding_top_20">
        <?php while (have_posts()) : ?>
            <div class="row">
                <div class="col">
                    <?php the_post();

					get_template_part( 'template-parts/post/content', get_post_format() );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                    // the_post_navigation(array(
                    //     'prev_text' => '<span class="screen-reader-text">' . __('Previous Post', 'atlantis') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Previous', 'twentyseventeen') . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . atlantis_icon_fa(array('icon' => 'arrow-left')) . '</span>%title</span>',
                    //     'next_text' => '<span class="screen-reader-text">' . __('Next Post', 'atlantis') . '</span><span aria-hidden="true" class="nav-subtitle">' . __('Next', 'twentyseventeen') . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . atlantis_icon_fa(array('icon' => 'arrow-right')) . '</span></span>',
                    // ));
                    ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php get_footer();
