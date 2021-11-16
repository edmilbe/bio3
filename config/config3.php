

<?php
define('DEBUG', true);//when is online false

define('DB_NAME', 'bio');//database name  Camaramz2021@  u806777872_cmz_01
define('DB_USER', 'root');//database user
define('DB_PASSWORD', '');//database password
define('DB_HOST', '127.0.0.1');//database host ***use IP address to avoid DNS lookup //avoid --> evitar

// Mbio-stp21@

define('DEFAULT_CONTROLLER', 'Home');//default controller if there isn't on defined in the ulr
define('DEFAULT_LAYOUT','default'); //if no layout is set in the controller use this layout
define('DEFAULT_LANG','en'); //if no layout is set in the controller use this layout
define('MOEDA', ' dbs');

define('LANG', 'LANG');
define('PROOT','/bio/'); //set this to '/' for live server, like project root
define('URL_BASE', 'localhost/bio/');
//Movimento Biológico de São Tomé e Príncipe
define('SITE_TITLE','STP BIO'); //This will be sed if no site tile is set
define('MENU_BRAND','<div class="brand__title">
<h2 class="brand__title__h brand__title__h--h1 ">
     Movimento Biológico
</h2>
<h1 class="brand__title__h brand__title__h--h2">
    São Tomé e Príncipe
</h1>
</div>'); //This is the brand text in menu


define('LOGO',PROOT .'files/fix/biologo.png'); //This is the brand text in menu


define('CURRENT_USER_SESSION_NAME','kwhjrjytfyuTFDYTRCytFJGUTR');//session name for logged in user
define('REMEMBER_ME_COOKIE_NAME','JAkgkyuJHGFGjhgfghgfjfj');//cookie name for logged in user remember me
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