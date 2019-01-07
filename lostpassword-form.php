<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="row">
    <div class="offset-md-4"></div>
    <div class="col-md-4">
<div class="tml-lostpassword" id="theme-my-login<?php $template->the_instance(); ?>">
    <div class="alert alert-warning" role="alert">
        <strong>Alert!</strong> <?php $template->the_action_template_message( 'lostpassword' , '', ''); ?>
    </div>
    <?php if ($errors = $template->get_errors()) :?>
    <div class="alert alert-danger" role="alert">
		<?php echo $errors ?>
    </div>
    <?php endif; ?>
    <form name="lostpasswordform" id="lostpasswordform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'lostpassword', 'login_post' ); ?>" method="post">
		<div class="form-group">
			<label for="user_login<?php $template->the_instance(); ?>"><?php
			if ( 'email' == $theme_my_login->get_option( 'login_type' ) ) {
				_e( 'E-mail:', 'theme-my-login' );
			} else {
                _e( 'Username', 'theme-my-login' );
                ?> /
                <?php
                _e( 'E-mail', 'theme-my-login' );
			} ?></label>
			<input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="form-control" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
		</div>

		<?php do_action( 'lostpassword_form' ); ?>

		<div class="tml-submit-wrap">
			<input type="submit" name="wp-submit" class="btn btn-unfill" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Get New Password', 'theme-my-login' ); ?>" />
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'lostpassword' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="lostpassword" />
		</div>
	</form>
    <nav class="nav nav-inline">
        <a class="nav-link" href="<?php echo esc_url($template->get_action_url( 'login' )); ?>" rel="nofollow"><i class="fa fa-sign-in"></i> <?php esc_attr_e( 'Log In', 'theme-my-login' ); ?></a>
        <a class="nav-link" href="<?php echo get_permalink(377); ?>" rel="nofollow"><i class="fa fa-user-plus"></i> <?php esc_attr_e( 'Register', 'theme-my-login' ); ?></a>
        <a class="nav-link disabled" href="#" rel="nofollow"><i class="fa fa-key"></i> <?php esc_attr_e( 'Lost Password', 'theme-my-login' ); ?></a>
    </nav>
<!--	--><?php //$template->the_action_links( array( 'lostpassword' => false ) ); ?>
</div>
</div>
<div class="offset-md-4"></div>
</div>
