<?php

class UsersSession extends Model{
    public function __construct(){
        $table = 'users_session';

        parent::__construct($table);
    }

    public static function getFromCookie(){
        $userSession = new self();

        if(Cookie::exists(REMEMBER_ME_COOKIE_NAME)){
            $userSession = $userSession->findFirst(
                [
                    'conditions' => 'session_agent = ? AND session_session = ?',
                    'bind'  => [Session::uagent_no_version(), Cookie::get(REMEMBER_ME_COOKIE_NAME)]
                ]
            );
        }
        if(!$userSession) return false;

        return $userSession;
    }

}