<?php

// HELPERS
function userProfileGetPreference($string) {
    return getPreference($string, 'userProfile');
}

function userProfile($username = '') {
    userProfileRoute($username,false,false);
}

function userProfilePage($username = '', $ipage = '1') {
    userProfileRoute($username,10,$ipage);
}

function userProfilePagePagination($username = '', $ipp = '10', $ipage = '1') {
    userProfileRoute($username, $ipp, $ipage);
}

function userProfileRoute($username, $ipp = 10, $page = 1) {
    $var = userProfileGetPreference('user_profile_route');
    $username = trim(osc_sanitize_username($username));

    $user = User::newInstance()->findByUsername($username);


    if ($user) {

        if ($user['b_enabled'] !== '1' || $user['b_active'] !== '1') {
            userProfileRedirect();
        }

        Session::newInstance()->_set('user_profile_username', $username);
        Session::newInstance()->_set('user_profile_user', $user);
        if ($ipp && $ipp != 10) {
             $ippRegex = '/([0-9]+)';
            $ipp = '/{itemsPerPage}';
            Session::newInstance()->_set('user_profile_ipp', $ipp);
        } else {
             $ippRegex = '';
            $ipp = '';
            Session::newInstance()->_set('user_profile_ipp', 10);
        }
        if ($page ) {

             $pageRegex = '/([0-9]+)';
            $iPage = '/{iPage}';
            Session::newInstance()->_set('user_profile_page', $page);
        } else {
             $pageRegex = '';
            $iPage = '';
            Session::newInstance()->_set('user_profile_page', 1);
        }
        osc_add_route($var . '-' . $username, $var . '-' . $username.$ippRegex.$pageRegex, $var . '-{username}'. $ipp. $iPage  , osc_plugin_folder('user_profile/index.php') . 'views/profile.php', false, 'custom', 'pub_profile', __('Profile Page Of ') . $username);
    } else {

        userProfileRedirect();

        exit();
    }
}

function userProfileOptions() {

    $options = array(
        'user_profile_route' => 'user',
        'user_profile_redirect' => 'main',
    );

    return $options;
}

function setUserProfileOptions() {
    $defaults = userProfileOptions();
    foreach ($defaults as $def => $def_val) {

        osc_set_preference($def, $def_val, 'userProfile');
    }
}

function removeUserOptions() {
    $defaults = userProfileOptions();
    foreach ($defaults as $def => $def_val) {

        osc_delete_preference($def, 'userProfile');
    }
}

function userProfileMetaDescription() {
    $text = eTagsGetPreference(osc_current_user_locale() . '#userProfile_description');
    return preg_replace('/[^a-zA-Z,0-9-\/ ]/', '', $text);
}

/**
 * Redirect to function via JS
 *
 * @param string $url
 */
function userProfileJsRedirect($url) {
    ?>
    <script type="text/javascript">
        window.location = "<?php echo $url; ?>"
    </script>
    <?php
}

function userProfileRedirect() {
    switch (userProfileGetPreference('user_profile_redirect'))
    {
        case 'main':
            osc_redirect_to(osc_base_url());

            break;

        default:
            osc_redirect_to(osc_search_url());
            break;
    }
}
?>
