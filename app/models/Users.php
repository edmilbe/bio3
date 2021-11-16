<?php

class Users extends Model
{
    private $_isLoggedIn, $_sessionName, $_cookieName;

    public static $currentLoggedInUser = null;

    public function __construct($user = '')
    {
        $table = 'users';
        parent::__construct($table);

        $this->_sessionName = CURRENT_USER_SESSION_NAME;
        $this->_cookieName = REMEMBER_ME_COOKIE_NAME;
        $this->_softDelete = true;
        if ($user != '') {
            if (is_int($user)) {
                $u = $this->_db->findFirst('users',
                    [
                        'conditions' => 'user_id = ?',
                        'bind' => [$user]]);
            } else {
                $u = $this->findByEmail($user);

            }

            if ($u) {
                foreach ($u as $key => $value) {
                    $this->$key = $value;
                }
            }
        }
    }


    public function updateAcl($user)
    {
        $AclUsers = new AclUsers();

        $acls = $AclUsers->getAcl($user);

        //dnd($acls);

        $if = '"';
        $vigula = '","';
        $cont = count($acls);
        $flag = 0;
        $text = "";

        foreach ($acls as $acl):
            $text .= $acl->acl_acl;
            if (++$flag < $cont):
                $text .= $vigula;
            endif;
        endforeach;

        $text = "[" . $if . $text . $if . "]";
        $form['user_acl'] = $text;

        $text = $text == "" ? null : $text;


        $this->update($user, $form, 'user_id');
        //dnd($text);
    }

    public function getAcl()
    {

    }


    public function findByEmail($username)
    {

        $user = $this->_db->query('
                                select
                                user_id, passe_u_name as password, user_key, user_active from users
                                inner join emails_user  on email_u_user = user_id
                                inner join passes_user  on passe_u_user = user_id and
                                 (email_u_name = ? and user_id = email_u_user and email_u_active = 1)
                                order by user_id asc', [$username])->results();

        if ($user == false) {
            $user = $this->_db->query('
                                select
                                user_id, passe_u_name as password, user_key, user_active from users
                                inner join tels_user    on tel_u_user = user_id
                                inner join passes_user  on passe_u_user = user_id and
                                (tel_u_name = ? and user_id = tel_u_user and tel_u_active = 1)
                                order by user_id asc', [$username])->results();
        }
        if (!empty($user)) {
            $user = $user[0];
        }
        return $user;
    }

    public function findById($id, $value = '')
    {
        $id = sanitize($id);

        $user = $this->_db->query('
                              select
                                 email_u_name, tel_u_name,file_name, user_fname,user_lname,
                                 user_country, user_pcode, user_address, user_id, user_long,user_active,user_created from users
                                inner join emails_user on email_u_user = user_id
                                inner join tels_user on tel_u_user = user_id
                                 inner join passes_user on passe_u_user = user_id
                                  inner join files on file_id = user_foto
                                 and
                                user_id = ?  order by user_id asc', [$id])->results();


        if (!$user) {
            $user = $this->_db->query('
                              select
                                  tel_u_name,file_name, user_lname,user_fname, user_country, user_pcode, user_address, user_id, user_long,user_active,user_created from users
                                inner join tels_user on tel_u_user = user_id
                                 inner join passes_user on passe_u_user = user_id
                                  inner join files on file_id = user_foto
                                 and
                                user_id = ?  order by user_id asc', [$id])->results();

            if ($user) {
                $user = $this->_db->query('
                              select
                                file_name, tel_u_name,country_name,country_id,user_country, user_fname,user_lname, user_pcode,  user_address,user_long,user_active, user_id, user_created from users
                                inner join tels_user on tel_u_user = user_id
                                 inner join passes_user on passe_u_user = user_id
                                 inner join files on file_id = user_foto
                                 inner join countries on user_country = country_id
                                  and
                                user_id = ?  order by user_id asc', [$id])->results()[0];
            }
            return $user;

        }

        if ($user) {
            $user = $this->_db->query('
                              select
                                 email_u_name,file_name, tel_u_name,country_name,country_id,user_country, user_fname,user_lname, user_pcode,  user_address,user_long,user_active, user_id, user_created from users
                                inner join emails_user on email_u_user = user_id
                                inner join tels_user on tel_u_user = user_id
                                 inner join passes_user on passe_u_user = user_id
                                 inner join files on file_id = user_foto
                                 inner join countries on user_country = country_id
                                  and
                                user_id = ?  order by user_id asc', [$id])->results()[0];
        }
        return $user;
    }


    public static function currentLoggedInUser()
    {
        if (!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME)) {
            $u = new Users((int)Session::get(CURRENT_USER_SESSION_NAME));
            self::$currentLoggedInUser = $u;
        }
        return self::$currentLoggedInUser;
    }

    public function login($rememberMe = false)
    {

        Session::set($this->_sessionName, $this->user_id);
        if ($rememberMe) {
            $hash = md5(uniqid() + rand(0, 100));
            $user_agent = Session::uagent_no_version();
            Cookie::set($this->_cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
            $fields = ['session_session' => $hash, 'session_agent' => $user_agent, 'session_users' => $this->user_id];
            $this->_db->query("DELETE FROM users_session WHERE session_users = ? AND session_agent = ?", [$this->user_id, $user_agent]);
            $this->_db->insert('users_session', $fields);
        }

    }

    public function trylogin($username, $password)
    {

        $last_msg = false;
        $user = $this->findByEmail($username);


        if ($user) {
            if ($user->user_active == 1) {
                //dnd(Token::make($password,$user->user_key));
                //dnd($user->password);


                if (Token::make($password, $user->user_key) === $user->password && $user) {
                    $remember = false;
                    $self = new Users($user->user_id);
                    $self->login($remember);
                } else {
                    $last_msg = "Email ou senha incorrecta!";
                }
            } else {
                $last_msg = "Sua conta está suspensa!";
            }

        } else {
            $last_msg = "Email or password incorrect!";
        }


        return $last_msg;

    }

    public static function loginUserFromCookie()
    {

        $userSession = UsersSession::getFromCookie();

        if ($userSession->user_id != '') {
            $user = new self((int)$userSession->user_id);
        }

        if ($user) {
            $user->login();
        }

        return $user;
    }

    public function logout()
    {

        $userSession = UsersSession::getFromCookie();


        Session::delete(CURRENT_USER_SESSION_NAME);
        if (Cookie::exists(REMEMBER_ME_COOKIE_NAME)) {
            Cookie::delete(REMEMBER_ME_COOKIE_NAME);
        }
        self::$currentLoggedInUser = null;
        return true;
    }

    public function updateUserPicture($id)
    {
        //$this->assign($params);

        $form['user_pic'] = $id;


        //dnd()
        $this->update(currentUser()->user_id, $form, 'user_id');
    }

    public function updateUserDetails($params, $user)
    {
        //$this->assign($params);
        $user = sanitize($user);
        postsanitize($params);
        $form = array();
        $form['user_fname'] = $params['fname'];

        $this->update($user, $form, 'user_id');
        $email = new EmailsUser();


        $email->updateEmail(sanitize($params['email']), $user);

    }

    public function registerPaymentNewUser($params)
    {
        //$this->assign($params);
        //postsanitize($params);


        $form = array();
        $form['user_fname'] = sanitize($params['fname']);
        $form['user_lname'] = sanitize($params['lname']);
        $form['user_country'] = sanitize($params['country']);
        $form['user_key'] = $hash = utf8_encode(Token::hash(32));
        $form['user_long'] = time();
        $form['user_pcode'] = $params['p-code'];
        $form['user_address'] = $params['address'];

        $this->save($form);
        $id = $this->_db->lastID();

        if (is_numeric($id)) {
            /*$email = new EmailsUser();
            if($email->saveEmail(sanitize($params['email']), $id) > 0){

            }
            */
            $tel = new TelsUser();
            $email = new EmailsUser();
            if ($tel->saveTel(sanitize($params['tel']), $id) > 0) {
                if ($email->saveEmail(sanitize($params['email']), $id) > 0) {
                    $passe = new PassesUser();
                    if ($passe->savePasse(sanitize($params['password']), $id, $hash) > 0) {
                        return $this->trylogin(sanitize($params['tel']), sanitize($params['password']));
                    }
                }
            }
        }
        return false;
    }


    public function registerNewUser($params)
    {
        //$this->assign($params);
        //postsanitize($params);


        $form = array();
        $form['user_fname'] = sanitize($params['fname']);


        $form['user_key'] = $hash = utf8_encode(Token::hash(32));
        $form['user_long'] = time();


        $this->save($form);
        $id = $this->_db->lastID();

        if (is_numeric($id)) {
            /*$email = new EmailsUser();
            if($email->saveEmail(sanitize($params['email']), $id) > 0){

            }
            */
            $email = new EmailsUser();

            if ($email->saveEmail(sanitize($params['email']), $id) > 0) {
                $passe = new PassesUser();
                if ($passe->savePasse(sanitize($params['password']), $id, $hash) > 0) {

                    return $this->trylogin(sanitize($params['email']), sanitize($params['password']));
                }
            }
        }
        return false;
    }

    public function registerPaymentAddress($params, $session)
    {
        //$this->assign($params);
        //postsanitize($params);

        $sk = new ShoppedKey();
        $lastS = $sk->getBySession($session);

        if ($lastS->shopped_k_shopper == currentUser()->user_id) {
            $form = array();
            $form['user_pcode'] = sanitize($params['p-code']);
            $form['user_address'] = sanitize($params['address']);

            $user = new Users(currentUser()->user_id);

            $user->update(currentUser()->user_id, $form, 'user_id');

            return 1;
        } else {
            return "You don't have permission to update the address";
        }
    }

    public function acls()
    {

        if (empty($this->user_acl)) return [];

        return json_decode($this->user_acl, true);
    }

    public function getAllUser($active = 0)
    {
        $active = sanitize($active);
        if ($active == 1) {
            return $this->_db->query('
                              select user_name,user_active, user_id,user_created,file_name,
                                 email_u_name, tel_u_name, user_name,user_city, user_pcode, user_address from users
                                inner join emails_user on email_u_user = user_id
                                inner join tels_user on tel_u_user = user_id
                                inner join files on file_id = user_foto and user_active = 1

                                   order by user_name asc', [$active])->results();
        } else {
            return $this->_db->query('
                              select user_name,user_active, user_id,user_created,file_name,user_long,
                                 email_u_name, tel_u_name, user_name,user_city, user_pcode, user_address from users
                                inner join emails_user on email_u_user = user_id
                                inner join tels_user on tel_u_user = user_id
                                inner join files on file_id = user_foto

                                   order by user_name asc', [])->results();
        }

    }

    public function userSetOn($user, $opc)
    {
        $form['user_active'] = $opc = sanitize($opc);
        $user = sanitize($user);
        if ($opc == 0 || $opc == 1) {
            $this->update($form, 'user_id = ' . $user);
        }

    }

}