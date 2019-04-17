<?php
$pluginInfo = osc_plugin_get_info('user_profile/index.php');
?>

<div class="clear"></div>
<p class="form-row">
    <span class="help-box"><?php _e('Version', 'user_profile'); ?>: <?php echo $pluginInfo['version']; ?></span><br />
    <span class="help-box"><?php _e('Description', 'user_profile'); ?>: <?php echo $pluginInfo['description']; ?></span><br />
    <span class="help-box"><?php _e('Author', 'user_profile'); ?>: <?php echo $pluginInfo['author']; ?></span><br />
    <span class="help-box"><?php _e('Author website', 'user_profile'); ?>: <a href="<?php echo $pluginInfo['author_uri']; ?>" target="_blank"><?php echo $pluginInfo['author_uri']; ?></a></span><br />
    <span class="help-box"><?php _e('Contact', 'user_profile'); ?>: <a href="mailto:4oscmad2@gmail.com?Subject=user_profile">Contact Developer</a></span>

</p>
<script type="text/javascript" src="<?php echo USER_PROFILE_URL . 'assets/js/dosc.js'; ?>" charset="utf-8" ></script>

  <script type="text/javascript">
        $(document).ready(function() {



 $('.dario.dropdown').dropdown();
        $('.dario.checkbox').checkbox();
		$('.dario.progress').progress();
		$('.dario.accordion').accordion();
        $('.rangeslider').jRange();

        $('[data-content]').popup({
            variation: "mini ",
			inline:true,

        });

              });
</script>
