<?php
require 'parts/header.php';
?>
<div class="dario segment form">
    <div class="row align-middle vertical-gutters align-center">
        <div class="column mobile-100"><?php _e('Frequently asked questions Help', 'user_profile'); ?></div>
        <div class="columns shrink mobile-100">
        </div>
    </div>
    <div class="dario fitted divider"></div>
<div class="dario space divider"></div>

<div class="dario styled accordion">
  <div class="active title">
    <i class="dropdown icon"></i>
   <?php _e('What this plugin will do ', 'user_profile'); ?>
  </div>
  <div class="active content">
    <p><?php _e('Will redirect users from www.yoursite.com/user/profile/username?iPage=2 to www.yoursite.com/user-username/2 ', 'user_profile'); ?></p>
  </div>
  <div class="title">
    <i class="dropdown icon"></i>
   <?php _e('Can i rename "user-"', 'user_profile'); ?>
  </div>
  <div class="content">
    <p><?php _e('Yes you can ...', 'user_profile'); ?></p>
  </div>
  <div class="title">
    <i class="dropdown icon"></i>
    <?php _e('Can i remove "user-"' , 'user_profile'); ?>
  </div>
  <div class="content">
    <p> <?php _e('Only if you know what you are  doing  and why . If not ,contact the developer using the <a href ="'.USER_PROFILE_ADMIN_VIEW_URL.'support.php">SUPPORT PAGE</a>,asking  for a quote .' , 'user_profile'); ?></p>
   </div>
    <div class="title">
    <i class="dropdown icon"></i>
    <?php _e('Can i contact developer' , 'user_profile'); ?>
  </div>
  <div class="content">
    <p> <?php   _e('Solving bugs it\'s free work by developer.Everything else is a subject of freelance job. Use the <a href ="'.USER_PROFILE_ADMIN_VIEW_URL.'support.php">SUPPORT PAGE</a>.' , 'user_profile'); ?></p>
   </div>
</div>
<div class="dario space divider"></div>
    </div>

<?php
require'parts/footer.php';
?>