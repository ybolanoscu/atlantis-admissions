<?php
/**
 * Created by PhpStorm.
 * User: ejromeror
 * Date: 4/11/18
 * Time: 1:19 AM
 */

add_action('woocommerce_account_dashboard', 'devyai_dashboard');
function devyai_dashboard()
{
    global $wpdb;
    $submissions = isset($_POST['tab_current']) ? intval($_POST['tab_current']) : false;
    $user = wp_get_current_user();
    $exists = $wpdb->get_var(
        $wpdb->prepare("SELECT `user_id_wd` FROM {$wpdb->prefix}formmaker_submits WHERE form_id='%d' AND user_id_wd='%d'",
            array(7, $user->ID)
        )
    );

    $table_pdf = MIBase::TABLE_NAME_USER;
    $pdfs = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$wpdb->prefix}$table_pdf WHERE email = '%s'", array(
        $user->user_email
    )));
    ?>
    <div style="padding: 0 15px;">
        <div class="row">
            <?php if (is_user_logged_in()) : ?>
                <div class="col-md-12 mb-4">
                    <nav class="nav nav-tabs">
                        <?php if (is_user_logged_in()) : ?>
                            <a href="#tab-upload" role="tab" aria-controls="profile" aria-selected="false"
                               class="nav-link <?php echo($submissions == false ? 'active' : ''); ?>"
                               data-toggle="tab"><?php _e('Upload PDF','atlantis-admissions')?></a>
                            <a href="#tab-pdfs" role="tab" aria-controls="profile" aria-selected="false"
                               class="nav-link" data-toggle="tab"><?php _e('Generated PDF','atlantis-admissions')?></a>
                            <?php if (user_can(get_current_user_id(), 'submissions')) : ?>
                                <a href="#tab-submissions" role="tab" aria-controls="profile" aria-selected="false"
                                   class="nav-link <?php echo($submissions == 1 ? 'active' : ''); ?>"
                                   data-toggle="tab"><?php _e('Admissions','atlantis-admissions')?></a>
                                <a href="#tab-uploads" role="tab" aria-controls="profile" aria-selected="false"
                                   class="nav-link <?php echo($submissions == 2 ? 'active' : ''); ?>"
                                   data-toggle="tab"><?php _e('Upload Admissions','atlantis-admissions')?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </nav>
                </div>
                <div class="col-md-12 mb-4">
                    <?php do_action('tml_user_panel'); ?>
                    <div class="tab-content">
                        <div class="tab-pane fade <?php echo($submissions == false ? 'active show' : ''); ?>"
                             id="tab-upload" role="tabpanel" aria-labelledby="tab-upload">
                            <h3><?php _e('Upload Admission','atlantis-admissions')?></h3>
                            <?php if ($exists) : ?>
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only"><?php _e('Close','atlantis-admissions')?></span>
                                    </button>
                                    <strong>Hmmm...</strong><?php _e('You already sent this form, are you sure you want to continue?','atlantis-admissions')?>
                                </div>
                            <?php endif; ?>
                            <?php echo do_shortcode('[Form id="7"]') ?>
                        </div>
                        <div class="tab-pane fade <?php echo($submissions == false ? 'active' : ''); ?>"
                             id="tab-pdfs" role="tabpanel" aria-labelledby="tab-pdfs">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th><?php _e('Date','atlantis-admissions')?></th>
                                    <th><?php _e('Title','atlantis-admissions')?></th>
                                    <th><i class="fa fa-download" aria-hidden="true"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($pdfs as $pdf) : ?>
                                    <tr>
                                        <td><?php echo str_replace('-', '/', $pdf->time); ?></td>
                                        <td><?php echo str_replace('-', ' ', $pdf->title); ?></td>
                                        <td><a target="_blank" title="<?php echo _q('Download') ?>" href="<?php echo get_site_url() . '/' . $pdf->pdf_link; ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if (user_can(get_current_user_id(), 'submissions')) : ?>
                            <div class="tab-pane fade <?php echo($submissions == 1 ? 'active show' : ''); ?>"
                                 id="tab-submissions" role="tabpanel" aria-labelledby="tab-submissions">
                                <!--                            <h3>Submission</h3>-->
                                <input type="hidden" name="tab_current" value="1">
                                <?php echo do_shortcode('[Form id="6" type="submission" startdate="" enddate="" submit_date="1" submitter_ip="0" username="0" useremail="0" form_fields="1" show="1,1,1,1,1,1,1,1,1,0"]') ?>
                            </div>
                            <div class="tab-pane fade <?php echo($submissions == 2 ? 'active show' : ''); ?>"
                                 id="tab-uploads" role="tabpanel" aria-labelledby="tab-uploads">
                                <!--                            <h3>Submission Upload</h3>-->
                                <input type="hidden" name="tab_current" value="2">
                                <?php echo do_shortcode('[Form id="7" type="submission" startdate="" enddate="" submit_date="1" submitter_ip="0" username="1" useremail="1" form_fields="1" show="1,1,1,1,1,1,1,1,1,0"]') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function () {
                            jQuery('.button-submit').addClass('btn btn-unfill');
                            jQuery('.button-reset').addClass('btn btn-fill-grey');
                            jQuery('.submissions a.modal').removeClass('modal');
                            var tabs = jQuery('.tab-pane');
                            tabs.each(function () {
                                var $this = jQuery(this), tab = $this.find('> input[type="hidden"]');
                                if (tab.length > 0) {
                                    $this.find('#adminForm').append(tab);
                                }
                            })
                        });
                    </script>
                </div>
            <?php else: ?>
                <div class="alert alert-danger mt-3 mb-3" role="alert">
                    <strong><?php echo _q('[:en]Got you[:es]Te atrapé... [:]')?></strong><?php echo _q('[:en]You should not be here ... please[:es] No deberías estar por aquí ... por favor[:]')?><a
                            href="<?php echo get_home_url() ?>" class="btn btn-danger btn-sm"><?php echo _q('[:en]go back to home.[:es]regrese al inicio.[:]')?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
}
