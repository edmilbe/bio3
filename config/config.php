<?php
define('DEBUG', true);//when is online false

define('DB_NAME', 'bio');//database name
define('DB_USER', 'root');//database user
define('DB_PASSWORD', '');//database password
define('DB_HOST', '127.0.0.1');//database host ***use IP address to avoid DNS lookup //avoid --> evitar*/
/*
define('DB_NAME', 'u725011803_bio');//database name
define('DB_USER', 'u725011803_bio');//database user
define('DB_PASSWORD', 'Mbio-stp21@');//database password
define('DB_HOST', 'mysql.hostinger.co.uk');//database host ***use IP address to avoid DNS lookup //avoid
*/

define('LANG', 'LANG');
define('PROOT',''); //set this to '/' for live server, like project root
define('TPROOT',PROOT . 'template/'); //set this to '/' for live server, like project root
define('URL_BASE', 'localhost/bio3/');

define('DEFAULT_CONTROLLER', 'Home');//default controller if there isn't on defined in the ulr
define('DEFAULT_LAYOUT','default'); //if no layout is set in the controller use this layout
define('DEFAULT_LANG','en'); //if no layout is set in the controller use this layout
define('MOEDA', ' &pound;');
define('SITE_TITLE','STP BIO'); //This will be sed if no site tile is set
define('MENU_BRAND','Movimento Biológico'); //This is the brand text in menu


define('LOGO',PROOT .'files/fix/biologo.png'); //This is the brand text in menu


define('CURRENT_USER_SESSION_NAME','kwhjrngjgfdjdHFGDJGFtFJGUTR');//session name for logged in user
define('REMEMBER_ME_COOKIE_NAME','JAkHGFJHhjgfhJGgfghgfjfj');//cookie name for logged in user remember me
define('REMEMBER_ME_COOKIE_EXPIRY',2592000);// time in the second form remember me cokkie to live (30 days);
define('ACCESS_RESTRICTED', 'Restricted'); //controller name for the restricted redirect




$GLOBALS['config'] = array(

    'session'   => array(
        'session_name' => 'user',

        'token_name' => 'token'
    ),
);

function redirectOut($location){

    header('Location: ' .$location);
    die();

}
