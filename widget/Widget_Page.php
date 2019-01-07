<?php

class Widget_Page extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('atlantis_widget',
            'Atlantis Page', array(
                'description' => 'Load a page inside',
                'customize_selective_refresh' => true
            ), array());
        add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'));
    }

    public function admin_enqueue_scripts($hook_suffix)
    {
        if ($hook_suffix != 'widgets.php') {
            return;
        }

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
    }

    public function widget($args, $instance)
    {
        $page = isset($instance['page']) ? $instance['page'] : null;
        $post = get_post($page);
        if ($post) {
            require __DIR__ . '/templates/widget_page.php';
        }
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['page'] = isset($new_instance['page']) ? intval($new_instance['page']) : '';
        $instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        $instance['slogan'] = isset($new_instance['slogan']) ? strip_tags($new_instance['slogan']) : '';
        $instance['background_color_start'] = isset($new_instance['background_color_start']) ? strip_tags($new_instance['background_color_start']) : '';
        $instance['background_color_end'] = isset($new_instance['background_color_end']) ? strip_tags($new_instance['background_color_end']) : '';

        return $instance;
    }

    public function form($instance)
    {
        $page = isset($instance['page']) ? $instance['page'] : null;
        $title = isset($instance['title']) ? $instance['title'] : null;
        $slogan = isset($instance['slogan']) ? $instance['slogan'] : null;
        $background_start = isset($instance['background_color_start']) ? $instance['background_color_start'] : null;
        $background_end = isset($instance['background_color_end']) ? $instance['background_color_end'] : null;
        $args = array(
            'id' => $this->get_field_id('page'),
            'name' => $this->get_field_name('page'),
            'depth' => 0,
            'child_of' => 0,
            'selected' => $page,
            'echo' => 1,
            'sort_order' => 'ASC',
            'sort_column' => 'post_title',
            'hierarchical' => 1,
            'post_type' => 'page'
        );
        $background_color_start = esc_attr($this->get_field_id('background_color_start'));
        $background_color_end = esc_attr($this->get_field_id('background_color_end'));
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('page')); ?>"><?php _e('Atlantis Page', 'atlantis'); ?></label>
            <?php wp_dropdown_pages($args); ?>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'atlantis'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('title')) ?>" id="<?php echo esc_attr($this->get_field_id('title')) ?>" value="<?php echo $title; ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('slogan')); ?>"><?php _e('Slogan', 'atlantis'); ?></label>
            <input type="text" name="<?php echo esc_attr($this->get_field_name('slogan')) ?>" id="<?php echo esc_attr($this->get_field_id('slogan')) ?>" value="<?php echo $slogan; ?>">
        </p>
        <p>
            <label for="<?php echo $background_color_start; ?>"><?php _e('Box Color Start', 'atlantis'); ?></label>
            <input type="color" class="atlantis-color-picker" name="<?php echo esc_attr($this->get_field_name('background_color_start')) ?>" id="<?= $background_color_start; ?>" value="<?php echo $background_start; ?>">
        </p>
        <p>
            <label for="<?php echo $background_color_end; ?>"><?php _e('Box Color End', 'atlantis'); ?></label>
            <input type="color" class="atlantis-color-picker" name="<?php echo esc_attr($this->get_field_name('background_color_end')) ?>" id="<?= $background_color_end; ?>" value="<?php echo $background_end; ?>">
        </p>
    <?php }
}