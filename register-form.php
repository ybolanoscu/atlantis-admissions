<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="row">
    <div class="offset-md-4"></div>
    <div class="col-md-4">
        <div class="tml-register" id="theme-my-login<?php $template->the_instance(); ?>">
            <div class="alert alert-info" role="alert">
                <strong>Hello!</strong> <?php $template->the_action_template_message( 'register' , '', ''); ?>
            </div>

            <?php $template->the_errors(); ?>
            <form name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register', 'login_post' ); ?>" method="post">
                <?php if ( 'email' != $theme_my_login->get_option( 'login_type' ) ) : ?>
                <div class="form-group">
                    <label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'theme-my-login' ); ?></label>
                    <input type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="form-control" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'E-mail', 'theme-my-login' ); ?></label>
                    <input type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>"  class="form-control" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
                </div>

                <?php do_action( 'register_form' ); ?>

                <p class="tml-registration-confirmation" id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'Registration confirmation will be e-mailed to you.', 'theme-my-login' ) ); ?></p>

                <p class="tml-submit-wrap">
                    <input type="submit" class="btn btn-unfill" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Register', 'theme-my-login' ); ?>" />
                    <input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
                    <input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
                    <input type="hidden" name="action" value="register" />
                </p>
            </form>
            <div class="row">
                <nav class="nav nav-inline">
                    <a class="nav-link" href="<?php echo esc_url($template->get_action_url( 'login' )); ?>" rel="nofollow"><i class="fa fa-sign-in"></i> Login</a>
                    <a class="nav-link disabled" href="#"><i class="fa fa-user-plus"></i> Register</a>
                    <a class="nav-link" href="<?php echo esc_url($template->get_action_url( 'lostpassword' )); ?>" rel="nofollow"><i class="fa fa-key"></i> Lost Password</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="offset-md-4"></div>
</div>
