<?php

if ((!defined('ABS_PATH')))
    exit('Access is not allowed.');


if (!OC_ADMIN){
    exit('User access is not allowed.');
}
$action = Params::getParam('action_specific');
$locales = OSCLocale::newInstance()->listAllEnabled();
switch ($action)
{

         case('userSettings'):
             $user_profile_route = trim(Params::getParam('user_profile_route'));
             $user_profile_redirect = trim(Params::getParam('user_profile_redirect'));

 osc_set_preference('user_profile_route', ($user_profile_route != '') ? $user_profile_route : 'user', 'userProfile', 'STRING');
 osc_set_preference('user_profile_redirect', ($user_profile_redirect != '') ? $user_profile_redirect : 'main', 'userProfile', 'STRING');

  osc_add_flash_ok_message( _m('Settings updated') );
userProfileJsRedirect(USER_PROFILE_ADMIN_VIEW_URL . 'settings.php');

         break ;
        case('support'):
         osc_csrf_check();
                                        $yourName  = Params::getParam('yourName');
                                        $yourEmail = Params::getParam('yourEmail');
                                        $subject   = Params::getParam('subject');
                                        $message   = Params::getParam('message');



                                        if ( !osc_validate_email($yourEmail, true) ) {
                                            osc_add_flash_error_message( _m('Please enter a correct email') );
                                            Session::newInstance()->_setForm('yourName', $yourName);
                                            Session::newInstance()->_setForm('subject', $subject);
                                            Session::newInstance()->_setForm('message_body', $message);
                                            userProfileJsRedirect(USER_PROFILE_ADMIN_VIEW_URL . 'support.php');
                                        }

                                        $message_name    = sprintf(__('Name: %s'), $yourName);
                                        $message_email   = sprintf(__('Email: %s'), $yourEmail);
                                        $message_subject = sprintf(__('Subject: %s'), $subject);
                                        $message_body    = sprintf(__('Message: %s'), $message);
                                        $message_date    = sprintf(__('Date: %s at %s'), date('l F d, Y'), date('g:i a'));
                                        $message_IP      = sprintf(__('IP Address: %s'), get_ip());
                                        $message = <<<MESSAGE
{$message_name}
{$message_email}
{$message_subject}
{$message_body}

{$message_date}
{$message_IP}
MESSAGE;

                                        $params = array(
                                            'from'      => osc_contact_email(),
                                            'to'        =>  'oscmad.000@gmail.com',
                                            'to_name'   => osc_page_title(),
                                            'reply_to'  => $yourEmail,
                                            'subject'   => '[' . osc_page_title() . '] ' . __('Support'),
                                            'body'      => nl2br($message)
                                        );


                                        $error = false;

                                            $attachment   = Params::getFiles('attachment');
                                            if(isset($attachment['error']) && $attachment['error']==UPLOAD_ERR_OK) {
                                                $mime_array = array(
                                                    'text/php',
                                                    'text/x-php',
                                                    'application/php',
                                                    'application/x-php',
                                                    'application/x-httpd-php',
                                                    'application/x-httpd-php-source',

													'hqx'	=>	'application/mac-binhex40',
                    'cpt'	=>	'application/mac-compactpro',
                    'csv'	=>	array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel'),


                    'class'	=>	'application/octet-stream',
                    'psd'	=>	'application/x-photoshop',
                    'so'	=>	'application/octet-stream',
                    'sea'	=>	'application/octet-stream',
                    'dll'	=>	'application/octet-stream',
                    'oda'	=>	'application/oda',
                    'pdf'	=>	array('application/pdf', 'application/x-download'),

                    'smi'	=>	'application/smil',
                    'smil'	=>	'application/smil',
                    'mif'	=>	'application/vnd.mif',
                    'xls'	=>	array('application/excel', 'application/vnd.ms-excel', 'application/msexcel'),
                    'ppt'	=>	array('application/powerpoint', 'application/vnd.ms-powerpoint'),
                    'wbxml'	=>	'application/wbxml',
                    'wmlc'	=>	'application/wmlc',
                    'dcr'	=>	'application/x-director',
                    'dir'	=>	'application/x-director',
                    'dxr'	=>	'application/x-director',
                    'dvi'	=>	'application/x-dvi',
                    'gtar'	=>	'application/x-gtar',
                    'gz'	=>	'application/x-gzip',
                    'php'	=>	'application/x-httpd-php',
                    'php4'	=>	'application/x-httpd-php',
                    'php3'	=>	'application/x-httpd-php',
                    'phtml'	=>	'application/x-httpd-php',
                    'phps'	=>	'application/x-httpd-php-source',
                    'js'	=>	'application/x-javascript',
                    'swf'	=>	'application/x-shockwave-flash',
                    'sit'	=>	'application/x-stuffit',
                    'tar'	=>	'application/x-tar',
                    'rar'	=>	'application/x-rar',
                    'tgz'	=>	array('application/x-tar', 'application/x-gzip-compressed'),
                    'xhtml'	=>	'application/xhtml+xml',
                    'xht'	=>	'application/xhtml+xml',
                    'zip'	=>  array('application/x-zip', 'application/zip', 'application/x-zip-compressed'),
                    'mid'	=>	'audio/midi',
                    'midi'	=>	'audio/midi',
                    'mpga'	=>	'audio/mpeg',
                    'mp2'	=>	'audio/mpeg',
                    'mp3'	=>	array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3'),
                    'aif'	=>	'audio/x-aiff',
                    'aiff'	=>	'audio/x-aiff',
                    'aifc'	=>	'audio/x-aiff',
                    'ram'	=>	'audio/x-pn-realaudio',
                    'rm'	=>	'audio/x-pn-realaudio',
                    'rpm'	=>	'audio/x-pn-realaudio-plugin',
                    'ra'	=>	'audio/x-realaudio',
                    'rv'	=>	'video/vnd.rn-realvideo',
                    'wav'	=>	'audio/x-wav',
                    'bmp'	=>	'image/bmp',
                    'gif'	=>	'image/gif',
                    'jpeg'	=>	array('image/jpeg', 'image/pjpeg'),
                    'jpg'	=>	array('image/jpeg', 'image/pjpeg'),
                    'jpe'	=>	array('image/jpeg', 'image/pjpeg'),
                    'png'	=>	array('image/png',  'image/x-png'),
                    'tiff'	=>	'image/tiff',
                    'tif'	=>	'image/tiff',
                    'css'	=>	'text/css',
                    'html'	=>	'text/html',
                    'htm'	=>	'text/html',
                    'shtml'	=>	'text/html',
                    'txt'	=>	'text/plain',
                    'text'	=>	'text/plain',
                    'log'	=>	array('text/plain', 'text/x-log'),
                    'rtx'	=>	'text/richtext',
                    'rtf'	=>	'text/rtf',
                    'xml'	=>	'text/xml',
                    'xsl'	=>	'text/xml',
                    'mpeg'	=>	'video/mpeg',
                    'mpg'	=>	'video/mpeg',
                    'mpe'	=>	'video/mpeg',
                    'qt'	=>	'video/quicktime',
                    'mov'	=>	'video/quicktime',
                    'avi'	=>	'video/x-msvideo',
                    'movie'	=>	'video/x-sgi-movie',
                    'doc'	=>	'application/msword',
                    'docx'	=>	'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'xlsx'	=>	'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'word'	=>	array('application/msword', 'application/octet-stream'),
                    'xl'	=>	'application/excel',
                    'eml'	=>	'message/rfc822',
                    'json'  => array('application/json', 'text/json'),
                   
                                                );
                                                $resourceName = $attachment['name'];
                                                $tmpName      = $attachment['tmp_name'];
                                                $resourceType = $attachment['type'];

                                                if(function_exists('mime_content_type')){
                                                    $resourceType = mime_content_type($tmpName);
                                                }

                                                if(function_exists('finfo_open')){
                                                    $finfo = finfo_open(FILEINFO_MIME);
                                                    $output = finfo_file($finfo, $tmpName);
                                                    finfo_close($finfo);

                                                    $output = explode("; ",$output);
                                                    if ( is_array($output) ) {
                                                        $output = $output[0];
                                                    }
                                                    $resourceType = $output;
                                                }

                                                // check mime file
                                                if(!in_array($resourceType, $mime_array)) {
                                                    $emailAttachment = array('path' => $tmpName, 'name' => $resourceName);
                                                    $error = false;
                                                } else {
                                                    $error = true;
                                                }
                                                // --- check mime file
                                            } else {
                                                $error = true;
                                            }

                                        if(!$error) {
                                            if( isset($emailAttachment) ) {
                                                $params['attachment'] = $emailAttachment;
                                            }



                                            osc_sendMail(osc_apply_filter('contact_params', $params));

                                            if( isset($tmpName) ) {
                                                @unlink($tmpName);
                                            }

                                            osc_add_flash_ok_message( _m('Your email has been sent properly. Thank you for contacting us!') );
                                        } else {
                                            osc_add_flash_error_message( _m('The file you tried to upload does not have a valid extension') );
                                        }

                                        userProfileJsRedirect(USER_PROFILE_ADMIN_VIEW_URL . 'support.php');
    default:
        break;
}
