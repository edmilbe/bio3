<?php

class Register extends Controller implements InterfaceRegister
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
        $this->load_model('Users');
        $this->view->setLayout('default');
    }

    public function indexAction()
    {
        //dnd($_SESSION);
        $validation = new Validate();
        $posted_values = [
            'name' => ''
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                //dnd(Input::get('token'));
                if ($_POST) {
                    //form validation
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'name' => [
                            'display' => 'Login',
                            'require' => true
                        ],
                        'password' => [
                            'display' => 'Password',
                            'require' => true
                        ]

                    ]);
                    if ($validation->passed()) {
                        $user = new Users();
                        $username = sanitize(Input::get('name'));
                        $password = sanitize(Input::get('password'));
                        $error = $user->trylogin($username, $password);

                        if ($error == false) {
                            if (currentUser()) {
                                Router::redirect('home/index');

                            } else {
                                $validation->addError($error);
                            }
                        } else {
                            $validation->addError($error);
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



    public function loginAction()
    {
        //dnd($_SESSION);

        $this->view->slash = Session::get('slash');
        $validation = new Validate();
        $posted_values = [
            'name' => ''
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                //dnd(Input::get('token'));
                if ($_POST) {
                    //form validation
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'name' => [
                            'display' => 'Email',
                            'require' => true
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
                        $error = $user->trylogin($username, $password);

                        if ($error == false) {
                            if (currentUser()) {
                                Router::redirect('home/index');

                            } else {
                                $validation->addError($error);
                            }
                        } else {
                            $validation->addError($error);
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
        Router::redirect('home/index');
    }

    public function registerAction()
    {
        $validation = new Validate();

        $posted_values = [
            'fname' => '',
            'email' => '',
            'password' => '',
            'c-password' => ''
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'fname' => [
                            'display' => 'Nome completo',
                            'require' => true
                        ],
                        'email' => [
                            'display' => 'Email',
                            'require' => true
                        ],
                        'password' => [
                            'display' => 'Senha',
                            'require' => true,
                            'min' => 6
                        ],
                        'password-c' => [
                            'display' => 'Confirmação da senha',
                            'require' => true,
                            'matches' => 'password'
                        ]

                    ]);

                    if ($validation->passed()) {
                        $newUser = new Users();

                        $newUser->registerNewUser($_POST);
                        Router::redirect('home/index');
                    }
                }
            }
        }

        $Country = new Countries();

        $this->view->countries = $Country->find([]);



        $this->view->post = $posted_values;
        $this->view->displayErrors = $validation->displayErrors();


        $this->view->render('register/register');

    }


    public function insertorganizationAction(){
        $validation = new Validate();

        $posted_values = [
            'fname' => '',
            'country' => '',
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'fname' => [
                            'display' => 'Nome da organização',
                            'require' => true,
                            'unique' => ['organization', 'org_name']
                        ],
                        'country' => [
                            'display' => 'País de criação',
                            'require' => true,
                            'is-numeric' >= true,
                            'selected' => ['countries', 'country_id'],

                        ]
                    ]);

                    if ($validation->passed()) {
                        $Organization = new Organization();

                        $Organization->saveOrg($_POST);
                        //Router::redirect('');

                        $this->view->displayErrors = $validation->displayOkay('A sua organização foi inserida com sucesso, entraremos em contacto via email para fazer ultimos acertos, obrigado!');

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();

                    }
                }
            }
        }

        $Country = new Countries();

        $this->view->countries = $Country->find([]);



        $this->view->post = $posted_values;


        $this->view->render('register/organization');

    }

    public function beamemberAction(){
        $validation = new Validate();

        $this->view->slash = Session::get('slash');

        $posted_values = [
            'org' => '',
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                   // dnd($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'org' => [
                            'display' => 'País de criação',
                            'require' => true,
                            'is-numeric' >= true,
                            'selected' => ['organization', 'org_id'],

                        ]
                    ]);

                    if ($validation->passed()) {
                        $Members = new Members();

                        $response = $Members->saveMember($_POST);

                        //dnd($response);


                        if($response == 1){
                            $this->view->displayErrors = $validation->displayOkay('O seu pedido foi enviado para o administrador da organização solicitada!');
                        }elseif($response == 0){
                            $validation->addError('Não foi possível envaiar a solicitação, tente mais tarde!');
                            $this->view->displayErrors = $validation->displayErrors();
                        }else{
                            $validation->addError('Já estas registado nessa organização!');
                            $this->view->displayErrors = $validation->displayErrors();
                        }


                    }else{
                        $this->view->displayErrors = $validation->displayErrors();

                    }
                }
            }
        }

        $Organization = new Organization();

        $this->view->orgs = $Organization->getOrgs(1);

        //dnd($this->view->orgs);



        $this->view->post = $posted_values;


        $this->view->render('register/beamember');

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
                            'display' => 'Email Address',
                            'require' => true,
                            'valid_email' => true
                        ]
                    ]);

                    if ($validation->passed()) {
                        $email = new EmailsUser();
                        if ($email->emailExistis(Input::get('email'))) {
                            if ($this->NewRecover(Input::get('email')) == true) {
                                $this->view->displayOkay = $msg1 = "Message successfully sent!";
                            } else {
                                $validation->addError("Sorry, error sending the message, try later!");
                            }
                        } else {
                            $validation->addError("Email not found!");
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


            $message = "<h2>Malanza</h2> <h4>Recover Account</h4>";


            $message .= "<p>Hello, click <a href='https://2x-shopping.com/register/setpasspass/$link'>herei</a> to recever your account!</p>";


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
                            'display' => 'Password',
                            'require' => true,
                            'min' => 6
                        ],
                        'password2' => [
                            'display' => 'Password Confirmation',
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
                            $this->view->displayOkay = 'Password sucessfully changed!';
                        } else {
                            $validation->addError("The link expired!");
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




