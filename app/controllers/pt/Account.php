<?php

class Account extends  Controller implements InterfaceAccount{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);

    }
    public function indexAction(){
        Router::redirect('');
    }
    public function detailsAction(){
        $validation = new Validate();



        $posted_values = [
            'name'     => '', 'tel'  =>'',  'email' => '','city' => '','address' => '',
            'pcode' => ''
        ];
        $this->view->displayOkay = '';
        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'name' => [
                            'display' => 'Nome complecto',
                            'require' => true
                        ],
                        'tel' => [
                            'display' => 'Telemovel',
                            'require' => true,
                            'unique_update' => ['tels_user','tel_u_name','tel_u_user', currentUser()->user_id]
                        ],
                        'email' => [
                            'display' => 'Correio Electronico',
                            'require' => true,
                            'unique_update' => ['emails_user','email_u_name','email_u_user', currentUser()->user_id],
                            'valid_email' => true
                        ],
                        'city' => [
                            'display' => 'Cidade',
                            'require' => true,
                            'selected' => ['cities', 'city_id'],
                        ],
                        'address' => [
                            'display' => 'Endereço',
                            'require' => true
                        ],
                        'pcode' => [
                            'display' => 'Caixa postal',
                            'require' => true
                        ]
                    ]);
                    if ($validation->passed()) {
                        $newUser = new Users();
                        $newUser->updateUserDetails($_POST);
                        $this->view->displayOkay = 'Atualizado com sucesso!';
                        //Router::redirect('account/details');
                    }
                }
            }
        }

        $ctr = new Countries();
        $cti = new Cities();


        $paises = $ctr->find([]);
        $novo = [];
        $p = [];
        foreach($paises as $ctrs){

            $c = [];
            //$p['cities'][] = [];
            $p[$ctrs->country_name] = $cities = $cti->find( [
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
        $user = new Users();
        $this->view->detail = $user->findById(currentUser()->user_id);

        $this->view->displayErrors = $validation->displayErrors();

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
                        'current' => [
                            'display' => 'Senha actual',
                            'require' => true,
                            'min' => 6,
                            'check-pass-user' => true,
                        ],
                        'password' => [
                            'display' => 'Nova senha',
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
                        $new = new PassesUser();
                        $new->updatePasse(sanitize(Input::get('password')),currentUser()->user_id);
                        $this->view->displayOkay = 'Senha alterada com sucesso!';

                    }
                }
            }
        }


        $this->view->displayErrors = $validation->displayErrors();


        $this->view->render('account/password');
    }

    public function orderedAction(){
        $sek = new ShoppedKey();
        $this->view->prds = $sek->getOrderedByUser(currentUser()->user_id);
        //var_dump( $this->view->prds);
        $this->view->render('account/ordered');
    }
    public function statusorderedAction($id_key){
        $sek = new ShoppedPrds();
        $id_key = sanitize($id_key);
        $this->view->items = $sek->boxed($id_key);//admin = false
        $this->view->notfound = '';
        if($this->view->items == false){
            $this->view->notfound = 'Compra desconhecida!';
        }
        $this->view->render('account/statusordered');
        //var_dump( $this->view->prds);
    }
}