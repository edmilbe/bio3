<?php

class Token{

    public static function generate(){
        return Session::set(Config::get('session/token_name'), md5(uniqid()));
    }

    public static function check($token){
        $tokenName = Config::get('session/token_name');

        if(Session::exists($tokenName) && $token === Session::get($tokenName) ){
            Session::delete($tokenName);
            return true;
        }//enfoire21
        return false;
    }


    public static function make($password, $hash = ''){
        return hash('sha256',$password.$hash);
    }

    public static function hash($lenght = 32){
        if(!isset($length) || intval($length) <= 8 ){
            $length = 32;
        }

        if (function_exists('random_bytes')) {
            //return bin2hex(random_bytes($lenght));
            return random_bytes($lenght);

        }
        return bin2hex(random_bytes($lenght));

    }

}