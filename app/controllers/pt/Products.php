<?php

class Products extends Controller implements InterfaceProducts{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);

    }
    public function indexAction($name = ''){


    }



    public function newmedidaAction()
    {
        $validation = new Validate();

        $posted_values = [
            'pr-name'     => '',  'pr-sigla'     => ''
        ];
        $this->view->displayOkay = '';
        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'pr-name' => [
                            'display' => 'Medida',
                            'require' => true,
                            'unique' => ['medidas','med_name']
                        ],
                        'pr-sigla' => [
                            'display' => 'Sigla',
                            'require' => true,
                            'unique' => ['medidas','med_sigla']
                        ]
                    ], $_FILES);
                    if ($validation->passed()) {
                        $medidas = new Medidas();


                        if($medidas->saveMedida(Input::get('pr-name'),Input::get('pr-sigla') )){
                            $this->view->displayOkay = 'Medida "' . Input::get('pr-name') . '" inserida com sucesso!';
                        }else{
                            $validation->addError('Erro ao inserir a medida!');

                        }
                        //$newUser->updateUserDetails($_POST);
                        //Router::redirect('account/details');
                    }
                }
            }
        }


        $this->view->post =  $posted_values;
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('products/newmedida');
    }

    public function newmarcaAction()
    {
        $validation = new Validate();

        $posted_values = [
            'pr-name'     => ''
        ];
        $this->view->displayOkay = '';
        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'pr-name' => [
                            'display' => 'Marca',
                            'require' => true,
                            'unique' => ['marcas','marca_name']
                        ]
                    ], $_FILES);
                    if ($validation->passed()) {
                        $marca = new Marcas();
                        ;

                        if($marca->saveMarca(Input::get('pr-name'))){
                            $this->view->displayOkay = 'Marca "' . Input::get('pr-name') . '" inserida com sucesso!';
                        }else{
                            $validation->addError('Erro ao inserir a marca!');

                        }
                        //$newUser->updateUserDetails($_POST);
                        //Router::redirect('account/details');
                    }
                }
            }
        }


        $this->view->post =  $posted_values;
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('products/newmarca');
    }

    public function newproductAction(){

        $validation = new Validate();

        $posted_values = [
            'pr-name'     => '', 'grupo' => '', 'escala' => ''
        ];
        $this->view->displayOkay = '';
        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'pr-name' => [
                            'display' => 'Nome do item',
                            'require' => true,
                            'unique' => ['prds','prd_name']
                        ],
                        'grupo' => [
                            'display' => 'Grupo do item',
                            'require' => true,
                            'selected' => ['group2','group2_id']
                        ],
                        'escala' => [
                            'display' => 'Escala do item',
                            'require' => true,
                            'is_numeric' => true
                        ]
                    ], $_FILES);
                    if ($validation->passed()) {

                        if(Input::get('marca') == 1){
                            $posted_values = [
                                'marca-opc'     => ''
                            ];
                            $validation->check($_POST, [
                                'marca-opc' => [
                                    'display' => 'Marca do item',
                                    'require' => true,
                                    'selected' => ['marcas','marca_id']
                                ]
                            ], $_FILES);
                            if($validation->passed()){
                                $validation = $this->validate1();
                            }
                        }

                        if($validation->passed()){

                            $validation = $this->validate1();
                            if($validation->passed()){
                                $validation->check($_POST, [
                                    'foto-pn' => [
                                        'display' => 'Imagens do item',
                                        'multi-img' => 'files',
                                        'files-types' => ['png', 'jpeg', 'jpg']
                                    ]
                                ], $_FILES);
                            }

                        }
                        if($validation->passed()){
                            if($this->savePrd1($_POST, $_FILES['foto-pn']) == false){
                                $validation->addError('Ocorreu um erro
                                , tente novamente!');
                            }else{
                                $this->view->displayOkay = sanitize(Input::get('pr-name')) . ' inserido(a) com sucesso';

                            }
                        }
                    }
                }
            }
        }
        $gr2 = new Group2();
        $this->view->grupos = $gr2->find([]);

        $marcas = new Marcas();
        $this->view->marcas = $marcas->getMarcas();

        $medidas = new Medidas();
        $this->view->medidas = $medidas->find([]);



        $this->view->post =  $posted_values;
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('products/newproduct');
    }

    protected function savePrd1($post, $files){
        $pr = new Prds();
        $flag = false;
        $form['prd_name'] = sanitize($post['pr-name']);
        $form['prd_int'] = time();
        $form['prd_update'] = GetDateTime(time());

        $form['prd_intbig'] = time();
        $form['prd_opc'] = sanitize($post['unidade']);
        $form['prd_escala'] = sanitize($post['escala']);

        $id_pr = $pr->savePrd($form);

        if(is_numeric($id_pr)){
            $prg = new PrGroup();
            $gr = $prg->savePrG($post['grupo'],$id_pr);

            if(is_numeric($gr)){
                $id_marca = '';

                if(isset($post['marca'])){
                    if($post['marca'] == 1){
                        //var_dump($post['marca-opc']);
                        $marca = new PrMarcas();
                        $id_marca = $marca->savePrM($post['marca-opc'],$id_pr);
                    }
                }
                if(isset($post['marca'])){
                    //var_dump($post['marca']);

                    if(($post['marca'] == 1 && is_numeric($id_marca))){
                        //var_dump($post['marca']);

                        $flag = $this->savePrd2($post, $files, $id_pr);
                    }
                }elseif(is_numeric($id_pr)){
                    $flag = $this->savePrd2($post, $files, $id_pr);
                }

            }
        }


        return $flag;
    }

    protected function savePrd2($post, $files, $id_pr)
    {
        $flag = false;

        if ($post['unidade'] == 1) {
            $uni = new PrUnis();
            $id_uni = $uni->savePrUni($post['uni-preco'],$id_pr);
            if(is_numeric($id_uni)){
                $flag = true;
            }
        } elseif ($post['unidade'] == 2) {
            $solto = new PrSolto();
            $id_solto = $solto->savePrSolto(
                $post['solto-preco'],
                $post['solto-qt'],
                $post['solto-med'],
                $id_pr);
            if(is_numeric($id_solto)){
                $flag = true;
            }
        } elseif ($post['unidade'] == 3) {

            $o1 = new PrOutros1();
            $id_o1 = $o1->savePrOutros1(
                $post['d1-preco'],
                $post['d1-qt'],
                $post['d1-med'],
                $id_pr);

            if(is_numeric($id_o1)){
                $o2 = new PrOutros2();
                $id_o2 = $o2->savePrOutros2(
                    $id_o1,
                    $post['d2-qt'],
                    $post['d2-med'],
                    $id_pr);
                if(is_numeric($id_o2) && !isset($_POST['d'][0])){
                    $flag = true;
                }elseif(is_numeric($id_o2) && isset($_POST['d'][0])){
                    $o3 = new PrOutros3();
                    $id_o3 = $o3->savePrOutros3(
                        $id_o2,
                        $post['d3-qt'],
                        $post['d3-med'],
                        $id_pr);
                    if(is_numeric($id_o3)){
                        $flag = true;
                    }
                }
            }
        }
        //var_dump($flag);
        if($flag == true){
            $file = new Files();
            $names  = $file->SaveMFile($files,'prds');
            if($names != false){
                if(is_array($names)){
                    $pf = new PrFiles();

                    foreach($names as $key => $id_foto){
                        if($key == 0){
                            $prd = new Prds();
                            $prd->updatePrFoto($id_pr,$id_foto);
                        }
                        if(!is_numeric($pf->savePrFoto($id_pr,$id_foto))){
                            return false;
                        }
                    }
                }else{
                    $flag = false;
                }
            }else{
                $flag = false;
            }
            //var_dump($flag);
        }
        //dnd($flag);

        return $flag;
    }
    protected function validate1(){

        $validation = new Validate();
        if(Input::get('unidade') == 1 || Input::get('unidade') == 2 || Input::get('unidade') == 3 ){
            $validation = $this->validate2();
        }else{
            $validation->addError('Escolha o  tipo do item.');
        }

        return $validation;
    }

    protected function validate2(){
        $validation = new Validate();
        if(Input::get('unidade') == 1){
            $validation->check($_POST, [
                'uni-preco' => [
                    'display' => 'Preco do item',
                    'require' => true,
                    'is_numeric' => true
                ]
            ], $_FILES);
        }elseif(Input::get('unidade') == 2){
            $validation->check($_POST, [
                'solto-qt' => [
                    'display' => 'Quantidade',
                    'require' => true,
                    'is_numeric' => true
                ],
                'solto-med' => [
                    'display' => 'Medida do item',
                    'require' => true,
                    'is_numeric' => true,
                    'selected' => ['medidas', 'med_id']
                ],
                'solto-preco' => [
                    'display' => 'Preco do item',
                    'require' => true,
                    'is_numeric' => true
                ]
            ], $_FILES);
        }elseif(Input::get('unidade') == 3){
            $validation->check($_POST, [
                'd1-qt' => [
                    'display' => 'Quantidade',
                    'require' => true,
                    'is_numeric' => true
                ],
                'd1-med' => [
                    'display' => 'Medida do item',
                    'require' => true,
                    'is_numeric' => true,
                    'selected' => ['medidas', 'med_id']
                ],
                'd1-preco' => [
                    'display' => 'Preco do item',
                    'require' => true,
                    'is_numeric' => true
                ],
                'd2-qt' => [
                    'display' => 'D2 Quantidade',
                    'require' => true,
                    'is_numeric' => true
                ],
                'd2-med' => [
                    'display' => 'D2 Medida do item',
                    'require' => true,
                    'is_numeric' => true,
                    'selected' => ['medidas', 'med_id']
                ]
            ], $_FILES);

            //dnd($_POST['d'][0]);
            if($validation->passed()){
                if(isset($_POST['d'][0])){
                    if($_POST['d'][0] == 2){
                        $validation->check($_POST, [
                            'd3-qt' => [
                                'display' => 'D3 Quantidade',
                                'require' => true,
                                'is_numeric' => true
                            ],
                            'd3-med' => [
                                'display' => 'D3 Medida do item',
                                'require' => true,
                                'is_numeric' => true,
                                'selected' => ['medidas', 'med_id']
                            ]
                        ], $_FILES);
                    }else{
                        $validation->addError('Marque um D3 correcto!');
                    }
                }
            }
        }


        return $validation;


    }

    public function newgroup2Action(){

        $validation = new Validate();

        $posted_values = [
            'pr-name'     => '',  'grupo'     => ''
        ];
        $this->view->displayOkay = '';
        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'pr-name' => [
                            'display' => 'Nome do Grupo 2',
                            'require' => true,
                            'unique' => ['group2','group2_name']
                        ],
                        'grupo' => [
                            'display' => 'Grupo 1',
                            'require' => true,
                            'selected' => ['group1','group1_id']
                        ],
                        'foto-pn' => [
                            'display' => 'Foto do Grupo 2',
                            'require-pic' => 'files',
                            'files-types' => ['png', 'jpeg', 'jpg']

                        ]
                    ], $_FILES);
                    if ($validation->passed()) {
                        $gr2 = new Group2();
                        if($gr2->createGp2(Input::get('pr-name'), Input::get('grupo'), $_FILES['foto-pn']) > 0){
                            $this->view->displayOkay = Input::get('pr-name') . ' inserido!';
                        }
                        //$newUser->updateUserDetails($_POST);
                        //Router::redirect('account/details');
                    }
                }
            }
        }
        $gr1 = new Group1();

        $this->view->grupos = $gr1->find([]);

        $this->view->post =  $posted_values;
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('products/newgroup2');
    }

    public function newgroup1Action(){

        $validation = new Validate();

        $posted_values = [
            'pr-name'     => ''
        ];
        $this->view->displayOkay = '';
        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'pr-name' => [
                            'display' => 'Nome do Grupo',
                            'require' => true,
                            'unique' => ['group1','group1_name']
                        ],

                        'foto-pn' => [
                            'display' => 'Foto do Grupo 2',
                            'require-pic' => 'files',
                            'files-types' => ['png', 'jpeg', 'jpg']
                        ]
                    ], $_FILES);
                    if ($validation->passed()) {
                        $gr2 = new Group2();
                        if($gr2->createGp2(Input::get('pr-name'), Input::get('grupo'), $_FILES['foto-pn']) > 0){
                            $this->view->displayOkay = Input::get('pr-name') . ' inserido!';
                        }
                        //$newUser->updateUserDetails($_POST);
                        //Router::redirect('account/details');
                    }
                }
            }
        }
        $gr2 = new Group1();
        $this->view->grupos = $gr2->find([]);

        $marcas = new Marcas();
        $this->view->marcas = $marcas->getMarcas();

        $medidas = new Medidas();
        $this->view->medidas = $medidas->find([]);


        $this->view->post =  $posted_values;
        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('products/newgroup1');
    }
}

