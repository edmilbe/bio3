<?php


require_once("files/dompdf/autoload.inc.php");
use Dompdf\Dompdf;


class Home extends Controller implements InterfaceHome
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    public function langAction($lang)
    {
        Session::set(LANG, $lang);

        Router::redirect('');
    }


    public function indexAction($on = false, $onon = false)
    {



        //dnd(NumeroEmExtenso(17));





        $Posts = new Posts();
        $this->view->lasts = $Posts->getPosts(3);



        $Agendas = new Agendas();

        $this->view->agenda = $Agendas->find([

                'conditions' => 'agenda_complete > ?',
                'bind' => [Date('Y')."-".Date('m')."-".Date('d')],
                'order' => 'agenda_complete ASC',
                'limit' => '4'
            ]

        );

        $Turismos = new Turismos();
        $this->view->turismos = $Turismos->getPosts(30);


        $Contactos = new Contactos();
        $this->view->contactos = $Contactos->find([]);


        //dnd($this->view->turismos);


        //SELECT *FROM agendas WHERE agenda_complete > '2020-12-17' ORDER BY agenda_complete ASC LIMIT 5


        $this->view->render('home/index');

    }


    public function aboutusAction()
    {

        $Members = new Members();

        $this->view->membros = $Members->find([]);




        $Cargos = new Cargos();
        $this->view->staffs = $Cargos->getPosts();

    //dnd(    $this->view->staffs);


        $this->view->render('home/aboutus');
    }




    public function om4daboutAction(){

        $Cargos = new Cargos();
        $this->view->staffs = $Cargos->getPosts();
        $this->view->render('home/om4daboutus');
    }
    public function spgAction(){

        $Cargos = new Cargos();
        $this->view->staffs = $Cargos->getPosts();
        $this->view->render('home/spg');
    }


    public function docsAction(){
        $doc = new Docs();


        for($i = 1; $i <= 4; $i++){
            $this->view->docs[$i] = $doc->getPosts($i);
        }

        //dnd($this->view->docs);


        $this->view->render('home/docs');


    }





    public function downloadAction($pasta, $nome){

        //dnd(1);

        //header("Content-type: application/pdf");
        //header("Content-Disposition: inline; filename=filename.pdf");
        //@readfile(PROOT . "files/" . $pasta . "/" . $nome . ".pdf");
       // @readfile(PROOT . "files/" . $pasta . "/" . $nome);



        // Store the file name into variable
        $file = ROOT . DS. "files" .DS . $pasta . DS . $nome;
        $filename = ROOT . DS. "files" .DS . $pasta . DS . $nome;
       // dnd($filename);

// Header content type
        header('Content-type: application/pdf');

        header('Content-Disposition: inline; filename="' . $filename . '"');

        header('Content-Transfer-Encoding: binary');

        header('Accept-Ranges: bytes');

// Read the file
        @readfile($file);




    }











    public function postsAction($page = 1){

        if(!is_numeric($page) ){
            $page = 1;
        }
        $Posts = new Posts();



        $this->view->total_pages = ceil($Posts->RowsNumber(null,null, "post_id") / 3);
        $this->view->pageno = $page;

        $this->view->lasts = $Posts->getPostList($page, 3);


        $this->view->render('home/posts');


    }

    public function turismosAction($page = 1){

        if(!is_numeric($page) ){
            $page = 1;
        }
        $Posts = new Turismos();



        $this->view->total_pages = ceil($Posts->RowsNumber() / 3);
        $this->view->pageno = $page;

        $this->view->lasts = $Posts->getPostList($page, 3);


        $this->view->render('home/turismos');


    }



    public function postreadAction($post_id){
        //dnd($post_id);
        $Posts = new Posts();
        $this->view->post= $Posts->getPost($post_id);
        $this->view->lasts = $Posts->getPosts(6);
        $this->view->render('home/postread');

    }
    public function turismoreadAction($post_id){
        //dnd($post_id);
        $Posts = new Turismos();
        $this->view->post= $Posts->getPost($post_id);
        $this->view->lasts = $Posts->getPosts(6);
        $this->view->render('home/turismoread');

    }


    private function createAtestado($results)
    {


    }

    /*
     *
     * menu no formulario é(inserir bi, e atualizar bi) ambos vem com pop up e executa de mesma forma
     * e em baixo do formulario de criacao de atestado tem a opção refazer atestado entao ali pode-se alterar a residencia do atestado
     * e seguir para impressão
     * tem a opção ver atestado tbm para poder
     *
     *
     * ver atestado -> clica num dos atestados na lista -> edita em pop up - > salva e exoporta
     * alter bi -> lista bi -> salva BI
     *
     *
     *
     *
     */




    public function atestadosAction()
    {
        $Atestados = new Atestados();
        $this->view->results = $Atestados->find(['order' =>
                'atestado_id DESC'
            ]
        );
        //dnd($result);
        $this->view->render('atestado/multi-view');

    }


    public function atestadoAction($atestado)
    {
        $atestado = sanitize($atestado);
        $Atestados = new Atestados();
        $this->view->result = $Atestados->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [$atestado]
            ]
        );
        if (!$this->view->result) {

        } else {
            $this->view->render('atestados/view-one');
        }
    }



    public function helpssearchAction()
    {
        Router::redirect('home/ajudas/0' . Input::get('bi'));
    }












    public function boxAction()
    {

        $prds = new Prds();

        $this->view->items = $prds->box();


        $prds = new Prds();

        $this->view->items = $prds->box();

        $posted_values = [
            'address' => '',
        ];

        if (currentUser() && $this->getTotalToPay() > 0) {

            $validation = new Validate();


            if (Input::exists()) {


                if (Token::check(Input::get('token'))) {

                    if ($_POST) {
                        postsanitize($_POST);
                        $posted_values = posted_values($_POST);
                        $validation->check($_POST, [

                            'address' => [
                                'display' => 'Address',
                                'require' => true
                            ]
                        ]);

                        if ($validation->passed()) {
                            postsanitize($_POST);
                            $posted_values = posted_values($_POST);
                            //dnd(Input::exists());

                            //var_dump($_POST);

                            $newUser = new Users();

                            //$error = $newUser->registerPaymentNewUser($_POST);
                            $prd = new Prds();
                            $box = $prd->box();
                            if ($box != false) {
                                if ($prd->verificaPreco($box)) {
                                    //$this->finishShopping($_POST);
                                    $sik = new ShoppingKey();
                                    //$sik->saveDetails($_POST);

                                    //$box = $prd->box();
                                    $sek = new ShoppedKey();


                                    $id = $sek->saveDetails($_POST, $box);


                                    if ($id) {
                                        $sep = new ShoppedPrds();
                                        $this->view->total = $total = $sep->getTotalByKeyId($id);

                                        $this->view->recive = $factura = Session::ReturnSession();


                                        $inicialF = $this->view->total + 10;


                                        // dnd($token);


                                        $sik->NewShoppingKey();

                                        Router::redirect('home/invoice/' . $total . '/' . $factura);
                                    }


                                } else {
                                    $validation->addError('Empty the box and shop make and do new shopping!');
                                }

                            }
                        }


                    }
                }
            }

        }

        $this->view->token = Token::generate();

        $this->view->render('home/box');
    }

    public function gr1Action()
    {
        $prds = new Group1();

        $this->view->items = $prds->getAllGr1();
        $this->view->render('home/gr1');

    }

    public function gr2Action($g1 = 0)
    {
        $prds = new Group2();
        $g1 = sanitize($g1);
        if ($g1 != 0) {
            $this->view->g1 = $g1;
            $this->view->items = $prds->getAllGr2($g1);
        } else {
            $this->view->g1 = 0;
            $this->view->items = $prds->getAllGr2();

        }

        //$this->view->items = $prds->getAllGr2();
        $this->view->render('home/gr2');

    }

    public function closeboxAction()
    {
        if (currentUser()) {
            Router::redirect('home/receiver');
        } else {
            Router::redirect('register/login');
        }
    }

    public function receiverAction()
    {
        $validation = new Validate();


        $posted_values = [
            'name' => '', 'tel' => '', 'address' => ''
        ];
        $this->view->displayOkay = '';
        $user = new Users();
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'name' => [
                            'display' => 'Name',
                            'require' => true
                        ],
                        'tel' => [
                            'display' => 'Number Phone',
                            'require' => true,
                            'unique_update' => ['tels_user', 'tel_u_name', 'tel_u_user', currentUser()->user_id]
                        ],
                        'address' => [
                            'display' => 'Address',
                            'require' => true
                        ]
                    ]);
                    if ($validation->passed()) {
                        $newUser = new Users();
                        $prd = new Prds();
                        $box = $prd->box();
                        if ($box != false) {
                            if ($prd->verificaPreco($box)) {
                                //$this->finishShopping($_POST);
                                $sik = new ShoppingKey();
                                $sik->saveDetails($_POST);

                                //$box = $prd->box();
                                $sek = new ShoppedKey();


                                $id = $sek->saveDetails($_POST, $box);


                                if ($id) {
                                    $sep = new ShoppedPrds();
                                    $this->view->total = $total = $sep->getTotalByKeyId($id);
                                    $this->view->recive = $factura = Session::ReturnSession();

                                    $sik->NewShoppingKey();

                                    Router::redirect('home/invoice/' . $total . '/' . $factura);
                                }


                            } else {
                                $validation->addError('Empty the box and shop make and do new shopping!');
                            }

                        }
                        //$newUser->updateUserDetails($_POST);
                        $this->view->displayOkay = 'Successfully updated!';
                        //Router::redirect('account/details');
                    }
                }
            }
        }


        $this->view->post = $this->view->detail = $user->findById(currentUser()->user_id);

        $this->view->displayErrors = $validation->displayErrors();

        $this->view->render('home/receiverdetails');
    }


    function finishShopping($params)
    {

        $this->saveDetails($params);
        $this->makePayment();
        $this->printRecive();
    }

    public function facturaAction($session)

    {
        $ps = new ShoppedPrds();
        $prds = $ps->getBySession($session);
        $sek = new ShoppedKey();

        $k = $sek->getBySession($session);
        $html = '';
        if ($prds != false) {
            $moeda = MOEDA;
            $dompdf = new DOMPDF();
            $num = $k->shopped_k_id;
            $data = $k->shopped_k_data;
            $foto = 'files/fix/malanza1.png';


            ?>


            <?php

            $html .= "


 <html lang='pt-PT'>



        <body>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>





                <table class='table'>
                <thead>
                <tr>
                    <th scope='col'>N&ordm;</th>
                    <th scope='col'>Designacao</th>
                    <th scope='col'>Quantidade (KG)</th>
                    <th scope='col'>Preço</th>
                    <th scope='col'>Total</th>
                </tr>
                </thead>
                <tbody>
                ";

            $totalg = 0;
            $cont = 0;
            foreach ($prds as $prd) {
                $total = 0;
                $cont++;
                $name = $prd->prd_name;
                $preco = $prd->shopped_p_prc;
                $qt = $prd->shopped_p_qt;
                if ($qt > 0) {
                    if ($prd->m0 != null) {
                        $des = $prd->m0;
                    } elseif ($prd->m1 != null) {
                        $des = $prd->m1;
                    } else {
                        $des = "Unity";
                    }
                    $total = $qt * $preco;
                    $totalg += $total;


                    $cont = ($cont < 10) ? '0' . $cont : $cont;
                    $preco = number_format($preco, 2);
                    $total = number_format($total, 2);

                    $html .= "

                        <tr>
                            <th scope='row'>$cont</th>
                            <td>$name</td>
                            <td>$qt</td>
                            <td>$preco $moeda</td>
                            <th>$total $moeda</th>
                        </tr>
                          ";

                }

            }

            ?>


            <?php
            $tt = number_format($totalg + 10, 2);
            $html .= "</tbody>
            </table>

            <table class='table'>
  <thead>
    <tr>
      <th scope='col'>Subtotal</th>
      <th scope='col'>Transporte</th>
      <th scope='col'>Total a pagar</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td>$totalg  $moeda</td>
      <td>10.00  $moeda</td>
      <td>$tt  $moeda</td>
    </tr>
  </tbody>
</table>


            </body>
            </html>
            "
            ?>

            <?php

// (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'portrait');

            $dompdf->load_html($html);

//Renderizar o html

            $dompdf->render();


            $file_to_save = "files/facturas/" . $session . ".pdf";


            file_put_contents($file_to_save, $dompdf->output());


            $file_to_save = "files/facturas/" . $session . ".pdf";


            /*header('Content-Type: application/pdf');
            header("Content-Disposition: attachment; filename=malanza.pdf");
            set_time_limit(0);
            $file = @fopen($file_to_save, "rb");
            while (!feof($file)) {
                print(@fread($file, 1024 * 8));
                ob_flush();
                flush();
            }*/

        }

        return $session;
    }


    public function invoiceAction($total, $factura, $xxx = false)
    {
        $session = $this->facturaAction($factura);

        $sk = new ShoppedKey();
        $lastS = $sk->getBySession($session);

        Session::set('SLASH', '<p class="btn btn-success">Pedido realizado com sucesso! Entremos em contacto brevemente para confirmar o pedido.</p>');

        Router::redirect('account/statusordered/' . $lastS->shopped_k_id);


    }


    public function makePayment()
    {
        return true;
    }

    private function printRecive()
    {

    }

    public function saveDetails($params)
    {


    }

}