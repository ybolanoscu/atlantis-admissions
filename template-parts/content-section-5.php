<?php if (get_post()): ?>
    <div class="padding_top_40 padding_bottom_40">
        <h1 style="color: #8f2227;font-weight: bolder;font-size: 2.5em;" class="text-center"><?php the_title(); ?></h1>
        <div class="clearfix"></div>
        <?php the_content(); ?>
        <div class="clearfix"></div>
    </div>
<?php endif; ?>