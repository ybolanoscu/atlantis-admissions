<?php
/**
 * Template Name: Page No Sidebar
 *
 * @package Atlantis
 * @subpackage Atlantis_Templates
 * @since Atlantis Templates 1.0
 * The template for displaying all single posts
 */

get_header(); ?>
    <div class="bg_gray">
        <?php if (have_posts()):
            the_post(); ?>
            <header class="entry-header">
                <div class="container">
                    <div class="row">
                        <div class="col-xs col-sm-7 no_padding_left no_padding_xs">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        </div>
                        <div class="col-xs col-sm-5 no_padding">
                            <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
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
            <div class="container padding_bottom_40 padding_top_20">
                <div class="row">
                    <div class="col">
                        <?php atlantis_edit_link(); ?>
                        <div class="clearfix"></div>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content">
                                <?php
                                $url = get_the_post_thumbnail_url( null, 'post-thumbnail');
                                if (!empty($url)) : ?>
                                    <div style="padding-right: 30px;" class="col-xs-12 col-sm-4 pull-left no_padding_left no_padding_xs">
                                        <img style="max-width: 381px;width: 100%;" src="<?php echo $url; ?>" alt=""/>
                                    </div>
                                <?php endif; ?>
                                <?php
                                the_content();

                                wp_link_pages(array(
                                    'before' => '<div class="page-links">' . __('Pages:', 'atlantis'),
                                    'after' => '</div>',
                                ));
                                ?>
                            </div>
                        </article>
                        <?php if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif; ?>
                    </div>
                    <?php while (have_posts()):
                        the_post(); ?>
                        <div class="col-xs no_padding_xs">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            the_content();
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <script type="text/javascript">
                <?php
                $script_val = get_post_meta( $post->ID, 'atlantis_script_page', true );
                echo $script_val;
                ?>
            </script>
        <?php endif; ?>
    </div>
<?php get_footer();