<?php

/*
  Plugin Name: User Profile
  Plugin URI: http://www.oscmad.com/
  Description: User Profile Pretty URL.
  Version: 1.0.0
  Author: OscMad
  Author URI: http://www.oscmad.com/
  Short Name: user_profile
  Plugin update URI: ''
 */
define('USER_PROFILE_PATH', PLUGINS_PATH . 'user_profile/');
define('USER_PROFILE_URL', osc_base_url() . 'oc-content/plugins/user_profile/');
define('USER_PROFILE_VIEW_PATH', USER_PROFILE_PATH . 'views/');
define('USER_PROFILE_VIEW_URL', USER_PROFILE_URL . 'views/');
define('USER_PROFILE_ADMIN_VIEW_URL', osc_admin_render_plugin_url(osc_plugin_path(dirname(__FILE__))) . '/views/admin/');
//define('USER_PROFILE_ADMIN_VIEW', USER_PROFILE_PATH . 'views/admin/');

define('USER_PROFILE_HELPERS_PATH', PLUGINS_PATH . 'user_profile/helpers/');
require USER_PROFILE_HELPERS_PATH . 'init.php';

//function userSession (){
//    osc_run_hook('user_footer');
//    $routes = Rewrite::newInstance()->getRoutes();
//                p_print_r($routes);
//    p_print_r($_SESSION);
//}
//osc_add_hook('footer', 'userSession');
function user_profile_redirect() {
    $var = preg_quote(userProfileGetPreference('user_profile_route'));
    if (Params::getParam('username') != '') {
        $user = User::newInstance()->findByUsername(Params::getParam('username'));
    } else {
        $user = User::newInstance()->findByPrimaryKey(Params::getParam('id'));
    }
    // user doesn't exist, show 404 error
    if (!$user) {
        Rewrite::newInstance()->set_location('error');
        header('HTTP/1.1 404 Not Found');
        osc_current_web_theme_path('404.php');
        exit;
    }

    $itemsPerPage = Params::getParam('itemsPerPage');
    if (is_numeric($itemsPerPage) && intval($itemsPerPage) > 0) {
        $itemsPerPage = '/'.intval($itemsPerPage);
    } else {
        $itemsPerPage = '';
    }

    $page = Params::getParam('iPage');
    if (is_numeric($page) && intval($page) > 0) {
        $page = intval($page);
    } else {
        $page = 0;
    }
    $val = ($page > 0) ?  $itemsPerPage . '/' . $page : '';
    Session::newInstance()->_set('user_profile_user', $user);
    Session::newInstance()->_set('user_profile_redirect', true);
    Session::newInstance()->_set('user_profile_username', $user['s_username']);
    Session::newInstance()->_set('user_profile_ipp', $itemsPerPage);
    Session::newInstance()->_set('user_profile_page', $page);
    osc_redirect_to(osc_base_url() . $var . '-' . $user['s_username'] . $val);
    exit();
}

osc_add_hook('init_user_non_secure', 'user_profile_redirect');

function user_profile_custom() {
    $routes = Rewrite::newInstance()->getRoutes();
    $var = preg_quote(userProfileGetPreference('user_profile_route'));
    //   p_print_r($routes);
    if (Params::existParam('route')) {
        $route = Params::getParam('route');
        $pos = strpos($route, $var . '-', 0);
        if ($pos !== false) {

            if (Params::existParam('route')) {

                $rid = Params::getParam('route');
                $file = '../';
                if (isset($routes[$rid]) && isset($routes[$rid]['file'])) {
                    $file = $routes[$rid]['file'];
                }
            }
            // valid file?
            if (strpos($file, '../') !== false || strpos($file, '..\\') !== false || stripos($file, '/admin/') !== false) { //If the file is inside an "admin" folder, it should NOT be opened in frontend
                Rewrite::newInstance()->set_location('error');
                header('HTTP/1.1 404 Not Found');
                osc_current_web_theme_path('404.php');
                exit;
            }

            // check if the file exists
            if (!file_exists(osc_plugins_path() . $file)) {
                Rewrite::newInstance()->set_location('error');
                header('HTTP/1.1 404 Not Found');
                osc_current_web_theme_path('404.php');
            }

//            osc_run_hook('custom_controller');
//
//            osc_run_hook("before_html");
            require USER_PROFILE_VIEW_PATH . 'profile.php';

            exit();
        }
    }
}

$newArray = array();
osc_add_hook('init_custom', 'user_profile_custom');
$var = userProfileGetPreference('user_profile_route');


    osc_add_route('cris', 'cris', 'cris' , osc_plugin_folder('user_profile/index.php') . 'views/cris.php', false, 'custom', 'pub_profile', __('Profile Page Of ') );
   
if (Params::existServerParam('REQUEST_URI') && stripos(Params::getServerParam('REQUEST_URI', false, false), '/oc-admin/') == false) {

        $request_uri = preg_replace('@^' . REL_WEB_URL . '@', "", Params::getServerParam('REQUEST_URI', false, false));
        $pos = strpos($request_uri, $var . '-', 0);

        if ($pos !== false) {
            if (!class_exists('AltoRouter')) {
                require USER_PROFILE_PATH . 'classes/router.php';
            }

            $pathinfo = pathinfo(Params::getServerParam('SCRIPT_NAME', false, false));


            $basePath = $pathinfo['dirname'];

            $router = new \AltoRouter();
            $router->setBasePath($basePath);


$router->map('GET',"/{$var}-[a:username]", 'userProfile', 'users');
$router->map('GET',"/{$var}-[a:username]/[i:iPage]", 'userProfilePage', 'users_page');
$router->map('GET',"/{$var}-[a:username]/[i:itemsPerPage]/[i:iPage]", 'userProfilePagePagination', 'users_pagination');

            if (($match = $router->match()) !== false) {

                call_user_func_array($match['target'], $match['params']);
            }
        }
  //  }
}
//p_print_r(Rewrite::newInstance()->getRoutes());


function userProfileInstall() {
    setUserProfileOptions();
}

function userProfileUnistall() {
    removeUserOptions();
}

function userProfileConfig() {

}

// install function
osc_register_plugin(osc_plugin_path(__FILE__), 'userProfileInstall');

// unistall function
osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'userProfileUnistall');


//osc_add_hook(osc_plugin_path(__FILE__) . "_configure", 'userProfileConfig');
?>
