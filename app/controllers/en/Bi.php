<?php


class Bi extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

    }

    public function indexAction()
    {
        $this->view->render('bi/buscar');

    }




    public function newbiAction()
    {

        $Bis = new Bis();

        $validation = new Validate();


        $posted_values2 = [
            'documento' => '',
            'entidade' => '',
            'bi' => '',
            'name' => '',
            'mae' => '',
            'pai' => '',
            'nas-dia' => '',
            'nas-mes' => '',
            'nas-ano' => '',
            'nature' => '',
            'genero' => '',
            'emissao-dia' => '',
            'emissao-mes' => '',
            'emissao-ano' => '',
            'estado' => ''
        ];

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [

                        'documento' => [
                            'display' => 'documento de identificação',
                            'require' => true,
                            'selected' => ['documentos', 'documento_id'],
                        ],
                        'entidade' => [
                            'display' => 'entidade emissora do documento',
                            'require' => true,
                            'selected' => ['entidades', 'entidade_id']
                        ],
                        'bi' => [
                            'display' => 'número do documento de identificação',
                            'require' => true,
                            'unique' => ['bis', 'bi_number']
                        ],
                        'name' => [
                            'display' => 'nome do cidadão',
                            'require' => true
                        ],
                        'mae' => [
                            'display' => 'mão do cidadão',
                            'require' => true
                        ],
                        'pai' => [
                            'display' => 'pai do cidadão',
                            'require' => true
                        ],
                        'nas-dia' => [
                            'display' => 'dia de nascimento',
                            'require' => true,
                            'selected' => ['dias', 'dia_id'],
                        ],
                        'nas-mes' => [
                            'display' => 'mes de nascimento',
                            'require' => true,
                            'selected' => ['meses', 'mes_id'],
                        ],
                        'nas-ano' => [
                            'display' => 'ano de nascimento',
                            'require' => true,
                            'selected' => ['anos', 'ano_name'],
                        ],
                        'nature' => [
                            'display' => 'local de nascimento',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id'],
                        ],
                        'genero' => [
                            'display' => 'sexo',
                            'require' => true
                        ],
                        'emissao-dia' => [
                            'display' => 'dia de emissão',
                            'require' => true,
                            'selected' => ['dias', 'dia_id'],
                        ],
                        'emissao-mes' => [
                            'display' => 'mes de emissão',
                            'require' => true,
                            'selected' => ['meses', 'mes_id'],
                        ],
                        'emissao-ano' => [
                            'display' => 'ano de emissão',
                            'require' => true,
                            'selected' => ['anos', 'ano_name'],
                        ],
                        'estado' => [
                            'display' => 'estado civíl',
                            'require' => true,
                            'selected' => ['estados', 'estado_id'],
                        ]

                    ]);

                    if ($validation->passed()) {

                        $newBi = $Bis->saveBI($_POST);

                       // Router::redirect('atestado/create');

                        $this->view->displayErrors = $validation->displayOkay("Documento inserido com sucesso");



                    } else {
                        $this->view->displayErrors = $validation->displayErrors();

                    }
                }
            }
        }


        // $Distritos = new Dis

        $Dias = new Dias();
        $Meses = new Meses();
        $Anos = new Anos();


        $Documentos = new Documentos();
        $Entidades = new Entidades();
        $Estados = new Estados();
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);
        $this->view->documentos = $Documentos->find([]);
        $this->view->entidades = $Entidades->find([]);
        $this->view->estados = $Estados->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $this->view->distritos = $Distritos->find([]);
        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('bi/new');
    }


    public function updatebiAction($bi){
        $Bis = new Bis();

        $this->view->bis = $Bis->getBIById(sanitize($bi));

        //dnd($this->view->bis);

        if(!$this->view->bis){
            Router::redirect('atestado/create');
        }

        $validation = new Validate();


        $posted_values2 = [
            'documento' => '',
            'entidade' => '',
            'bi' => '',
            'name' => '',
            'mae' => '',
            'pai' => '',
            'nas-dia' => '',
            'nas-mes' => '',
            'nas-ano' => '',
            'nature' => '',
            'genero' => '',
            'emissao-dia' => '',
            'emissao-mes' => '',
            'emissao-ano' => '',
            'estado' => ''
        ];

        $this->view->displayErrors = "";

        if (Input::exists()) {

            if (Token::check(Input::get('token'))) {

                if ($_POST) {

                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'documento' => [
                            'display' => 'documento de identificação',
                            'require' => true,
                            'selected' => ['documentos', 'documento_id'],
                        ],
                        'entidade' => [
                            'display' => 'entidade emissora do documento',
                            'require' => true,
                            'selected' => ['entidades', 'entidade_id']
                        ],
                        'bi' => [
                            'display' => 'número do documento',
                            'require' => true,
                            'unique_update' => ['bis','bi_number','bi_id', $bi]
                        ],
                        'name' => [
                            'display' => 'nome do cidadão',
                            'require' => true
                        ],
                        'mae' => [
                            'display' => 'mão do cidadão',
                            'require' => true
                        ],
                        'pai' => [
                            'display' => 'pai do cidadão',
                            'require' => true
                        ],
                        'nas-dia' => [
                            'display' => 'dia de nascimento',
                            'require' => true,
                            'selected' => ['dias', 'dia_id'],
                        ],
                        'nas-mes' => [
                            'display' => 'mes de nascimento',
                            'require' => true,
                            'selected' => ['meses', 'mes_id'],
                        ],
                        'nas-ano' => [
                            'display' => 'ano de nascimento',
                            'require' => true,
                            'selected' => ['anos', 'ano_name'],
                        ],
                        'nature' => [
                            'display' => 'local de nascimento',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id'],
                        ],
                        'genero' => [
                            'display' => 'sexo',
                            'require' => true
                        ],
                        'emissao-dia' => [
                            'display' => 'dia de emissão',
                            'require' => true,
                            'selected' => ['dias', 'dia_id'],
                        ],
                        'emissao-mes' => [
                            'display' => 'mes de emissão',
                            'require' => true,
                            'selected' => ['meses', 'mes_id'],
                        ],
                        'emissao-ano' => [
                            'display' => 'ano de emissão',
                            'require' => true,
                            'selected' => ['anos', 'ano_name'],
                        ],
                        'estado' => [
                            'display' => 'estado civíl',
                            'require' => true
                        ]

                    ]);

                    if ($validation->passed()) {

                        $Bis->updateBI($_POST, $bi);
                        //dnd($_POST);


                        $this->view->bis = $Bis->getBIById(sanitize($bi));
                        $this->view->displayErrors = $validation->displayOkay("Documento atualizado com sucesso");

                    } else {
                        $this->view->displayErrors = $validation->displayErrors();

                    }
                }
            }
        }




        // $Distritos = new Dis

        $Dias = new Dias();
        $Meses = new Meses();
        $Anos = new Anos();
        $Documentos = new Documentos();
        $Entidades = new Entidades();
        $Estados = new Estados();
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);
        $this->view->documentos = $Documentos->find([]);
        $this->view->entidades = $Entidades->find([]);
        $this->view->estados = $Estados->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind'  => [date('Y')]


        ]);

        $Distritos= new Distritos();
        $this->view->distritos= $Distritos->find([]);
        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('bi/update');
    }






}