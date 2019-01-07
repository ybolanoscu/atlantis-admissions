<?php
/**
 * The template for displaying all single posts
 */

get_header(); ?>
    <div class="bg_gray">
        <?php if (is_category()):
            $category = get_the_category()[0]; ?>
            <header class="entry-header">
                <div class="container">
                    <div class="row">
                        <div class="col-xs col-sm-7 no_padding_left no_padding_xs">
                            <h1 class="entry-title"><?php echo single_cat_title(); ?></h1>
                        </div>
                        <div class="col-xs col-sm-5 no_padding">
                            <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                                <?php $home = is_home() || is_front_page(); ?>
                                <li class="<?php echo $home ? 'active' : ''; ?>" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="<?php echo get_home_url(); ?>">Home</a></li>
                                <li class="active" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="<?php echo get_category_link($category->id); ?>"><?php echo single_cat_title(); ?></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container padding_bottom_40 padding_top_20">
                <div class="row">
                    <div class="col-xs <?php echo is_active_sidebar('sidebar-1') ? 'col-sm-8 col-md-9 no_padding_left no_padding_xs' : ''; ?>">
                        <div style="display: flex;flex-wrap: wrap;">
                            <?php $args = array('category' => $category->cat_ID, 'posts_per_page' => 12);
                            $myposts = get_posts($args);
                            foreach ($myposts as $post) : setup_postdata($post); ?>
                                <div class="col-xs-12 col-sm-4 no_padding_xs" style="">
                                    <h3><?php the_title(); ?></h3>
                                    <?php the_excerpt(); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php if (is_active_sidebar('sidebar-1')): ?>
                        <div class="col-xs col-sm-4 col-md-3 no_padding_right no_padding_xs">
                            <?php get_sidebar('sidebar-1'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php get_footer();