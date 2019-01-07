<?php

require_once __DIR__ . '/includes/icon-functions.php';
require_once __DIR__ . '/includes/template-tags.php';

function atlantis_theme_setup()
{
    register_nav_menu('top-menu', __('Top Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
    register_nav_menu('footer-menu-first-column', __('Footer Menu First Column'));
    register_nav_menu('footer-menu-second-column', __('Footer Menu Second Column'));
    register_nav_menu('footer-menu-third-column', __('Footer Menu Third Column'));
    register_nav_menu('social-menu', __('Social Menu'));
    register_nav_menu('section-1-menu', __('Top Slide Buttons'));

//	load_theme_textdomain( 'documentation', get_template_directory() . '/languages' );

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('customize-selective-refresh-widgets');

    add_theme_support('html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ));

    $starter_content = array(

        // Default to a static front page and assign the front and posts pages.
        'options' => array(
            'show_on_front' => 'page',
            'page_on_front' => '{{home}}',
            'page_for_posts' => '{{blog}}',
        ),

        // Set the front page section theme mods to the IDs of the core-registered pages.
        'theme_mods' => array(
            'panel_1' => '{{homepage-section}}',
            'panel_2' => '{{about}}',
            'panel_3' => '{{blog}}',
            'panel_4' => '{{blog}}',
            'panel_5' => '{{contact}}',
            'panel_6' => '{{contact}}',
            'panel_7' => '{{contact}}',
        ),

    );

//	Mainly for customize the defaults content
//	$starter_content = apply_filters( 'atlantis_starter_content', $starter_content );
    add_theme_support('starter-content', $starter_content);

    add_theme_support('atlantis_customizer', array('all'));
    require_if_theme_supports('atlantis_customizer', get_template_directory() . '/includes/customizer.php');
//	require_if_theme_supports('atlantis_customizer', get_template_directory() . '/includes/customizer_class.php');

    add_filter('wp_nav_menu_objects', 'menu_has_children', 10, 1);

    function menu_has_children($sorted_menu_items)
    {
        $parents = array();
        foreach ($sorted_menu_items as $key => $obj)
            $parents[] = $obj->menu_item_parent;
        foreach ($sorted_menu_items as $key => $obj)
            $sorted_menu_items[$key]->has_children = (in_array($obj->ID, $parents)) ? true : false;
        return $sorted_menu_items;
    }

    add_filter('upload_mimes', 'custom_upload_mimes');
    function custom_upload_mimes($existing_mimes = array())
    {
        $existing_mimes['svg'] = 'image/svg+xml';
        return $existing_mimes;
    }

    load_theme_textdomain('atlantis-admissions', __DIR__ . '/languages');
}

add_action('after_setup_theme', 'atlantis_theme_setup');

function atlantis_widgets_setup()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'woocommerce'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'woocommerce'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Shop Sidebar', 'woocommerce'),
        'id' => 'sidebar-shop',
        'description' => __('Add widgets here to appear in your sidebar on shop and product pages.', 'woocommerce'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => __('Atlantis Body', 'woocommerce'),
        'id' => 'atlantis-body',
        'description' => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'woocommerce'),
        'before_widget' => '<article id="%1$s" class="widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '',
        'after_title' => '',
    ));

    register_sidebar(array(
        'name' => __('Homepage Boxes', 'woocommerce'),
        'id' => 'homepage-boxes',
        'description' => __('Add widgets here to appear in your homepage as colored boxes.', 'woocommerce'),
    ));

    register_sidebar(array(
        'name' => __('Footer', 'woocommerce'),
        'id' => 'sidebar-2',
        'description' => __('Add widgets here to appear in your footer.', 'woocommerce'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

//	register_sidebar( array(
//		'name'          => __( 'Footer 2', 'woocommerce' ),
//		'id'            => 'sidebar-3',
//		'description'   => __( 'Add widgets here to appear in your footer.', 'woocommerce' ),
//		'before_widget' => '<section id="%1$s" class="widget %2$s">',
//		'after_widget'  => '</section>',
//		'before_title'  => '<h2 class="widget-title">',
//		'after_title'   => '</h2>',
//	) );
}

add_filter('devyai_trim_text', 'trim_text_callback', 10, 2);

function trim_text_callback($text, $limit)
{
    $text = strip_tags(html_entity_decode($text));
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr(strip_tags($text), 0, $pos[$limit]) . '...';
    }
    return $text;
}

add_action('widgets_init', 'atlantis_widgets_setup');

function atlantis_remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_action('after_setup_theme', 'atlantis_remove_admin_bar');

function atlantis_register_scripts_css()
{
    wp_deregister_script('jquery');
    wp_deregister_script('bootstrap.min.js');
    wp_deregister_script('zcfbootstrap-min-js');
    wp_deregister_style('zcfbootstrap-css-css');
    wp_deregister_style('zcfbootstrap-css');
//    wp_enqueue_style('aos', get_theme_file_uri('/css/aos.min.css'));
    wp_enqueue_style('bootstrap', get_theme_file_uri('/css/bootstrap.min.css'));
    wp_enqueue_style('font-awesome', get_theme_file_uri('/css/font-awesome.min.css'));
    wp_enqueue_style('font-open', get_theme_file_uri('/css/font-open-sans.min.css'));
//    wp_enqueue_style('styles', get_theme_file_uri('/css/style.min.css'));
//    wp_enqueue_style('styles', get_theme_file_uri('/css/style.css'));
    wp_enqueue_style('styles', get_theme_file_uri('/css/app.min.css'), array('bootstrap'), '1.0.1');
//    wp_enqueue_style('styles', get_theme_file_uri('/css/app.css'), array('bootstrap'), '1.0.1');
    wp_enqueue_script('jquery', get_theme_file_uri('/js/jquery.min.js'), array(), '2.0.3', false);
    wp_enqueue_script('bootstrap', get_theme_file_uri('/js/bootstrap.min.js'), array('jquery'), '4.0.0', true);
//    wp_enqueue_script('script', get_theme_file_uri('/js/script.min.js'), array('bootstrap'), '0.0.5', true);
//    wp_enqueue_script('aos', get_theme_file_uri('/js/aos.min.js'), array('bootstrap'), '2.2.0', true);
    wp_enqueue_script('smoothscroll', get_theme_file_uri('/js/smoothscroll.min.js'), array('jquery'), '1.0.1', true);
//    wp_enqueue_script('script', get_theme_file_uri('/js/script.js'), array('jquery'), '0.0.8', true);
    wp_enqueue_script('script', get_theme_file_uri('/js/script.min.js'), array('jquery'), '0.0.8', true);
//    wp_enqueue_script('mediaelement', plugins_url('wp-mediaelement.min.js', __FILE__), array('jquery'), '4.8.2', true);
    wp_deregister_script('wp-mediaelement');
    wp_deregister_style('wp-mediaelement');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_localize_script('script', 'WPURLS', array('siteurl' => get_option('siteurl')));

    $locales = array(
        'menu' => __('menu'),
        'down' => __('down'),
        'up' => __('up'),
    );
    wp_localize_script('script', 'atl_lng', $locales);
}

add_action('wp_enqueue_scripts', 'atlantis_register_scripts_css', 100);

if (!function_exists('atlantis_get_theme_options')):
    function atlantis_get_theme_options()
    {
        return wp_parse_args(get_option('atlantis_theme_options', array()), atlantis_get_option_defaults_values());
    }
endif;
if (!function_exists('atlantis_get_theme_option')):
    function atlantis_get_theme_option($name)
    {
        $options = wp_parse_args(get_option('atlantis_theme_options', array()), atlantis_get_option_defaults_values());
        return $options[$name];
    }
endif;

if (is_admin()) {
    require_once(__DIR__ . '/includes/page-meta-boxes.php');
}

function atlantis_no_admin_access()
{
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/');
    global $current_user;
    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);
    if ($user_role === 'secretary' || $user_role === 'student') {
        exit(wp_redirect($redirect));
    }
}

add_action('admin_init', 'atlantis_no_admin_access', 100);

function notices_theme()
{
    ?>
    <div class="notice notice-info" id="wd_bp_notice_cont">
        <div class="notice-title">Title</div>
        <p>
            Notices... Just for test... right now...
            <a class="button button-primary" href="#">
                <span onclick="alert('Message');"><?php _e("Install", 'woocommerce'); ?></span>
            </a>
        </p>
        <button type="button" class="wd_bp_notice_dissmiss notice-dismiss" onclick="jQuery('#wd_bp_notice_cont').hide();"><span class="screen-reader-text"></span></button>
    </div>
    <?php
}

function _q($text)
{
    if (function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage'))
        return qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($text);
    return 'Activate qtranslate';
}

//add_action('admin_notices', 'notices_theme');

function mytheme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

if (!function_exists('atlantis_posted_on')) :
    function woocommerce_posted_on()
    {
        $byline = sprintf(
            __('by %s', 'atlantis'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . get_the_author() . '</a></span>'
        );

        echo '<span class="posted-on">' . atlantis_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
    }
endif;

if (!function_exists('atlantis_time_link')) :
    function atlantis_time_link()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string,
            get_the_date(DATE_W3C),
            get_the_date(),
            get_the_modified_date(DATE_W3C),
            get_the_modified_date()
        );
        return sprintf(
            __('<span class="screen-reader-text">Posted on</span> %s', 'woocommerce'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
        );
    }
endif;

if (!function_exists('atlantis_entry_footer')) :
    function atlantis_entry_footer()
    {
        $separate_meta = __(', ', 'woocommerce');
        $categories_list = get_the_category_list($separate_meta);
        $tags_list = get_the_tag_list('', $separate_meta);
        if (((atlantis_categorized_blog() && $categories_list) || $tags_list) || get_edit_post_link()) {

            echo '<footer class="entry-footer">';

            if ('post' === get_post_type()) {
                if (($categories_list && atlantis_categorized_blog()) || $tags_list) {
                    echo '<span class="cat-tags-links">';
                    if ($categories_list && atlantis_categorized_blog()) {
                        echo '<span class="cat-links">' . atlantis_get_svg(array('icon' => 'folder-open')) . '<span class="screen-reader-text">' . __('Categories', 'woocommerce') . '</span>' . $categories_list . '</span>';
                    }
                    if ($tags_list && !is_wp_error($tags_list)) {
                        echo '<span class="tags-links">' . atlantis_get_svg(array('icon' => 'hashtag')) . '<span class="screen-reader-text">' . __('Tags', 'woocommerce') . '</span>' . $tags_list . '</span>';
                    }
                    echo '</span>';
                }
            }
            atlantis_edit_link();
            echo '</footer>';
        }
    }
endif;

function atlantis_get_svg($args = array())
{
    if (empty($args)) {
        return __('Please define default parameters in the form of an array.', 'twentyseventeen');
    }
    if (false === array_key_exists('icon', $args)) {
        return __('Please define an SVG icon filename.', 'twentyseventeen');
    }
    $defaults = array(
        'icon' => '',
        'title' => '',
        'desc' => '',
        'fallback' => false,
    );
    $args = wp_parse_args($args, $defaults);
    $aria_hidden = ' aria-hidden="true"';
    $aria_labelledby = '';
    $unique_id = uniqid();
    if ($args['title']) {
        $aria_hidden = '';
        $aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

        if ($args['desc']) {
            $aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
        }
    }
    $svg = '<svg class="icon icon-' . esc_attr($args['icon']) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';
    if ($args['title']) {
        $svg .= '<title id="title-' . $unique_id . '">' . esc_html($args['title']) . '</title>';
        if ($args['desc']) {
            $svg .= '<desc id="desc-' . $unique_id . '">' . esc_html($args['desc']) . '</desc>';
        }
    }

    $svg .= ' <use href="#icon-' . esc_html($args['icon']) . '" xlink:href="#icon-' . esc_html($args['icon']) . '"></use> ';
    if ($args['fallback']) {
        $svg .= '<span class="svg-fallback icon-' . esc_attr($args['icon']) . '"></span>';
    }
    $svg .= '</svg>';
    return $svg;
}

add_filter('script_loader_tag', function ($tag, $handle, $src) {
    if (!is_admin() && !in_array($handle, array('jquery', 'bootstrap', 'stripe')))
        $tag = preg_replace('/src=/', 'async="" src=', $tag);

    return $tag;
}, 10, 3);

add_filter('style_loader_tag', function ($link, $handle) {
    if (is_admin() || in_array($handle, array('bootstrap', 'styles')))
        return $link;

    if (strpos($link, 'media="all"') === false && strpos($link, "media='all'") === false)
        $link = str_replace('type="text/css"', 'type="text/css" media="all"', $link);

    $link = str_replace("media='all'", 'media="none" onload="if(media==\'none\')media=\'all\'"', $link);
    $link = str_replace('media="all"', 'media="none" onload="if(media==\'none\')media=\'all\'"', $link);

    return $link;
}, 10, 2);

//Filter for removing payment mechanism in wocommerce
//add_filter('woocommerce_cart_needs_payment', '__return_false');

require_once __DIR__ . '/includes/customizer/theme-options-default-values.php';
require_once __DIR__ . '/includes/woocommerce.php';
require_once __DIR__ . '/widget/widgets.php';
require_once __DIR__ . '/custom-dashboard.php';
