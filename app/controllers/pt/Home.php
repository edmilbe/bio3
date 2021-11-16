

<?php

require_once("files/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

class Home extends  Controller implements InterfaceHome{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    public function langAction($lang){
        Session::set(LANG, $lang);

        Router::redirect('');
    }

    public function indexAction($on = false, $onon = false){
        //var_dump('aquiihi');
        $this->view->on = 0;
        $this->view->onon = 0;
        $this->view->g1 = false;
        if($on == false && $onon == false){
            $shopping = new ShoppingPrds();

            $this->view->items =  $shopping->findByAll();

        }elseif(is_numeric($on) && is_numeric($onon)){
            $shopping = new ShoppingPrds();
            $g1 = new Group1();
            $this->view->on = $on;
            $this->view->onon = $onon;


            $this->view->g1 = $g1->findFirst(['conditions' => 'group1_id = ?', 'bind' => [$onon]]);
            $this->view->items =  $shopping->findByGroups($on, $onon);
        }else{
            //Router::redirect('home/index');
        }

        $this->view->render('home/index');
    }

    public function viewfullAction($on = false){


        $sp = new ShoppingPrds();
        $prds = new Prds();

        $on = sanitize($on);
        if(is_numeric($on)){
            $this->view->item =  $sp->getById($on);
            $this->view->gps = $prds->getByIdGroups1($on);

            if($this->view->item){
                $this->view->fotos = $prds->getPrImages($on);
                $this->view->render('home/viewfull');
            }else{
                $this->view->render('home/index');
            }
        }else{
            $this->view->render('home/index');
        }

    }

    public function boxAction(){

        $prds = new Prds();

        $this->view->items = $prds->box();

        $this->view->render('home/box');
    }
    public function gr1Action(){
        $prds = new Group1();

        $this->view->items = $prds->getAllGr1();
        $this->view->render('home/gr1');

    }
    public function gr2Action($g1 = 0){
        $prds = new Group2();
        $g1 = sanitize($g1);
        if($g1 != 0){
            $this->view->g1 = $g1;
            $this->view->items = $prds->getAllGr2($g1);
        }else{
            $this->view->g1 = 0;
            $this->view->items = $prds->getAllGr2();

        }

        //$this->view->items = $prds->getAllGr2();
        $this->view->render('home/gr2');

    }

    public function closeboxAction(){
        if(currentUser()){
            Router::redirect('home/receiver');
        }else{
            Router::redirect('register/login');
        }
    }

    public function receiverAction(){
        $validation = new Validate();



        $posted_values = [
            'name'     => '', 'tel'  =>'','address' => ''
        ];
        $this->view->displayOkay = '';
        $user = new Users();
        if(Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    $posted_values = posted_values($_POST);
                    $validation->check($_POST, [
                        'name' => [
                            'display' => 'Nome',
                            'require' => true
                        ],
                        'tel' => [
                            'display' => 'Numero de telefone',
                            'require' => true,
                            'unique_update' => ['tels_user','tel_u_name','tel_u_user', currentUser()->user_id]
                        ],
                        'address' => [
                            'display' => 'Endereço',
                            'require' => true
                        ]
                    ]);
                    if ($validation->passed()) {
                        $newUser = new Users();
                        $prd = new Prds();
                        $box = $prd->box();
                        if($box != false){
                            if($prd->verificaPreco($box)){
                                //$this->finishShopping($_POST);
                                $sik = new ShoppingKey();
                                $sik->saveDetails($_POST);

                                //$box = $prd->box();
                                $sek = new ShoppedKey();


                                $id = $sek->saveDetails($_POST, $box);


                                if($id){
                                    $sep = new ShoppedPrds();
                                    $this->view->total = $total = $sep->getTotalByKeyId($id);
                                    $this->view->recive = $factura =  Session::ReturnSession();

                                    $sik->NewShoppingKey();

                                    Router::redirect('home/invoice/' . $total . '/'.$factura);
                                }




                            }else{
                                $validation->addError('Esvazie o seu carrinho e faça uma nova compra!');
                            }

                        }
                        //$newUser->updateUserDetails($_POST);
                        $this->view->displayOkay = 'Atualizado com sucesso!';
                        //Router::redirect('account/details');
                    }
                }
            }
        }



        $this->view->post = $this->view->detail = $user->findById(currentUser()->user_id);

        $this->view->displayErrors = $validation->displayErrors();

        $this->view->render('home/receiverdetails');
    }



    function finishShopping($params){

        $this->saveDetails($params);
        $this->makePayment();
        $this->printRecive();
    }

    public function facturaAction($session){
        $ps = new ShoppedPrds();
        $prds = $ps->getBySession($session);
        $sek = new ShoppedKey();

        $k = $sek->getBySession($session);
        if($prds != false){
            $dompdf = new DOMPDF();
            $num = $k->shopped_k_id;
            $data = $k->shopped_k_data;
            $foto = 'files/2x_feito/2x_shop_em_baixo1.jpg';
            $html = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Malanza Factura</title>
         <style>

                .fac-logo img{
                    width: 100%;
                    max-width: 200px;
                    display: block;
                    height: auto;
                    margin: 0 auto;

                }
                .fac-cab-3{

                    width: 90%;
                    max-width: 200px;
                    text-align: left;

                }
                .fac-total{
                    text-align: right;
                }
                .fac-cab-3 img{
                    width: 100%;
                    max-width: 60px;
                    display: block;
                    height: auto;
                    margin: 0 auto;
                }
                .fac-pr-tb{
                    width: 100%;
                    max-width: 600px;
                    margin: 0 auto;
                }
                .fac-pr-tb td,.fac-pr-tb th{
                    border: 1px solid #D5C7A4;

                }
                .fac-pr-tb th{
                    text-align: center;

                }
                .facs{
                    text-align: center;
                }
                .fac-pr-tb-b td, .fac-pr-tb-b th{
                    text-align: center;
                }

                .fac-pr-tb-t td, .fac-pr-tb-t th{
                    text-align: left;
                }
                .fac-pr-tb-t {

                }
                .fac-pr-tb-b td,.fac-pr-tb-b th,  .fac-pr-tb-t td,.fac-pr-tb-t th {
                    border: none;
                }


            </style>
</head>
<body>

<div class='facs'>


                <table class='fac-pr-tb fac-pr-tb-t'>
                    <tr>
                        <td rowspan='2' class='fac-logo'><img src=$foto></td>
                        <td>Factura N&ordm;</td>
                        <td>Data</td>
                        <td>Estado</td>
                    </tr>
                    <tr>

                        <td>$num</td>
                        <td>$data</td>
                        <td>Pago</td>
                    </tr>


                </table>


                <h2>Itens</h2>
                <table class='fac-pr-tb' cellspacing='0'>
                    <tr>
                        <th>N&ordm;</th>
                        <th>Item</th>
                        <th>Pre&ccedil;o</th>
                        <th>Qtd.</th>
                        <th>Designa&ccedil;&atilde;o</th>
                        <th>Total</th>
                    </tr>";

            $totalg = 0;$cont = 0;
            foreach($prds as $prd){
                $total = 0;$cont++;
                $name = $prd->prd_name;
                $preco = $prd->shopped_p_prc;
                $qt = $prd->shopped_p_qt;
                if($prd->m0 != null){
                    $des = $prd->m0;
                }elseif($prd->m1 != null){
                    $des = $prd->m1;
                }else{
                    $des = "Unidade";
                }
                $total = $qt * $preco;
                $totalg += $total;

                $html .= "
                        <tr>
                            <td>"; $x = ($cont >= 10) ? '0'.$cont : "00".$cont; $html .= "$x</td>
                            <td>$name</td>
                            <td>$preco DBS</td>
                            <td>$qt</td>
                            <td>$des</td>
                            <th class='fac-total'>$total DBS</th>
                        </tr>";

            }
            $html .= "</table>";




            $html .= "
                <h3>Total: $totalg DBS</h3>
                <table class='fac-pr-tb fac-pr-tb-b' cellspacing='0'>
                    <tr>

                        <th>Assinatura da Loja</th>

                        <th>Assinatura do Comprador(a)</th>

                    </tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>
                    <tr><td></td></tr>

                    <tr>

                        <td>_____________________</td>

                        <td>_____________________</td>

                    </tr>

                </table>
            </div>


</body>
</html>";

            //echo $html;
            /**/
//echo $html;


            $dompdf->load_html($html);

//Renderizar o html

            $dompdf->render();


            $file_to_save = "files/facturas/" . $session . ".pdf";




            file_put_contents($file_to_save, $dompdf->output());


            $file_to_save =  "files/facturas/" . $session . ".pdf";



            header('Content-Type: application/pdf');
            header("Content-Disposition: attachment; filename=malanza.pdf");
            set_time_limit(0);
            $file = @fopen($file_to_save, "rb");
            while(!feof($file)) {
                print(@fread($file, 1024*8));
                ob_flush();
                flush();
            }

        }

    }


    public function invoiceAction($total, $factura, $xxx = false){
        //var_dump($factura);
        if($xxx == false){
            $this->view->total = sanitize($total);
            $this->view->recive = $factura;
            $this->view->render('home/invoice');
        }else{
            $this->facturaAction($factura);
        }


    }


    public function makePayment(){
        return true;
    }

    private function printRecive(){

    }
    public function saveDetails($params){





    }

}