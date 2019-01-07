<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if (!defined('ABSPATH')) {
    exit;
} ?>

<h3 class="bg-primary-default"><?php echo __('Account Details', 'woocommerce'); ?></h3>
<div class="container">
    <div class="table-responsive">
        <?php do_action('woocommerce_before_edit_account_form'); ?>
        <div class="container w-100">
            <form class="woocommerce-EditAccountForm edit-account" action="" method="post">

                <?php do_action('woocommerce_edit_account_form_start'); ?>

                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label for="account_first_name"><?php esc_html_e('Nombre', 'woocommerce'); ?> <span class="required text-danger">*</span></label>
                            <input type="text" id="account_first_name" class="form-control" name="account_first_name" id="" value="<?php echo esc_attr($user->first_name); ?>" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted"><?php _e('Please enter your name','woocommerce')?></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label for="account_last_name"><?php esc_html_e('Apellidos', 'woocommerce'); ?><span class="required text-danger">*</span></label>
                            <input type="text" id="account_last_name" class="form-control" name="account_last_name" id="" value="<?php echo esc_attr($user->last_name); ?>" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted"><?php _e('Please enter your lastname','woocommerce')?></small>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label for="account_email"><?php esc_html_e('Email address', 'woocommerce'); ?><span class="required text-danger">*</span></label>
                            <input type="text" id="account_email" class="form-control" name="account_email" value="<?php echo esc_attr($user->user_email); ?>" aria-describedby="helpId" placeholder="">
                            <small id="helpId" class="form-text text-muted"><?php _e('Please enter your email','woocommerce')?></small>
                        </div>
                    </div>
                </div>
                <div id="accordianId" role="tablist" class="mb-3" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header" role="tab" id="section1HeaderId">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" data-parent="#accordianId" href="#section1ContentId" aria-expanded="true" aria-controls="section1ContentId">
                                    <?php _e('Change Password','woocommerce')?>
                                </a>
                            </h5>
                        </div>
                        <div id="section1ContentId" class="collapse in" role="tabpanel" aria-labelledby="section1HeaderId">
                            <div class="card-body row">
                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="password_current"><?php esc_html_e('Password', 'woocommerce'); ?></label>
                                        <input type="password" class="form-control" name="password_current" id="password_current" aria-describedby="helpId" placeholder="">
                                        <small id="helpId" class="form-text text-muted"><?php _e('Leave blank to ignore changes','woocommerce')?></small>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="password_1"><?php esc_html_e('New password', 'woocommerce'); ?></label>
                                        <input type="password" class="form-control" name="password_1" id="password_1" aria-describedby="helpId" placeholder="">
                                        <small id="helpId" class="form-text text-muted"><?php _e('Leave blank to ignore changes','woocommerce')?></small>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group">
                                        <label for="password_2"><?php esc_html_e('Confirm password', 'woocommerce'); ?></label>
                                        <input type="password" class="form-control" name="password_2" id="password_2" aria-describedby="helpId" placeholder="">
                                        <small id="helpId" class="form-text text-muted"><?php _e('Re-enter new password','woocommerce')?></small>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <?php do_action('woocommerce_edit_account_form'); ?>

                <p>
                    <?php wp_nonce_field('save_account_details'); ?>
                    <button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e('Save changes', 'woocommerce'); ?>"><?php esc_html_e('Save changes', 'woocommerce'); ?></button>
                    <input type="hidden" name="action" value="save_account_details"/>
                </p>

                <?php do_action('woocommerce_edit_account_form_end'); ?>
            </form>
        </div>

        <?php do_action('woocommerce_after_edit_account_form'); ?>
    </div>
</div>
