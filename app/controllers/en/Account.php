
<?php

class Account extends  Controller implements InterfaceAccount{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);

    }
    public function indexAction(){
        Router::redirect('');
    }





    public function orgsAction(){
        $Members = new Members();


        $this->view->orgs = $Members->getOrgsOf(currentUser()->user_id,1);
        $this->view->user = currentUser()->user_id;

        $this->view->render('account/orgs');

    }

    public function detailsAction(){
        $validation = new Validate();

        $posted_values = [
            'fname' => '',
            'email' => ''
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'fname' => [
                            'display' => 'Nome',
                            'require' => true
                        ],
                        'email' => [
                            'display' => 'Email',
                            'require' => true,
                            'unique_update' => ['emails_user','email_u_name','email_u_user', currentUser()->user_id],
                        ]
                    ]);

                    if ($validation->passed()) {
                        $newUser = new Users();

                        //$newUser->registerNewUser($_POST);
                        $newUser->updateUserDetails($_POST, currentUser()->user_id);

                    }
                }
            }
        }

        $mes = new Meses();
        $this->view->months = $mes->find([]);

        $year = new Anos();
        $this->view->years = $year->find([
            'conditions' => 'ano_name >= ?', 'bind' => [ date('Y')]
        ]);


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




        $this->view->user = $user = new Users(currentUser()->user_id);

        $email = new EmailsUser();

        $this->view->email = $email->getEmailUser(currentUser()->user_id);

        $email = new TelsUser();

        $this->view->tel = $email->getTelUser(currentUser()->user_id);

        if($validation->passed()){
            $this->view->displayErrors = $validation->displayOkay('Details successfully updated!');

        }else{
            $this->view->displayErrors = $validation->displayErrors();

        }

        $this->view->render('account/details');
    }


    public function passwordAction(){
        $validation = new Validate();
        $this->view->displayOkay = '';
        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [

                        'password' => [
                            'display' => 'Nova Senha',
                            'require' => true,
                            'min' => 6
                        ],
                        'c-password' => [
                            'display' => 'Confirmação da nova senha',
                            'require' => true,
                            'matches' => 'password'
                        ],
                        'current' => [
                            'display' => 'Senha atual',
                            'require' => true,
                            'min' => 6,
                            'check-pass-user' => true,
                        ]
                    ]);
                    if ($validation->passed()) {
                        $new = new PassesUser();
                        $new->updatePasse(sanitize(Input::get('password')),currentUser()->user_id);

                    }
                }
            }
        }


        if($validation->passed()){
            $this->view->displayErrors = $validation->displayOkay('Details successfully updated!');

        }else{
            $this->view->displayErrors = $validation->displayErrors();

        }

        $this->view->render('account/password');
    }

    public function orderedAction(){
        $sek = new ShoppedKey();
        $this->view->prds = $sek->getOrderedByUser(currentUser()->user_id);
        //dnd($this->view->prds);
        //var_dump( $this->view->prds);
        $this->view->render('account/ordered');
    }
    public function statusorderedAction($id_key){


        $sek = new ShoppedKey();
        $this->view->address = $sek->getOrderedAdress($id_key);
        $this->view->token = Token::generate();

        //dnd($this->view->address);
        $sek = new ShoppedPrds();
        $id_key = sanitize($id_key);
        $this->view->items = $sek->boxed($id_key,currentUser()->user_id);//admin = false

        //dnd( $this->view->items);
        $this->view->key = $id_key;//admin = false
        $this->view->notfound = '';
        if($this->view->items == false){
            $this->view->notfound = 'Unknown Shopping!';
        }


        $validation = new Validate();

        $posted_values = [
            'country' => '','p-code' => '', 'address' => ''
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'country' => [
                            'display' => 'Country',
                            'require' => true
                        ],
                        'p-code' => [
                            'display' => 'Post code',
                            'require' => true
                        ],
                        'address' => [
                            'display' => 'Address',
                            'require' => true
                        ]
                    ]);

                    if ($validation->passed() && $this->view->address->shopped_k_shopper == currentUser()->user_id) {
                        $shk= new ShoppedKey();
                        $shk->updateAddress($_POST, $id_key);
                        $sek = new ShoppedKey();
                        $this->view->address = $sek->getOrderedAdress($id_key);

                    }else{
                        $validation->addError("You don't have permition to change this shopping!");
                    }
                }
            }
        }






        $this->view->post = $posted_values;
        if($validation->passed()){
            $this->view->displayErrors = $validation->displayOkay('Address successfully registered!');

        }else{
            $this->view->displayErrors = $validation->displayErrors();

        }


        $this->view->render('account/statusordered');
        //var_dump( $this->view->prds);
    }
}