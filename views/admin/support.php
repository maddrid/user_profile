<?php
require 'parts/header.php';
?>

<div class="dario segment form">
    <div class="row align-middle vertical-gutters align-center">
        <div class="column mobile-100"><?php _e('Support', 'user_profile'); ?></div>
        <div class="columns shrink mobile-100">
        </div>
    </div>
    <div class="dario fitted divider"></div>
    <div class="dario    fields">
        <div class="field">
            <form  id="dario_form" action="<?php echo osc_admin_render_plugin_url('user_profile/manager.php'); ?>" method="post">
                <input type="hidden" name="action_specific" value="support" />
                <div class="field nine wide labeled">
                    <label class="content-left mobile-content-left">
                        <?php _e('Your  Name', 'user_profile') ?> <i class="icon-append icon asterisk"></i>
                    </label>
                    <label class="input ">
                        <input type="text"  name="yourName" value="">
                    </label>
                </div>
                <div class="field nine wide labeled">
                    <label class="content-left mobile-content-left">
                        <?php _e(' Email', 'user_profile') ?>  <i class="icon-append icon asterisk"></i>
                    </label>
                    <label class="input ">

                        <input type="text"  name="yourEmail" value="<?php echo osc_logged_admin_email(); ?>">
                    </label>
                </div>

                <div class="field nine wide labeled">
                    <label class="content-left mobile-content-left">
                        <?php _e('Subject', 'user_profile') ?> <i class="icon-append icon asterisk"></i>
                    </label>
                    <label class="input ">

                        <input type="text"  name="subject" value="">
                    </label>
                </div>
                <div class="field nine wide labeled required">
                    <label class="content-left mobile-content-left">
                        <?php _e('Message', 'user_profile') ?>  <i class="icon-append icon asterisk"></i>
                    </label>
                    <label class="input ">

                        <textarea name="message" rows="4" cols="50">

                        </textarea>
                    </label>
                </div>

                <div class="field nine wide labeled">
                    <label class="content-left mobile-content-left">
                        <?php _e('Attachment', 'user_profile'); ?>
                    </label>
                    <fieldset>
                        <?php  echo '<input type="file" name="attachment" />'; ?>
                    </fieldset>
                    </label>
                </div>

                <div class="form-actions">
                    <input type="submit" value="Send mail" class="btn btn-submit">
                </div>
            </form>
        </div>
        <div class="field">
            <div class="postbox " id="linksubmitdiv">
                <div>
                    <div id="submitlink" >
                        <h3> <?php _e('Hello there Admin of')?> <b><?php echo $_SERVER["SERVER_NAME"] ?></b></h3>
                        <div class="section">
                            <p style="line-height: 19px;" align="justify">
                                <?php _e('If you are still new to things, we recommend that you read the Help Section on each page were available', 'user_profile') ?>.
                            </p>
                            <p style="line-height: 19px;" align="justify">
                                <?php _e('If you run into any issue then refer to <b><a href ="'.USER_PROFILE_ADMIN_VIEW_URL.'support.php">SUPPORT PAGE</a></b> to know how to reach us', 'wordpress-social-login') ?>.
                            </p>
                        </div>
</div>
                </div>
            </div>
            <div class="dario space divider"></div>
             <?php  require'parts/plugins.php';?>
        </div>

    </div>

</div>


<?php
require'parts/footer.php';
?>