<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="row">
    <div class="offset-md-4"></div>
    <div class="col-md-4">
        <div class="tml-login" id="theme-my-login<?php $template->the_instance(); ?>">
            <?php if ($errors = $template->get_errors()) :?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors ?>
            </div>
            <?php endif; ?>
		    <?php $template->the_action_template_message( 'login' ); ?>
            <form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login', 'login_post' ); ?>" method="post">
                <div class="form-group">
                    <label for="user_login<?php $template->the_instance(); ?>"><?php
					    if ( 'username' == $theme_my_login->get_option( 'login_type' ) ) {
						    _e( 'Username', 'theme-my-login' );
					    } elseif ( 'email' == $theme_my_login->get_option( 'login_type' ) ) {
						    _e( 'E-mail', 'theme-my-login' );
					    } else {
                            _e( 'Username', 'theme-my-login' );
                            ?> /
                            <?php
                            _e( 'E-mail', 'theme-my-login' );
					    }
					    ?></label>
                    <input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" class="form-control" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
                </div>

                <div class="form-group">
                    <label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password', 'theme-my-login' ); ?></label>
                    <input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" class="form-control" value="" size="20" autocomplete="off" />
                </div>

			    <?php do_action( 'login_form' ); ?>

                <div class="tml-rememberme-submit-wrap">
                    <div class="form-check">
                        <label for="rememberme<?php $template->the_instance(); ?>" class="form-check-label">
                            <input  name="rememberme" type="checkbox" id="rememberme<?php $template->the_instance(); ?>" value="forever">
						    <?php esc_attr_e( 'Remember Me', 'theme-my-login' ); ?>
                        </label>
                    </div>

                    <p class="tml-submit-wrap">
                        <input type="submit" class="btn btn-unfill" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Log In', 'theme-my-login' ); ?>" />
                        <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
                        <input type="hidden" name="action" value="login" />
                    </p>
                </div>
            </form>
            <div class="row">
                <nav class="nav nav-inline">
                    <a class="nav-link disabled" href="#"><i class="fa fa-sign-in"></i> <?php esc_attr_e( 'Log In', 'theme-my-login' ); ?></a>
                    <a class="nav-link" href="<?php echo get_permalink(377); ?>" rel="nofollow"><i class="fa fa-user-plus"></i> <?php esc_attr_e( 'Register', 'theme-my-login' ); ?></a>
                    <a class="nav-link" href="<?php echo esc_url($template->get_action_url( 'lostpassword' )); ?>" rel="nofollow"><i class="fa fa-key"></i> <?php esc_attr_e( 'Lost Password', 'theme-my-login' ); ?></a>
                </nav>
            </div>
<!--		    --><?php //$template->the_action_links( array( 'login' => false ) ); ?>
        </div>
    </div>
    <div class="offset-md-4"></div>
</div>