<footer>
    <section>
        <div class="row first-level">
            <div class="container">
                <div class="row">
                    <div class="logo col-sm-2">
                        <?php if (wp_attachment_is_image(get_theme_mod('footer_logo'))): ?>
                            <img class="img-responsive" src="<?php echo image_downsize(get_theme_mod('footer_logo'), 'full')[0]; ?>">
                        <?php else: ?>
                            <img src="<?php echo get_bloginfo('template_directory'); ?>/images/logo-au.svg">
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-2 col-xs-12">
                        <!-- <button type="button" class="btn btn-primary w-100">button</button>                     -->
                    </div>
                    <div class="col-sm-2 col-xs-12">
                        <!-- <button type="button" class="btn btn-primary w-100 p2">button</button> -->
                    </div>
                    <div class="col-sm-6 col-xs-12 text-center">
                        <span class="phone">
                            <i class="fa fa-phone fa-2x"></i>
                            Call 866.225.5948
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row second-level">
            <div class="container">
                <div class="row mt-2">
                    <div class="col-12">
                        <?php if (has_nav_menu('social-menu')): ?>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'social-menu',
                                'depth' => 1,
                                'container' => '',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_class' => 'social-menu',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                            )); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div style="border-right:solid 1px #8db9ca" class="col-sm-3">
                        <?php if (has_nav_menu('footer-menu-first-column')): ?>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer-menu-first-column',
                                'depth' => 2,
                                'container' => 'div',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_class' => 'footer-menu-column',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                            )); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-6" style="padding: 0 15px;">
                        <?php if (has_nav_menu('footer-menu-second-column')): ?>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer-menu-second-column',
                                'depth' => 2,
                                'container' => 'div',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_class' => 'footer-menu-column second',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                            )); ?>
                        <?php endif; ?>
                    </div>
                    <div style="border:solid 1px #8db9ca" class="col-sm-3">
                        <?php if (has_nav_menu('footer-menu-third-column')): ?>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer-menu-third-column',
                                'depth' => 2,
                                'container' => 'div',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_class' => 'footer-menu-column',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                            )); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row third-level">
            <div class="container">
                <div class="row p-3">
                    <div class="col-sm-6">
                        <p class="help-text">
                            <?php echo trim(str_replace('{year}', date('Y'), atlantis_get_theme_option('atlantis_bottom_slogan'))); ?>
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <?php if (has_nav_menu('footer-menu')) { ?>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'footer-menu',
                                'depth' => 1,
                                'container' => 'div',
                                'container_class' => '',
                                'container_id' => '',
                                'menu_class' => 'menu-footer-bottom',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                            )); ?>
                        <?php } ?>
                       <div class="float-right"> <?php dynamic_sidebar('sidebar-2')?></div>
                    </div>
                </div>
            </div>
        </div>
</footer>
<?php wp_footer(); ?>

<!-- Facebook Pixel Code -->
<script>
    !function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '212611426170428');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=212611426170428&ev=PageView&noscript=1"/></noscript>
<!-- End Facebook Pixel Code -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117912115-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-117912115-1');
</script>
</body>
</html>
