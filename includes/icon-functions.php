<?php

function atlantis_icon_fa($args) {

	// Set defaults.
	$defaults = array(
		'icon'        => '',
		'title'       => '',
		'fallback'    => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	echo "<i class='fa fa-{$args['icon']}' title='{$args['title']}'></i>";
}