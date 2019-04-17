<?php
// pretty print values
if (!function_exists('p_print_r')) {

    function p_print_r($expression) {
        echo '<pre>';
        print_r($expression);
        echo '</pre>';
    }

}
/**
 * tooltip()
 *
 * @param mixed $tip
 * @return
 */
function userProfileTooltip($tip) {
    echo '&nbsp&nbsp<img  src="' . USER_PROFILE_URL . 'assets/images/question.png" alt="Tip" data-content="' . __($tip, 'user_profile') . '"class="tooltip"  />';
}




function userPofileMultilanguageInput($locales, $field = null,$s_name)
        {
            $tabs = array();
            $content = array();
            foreach($locales as $locale) {
                    $value = (isset($field['locale'][$locale['pk_c_code']])) ? $field['locale'][$locale['pk_c_code']][$s_name] : "";
                    $name = $locale['pk_c_code'] . '#'.$s_name;

                    $contentTemp  = '<div id="'.$field['pk_i_id'].'-'.$locale['pk_c_code'].'" class="category-details-form">';
                    $contentTemp .= '<div id="'.$field['pk_i_id'].'-'.$locale['pk_c_code'].'-title"class="ElementTitle"><input id="' . $name .'" type="text" name="' . $name .'" value="' . osc_esc_html(htmlentities($value, ENT_COMPAT, "UTF-8")) . '"/></div>';
                    $contentTemp .= '</div>';
                    $tabs[] = '<li><a href="#'.$field['pk_i_id'].'-'.$locale['pk_c_code'].'">' . $locale['s_name'] . '</a></li>';
                    $content[] = $contentTemp;
             }
             echo '<div class="ui-osc-tabs osc-tab">';
             echo '<ul>'.join('',$tabs).'</ul>';
             echo join('',$content);
             echo '</div>';
        }

function userProfileAdminStyle() {

    $file = Params::getParam("file");
    if (preg_match('/user_profile/', $file)) {

        osc_remove_style('admin-css');
        osc_enqueue_style('admin-css', userProfileUrl('assets/css/osc_main.css'));
    }
}



osc_add_hook('admin_header', 'userProfileAdminStyle');

function userProfilePluginTitle($title) {
        $title = 'User Profile   Plugin';
        return $title;
    }

    if (osc_version() >= 300) {
        $file = explode('/', Params::getParam('file'));
        if ($file[0] == 'user_profile') {

            osc_add_filter('custom_plugin_title', 'userProfilePluginTitle');
        }
    }


osc_add_hook('admin_menu_init', 'userProfileAdminMenu');
//

function userProfileAdminMenu() {
    osc_add_admin_menu_page('User Profile', USER_PROFILE_ADMIN_VIEW_URL . 'dashboard.php', 'user_profile');
    osc_add_admin_submenu_page('user_profile', __('Help', 'user_profile'), USER_PROFILE_ADMIN_VIEW_URL.'help.php', 'user_profile_help');
    osc_add_admin_submenu_page('user_profile', __('Settings', 'user_profile'), USER_PROFILE_ADMIN_VIEW_URL.'settings.php', 'user_profile_settings');
    osc_add_admin_submenu_page('user_profile', __('Support', 'user_profile'), USER_PROFILE_ADMIN_VIEW_URL.'support.php', 'user_profile_support');
 }


    function user_profile_admin_menu() {
        ?>
        <style>

  .ico-user_profile{
        background-image: url('<?php echo USER_PROFILE_URL; ?>assets/images/user_profile.png') !important;
        background-size: 48px, 48px;
    }
    body.compact .ico-user_profile{
        background-image: url('<?php echo USER_PROFILE_URL; ?>assets/images/user_profile.png') !important;
        background-size: 35px, 35px;
    }
    .ico-user_profile:hover{
        background-image: url('<?php echo USER_PROFILE_URL; ?>assets/images/user_profile_hoover.png') !important;

    }
    body.compact .ico-user_profile:hover{
        background-image: url('<?php echo USER_PROFILE_URL; ?>assets/images/user_profile_hoover.png') !important;
        background-size: 35px, 35px;
    }
    .current .ico-user_profile {
        background-image: url('<?php echo USER_PROFILE_URL; ?>assets/images/user_profile_hoover.png') !important;
    }
    body.compact .current .ico-user_profile{
        background-image: url('<?php echo USER_PROFILE_URL; ?>assets/images/user_profile_hoover.png') !important;
        background-size: 35px, 35px;
    }

        </style>
        <?php
    }
	 osc_add_hook('admin_footer', 'user_profile_admin_menu');

 function userProfileUrl($file){
     return USER_PROFILE_URL.$file;
 }

