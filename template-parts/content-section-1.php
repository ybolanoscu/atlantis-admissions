<div class="atl_admissions_slide col-xs-12 no_padding" <?php if (wp_attachment_is_image(get_theme_mod('section_1_image'))) echo "style=\"background: url('" . image_downsize(get_theme_mod('section_1_image'), 'full')[0] . "') center no-repeat!important;\""; ?>>
    <div data-aos="fade-left" data-aos-duration="1000">
        <h2><?php echo atlantis_get_theme_option('atlantis_bg_section_h1'); ?></h2>
        <p><?php echo atlantis_get_theme_option('atlantis_bg_section_slogan'); ?></p>
        <?php if (has_nav_menu('section-1-menu') || is_customize_preview()): ?>
            <div class="col-xs-12 text-center no_padding">
                <?php if (has_nav_menu('section-1-menu'))
                    wp_nav_menu(array(
                        'theme_location' => 'section-1-menu',
                        'depth' => 1,
                        'container' => null,
                        'menu_class' => '',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                    )); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="clearfix"></div>