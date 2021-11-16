<?php

class Session{
    public static function exists($name){

        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function get($name){

        return isset($_SESSION[$name]) ? $_SESSION[$name] : '';
    }

    public static function set($name, $value){
        return $_SESSION[$name] = $value;
    }

    public static function delete($name){
        if(self::exists($name)){

            unset($_SESSION[$name]);


        }
    }

    public static function uagent_no_version(){
        $uagent = $_SERVER['HTTP_USER_AGENT'];
        $regx ='/\/|a-zA-Z0-9.]+/';
        $newString = preg_replace($regx,'',$uagent);
        return $newString;
    }
    public static function  ReturnSession(){
        if(self::exists('shopping')){
            return self::get('shopping');
        }else{
            self::set('shopping', KeyGenerator());
        }
        return self::get('shopping');
    }
}