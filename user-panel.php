<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
if (is_user_logged_in()) {
    $redirect = site_url('dashboard');
	exit( wp_redirect( $redirect ) );
}
?>
<!--<div class="tml tml-user-panel" id="theme-my-login--><?php //$template->the_instance(); ?><!--">-->
<!--	--><?php //if ( $template->options['show_gravatar'] ) : ?>
<!--	<div class="tml-user-avatar">--><?php //$template->the_user_avatar(); ?><!--</div>-->
<!--	--><?php //endif; ?>
<!--</div>-->

<div class="row">
    <div class="col-md-3">
        <div class="list-group">
			<?php if ( is_user_logged_in() ) : ?>
                <a href="#tab-upload" role="tab" aria-controls="profile" aria-selected="false"
                   class="list-group-item list-group-item-action list-group-item-light" data-toggle="tab">Upload PDF</a>
				<?php if ( user_can( get_current_user_id(), 'submissions' ) ) : ?>
                <a href="#tab-submissions" role="tab" aria-controls="profile" aria-selected="false"
                   class="list-group-item list-group-item-action list-group-item-light" data-toggle="tab">Submissions</a>
				<?php endif; ?>
			<?php endif; ?>
            <a href="<?php echo wp_logout_url(); ?>"
               class="list-group-item list-group-item-action list-group-item-danger"><?php echo $template->get_title( 'logout' ); ?></a>
        </div>
    </div>
    <div class="col-md-9">
		<?php do_action( 'tml_user_panel' ); ?>
        <div class="tab-content">
            <div class="tab-pane fade hide" id="tab-upload" role="tabpanel" aria-labelledby="tab-upload">
                <h4>ShowUp</h4>
            </div>
            <div class="tab-pane fade hide" id="tab-submissions" role="tabpanel" aria-labelledby="tab-submissions">
                <h3>Submissions</h3>
                <?php echo do_shortcode('[Form id="2" type="submission" startdate="" enddate="" submit_date="0" submitter_ip="0" username="0" useremail="0" form_fields="1" show="1,1,1,1,1,1,1,1,1,1"]') ?>
            </div>
        </div>
    </div>
</div>