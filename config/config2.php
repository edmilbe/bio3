

<?php
define('DEBUG', true);//when is online false

define('DB_NAME', 'u456429141_ajudacerta');//database name
define('DB_USER', 'u456429141_ajudacerta');//database user
define('DB_PASSWORD', '14espirito14');//database password
define('DB_HOST', 'hostinger.co.uk');//database host ***use IP address to avoid DNS lookup //avoid --> evitar



define('DEFAULT_CONTROLLER', 'Home');//default controller if there isn't on defined in the ulr
define('DEFAULT_LAYOUT','default'); //if no layout is set in the controller use this layout
define('DEFAULT_LANG','en'); //if no layout is set in the controller use this layout
define('MOEDA', ' dbs');

define('LANG', 'LANG');
define('PROOT','malanza.co.uk/ajudacerta/'); //set this to '/' for live server, like project root
define('URL_BASE', 'malanza.co.uk/ajudacerta/');

define('SITE_TITLE','Ajuda Certa'); //This will be sed if no site tile is set
define('MENU_BRAND','Ajuda Certa'); //This is the brand text in menu


define('CURRENT_USER_SESSION_NAME','kwXejydffdfjJFDUTR');//session name for logged in user
define('REMEMBER_ME_COOKIE_NAME','JAGhfdsdffdutrDIjgfj');//cookie name for logged in user remember me
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