<div class="col-xs-12 no_padding bg_deg_gray">
    <div class="container text-center padding_top_10 padding_bottom_10">
        <h1 style="color: #ed1c24;"><?php the_title(); ?></h1>
    </div>
</div>
<div class="clearfix"></div>
<div class="col-xs-12 no_padding bg_gray padding_bottom_40">
    <div class="col-xs-12 no_padding padding_top_20 padding_bottom_20">
        <?php the_content(); ?>
    </div>
    <div class="clearfix"></div>
    <iframe style="border: 0;max-width: 100%;" src="https://www.google.com/maps/embed?pb=<?php echo atlantis_get_theme_option('atlantis_section_5_map'); ?>" width="1900" height="350" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
    <div class="clearfix"></div>
</div>