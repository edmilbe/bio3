<?php

class Register extends Controller implements InterfaceRegister
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function index()
    {

    }

    public function loginAction()
    {
        $validation = new Validate();
        $posted_values = [
            'name' => ''
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {

                if ($_POST) {
                    //form validation
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'name' => [
                            'display' => 'Correio electronico',
                            'require' => true,
                            'valid_email' => true
                        ],
                        'password' => [
                            'display' => 'Senha',
                            'require' => true
                        ]

                    ]);
                    if ($validation->passed()) {
                        $user = new Users();
                        $username = sanitize(Input::get('name'));
                        $password = sanitize(Input::get('password'));
                        $msg = $user->trylogin($username, $password);
                        if ($msg == null) {
                            if (currentUser()) {
                                Router::redirect('home/index');

                            } else {
                                $validation->addError('Correio electronico ou senha esta incorrecto!');
                            }
                        } else {
                            $validation->addError($msg);

                        }
                    }

                }
            }
        }
        $this->view->post = $posted_values;
        //var_dump($posted_values);
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('register/login');
    }

    public function logoutAction()
    {
        if (currentUser()) {
            currentUser()->logout();
        }
        Router::redirect('register/login');
    }

    public function registerAction()
    {
        $validation = new Validate();

        $posted_values = [
            'name' => '', 'tel' => '', 'email' => '', 'city' => '', 'address' => '',
            'pcode' => '', 'password' => '', 'password2' => ''
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'name' => [
                            'display' => 'Nome Complecto',
                            'require' => true
                        ],
                        'tel' => [
                            'display' => 'Tel',
                            'require' => true
                        ],

                        'email' => [
                            'display' => 'Correio Electronico',
                            'require' => true,
                            'unique' => ['emails_user', 'email_u_user'],
                            'valid_email' => true
                        ],
                        'city' => [
                            'display' => 'City',
                            'require' => true,
                            'selected' => ['cities', 'city_id'],
                        ],
                        'address' => [
                            'display' => 'Endereço',
                            'require' => true
                        ],
                        'pcode' => [
                            'display' => 'Caixa Postal',
                            'require' => true
                        ],

                        'password' => [
                            'display' => 'Senha',
                            'require' => true,
                            'min' => 6
                        ],
                        'password2' => [
                            'display' => 'Confimacao da Senha',
                            'require' => true,
                            'matches' => 'password'
                        ]
                    ]);

                    if ($validation->passed()) {
                        $newUser = new Users();

                        $newUser->registerNewUser($_POST);
                        Router::redirect('');
                    }
                }
            }
        }
        $ctr = new Countries();
        $cti = new Cities();


        $paises = $ctr->find([]);
        $novo = [];
        $p = [];
        foreach ($paises as $ctrs) {

            $c = [];
            //$p['cities'][] = [];
            $p[$ctrs->country_name] = $cities = $cti->find([
                'conditions' => 'city_country = ?',
                'bind' => [$ctrs->country_id]]);
        }
        //var_dump($p);

        /*foreach($p as $key => $value){
            var_dump($key);
            foreach($value as $cities){
                var_dump($cities->city_name);
            }
        }*/
        $this->view->p = $p;
        //dnd(5);
        $this->view->post = $posted_values;
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('register/register');

    }


    public function recoveremailAction()
    {
        $validation = new Validate();

        $posted_values = [
            'email' => ''
        ];
        $this->view->displayOkay = '';
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);


                    $validation->check($_POST, [
                        'email' => [
                            'display' => 'Correio Electronico',
                            'require' => true,
                            'valid_email' => true
                        ]
                    ]);

                    if ($validation->passed()) {
                        $email = new EmailsUser();
                        if ($email->emailExistis(Input::get('email'))) {
                            if ($this->NewRecover(Input::get('email')) == true) {
                                $this->view->displayOkay = $msg1 = "Enviada a mensagem para seu email!";
                            } else {
                                $validation->addError("Desculpa, erro ao enviar a mensagem, tente mais tarde!");
                            }
                        } else {
                            $validation->addError("Email nao encontrado!");
                        }
                    }
                }
            }
        }

        $this->view->post = $posted_values;
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('register/recoveremail');

    }

    private function NewRecover($email)
    {
        $form = array();
        $flag = false;
        $user = new Users();
        $user = $user->findByEmail($email);
        $reset = new PassesReset();

        $form = array();

        $form['passe_r_on'] = 3;
        $user = $user->email_u_user;
        $reset->update($form, "passe_r_user = $user");

        $link = KeyGenerator();
        $id = $reset->saveReset($link, $user);

        if ($id > 0) {

            $to = $email;
            //var_dump($email);
            $subject = "2X-Shopping";


            $message = "<h2>Malanza</h2> <h4>Repor a senha</h4>";


            $message .= "<p>Ola, click <a href='https://2x-shopping.com/register/setpasspass/$link'>aqui</a> para repor a sua senha!</p>";


            $m = new Msg();

            $retval = $m->envia($to, "2X-Shopping - Recuperar a conta", $message, "");


            $flag = $retval;
        }
        return $flag;
    }

    public function recoverpassAction($link = '')
    {

        $reset = new PassesReset();
        $rs = $reset->findFirst(['conditions' => ['passe_r_key = ?', 'passe_r_on = ?'], [$link, 1]]);

        if ($rs != false) {
            $form = array();
            $form['passe_r_on'] = 2;
            $user = $rs['passe_r_user'];
            $reset->update($form, "passe_r_key = '" . $link . "' and passe_r_user = '" . $user);

            Router::redirect('register/recoverpass/' . $link);
        }

        $validation = new Validate();
        $this->view->displayOkay = '';
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {

                    $validation->check($_POST, [

                        'password' => [
                            'display' => 'Senha',
                            'require' => true,
                            'min' => 6
                        ],
                        'password2' => [
                            'display' => 'Confirmação da senha',
                            'require' => true,
                            'matches' => 'password'
                        ]
                    ]);
                    if ($validation->passed()) {


                        $reset = new PassesReset();
                        $rs = $reset->findFirst(['conditions' => ['passe_r_key = ?', 'passe_r_on = ?'], [$link, 2]]);

                        if ($rs != false) {
                            $form = array();
                            $form['passe_r_on'] = 3;
                            $user = $rs['passe_r_user'];
                            $reset->update($form, "passe_r_key = '" . $link . "' and passe_r_user = '" . $user);

                            $new = new PassesUser();
                            $new->updatePasse(sanitize(Input::get('password')), $user);
                            $this->view->displayOkay = 'Senha alterada com sucesso!';
                        } else {
                            $validation->addError("O link expirou!");
                        }
                    }
                }
            }
        }
        $this->view->key = $link;
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('register/recoverpass');
    }
}




