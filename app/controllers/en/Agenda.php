
<?php

class Agenda extends  Controller {
    public function __construct($controller, $action){
        parent::__construct($controller, $action);

    }
    public function indexAction(){






        $validation = new Validate();

        $posted_values = [

            'titlo' => '',
            'dia' => '',
            'mes' => '',
            'ano' => ''
        ];
        //dnd($_POST);
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);

                    $posted_values = posted_values($_POST);

                    $validation->check($_POST, [
                        'titlo' => [
                            'display' => 'Insira o titlo do evento',
                            'require' => true
                        ],
                        'dia' => [
                            'display' => 'Escolha o dia do envento',
                            'require' => true,
                            'selected' => ['dias', 'dia_name']
                        ],
                        'mes' => [
                            'display' => 'Escolha o mes do envento',
                            'require' => true,
                            'selected' => ['meses', 'mes_id']
                        ],
                        'ano' => [
                            'display' => 'Escolha o ano do envento',
                            'require' => true,
                            'selected' => ['anos', 'ano_name']
                        ]

                    ]);
                    // dnd($validation->passed());

                    if ($validation->passed()) {

                        $Agenda = new Agendas();



                        $id = $Agenda->newAgenda($_POST);
                        //dnd($id);

                        if($id > 1){
                            $validation->displayOkay("Agenda anotada!");
                        }else{
                            $validation->addError("Erro ao anotar!");
                        }
                        $this->view->displayErrors = $validation->displayErrors();

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();

                    }
                }
            }
        }

        $Dias = new Dias();
        $this->view->dias = $Dias->find([]);
        $Meses = new Meses();
        $this->view->meses = $Meses->find([]);
        //dnd($this->view->meses);
        $Anos = new Anos();
        $this->view->anos = $Anos->find([]);

        //$Agenda = new Agenda();





        $this->view->post = $posted_values;

        //$this->view->render('home/postnew');
        $this->view->token = Token::generate();

        $this->view->render('agenda/agendanew');
    }
























    public function newassociationAction()
    {
        $validation = new Validate();

        $posted_values = [
            'titulo' => '',
            'photo' => '',
            'text' => ''
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
        //dnd($_POST);
                    postsanitize($_POST);

                    $posted_values = posted_values($_POST);

                    $validation->check($_POST, [

                        'titulo' => [
                            'display' => 'Insira o nome da Assiciação',
                            'require' => true
                        ],
                        'text' => [
                            'display' => 'Insira descrição da Assiciação',
                            'require' => true
                        ]
                    ]);
                    // dnd($validation->passed());

                    if ($validation->passed()) {

                        if (!isset($_FILES['photo']['name'])) {
                            $validation->addError("Insira a imagem");
                            $this->view->displayErrors = $validation->displayErrors();
                        } else {
                            $Files = new Files();
                            $Posts = new Associations();

                            //dnd($_FILES['photo']);
                            $img = $Files->SaveAFile($_FILES['photo'], 'associations');
                            //dnd($img);
                            $id_news = $Posts->newPost($_POST, $img);

                            if($id_news > 0){
                                $link = PROOT . "home/association/" . $id_news;
                                $this->view->displayErrors = $validation->displayOkay("Associação inserida com sucesso, <a href='$link'>Vizualizar</a>");
                            }else{
                                $validation->addError("Erro ao inserir a imagem");
                                $this->view->displayErrors = $validation->displayErrors();

                            }
                        }

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();

                    }
                }
            }
        }





        $this->view->post = $posted_values;

        $this->view->render('account/associationnew');

    }



    public function newclipAction()
    {
        $validation = new Validate();

        $posted_values = [
            'titulo' => '',
            'text' => ''
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
        //dnd($_POST);
                    postsanitize($_POST);

                    $posted_values = posted_values($_POST);

                    $validation->check($_POST, [

                        'titulo' => [
                            'display' => 'Insira o titulo do clip',
                            'require' => true
                        ],
                        'text' => [
                            'display' => 'Insira o link incorporado do clip',
                            'require' => true
                        ]
                    ]);
                    // dnd($validation->passed());

                    if ($validation->passed()) {

                        $Posts = new Clips();

                        //dnd($_FILES['photo']);
                        //dnd($img);
                        $id_news = $Posts->newPost($_POST);

                        if($id_news > 0){
                            $link = PROOT . "home/clip/" . $id_news;
                            $this->view->displayErrors = $validation->displayOkay("Clip inserido com sucesso, <a href='$link'>Vizualizar</a>");
                        }else{
                            $validation->addError("Erro ao inserir o clip!");
                            $this->view->displayErrors = $validation->displayErrors();

                        }

                    }else{
                        $this->view->displayErrors = $validation->displayErrors();

                    }
                }
            }
        }





        $this->view->post = $posted_values;

        $this->view->render('account/clipnew');

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
            'tel' => '', 'address' => ''
        ];
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'fname' => [
                            'display' => 'First name',
                            'require' => true
                        ],
                        'tel' => [
                            'display' => 'Phone number',
                            'require' => true,
                            'unique_update' => ['tels_user','tel_u_name','tel_u_user', currentUser()->user_id],
                        ],
                        'address' => [
                            'display' => 'Address',
                            'require' => true
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