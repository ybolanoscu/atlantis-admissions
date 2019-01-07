<div class="col-xs no_padding bg_deg_gray padding_top_20 padding_bottom_20">
    <div class="container">
        <div class="row padding_top_20 padding_bottom_20">
            <div class="col">
                <?php if (get_post()):
                    the_content();
                endif; ?>
            </div>
        </div>
        <?php if (is_registered_sidebar('homepage-boxes')):
            $total_widgets = wp_get_sidebars_widgets();
            $sidebar_widgets = count($total_widgets['homepage-boxes']);
            if (is_customize_preview() || $sidebar_widgets > 0):?>
                <div class="row justify-content-md-center">
                    <?php get_sidebar('homepage-boxes'); ?>
                </div>
            <?php endif;
        endif; ?>
    </div>
</div>