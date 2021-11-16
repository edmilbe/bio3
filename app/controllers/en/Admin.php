
<?php

class Admin extends  Controller{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);

    }
    public function indexAction(){
        //Router::redirect('');
    }
    public function organizationAction(){

        $Organization = new Organization();

        $this->view->orgs = $Organization->getOrgs();


        $this->view->token =  Token::generate();




            $this->view->render('admin/organization');
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
    public function addlocalidadeAction(){
        $validation = new Validate();
        $this->view->displayErrors = "";



        $posted_values2 = [
            'localidade' => '',
            'distrito' => '',
        ];

        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [

                        'localidade' => [
                            'display' => 'Localidade',
                            'require' => true,
                            'unique' =>  ['localidades', 'localidade_name']
                        ],
                        'distrito' => [
                            'display' => 'distrito',
                            'require' => true,
                            'selected' => ['distritos', 'distrito_id']
                        ]
                    ]);
                    if ($validation->passed()) {
                        $Localidade = new Localidades();
                        $id = $Localidade->newSave($_POST);

                        if($id > 0){
                            $this->view->displayErrors = $validation->displayOkay(
                                Input::get('localidade') . " inserido(a) com sucesso!");

                        }else{
                            $this->view->displayErrors = $validation->displayError(
                                Input::get('localidade') . " não inserido(a)!");
                        }

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();
                    }
                }
            }
        }


        $Distritos = new Distritos();

        $this->view->distritos = $Distritos->find([]);


        $Localidades = new Localidades();

        $this->view->localidades = $Localidades->find([]);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('admin/addlocalidade');
    }

    public function adduniverAction(){
        $validation = new Validate();
        $this->view->displayErrors = "";



        $posted_values2 = [
            'univer' => '',
        ];

        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [

                        'univer' => [
                            'display' => 'Universidade',
                            'require' => true,
                            'unique' =>  ['univers', 'univer_name']
                        ]
                    ]);
                    if ($validation->passed()) {
                        $Univers = new Univers();
                        $id = $Univers->newSave($_POST);

                        if($id > 0){
                            $this->view->displayErrors = $validation->displayOkay(
                                Input::get('univer') . " inserido(a) com sucesso!");

                        }else{
                            $this->view->displayErrors = $validation->displayError(
                                Input::get('univer') . " não inserido(a)!");
                        }

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();
                    }
                }
            }
        }


        $Univers = new Univers();

        $this->view->univers = $Univers->find([]);




        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('admin/adduniver');
    }


    public function adddistritoAction(){
        $validation = new Validate();
        $this->view->displayErrors = "";



        $posted_values2 = [
            'distrito' => '',
            'pais' => '',

        ];

        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [

                        'distrito' => [
                            'display' => 'Distrito',
                            'require' => true,
                            'unique' =>  ['distritos', 'distrito_name']
                        ],
                        'pais' => [
                            'display' => 'pais',
                            'require' => true,
                            'selected' => ['countries', 'country_id']
                        ]
                    ]);
                    if ($validation->passed()) {
                        $Distritos = new Distritos();
                        $id = $Distritos->newSave($_POST);

                        if($id > 0){
                            $this->view->displayErrors = $validation->displayOkay(
                                Input::get('distrito') . " inserido(a) com sucesso!");

                        }else{
                            $this->view->displayErrors = $validation->displayError(
                                Input::get('distrito') . " não inserido(a)!");
                        }

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();
                    }
                }
            }
        }


        $country = new Countries();

        $this->view->countries = $country->find([]);


        $Distritos = new Distritos();


        $this->view->distritos = $Distritos->find([]);



        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('admin/adddistrito');
    }
    public function addpaisAction(){
        $validation = new Validate();
        $this->view->displayErrors = "";



        $posted_values2 = [
            'pais' => '',
            'codigo' => '',


        ];

        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [


                        'pais' => [
                            'display' => 'pais',
                            'require' => true,
                            'unique' => ['countries', 'country_name']
                        ],
                        'codigo' => [
                            'display' => 'Código Telefónico',
                            'require' => true,
                            'unique' =>  ['countries', 'country_code']
                        ],
                    ]);
                    if ($validation->passed()) {
                        $Countries = new Countries();
                        $id = $Countries->newSave($_POST);

                        if($id > 0){
                            $this->view->displayErrors = $validation->displayOkay(
                                Input::get('pais') . " inserido(a) com sucesso!");

                        }else{
                            $this->view->displayErrors = $validation->displayError(
                                Input::get('pais') . " não inserido(a)!");
                        }

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();
                    }
                }
            }
        }

        $Countries = new Countries();


        $this->view->countries = $Countries->find([]);




        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('admin/addpais');
    }


    public function addentidadeAction(){
        $validation = new Validate();
        $this->view->displayErrors = "";



        $posted_values2 = [
            'entidade' => ''
        ];

        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [


                        'entidade' => [
                            'display' => 'entidade',
                            'require' => true,
                            'unique' => ['entidades', 'entidade_name']
                        ]
                    ]);
                    if ($validation->passed()) {
                        $Entidades = new Entidades();
                        $id = $Entidades->newSave($_POST);

                        if($id > 0){
                            $this->view->displayErrors = $validation->displayOkay(
                                Input::get('entidade') . " inserido(a) com sucesso!");

                        }else{
                            $this->view->displayErrors = $validation->displayError(
                                Input::get('entidade') . " não inserido(a)!");
                        }

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();
                    }
                }
            }
        }


        $Entidades = new Entidades();

        $this->view->entidades = $Entidades->find([]);






        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('admin/addentidade');
    }



    public function adddocumentoAction(){
        $validation = new Validate();
        $this->view->displayErrors = "";



        $posted_values2 = [
            'documento' => ''
        ];

        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [


                        'documento' => [
                            'display' => 'documento',
                            'require' => true,
                            'unique' => ['documentos', 'documento_name']
                        ]
                    ]);
                    if ($validation->passed()) {
                        $Documentos = new Documentos();
                        $id = $Documentos->newSave($_POST);

                        if($id > 0){
                            $this->view->displayErrors = $validation->displayOkay(
                                Input::get('documento') . " inserido(a) com sucesso!");

                        }else{
                            $this->view->displayErrors = $validation->displayError(
                                Input::get('documento') . " não inserido(a)!");
                        }

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();
                    }
                }
            }
        }

        $Documentos = new Documentos();


        $this->view->documentos = $Documentos->find([]);




        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('admin/adddocumento');
    }



    public function usersAction(){
        $validation = new Validate();
        $this->view->displayErrors = "";



        $posted_values2 = [
            'user' => '',
            'acl' => ''
        ];

        $Users = new Users();

        //dnd($Users->setAcl(12));

        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [


                        'user' => [
                            'display' => 'utilizador',
                            'require' => true,
                            'selected' => ['users', 'user_id']
                        ],
                        'acl' => [
                            'display' => 'previlégio',
                            'require' => true,
                            'selected' => ['acls', 'acl_id']
                        ]
                    ]);
                    if ($validation->passed()) {
                        $AclUsers = new AclUsers();
                        $id = $AclUsers->newSave($_POST);
                        $Users = new Users();

                        if($id > 0){
                            $this->view->displayErrors =
                                $validation->displayOkay(
                                    "Previlégio inserido(a) com sucesso!");

                        }else{
                            $this->view->displayErrors =
                                $validation->displayError(
                                "Previlégio não inserido(a)!");
                        }

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();
                    }
                }
            }
        }

        $Acls = new Acls();
        $Users = new Users();

        $this->view->acls = $Acls->find([]);

        foreach($this->view->acls as $acl):

                $this->view->aclusers[$acl->acl_id] = $Acls->aclUsers($acl->acl_id);
            endforeach;

        //dnd($this->view->acls);
        $this->view->users = $Users->find([]);




        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('admin/users');
    }


    public function useroffAction($acl, $user){

        $AclUsers = new AclUsers();


        $AclUsers->removeAcl($acl, $user);

        //dnd(1);

        Router::redirect('admin/users');

    }



    public function addestadoAction(){
        $validation = new Validate();
        $this->view->displayErrors = "";



        $posted_values2 = [
            'estado' => ''
        ];

        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [


                        'estado' => [
                            'display' => 'estado',
                            'require' => true,
                            'unique' => ['estados', 'estado_name']
                        ]
                    ]);
                    if ($validation->passed()) {
                        $Estados = new Estados();
                        $id = $Estados->newSave($_POST);

                        if($id > 0){
                            $this->view->displayErrors = $validation->displayOkay(
                                Input::get('estado') . " inserido(a) com sucesso!");

                        }else{
                            $this->view->displayErrors = $validation->displayError(
                                Input::get('estado') . " não inserido(a)!");
                        }

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();
                    }
                }
            }
        }




        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('admin/addestado');
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