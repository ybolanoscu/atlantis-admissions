<div class="col no_padding section_wedding_planning">
    <div class="container-fluid">
        <div class="row row-eq-height">
            <div class="col-sm-6 col-lg-7 no_padding padding_top_40 padding_bottom_40">
                <h2 class="text-center"><?php the_title(); ?></h2>
                <div class="row">
                    <div class="col"></div>
                    <div class="col-sm-10">
                        <?php the_content('', true); ?>
                    </div>
                    <div class="col"></div>
                </div>
                <div class="col padding_top_20 text-center">
                    <a href="<?php echo get_permalink(1225); ?>" class="btn btn-default btn-unfill btn-redbold"><?php echo _q(atlantis_get_theme_option('atlantis_section_4_button')); ?></a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-5 section_wedding_planning_image no_padding" <?php if (wp_attachment_is_image(get_theme_mod('section_4_image'))) echo "style=\"background: url('" . image_downsize(get_theme_mod('section_4_image'), 'full')[0] . "') no-repeat center!important;\""; ?>></div>
        </div>
    </div>
</div>