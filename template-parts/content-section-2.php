<div class="col-xs-12 no_padding second_home_section bg_deg_gray_dark">
    <div <?php if (wp_attachment_is_image(get_theme_mod('section_3_image'))) echo "style=\"background: url('" . image_downsize(get_theme_mod('section_3_image'), 'full')[0] . "') right no-repeat!important;\""; ?>>
        <div class="container padding_top_60 padding_bottom_60">
            <div class="col-xs col-md-7 padding_bottom_20">
                <?php if (get_post()): ?>
                    <div class="col-sm" data-aos="zoom-in" data-aos-duration="1000">
                        <h1><?php the_title(); ?></h1>
                        <div class="clearfix"></div>
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="clearfix margin_bottom_20"></div>
                    <a href="<?php echo get_post_permalink(get_the_ID()); ?>" class="btn btn-default btn-rounded btn_more"><?= __('Learn More', 'atlantis'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>