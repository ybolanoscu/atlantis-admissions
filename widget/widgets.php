<?php

require_once __DIR__ . '/Widget_Page.php';

// Register the widget
function my_register_custom_widget() {
	register_widget( 'Widget_Page' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );