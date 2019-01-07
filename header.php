<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php $title = wp_title('', false);
        echo !empty($title) ? $title : bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body data-src="">
<header>
    <section class="top_menu <?= isset($nav_class) ? $nav_class : '' ?>">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="<?php echo get_home_url('/') ?>">
                    <?php if (wp_attachment_is_image(get_theme_mod('top_logo'))): ?>
                        <img class="img-responsive" src="<?php echo image_downsize(get_theme_mod('top_logo'), 'full')[0]; ?>">
                    <?php else: ?>
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/images/logo-au.svg">
                    <?php endif; ?>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-top-menu" aria-controls="bs-top-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php add_filter('nav_menu_css_class', function ($classes, $ref, $menu, $level) {
                    $classes[] = 'nav-item';
                    if ($menu->container_id === 'bs-top-menu')
                        $classes[] = 'dropdown';
                    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes))
                        $classes[] = 'active ';
                    return $classes;
                }, 10, 4);
                add_filter('nav_menu_submenu_css_class', function ($class, $menu, $level) {
                    if ($menu->container_id === 'bs-top-menu') {
                        $class = array('dropdown-menu');
                    }
                    return $class;
                }, 10, 3);
                add_filter('wp_nav_menu', function ($ulclass) {
                    $ul = preg_replace('/<a /', '<a class="nav-link"', $ulclass);
                    $text = '[:es]Acceder[:en]Login[:]';
                    if (is_user_logged_in())
                        $text = '[:es]Mi Cuenta[:en]Account[:]';
                    $ul = preg_replace('/>AccessWP</', ">" . _q($text) . "<", $ul);
                    return do_shortcode($ul);
                });
                if (has_nav_menu('top-menu')) {
                    $plugin = 'devyai-moodle-integration/devyai-moodle-integration.php';
                    $options = array(
                        'container' => 'div',
                        'theme_location' => 'top-menu',
                        'depth' => 2,
                        'container_class' => 'collapse navbar-collapse',
                        'container_id' => 'bs-top-menu',
                        'menu_class' => 'navbar-nav ml-auto',
                    );
                    if (in_array($plugin, get_option('active_plugins'))) {
                        require_once __DIR__ . '/../../plugins/devyai-moodle-integration/frontend/Nav_Footer_Walker.php';
                        $options['walker'] = new Nav_Footer_Walker();
                    }
                    wp_nav_menu($options);
                } ?>
            </div>
        </nav>
        <div class="clearfix"></div>
    </section>
</header>
