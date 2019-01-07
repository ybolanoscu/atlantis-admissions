<?php

function display_atlantis_style_page( $post ) {
	$current_style_val = get_post_meta( $post->ID, 'atlantis_style_page', true );
	$current_class_val = get_post_meta( $post->ID, 'atlantis_class_page', true );
	$current_script_page = get_post_meta( $post->ID, 'atlantis_script_page', true );
	?>
    <div class="form-group">
        <label for="atlantis_class_page">Class Container</label>
        <input type="text" name="atlantis_class_page" id="atlantis_class_page" style="width: 100%"
               placeholder="col-xs-6 col-md " value="<?php echo $current_class_val; ?>"/>
        <p id="atlantis_style_page" class="description">Is just the class for the container of page</p>
    </div>
    <div class="form-group">
        <label for="atlantis_style_page">Style Container</label>
        <textarea name="atlantis_style_page" id="atlantis_style_page" style="width: 100%" rows="3"
                  placeholder="color: #ff00ff;"><?php echo $current_style_val; ?></textarea>
        <p id="atlantis_style_page" class="description">Is just the style for the container of page</p>
    </div>
    <div class="form-group">
        <label for="atlantis_script_page">Script of page</label>
        <textarea name="atlantis_script_page" id="atlantis_script_page" style="width: 100%" rows="3"
                  placeholder="alert('Hello');"><?php echo $current_script_page; ?></textarea>
        <p id="atlantis_script_page" class="description">Is just the script for the current page</p>
    </div>
	<?php
}

function atlantis_add_meta_boxes() {
	add_meta_box( 'atlantis_style_page', __( 'Custom Theme Atlantis', 'atlantis' ), 'display_atlantis_style_page' );
}

add_action( 'add_meta_boxes_page', 'atlantis_add_meta_boxes' );

function atlantis_save_post_handler( $post_id, $post, $update ) {
	if ( ! isset( $_POST['action'] ) ) {
		//this is probably not edit or new post creation event
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if (isset($post_id)) {
		update_post_meta( $post_id, 'atlantis_style_page', sanitize_text_field( $_POST['atlantis_style_page'] ) );
		update_post_meta( $post_id, 'atlantis_class_page', sanitize_text_field( $_POST['atlantis_class_page'] ) );
		update_post_meta( $post_id, 'atlantis_script_page', ( $_POST['atlantis_script_page'] ) );
	}
}

add_action( 'save_post_page', 'atlantis_save_post_handler', 10, 3);
