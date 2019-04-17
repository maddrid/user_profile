<?php

if (Session::newInstance()->_get('user_profile_user') != '') {
    $user = Session::newInstance()->_get('user_profile_user');
} else {
    p_print_r('user_ inexistent');
    Rewrite::newInstance()->set_location('error');
    header('HTTP/1.1 404 Not Found');
    osc_current_web_theme_path('404.php');
    exit;
}
Rewrite::newInstance()->set_location('user');
$itemsPerPage = Session::newInstance()->_get('user_profile_ipp');
if (is_numeric($itemsPerPage) && intval($itemsPerPage) > 0) {
    $itemsPerPage = intval($itemsPerPage);
} else {
    $itemsPerPage = 10;
}

Params::setParam('itemsPerPage', $itemsPerPage);
$page = Session::newInstance()->_get('user_profile_page');
if (is_numeric($page) && intval($page) > 0) {
    $page = intval($page) - 1;
} else {
    $page = 0;
}
Params::setParam('iPage', $page);
$total_items = Item::newInstance()->countItemTypesByUserID($user['pk_i_id'], 'active');

if ($itemsPerPage == 'all') {
    $total_pages = 1;
    $items = Item::newInstance()->findItemTypesByUserID($user['pk_i_id'], 0, null, 'active');
} else {
    $total_pages = ceil($total_items / $itemsPerPage);
    $items = Item::newInstance()->findItemTypesByUserID($user['pk_i_id'], $page * $itemsPerPage, $itemsPerPage, 'active');
}

View::newInstance()->_exportVariableToView('user', $user);
View::newInstance()->_exportVariableToView('items', $items);
View::newInstance()->_exportVariableToView('search_total_pages', $total_pages);
View::newInstance()->_exportVariableToView('search_total_items', $total_items);
View::newInstance()->_exportVariableToView('items_per_page', $itemsPerPage);
View::newInstance()->_exportVariableToView('search_page', $page);
View::newInstance()->_exportVariableToView('canonical', osc_user_public_profile_url());
Session::newInstance()->_drop('user_profile_redirect');
Session::newInstance()->_drop('user_profile_user');
Session::newInstance()->_drop('user_profile_username');
Session::newInstance()->_drop('user_profile_ipp');
Session::newInstance()->_drop('user_profile_page');
osc_current_web_theme_path('user-public-profile.php');

exit();

