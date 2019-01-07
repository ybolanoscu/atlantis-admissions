<?php $background_color = !empty($instance['background_color_start']) ? 'background-color:' . $instance['background_color_start'] . ';' : '';
if (!empty($instance['background_color_start']) && !empty($instance['background_color_end']))
    $background_color = 'background: linear-gradient(' . $instance['background_color_start'] . ', ' . $instance['background_color_end'] . ');';
elseif (!empty($instance['background_color_start']) && !empty($instance['background_color_end']))
    $background_color = !empty($instance['background_color_end']) ? 'background-color:' . $instance['background_color_end'] . ';' : '';
?>
<div class="col-xs col-sm-4 home-box text-center">
    <div class="container padding_top_20 padding_bottom_20" style="<?php echo $background_color; ?>;">
        <div class="col-xs" style="color:white;">
            <?php if (has_post_thumbnail($post)): ?>
                <img class="img-responsive" src="<?php echo get_the_post_thumbnail_url($post); ?>">
            <?php endif; ?>
            <h3><?php echo !empty($instance['title']) ? $instance['title'] : (is_customize_preview() ? 'TITLE AREA' : ''); ?></h3>
            <h4><?php echo !empty($instance['slogan']) ? $instance['slogan'] : (is_customize_preview() ? 'Slogan' : ''); ?></h4>
            <a class="btn btn-default btn-rounded btn_more" href="<?php echo get_permalink($post); ?>"><?php _e('Learn More', 'atlantis'); ?></a>
        </div>
    </div>
</div>