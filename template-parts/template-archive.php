<div class="bg_gray">
    <?php if (is_archive()):
        $category = get_the_archive_title(); ?>
        <header class="entry-header">
            <div class="container">
                <div class="col-xs-12 col-sm-7 no_padding_left no_padding_xs">
                    <h1 class="entry-title"><?php echo get_the_archive_title(); ?></h1>
                </div>
                <div class="col-xs-12 col-sm-5 no_padding">
                    <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
                        <?php $home = is_home() || is_front_page(); ?>
                        <li class="<?php echo $home ? 'active' : ''; ?>" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="<?php echo get_home_url(); ?>">Home</a></li>
                        <li class="active" itemprop="itemListElement" itemtype="http://schema.org/ListItem"><a href="#"><?php echo get_the_archive_title(); ?></a></li>
                    </ol>
                </div>
            </div>
        </header>
        <div class="container padding_bottom_40 padding_top_20">
            <div class="col-xs-12 <?php echo is_active_sidebar('sidebar-1') ? 'col-sm-8 col-md-9 no_padding_left no_padding_xs' : ''; ?>">
                <div style="display: flex;flex-wrap: wrap;">
                    <?php $year = get_the_time('Y');
                    $month = get_the_time('m');
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $the_query = new WP_Query(array(
                        'monthnum' => $month,
                        'year' => $year,
                        'posts_per_page' => 2,
                        'paged' => $paged,
                    ));
                    while ($the_query->have_posts()) :
                        $the_query->the_post(); ?>
                        <div class="col-xs-12 col-sm-4 no_padding_xs" style="">
                            <h3><?php the_title(); ?></h3>
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="clearfix"></div>
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'base' => '%_%',
                        'total' => $the_query->max_num_pages,
                        'current' => max(1, get_query_var('paged')),
                        'format' => '?paged=%#%',
                        'show_all' => false,
                        'type' => 'plain',
                        'end_size' => 2,
                        'mid_size' => 1,
                        'prev_next' => true,
                        'prev_text' => sprintf('<i></i> %1$s', __('Newer Posts', 'text-domain')),
                        'next_text' => sprintf('%1$s <i></i>', __('Older Posts', 'text-domain')),
                        'add_args' => false,
                        'add_fragment' => '',
                    ));
                    ?>
                </div>
            </div>
            <?php if (is_active_sidebar('sidebar-1')): ?>
                <div class="col-xs-12 col-sm-4 col-md-3 no_padding_right no_padding_xs">
                    <?php get_sidebar('sidebar-1'); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>