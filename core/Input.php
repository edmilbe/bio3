<?php

class Input{


    public static function sanitize($dirty){
        return htmlentities($dirty, ENT_QUOTES, "UTF-8");
    }

    public static function get($input){
        if(isset($_POST[$input])){
            return self::sanitize($_POST[$input]);
        }elseif(isset($_GET[$input])){
            return self::sanitize($_GET[$input]);
        }
        return false;
    }

    public static function exists($type = 'post'){
        switch($type){
            case 'post':
                return (!empty($_POST)) ? true : false;
                break;
            case 'get':
                return (!empty($_GET)) ? true : false;

                break;
            default:
                return false;
                break;

        }
    }
}