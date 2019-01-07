<?php
/**
 * Template Name: Tabbed Childs
 *
 * @package Atlantis
 * @subpackage Atlantis_Templates
 * @since Atlantis Templates 1.0
 * The template for displaying the page by widgets
 */

get_header(); ?>
<?php if (have_posts()):
    the_post();

	$current_page_val = get_post_meta($post->ID, 'atlantis_script_page', true);
    ?>
    <header class="entry-header">
        <div class="container">
            <div class="row">
                <div class="col-sm no_padding">
                    <ol class="breadcrumb breadcrumb-xs" itemscope itemtype="http://schema.org/BreadcrumbList">
                        <?php $home = is_home() || is_front_page(); ?>
                        <li class="<?php echo $home ? 'active' : ''; ?>" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="<?php echo get_home_url(); ?>">Home</a></li>
                        <?php $format = '<li itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="%s" title="%s">%s</a></li>';
                        $anc = array_map('get_post', array_reverse((array)get_post_ancestors($post)));
                        $links = array_map('get_permalink', $anc);
                        $breadcrumbs = '';
                        foreach ($anc as $i => $apost) {
                            $title = apply_filters('the_title', $apost->post_title);
                            printf($format, $links[$i], esc_attr($title), esc_html($title));
                        } ?>
                        <li class="active" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="<?php echo wp_guess_url(); ?>"><?php echo the_title('', '', false); ?></a></li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="container padding_top_20">
        <div class="row">
            <?php atlantis_edit_link(); ?>
            <div class="col text-center tabbed_parent">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                <div class="clearfix"></div>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-content">
                        <?php if (has_post_thumbnail(get_the_ID())): ?>
                            <div style="padding-right: 30px;" class="col-xs-12 col-sm-4 pull-left no_padding_left no_padding_xs">
                                <img style="max-width: 381px;width: 100%;" src="<?php echo the_post_thumbnail_url(); ?>" alt=""/>
                            </div>
                        <?php
                        endif;
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . __('Pages:', 'atlantis'),
                            'after' => '</div>',
                        ));
                        ?>
                    </div>
                </article>
                <div class="clearfix"></div>
                <div class="container margin_top_50">
                    <?php
                    $args = array(
                        'post_type' => 'page',
                        'posts_per_page' => -1,
                        'post_parent' => $post->ID,
                        'order' => 'ASC',
                        'orderby' => 'menu_order'
                    );


                    $parent = new WP_Query($args);
                    $lis = $tabs = "";
                    if ($parent->have_posts()) :
                        $i = 0;
                        while ($parent->have_posts()) :
                            $parent->the_post();
                            ob_start(); ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo !$i ? 'active ' : ''; ?>" data-toggle="tab" href="#tabbed-child-<?php echo get_the_ID(); ?>" role="tab" aria-controls="profile" aria-selected="false"><?php the_title(); ?></a>
                            </li>
                            <?php $lis .= ob_get_contents();
                            ob_end_clean();

                            $current_style_val = get_post_meta($post->ID, 'atlantis_style_page', true);
                            $current_script_val = get_post_meta($post->ID, 'atlantis_script_page', true);

                            ob_start(); ?>
                            <div class="tab-pane fade <?php echo !$i ? 'show active ' : ''; ?>" id="tabbed-child-<?php echo get_the_ID(); ?>" role="tabpanel" aria-labelledby="tabbed-child-<?php echo get_the_ID(); ?>">
                                <?php atlantis_edit_link(); ?>
	                            <?php echo '<style type="text/css">' . $current_style_val . '</style>' ?>
                                <?php the_content(); ?>
	                            <?php echo '<script type="text/javascript">' . $current_script_val . '</script>' ?>
                            </div>
                            <?php $tabs .= ob_get_contents();
                            ob_end_clean();

                            $i++;
                        endwhile;
                    endif;
                    wp_reset_postdata(); ?>
                    <ul class="nav nav-pills justify-content-center">
                        <?php echo $lis; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="bg_gray tabbed_parent">
        <div class="container padding_bottom_40 padding_top_20">
            <div class="tab-content">
                <?php echo $tabs; ?>
            </div>
        </div>
    </div>
    <div class="container padding_bottom_40 padding_top_20">
        <div class="row">
            <?php if (comments_open() || get_comments_number()) :
                comments_template();
            endif; ?>
        </div>
    </div>
    <script type="text/javascript">
        <?php echo $current_page_val; ?>
    </script>
<?php endif; ?>
<?php get_footer();