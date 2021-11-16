<?php



$rest = substr("abcdef", -2);    // returns "ef"
$rest = substr("abcdef", -3, 1); // returns "d"


define('DS', DIRECTORY_SEPARATOR);

define('ROOT', dirname(__FILE__));


//load configuration and helper functions

require_once(ROOT . DS . 'config' . DS . 'config.php');
//die(ROOT . DS . 'config' . DS . 'config.php');
require_once(ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers' . DS . 'functions.php');

session_start();
//Autoload classes




function autoload($className)
{
    //$lang = $_SESSION['LANG'] = DEFAULT_LANG;
    if (isset($_SESSION['LANG'])) {
        $lang = $_SESSION['LANG'];
    } else {
        //se nao inserio vai buscar atravez do pais
        $lang = $_SESSION['LANG'] = DEFAULT_LANG;
    }
    if (file_exists(ROOT . DS . 'core'  . DS . $className . '.php')) {
        require_once(ROOT . DS . 'core' . DS . $className . '.php');
    }elseif (file_exists(ROOT . DS . 'core'  . DS .'interfaces'. DS . $className . '.php')) {
        require_once(ROOT . DS . 'core' . DS . 'interfaces'. DS . $className . '.php');
    } elseif (file_exists(ROOT . DS . 'app' . DS . 'controllers' . DS . $lang . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'controllers' . DS . $lang . DS . $className . '.php');
    } elseif (file_exists(ROOT . DS . 'app' . DS . 'models'  . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'models' . DS . $className . '.php');
    } elseif (file_exists(ROOT . DS . 'app' . DS . 'views'  . DS . $lang . DS . $className . '.php')) {
        require_once(ROOT . DS . 'app' . DS . 'views' . DS . $lang . DS . $className . '.php');
    }
}


spl_autoload_register('autoload');//cahama o autoload


$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];



if(!Session::exists(CURRENT_USER_SESSION_NAME) && Cookie::exists(REMEMBER_ME_COOKIE_NAME)){
    //Users::loginUserFromCookie();
}
//dnd(NumeroEmExtenso("2021"));
// Route the request

Router::route($url);



//css/bootstrap.min.css