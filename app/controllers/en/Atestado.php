<?php

require_once("files/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

class Atestado extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

    }

    public function indexAction($page = 1, $atestado = -1)
    {

        if(!is_numeric($page) ){
            $page = 1;
        }

        $this->view->atestadon = $atestado;

        $Atestados = new Atestados();
        $this->view->atestado_view = false;
        if($atestado != -1){
            $this->view->atestado_view = $Atestados->findAtestado($atestado);
        }



        $total = $Atestados->RowsNumber( 'atestado_state', '4');
        $this->view->total_pages = ceil($total != 0 ? $total : 5 / 5);

        $this->view->pageno = $page;

        $this->view->atestado = $Atestados->findAtestados($page, 5, 'atestado_state', '4');

        //$this->view->atestado;






        //dnd(sanitize(Date("d"))) ;
        $this->view->render('atestado/index');
    }

    public function pendentesAction($page = 1, $atestado = -1)
    {

        if(!is_numeric($page) ){
            $page = 1;
        }


        //var_dump($page);





        $this->view->atestadon = $atestado;

        $Atestados = new Atestados();
        $this->view->atestado_view = false;

        if($atestado != -1){
            $this->view->atestado_view = $Atestados->findAtestado($atestado);
            //dnd($this->view->atestado_view);
            //$this->view->atestado_view = $this->view->atestado_view != false ? $this->view->atestado_view[0]:false;

        }

        $total = $Atestados->RowsNumber( 'atestado_state', '1');
        $this->view->total_pages = ceil($total != 0 ? $total : 5 / 5);

        $this->view->pageno = $page;



        $this->view->atestado = $Atestados->findAtestados($page, 5, 'atestado_state', '1');

        //$this->view->atestado;

        //dnd(sanitize(Date("d"))) ;
        $this->view->render('atestado/pendentes');
    }


    public function closedAction($page = 1, $atestado = -1)
    {

        if(!is_numeric($page) ){
            $page = 1;
        }

        $this->view->atestadon = $atestado;

        $Atestados = new Atestados();
        $this->view->atestado_view = false;
        if($atestado != -1){
            $this->view->atestado_view = $Atestados->findAtestado($atestado);
        }

        $total = $Atestados->RowsNumber( 'atestado_state', '3');
        $this->view->total_pages = ceil($total != 0 ? $total : 5 / 5);

        $this->view->pageno = $page;

        $this->view->atestado = $Atestados->findAtestados($page, 5, 'atestado_state', '3');

        //$this->view->atestado;






        //dnd(sanitize(Date("d"))) ;
        $this->view->render('atestado/closeds');
    }


    public function buscarAction()
    {

        $Anos = new Anos();



        //dnd(sanitize(Date("d"))) ;
        $this->view->render('atestado/buscar');
    }




    public function style(){
        $style = "
        <style>
        body{
            padding: 20px;

        }

        .name{
            font-weight: bold;
        }

        h1{
            text-align: center;
        }
        p{
            text-align: justify;
            font-size: 14.1pt;
        }


        .p-center{
            text-align: center;
        }
        .p-left{
            text-indent: 0;
            text-align: justify;
            font-size: 14pt;
        }
        .tittle{
        font-size: 13pt;
        }
        #p-flex{
             font-size: 12pt;
        }






         .ctable{
            width: 100%;
        }
        .ctable__row{
            width: 100%;
        }
        .ctable__d{
            text-align: center;

        }
        .ctable__d--40{
            width: 45%;
        }
        .ctable__d--20{
            width: 10%;
        }
        .ctable__d--right{

            text-align: right;

        }
        .ctable__d--left{
            text-align: left;
        }
        .ctable__d--img{
            width: 40px;
            height: auto;
        }



        .contas{
        text-align: right;
        }


        .conta__table{
            width: 40%;
            float: right;



        }
        .conta__table__row{

        }
        .conta__table__th{

        }
        .conta__table__th--head{
            font-weight: 700;
            text-align: center;
        }
        .conta__table__th--title{
            font-weight: 400;
        }
        .conta__table__th--value{
            text-align: right;
            padding: 0;
        }

        .clear{
            clear: right;
        }

    </style>



         ";

        return $style;
    }


    public function head(){

        $img = ROOT.'/files/fix/brasao.png';
        $text = "
<table class='ctable'>
    <tr class='ctable__row'>
        <td class='ctable__d ctable__d--40 ctable__d--right '>República Democrática</td>
        <td class='ctable__d ctable__d--20'>
            <img class='ctable__d--img' src='$img' alt='Brasao'>
        </td>
        <td class='ctable__d ctable__d--40 ctable__d--left'>de S. Tomé e Príncipe</td>
    </tr>
    <tr>
        <td colspan='3' class='ctable__d'>CÂMARA DISTRITAL DE MÉ ZÓCHI
        </td>

    </tr>
    <tr>
        <td colspan='3' class='ctable__d'>(Unidade – Disciplina – Trabalho)

        </td>
    </tr>
</table>
";
        return $text;
    }

    public function conta($value = 23) {

        if($value <= 21)
        {
            $Atestados = new AtestadoTypes();

            $value =  $Atestados->findFirst(
                [
                    'conditions' => 'type_id = ?',
                    'bind' => [$value],

                ]
            )->type_price;
        }



        $Total = 0;


        $Total += $Rasa = 5;
        $Total += $Selo = 10;
        $Total += $Imposto = ($value - (10)) * 0.1;
        $Total += $Emolumento = ($value - 10) - $Rasa - $Imposto;


        $Emolumento = number_format($Emolumento,2);
        $Rasa = number_format($Rasa , 2);
        $Selo = number_format($Selo,2);
        $Imposto = number_format($Imposto, 2);

        $F = new NumberFormatter("pt",NumberFormatter::SPELLOUT);
        $Extenso = ucfirst($F->format($Total));
        $Total = number_format($Total, 2);

        ?>

        <?php


        return "
        <div class='contas'>
        <table class='conta__table'>
            <tr class='conta__table__row'>
                <td class='conta__table__th text-center' style='text-align: center' colspan='2' >Conta</td>
            </tr>
            <tr class='conta__table__row'>
                <td class='conta__table__th'>Emolumentos</td>
                <td class='conta__table__th'>$Emolumento dbs</td>
            </tr>
            <tr class='conta__table__row'>
                <td class='conta__table__th'>Imp Esp.</td>
                <td class='conta__table__th'>$Imposto dbs</td>
            </tr>
            <tr class='conta__table__row'>
                <td class='conta__table__th'>Rasa</td>
                <td class='conta__table__th'>$Rasa dbs</td>
            </tr>
            <tr class='conta__table__row'>
                <td class='conta__table__th'>Selo</td>
                <td class='conta__table__th'>$Selo dbs</td>
            </tr>
            <tr class='conta__table__row'>
                <td class='conta__table__th'>Total</td>
                <td class='conta__table__th'>$Total dbs</td>
            </tr>
            <tr class='conta__table__row'>
                <td class='conta__table__th text-center' style='text-align: center' colspan='2'>($Extenso dobras)</td>
            </tr>
        </table>
        </div>
        <div class='clear'>
        </div>



        ";
    }

    private function footer(){
        return "<br>
    <br>
    <p class='p-center'>
    O Presidente
    <br>
    <br>
    <br>
Américo da Conceição Fernandes de Ceita</p>
    ";
    }

    private function presidente(){
        return "AMÉRICO DA CONCEIÇÃO FERNANDES DE CEITA";
    }

    private function textoFinal(){
        return
        "
        ----------Por ser verdade e ter sido requerido, mandou passar o
        presente Atestado que, assina, sendo a sua assinatura autenticada com o carimbo em uso nesta Câmara.----------------------------------------------------------------------------------------------------


        ";
    }

    private function data($atestado_dia,$atestado_mes, $atestado_year){
        return
        "----------Câmara Distrital de Mé-Zóchi, na Cidade da Trindade, aos  $atestado_dia de $atestado_mes de $atestado_year.
        ------------------------------------------------------------------------------
        ";
    }


    public function createAction()
    {


        //dnd(GetFromStamp("2020-12-15 06:10:00", 'd'));



        $posted_values2 = [
            'atestado_bi_number' => '',
            'atestado_type' => ''
        ];


        //dnd($_POST);
        $this->view->displayErrors2 = "";
        $this->view->displayErrors = "";

        $validation = new Validate();
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values = posted_values($_POST);

                    $validation->check($_POST, [

                        'atestado_bi_number' => [
                            'display' => 'número de BI',
                            'require' => true,
                            'selected' => ['bis', 'bi_number']
                        ],
                        'atestado_type' => [
                            'display' => 'tipo de atestado',
                            'require' => true,
                            'min-value' => 1,
                            'max-value' => 21,
                        ]
                    ]);


                    if ($validation->passed()) {

                        $type = Input::get('atestado_type');
                        //dnd($type);
                        $bi = Input::get('atestado_bi_number');

                        switch ($type) {
                            case 1:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;
                            case 2:
                                Router::redirect('atestado/newatestado3/' . $bi. "/" .$type);
                                break;
                            case 3:
                                Router::redirect('atestado/newatestado2/' . $bi. "/" .$type);
                                break;
                            case 4:
                                Router::redirect('atestado/newatestado3/' . $bi. "/" .$type);
                                break;
                            case 5:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;
                            case 6:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;
                            case 7:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;
                            case 8:
                                Router::redirect('atestado/newatestado3/' . $bi. "/" .$type);
                                break;
                            case 9:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;
                            case 10:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;
                            case 11:
                                Router::redirect('atestado/newatestado4/' . $bi. "/" .$type);
                                break;
                            case 12:
                                Router::redirect('atestado/newatestado5/' . $bi. "/" .$type);
                                break;
                            case 13:
                                Router::redirect('atestado/newatestado6/' . $bi. "/" .$type);
                                break;
                            case 14:
                                Router::redirect('atestado/newtransfer/' . $bi);
                                break;
                            case 15:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;

                            case 18:
                                Router::redirect('atestado/newatestado7/' . $bi. "/" .$type);
                                break;
                            case 17:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;
                            case 16:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;
                            case 19:
                                Router::redirect('atestado/newatestado8/' . $bi. "/" .$type);
                                break;
                            case 20:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;
                            case 21:
                                Router::redirect('atestado/newatestado1/' . $bi. "/" .$type);
                                break;

                        }
                    } else {
                        $this->view->displayErrors = $validation->displayErrors();

                    }
                }
            }
        }


        $AtestadoTypes = new AtestadoTypes();


        $this->view->types = $AtestadoTypes->find([]);






        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        //dnd(  $this->view->token);
        $this->view->render('atestado/create');


    }

    public function updateAction()
    {


        //dnd(GetFromStamp("2020-12-15 06:10:00", 'd'));


        $Bis = new Bis();


        //dnd($_POST);
        $this->view->displayErrors = "";

        $validation = new Validate();
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values = posted_values($_POST);

                    $validation->check($_POST, [

                        'atestado_bi_number' => [
                            'display' => 'número de BI',
                            'require' => true
                        ],
                        'atestado_number' => [
                            'display' => 'número de Atestado',
                            'require' => true,
                            'atestado' => ['atestados', 'atestado_id']
                        ],
                        'atestado_type' => [
                            'display' => 'tipo de atestado',
                            'require' => true,
                            'min-value' => 1,
                            'max-value' => 21,
                        ]
                    ]);


                    if ($validation->passed()) {


                        $Atestados = new Atestados();
                        $result = $Atestados->findFirst([

                            'conditions' => 'atestado_id = ? ', 'bind' => [
                                sanitize(Input::get('atestado_number'))]


                        ]);

                        if ($result->atestado_id) {
                            $type = Input::get('atestado_type');
                            $bi = Input::get('atestado_bi_number');
                            switch ($type) {
                                case 1:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 2:
                                    Router::redirect('atestado/updateatestado3/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 3:
                                    Router::redirect('atestado/updateatestado2/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 4:
                                    Router::redirect('atestado/updateatestado3/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 5:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 6:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;

                                case 7:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 8:
                                    Router::redirect('atestado/updateatestado3/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 9:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 10:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 11:
                                    Router::redirect('atestado/updateatestado4/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 12:
                                    Router::redirect('atestado/updateatestado5/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 13:
                                    Router::redirect('atestado/updateatestado6/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 14:
                                    Router::redirect('atestado/updatetransfer/' . $bi);
                                    break;
                                case 15:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;

                                case 16:
                                    Router::redirect('atestado/updateatestado7/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 17:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 18:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 19:
                                    Router::redirect('atestado/updateatestado8/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 20:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;
                                case 21:
                                    Router::redirect('atestado/updateatestado1/'. Input::get('atestado_number') . "/" . $bi. "/" .$type);
                                    break;

                            }


                            $Atestado = new Atestados();

                            //$id = $Atestado->updateAtestado($_POST);

                            if (0) {
                                // vai buscar por id e faz a impressao

                                //dnd($Atestado->getById($id));
                                $this->creatAtestadoPDF(0);


                                //Router::redirect('home/done/' . $id);
                            }
                        } else {
                            $this->view->displayErrors = $validation->displayError("Atestado não encontrado");
                        }


                        //$newBi = $Bi->saveBI($_POST);

                        // Router::redirect('home/documents/'.$newBi);


                    } else {
                        $this->view->displayErrors = $validation->displayErrors();

                    }
                }
            }
        }


        $this->view->token = Token::generate();



        $this->view->render('atestado/update');


    }

    public function newbiAction()
    {

        $Bis = new Bis();

        $validation = new Validate();


        $posted_values2 = [
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
                        'bi' => [
                            'display' => 'número de BI',
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
                            'require' => true
                        ]

                    ]);

                    if ($validation->passed()) {

                        $newBi = $Bis->saveBI($_POST);

                        Router::redirect('atestado/create');


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);
        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('bi/new#popup');
    }




    public function newatestado1Action($bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();


        $biss = $bi;
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));
        $this->view->biss = $biss = $Bis->getBIFull(sanitize($biss));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [
            'house' => '',
            'localidade' => ''
        ];

        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();





                        $id = $Atestado->saveAtestado($this->view->bi, sanitize($type));

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            switch ($type) {
                                case 1:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;
                                case 2:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;
                                case 3:
                                    Router::redirect('atestado/newbolsainterna/' . $bi);
                                    break;
                                case 4:
                                    Router::redirect('atestado/newcasamento/' . $bi);
                                    break;
                                case 5:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;
                                case 6:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;
                                case 7:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;
                                case 8:
                                    Router::redirect('atestado/newfixresidencia/' . $bi);
                                    break;
                                case 9:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;
                                case 10:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;
                                case 11:
                                    Router::redirect('atestado/newjustica/' . $bi);
                                    break;
                                case 12:
                                    Router::redirect('atestado/newpersemorte/' . $bi);
                                    break;
                                case 13:
                                    Router::redirect('atestado/newsubtransporte/' . $bi);
                                    break;
                                case 14:
                                    Router::redirect('atestado/newtransfer/' . $bi);
                                    break;
                                case 15:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;

                                case 16:
                                    Router::redirect('atestado/newagrefam/' . $bi);
                                    break;
                                case 17:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;
                                case 18:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;
                                case 19:
                                    Router::redirect('atestado/newviagem/' . $bi);
                                    break;
                                case 20:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;
                                case 21:
                                    $this->creatAtestado1PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;

                            }








                            $this->view->newatestado = $id;
                            $link = PROOT . "files/atestados/" . $id . ".pdf";

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $this->view->localidades = $Localidades->find([
            'order' => 'localidade_name ASC'
        ]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y'),
            'order' => 'ano_name DESC'
            ]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = $Localidades->getName($bi->bi_nasc_loc)->localidade_name;
        $bi->bi_emi_mes = $Meses->getName($bi->bi_emi_mes);
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/01-newatestado');





    }
    public function newatestado2Action($bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();


        $biss = $bi;
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));
        $this->view->biss = $biss = $Bis->getBIFull(sanitize($biss));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [
            'house' => '',
            'localidade' => '',
            'entidade' => '',
            'univer' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'entidade' => [
                            'display' => 'entidade',
                            'require' => true,
                            'selected' => ['entidades', 'entidade_id']
                        ],
                        'univer' => [
                            'display' => 'universidade',
                            'require' => true,
                            'selected' => ['univers', 'univer_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();





                        $id = $Atestado->saveAtestado($this->view->bi, sanitize($type));

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            switch ($type) {

                                case 3:
                                    $this->creatAtestado2PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;

                            }








                            $this->view->newatestado = $id;
                            $link = PROOT . "files/atestados/" . $id . ".pdf";

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Univers = new Univers();
        $this->view->univers = $Univers->find([

            'order' => 'univer_name ASC'
        ]);


        $Entidades = new Entidades();
        $this->view->entidades = $Entidades->find([
            'order' => 'entidade_name ASC'
        ]);



        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([
            'order' => 'localidade_name ASC'
        ]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = $Localidades->getName($bi->bi_nasc_loc)->localidade_name;
        $bi->bi_emi_mes = $Meses->getName($bi->bi_emi_mes);
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/02-newatestado');




    }
    public function newatestado3Action($bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();


        $biss = $bi;
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));
        $this->view->biss = $biss = $Bis->getBIFull(sanitize($biss));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [
            'house' => '',
            'localidade' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();





                        $id = $Atestado->saveAtestado($this->view->bi, sanitize($type));

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            switch ($type) {
                                case 2:
                                    $this->creatAtestado3PDF($_POST, $id, $biss, $this->view->name, $type);
                                    break;
                                case 4:
                                    $this->creatAtestado3PDF($_POST, $id, $biss, $this->view->name, $type);
                                    break;
                                case 8:
                                    $this->creatAtestado3PDF($_POST, $id, $biss, $this->view->name, $type);
                                    break;

                            }








                            $this->view->newatestado = $id;
                            $link = PROOT . "files/atestados/" . $id .".pdf";

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Univers = new Univers();
        $this->view->univers = $Univers->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([
            'order' => 'localidade_name ASC'
        ]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = $Localidades->getName($bi->bi_nasc_loc)->localidade_name;
        $bi->bi_emi_mes = $Meses->getName($bi->bi_emi_mes);
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/03-newatestado');




    }
    public function newatestado4Action($bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();


        $biss = $bi;
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));
        $this->view->biss = $biss = $Bis->getBIFull(sanitize($biss));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [
            'house' => '',
            'localidade' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();





                        $id = $Atestado->saveAtestado($this->view->bi, sanitize($type));

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            switch ($type) {

                                case 11:
                                    $this->creatAtestado4PDF($_POST, $id, $biss, $this->view->name, sanitize($type));
                                    break;

                            }








                            $this->view->newatestado = $id;
                            $link = PROOT . "files/atestados/" . $id .".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();


        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([
            'order' => 'localidade_name ASC'
        ]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = $Localidades->getName($bi->bi_nasc_loc)->localidade_name;
        $bi->bi_emi_mes = $Meses->getName($bi->bi_emi_mes);
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/04-newatestado');




    }
    public function newatestado5Action($bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();


        $biss = $bi;
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));
        $this->view->biss = $biss = $Bis->getBIFull(sanitize($biss));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [
            'nome-1' => '',
            'instituicao' => '',

            'house' => '',
            'localidade' => '',

            'nome-2' => '',
            'localidade-2' => '',
            'desde' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'nome-1' => [
                            'display' => 'nome do funcinário',
                            'require' => true
                        ],
                        'instituicao' => [
                            'display' => 'instituição de funcionamento',
                            'require' => true
                        ],
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'nome-2' => [
                            'display' => 'nome do companheiro',
                            'require' => true
                        ],
                        'localidade-2' => [
                            'display' => 'localidade de nascimento do companheiro',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();





                        $id = $Atestado->saveAtestado($this->view->bi, sanitize($type));

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            switch ($type) {

                                case 12:
                                    $this->creatAtestado5PDF($_POST, $id, $biss, $this->view->name, $type);
                                    break;

                            }








                            $this->view->newatestado = $id;
                            $link = PROOT . "files/atestados/" . $id .".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();


        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([
            'order' => 'localidade_name ASC'
        ]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = $Localidades->getName($bi->bi_nasc_loc)->localidade_name;
        $bi->bi_emi_mes = $Meses->getName($bi->bi_emi_mes);
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/05-newatestado');




    }
    public function newatestado6Action($bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();


        $biss = $bi;
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));
        $this->view->biss = $biss = $Bis->getBIFull(sanitize($biss));
        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [

            'house' => '',
            'localidade' => '',
            'servico' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                                                'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'servico' => [
                            'display' => 'entidade empregadora',
                            'require' => true
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();





                        $id = $Atestado->saveAtestado($this->view->bi, sanitize($type));

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            switch ($type) {

                                case 13:
                                    $this->creatAtestado6PDF($_POST, $id, $biss, $this->view->name, $type);
                                    break;

                            }








                            $this->view->newatestado = $id;
                            $link = PROOT . "files/atestados/" . $id;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();


        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([
            'order' => 'localidade_name ASC'
        ]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = $Localidades->getName($bi->bi_nasc_loc)->localidade_name;
        $bi->bi_emi_mes = $Meses->getName($bi->bi_emi_mes);
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/06-newatestado');




    }
    public function newatestado7Action($bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();

        $biss = $bi;
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));
        $this->view->biss = $biss = $Bis->getBIFull(sanitize($biss));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [


            'house' => '',
            'localidade' => '',



            'desde' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                                                'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'desde' => [
                            'display' => 'tempo',
                            'require' => true
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();





                        $id = $Atestado->saveAtestado($this->view->bi, sanitize($type));

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            switch ($type) {

                                case 18:
                                    $this->creatAtestado7PDF($_POST, $id, $biss, $this->view->name, $type);
                                    break;

                            }








                            $this->view->newatestado = $id;
                            $link = PROOT . "files/atestados/" . $id .".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([
            'order' => 'localidade_name ASC'
        ]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = $Localidades->getName($bi->bi_nasc_loc)->localidade_name;
        $bi->bi_emi_mes = $Meses->getName($bi->bi_emi_mes);
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/07-newatestado');




    }

    public function GetAtestadoName($type){

        $AtestadoTypes = new AtestadoTypes();

        $result = $AtestadoTypes->findFirst([
            'conditions' => ['type_id = ?'],
            'bind' => [$type]
        ]);
        if($result){
            return $result->type_name;
        }
        return null;
    }
    public function newatestado8Action($bi, $type)
    {

        dnd(1);

        $Bis = new Bis();

        $validation = new Validate();


        $biss = $bi;
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));
        $this->view->biss = $biss = $Bis->getBIFull(sanitize($biss));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [


            'house' => '',
            'localidade' => '',

            'pais' => '',
            'nome-2' => '',
            'localidade-2' => '',
            'desde' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'pais' => [
                            'display' => 'país',
                            'require' => true,
                            'selected' => ['countries', 'country_id']
                        ],
                        'nome-2' => [
                            'display' => 'nome do companheiro',
                            'require' => true
                        ],
                        'localidade-2' => [
                            'display' => 'localidade de nascimento do companheiro',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'desde' => [
                            'display' => 'tempo',
                            'require' => true,

                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();





                        $id = $Atestado->saveAtestado($this->view->bi, sanitize($type));

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            switch ($type) {

                                case 19:
                                    $this->creatAtestado8PDF($_POST, $id, $biss, $this->view->name, $type);
                                    break;

                            }








                            $this->view->newatestado = $id;
                            $link = PROOT . "files/atestados/" . $id .".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Univers = new Univers();
        $this->view->univers = $Univers->find([]);
        $this->view->dias = $Dias->find([]);
        $Countries = new Countries();
        $this->view->countries = $Countries->find([]);

        $this->view->localidades = $Localidades->find([
            'order' => 'localidade_name ASC'
        ]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = $Localidades->getName($bi->bi_nasc_loc)->localidade_name;
        $bi->bi_emi_mes = $Meses->getName($bi->bi_emi_mes);
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/08-newatestado');




    }




    public function updateatestado1Action($atestado,$bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();

        $Atestado = new Atestados();


        $atestado = $this->view->atestado = sanitize($atestado);


        $result = $Atestado->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [sanitize($atestado)]]
        );


        if (!$result->atestado_id) {

            Router::redirect('atestado/create');

        }
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [
            'house' => '',
            'localidade' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);
        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');



                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($this->view->bi, sanitize($type), $atestado);

                        if ($atestado > 0) {
                            //dnd($this->view->bis);
                            $this->creatAtestado1PDF($_POST, $atestado, $bi,$this->view->name, sanitize($type));


                            $this->view->newatestado = $atestado;
                            $link = PROOT . "files/atestados/" . $atestado .".pdf";

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $atestado. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/01-updateatestado');
    }
    public function updateatestado2Action($atestado,$bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();
        $Atestado = new Atestados();


        $atestado = $this->view->atestado = sanitize($atestado);


        $result = $Atestado->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [sanitize($atestado)]]
        );


        if (!$result->atestado_id) {

            Router::redirect('atestado/create');

        }

        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [
            'house' => '',
            'localidade' => '',
            'univer' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'univer' => [
                            'display' => 'universidade',
                            'require' => true,
                            'selected' => ['univers', 'univer_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($this->view->bi, sanitize($type), $atestado);

                        if ($atestado > 0) {
                            //dnd($this->view->bis);
                            $this->creatAtestado2PDF($_POST, $atestado, $bi,$this->view->name, sanitize($type));


                            $this->view->newatestado = $atestado;
                            $link = PROOT . "files/atestados/" . $atestado.".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $atestado. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Univers = new Univers();
        $this->view->univers = $Univers->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/02-updateatestado');




    }
    public function updateatestado3Action($atestado,$bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();

        $Atestado = new Atestados();


        $atestado = $this->view->atestado = sanitize($atestado);


        $result = $Atestado->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [sanitize($atestado)]]
        );


        if (!$result->atestado_id) {

            Router::redirect('atestado/create');

        }
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [
            'house' => '',
            'localidade' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);
        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($this->view->bi, sanitize($type), $atestado);

                        if ($atestado > 0) {
                            //dnd($this->view->bis);
                            $this->creatAtestado3PDF($_POST, $atestado, $bi,$this->view->name, sanitize($type));


                            $this->view->newatestado = $atestado;
                            $link = PROOT . "files/atestados/" . $atestado.".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $atestado. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }



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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Univers = new Univers();
        $this->view->univers = $Univers->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/03-updateatestado');




    }
    public function updateatestado4Action($atestado,$bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();

        $Atestado = new Atestados();


        $atestado = $this->view->atestado = sanitize($atestado);


        $result = $Atestado->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [sanitize($atestado)]]
        );


        if (!$result->atestado_id) {

            Router::redirect('atestado/create');

        }
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [
            'house' => '',
            'localidade' => '',
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($this->view->bi, sanitize($type), $atestado);

                        if ($atestado > 0) {
                            //dnd($this->view->bis);
                            $this->creatAtestado4PDF($_POST, $atestado, $bi,$this->view->name, sanitize($type));


                            $this->view->newatestado = $atestado;
                            $link = PROOT . "files/atestados/" . $atestado.".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $atestado. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }

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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Univers = new Univers();
        $this->view->univers = $Univers->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/04-updateatestado');




    }
    public function updateatestado5Action($atestado,$bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();
        $Atestado = new Atestados();


        $atestado = $this->view->atestado = sanitize($atestado);


        $result = $Atestado->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [sanitize($atestado)]]
        );


        if (!$result->atestado_id) {

            Router::redirect('atestado/create');

        }

        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [
            'nome-1' => '',
            'instituicao' => '',

            'house' => '',
            'localidade' => '',

            'nome-2' => '',
            'localidade-2' => '',
            'desde' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'nome-1' => [
                            'display' => 'nome do funcinário',
                            'require' => true
                        ],
                        'instituicao' => [
                            'display' => 'instituição de funcionamento',
                            'require' => true
                        ],
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'nome-2' => [
                            'display' => 'nome do companheiro',
                            'require' => true
                        ],
                        'localidade-2' => [
                            'display' => 'localidade de nascimento do companheiro',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($this->view->bi, sanitize($type), $atestado);

                        if ($atestado > 0) {
                            //dnd($this->view->bis);
                            $this->creatAtestado5PDF($_POST, $atestado, $bi,$this->view->name, sanitize($type));


                            $this->view->newatestado = $atestado;
                            $link = PROOT . "files/atestados/" . $atestado.".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $atestado. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }



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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Univers = new Univers();
        $this->view->univers = $Univers->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();

        $bi->bi_estado = $bi->bi_estado == 1 ? "solteir".$oa:($bi->bi_estado == 2 ? "casad".$oa:($bi->bi_estado == 3 ? "divociad".$oa:($bi->bi_estado == 4 ? "viúv".$oa:("em comunhão de factos"))));
        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/05-updateatestado');




    }
    public function updateatestado6Action($atestado,$bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();

        $Atestado = new Atestados();


        $atestado = $this->view->atestado = sanitize($atestado);


        $result = $Atestado->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [sanitize($atestado)]]
        );


        if (!$result->atestado_id) {

            Router::redirect('atestado/create');

        }
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [

            'house' => '',
            'localidade' => '',
            'servico' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'servico' => [
                            'display' => 'entidade empregadora',
                            'require' => true
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($this->view->bi, sanitize($type), $atestado);

                        if ($atestado > 0) {
                            //dnd($this->view->bis);
                            $this->creatAtestado6PDF($_POST, $atestado, $bi,$this->view->name, sanitize($type));


                            $this->view->newatestado = $atestado;
                            $link = PROOT . "files/atestados/" . $atestado.".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $atestado. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }



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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Univers = new Univers();
        $this->view->univers = $Univers->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/06-updateatestado');




    }
    public function updateatestado7Action($atestado,$bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();

        $Atestado = new Atestados();


        $atestado = $this->view->atestado = sanitize($atestado);


        $result = $Atestado->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [sanitize($atestado)]]
        );


        if (!$result->atestado_id) {

            Router::redirect('atestado/create');

        }
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [


            'house' => '',
            'localidade' => '',
            'desde' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'desde' => [
                            'display' => 'tempo',
                            'require' => true
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($this->view->bi, sanitize($type), $atestado);

                        if ($atestado > 0) {
                            //dnd($this->view->bis);
                            $this->creatAtestado7PDF($_POST, $atestado, $bi,$this->view->name, sanitize($type));


                            $this->view->newatestado = $atestado;
                            $link = PROOT . "files/atestados/" . $atestado.".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $atestado. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }



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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Univers = new Univers();
        $this->view->univers = $Univers->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/07-updateatestado');




    }
    public function updateatestado8Action($atestado,$bi, $type)
    {

        $Bis = new Bis();

        $validation = new Validate();

        $Atestado = new Atestados();


        $atestado = $this->view->atestado = sanitize($atestado);


        $result = $Atestado->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [sanitize($atestado)]]
        );


        if (!$result->atestado_id) {

            Router::redirect('atestado/create');

        }
        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;
        $this->view->type = $type;



        $posted_values2 = [


            'house' => '',
            'localidade' => '',

            'pais' => '',
            'nome-2' => '',
            'localidade-2' => '',
            'desde' => ''
        ];


        $this->view->name =  $this->GetAtestadoName($type);

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'pais' => [
                            'display' => 'país',
                            'require' => true,
                            'selected' => ['countries', 'country_id']
                        ],
                        'nome-2' => [
                            'display' => 'nome do companheiro',
                            'require' => true
                        ],
                        'localidade-2' => [
                            'display' => 'localidade de nascimento do companheiro',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'desde' => [
                            'display' => 'tempo',
                            'require' => true,

                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($this->view->bi, sanitize($type), $atestado);

                        if ($atestado > 0) {
                            //dnd($this->view->bis);
                            $this->creatAtestado8PDF($_POST, $atestado, $bi,$this->view->name, sanitize($type));


                            $this->view->newatestado = $atestado;
                            $link = PROOT . "files/atestados/" . $atestado.".pdf";;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $atestado. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }



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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Univers = new Univers();
        $this->view->univers = $Univers->find([]);
        $this->view->dias = $Dias->find([]);
        $Countries = new Countries();
        $this->view->countries = $Countries->find([]);

        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $oa = $bi->bi_sexo  == 1 ? "o" : "a";
        $Estado = new Estados();
        $bi->bi_estado =  $dados['estado'] = $Estado->getName($bi->bi_estado)->estado_name;


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        $num = $type < 10? "0".$type : $type;
        $this->view->render('atestado/08-updateatestado');

    }






    private function creatAtestado1PDF($params, $id, $bi, $name, $type)

    {




        $Atestados = new Atestados();
        $Bis = new Bis();
        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();



        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;


        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;



        $atestado_casa = $this->setCasa($params['house']);


        $atestado = $Atestados->getAtestadoToPdf($Atestados->getById($id));


        $atestado_id = $atestado->atestado_id;
        $atestado_dia = $atestado->ext_atestado_dia;
        $atestado_year = $atestado->ext_atestado_year;
        $atestado_year_number = $atestado->atestado_year;
        $atestado_mes = $atestado->atestado_mes;
        $ext_atestado_dia = $atestado->ext_atestado_dia;
        $ext_atestado_year = $atestado->ext_atestado_year;



        $bi = $Bis->getByToPDF($bi);

        $bi_number = $bi->ext_bi_number;
        $bi_name = $bi->bi_name;
        $bi_pai = $bi->bi_pai;
        $bi_mae = $bi->bi_mae;
        $bi_nasc_dia = $bi->ext_bi_nasc_dia;
        $bi_nasc_mes = $bi->bi_nasc_mes;
        $bi_nasc_ano = $bi->ext_bi_nasc_ano;


        $bi_nasc_dist = $bi->bi_nasc_dist;
        $bi_nasc_loc = $bi->bi_nasc_loc;

        $bi_emi_dia = $bi->bi_emi_dia;

        $bi_emi_ano = $bi->bi_emi_ano;
        $bi_emi_mes = $bi->bi_emi_mes;

        $bi_emi_dia = $bi->ext_bi_emi_dia;
        $bi_emi_ano = $bi->ext_bi_emi_ano;

        $filho = $bi->bi_filho;
        $nascido = $bi->bi_nascido;

        $estado = $bi->bi_estado;
        $documento = $bi->bi_documento;
        $bi_emi_entidade = $bi->bi_emi_entidade;
        $bi_nasc_pais = $bi->bi_nasc_pais;


        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta($type);

        $footer = $this->footer();
        $presidente = $this->presidente();

        $texto_final = $this->textoFinal();
        $data = $this->data($atestado_dia, $atestado_mes, $atestado_year);

        $tempo = "";
        $fim = "Fins de ";
        if($name == "Bolsa de Estudo"){
            $tempo = " há mais de 3 anos e nos últimos 12 meses";
            $fim = "Efeitos de ";
        }



        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta


<br>
    <p class='tittle'>
     ------------------------------------A T E S T A D O Nº. $atestado_id  /$atestado_year_number.---------------------------------------
         </p>
    <p class='p-left'>
     ----------$presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ ZÓCHI. ----------------------------------------------------------
     </p>

     <p class='p-left'>----------Atesta para $fim $name que, $bi->bi_name, $estado, natural de $bi_nasc_loc,
     $nascido em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae,
     $documento número  $bi_number, passado pelo $bi_emi_entidade, em $bi_emi_dia de $bi_emi_mes de
     $bi_emi_ano, reside efetivamente $atestado_casa, na localidade de $atestado_localidade, Distrito de $atestado_distrito, deste Estado$tempo.
    </p>
    <p class='p-left'>
$texto_final
    </p>
    <p class='p-left'>
        $data
    </p>
    <p>
    $footer

    </p>


</body>
</html>";

        //echo $html;
        /**/
//echo $html;


        $dompdf->load_html($html);

//Renderizar o html

        $dompdf->render();


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        /*header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=malanza.pdf");
        set_time_limit(0);
        $file = @fopen($file_to_save, "rb");
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }*/

        return $atestado;
    }
    private function creatAtestado2PDF($params, $id, $bi, $name, $type)

    {
        //dnd(1);

        $Atestados = new Atestados();
        $Bis = new Bis();
        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Univers = new Univers();
        $Entidades = new Entidades();
        $Meses = new Meses();



        $atestado_casa = $params['house'];

        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;


        $atestado_univer = $Univers->getName($params['univer'])->univer_name;
        $atestado_entidade = $Entidades->getName($params['entidade'])->entidade_name;


        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;

        $atestado_casa = $this->setCasa($params['house']);


        $atestado = $Atestados->getAtestadoToPdf($Atestados->getById($id));


        $atestado_id = $atestado->atestado_id;
        $atestado_dia = $atestado->ext_atestado_dia;
        $atestado_year = $atestado->ext_atestado_year;
        $atestado_year_number = $atestado->atestado_year;
        $atestado_mes = $atestado->atestado_mes;
        $ext_atestado_dia = $atestado->ext_atestado_dia;
        $ext_atestado_year = $atestado->ext_atestado_year;



        $bi = $Bis->getByToPDF($bi);

        $bi_number = $bi->ext_bi_number;
        $bi_name = $bi->bi_name;
        $bi_pai = $bi->bi_pai;
        $bi_mae = $bi->bi_mae;
        $bi_nasc_dia = $bi->ext_bi_nasc_dia;
        $bi_nasc_mes = $bi->bi_nasc_mes;
        $bi_nasc_ano = $bi->ext_bi_nasc_ano;


        $bi_nasc_dist = $bi->bi_nasc_dist;
        $bi_nasc_loc = $bi->bi_nasc_loc;
        $bi_emi_dia = $bi->bi_emi_dia;

        $bi_emi_ano = $bi->bi_emi_ano;
        $bi_emi_mes = $bi->bi_emi_mes;

        $bi_emi_dia = $bi->ext_bi_emi_dia;
        $bi_emi_ano = $bi->ext_bi_emi_ano;

        $filho = $bi->bi_filho;
        $nascido = $bi->bi_nascido;

        $estado = $bi->bi_estado;


        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta($type);

        $footer = $this->footer();
        $presidente = $this->presidente();

        $texto_final = $this->textoFinal();
        $data = $this->data($atestado_dia, $atestado_mes, $atestado_year);

        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta



      <p class='tittle'>
     ------------------------------------A T E S T A D O Nº. $atestado_id  /$atestado_year_number.---------------------------------------
         </p>
    <p class='p-left'>
     ----------$presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ ZÓCHI. ----------------------------------------------------------
     </p>

     <p class='p-left'>----------Atesta para Efeitos de $name, á conceder pelo(a) $atestado_entidade
      que, $bi_name, $estado, natural de $bi_nasc_loc, $nascido em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae, $bi->bi_documento número  $bi_number, passado pelo $bi->bi_emi_entidade, em $bi_emi_dia de $bi_emi_mes de $bi_emi_ano, reside efetivamente $atestado_casa, na Localidade de $atestado_localidade, Distrito de $atestado_distrito, deste Estado, não dispõe de recursos para custear despesas com os seus estudos na $atestado_univer.</p>
    <p class='p-left'>
        $texto_final
    </p>
    <p class='p-left'>
    $data
    </p>
    <p>
    $footer

    </p>


</body>
</html>";

        //echo $html;
        /**/
//echo $html;


        $dompdf->load_html($html);

//Renderizar o html

        $dompdf->render();


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        /*header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=malanza.pdf");
        set_time_limit(0);
        $file = @fopen($file_to_save, "rb");
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }*/

        return $atestado;
    }
    private function creatAtestado3PDF($params, $id, $bi, $name, $type)

    {
        //dnd(1);

        $Atestados = new Atestados();
        $Bis = new Bis();
        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Univers = new Univers();
        $Meses = new Meses();






        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;




        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;

        $atestado_casa = $this->setCasa($params['house']);


        $desde = " há mais de trinta dias e nos últimos doze meses";

        if($name == "Bolsa de Estudo"){
            $desde = " há mais de três anos e nos últimos doze meses";

        }

        $atestado = $Atestados->getAtestadoToPdf($Atestados->getById($id));


        $atestado_id = $atestado->atestado_id;
        $atestado_dia = $atestado->ext_atestado_dia;
        $atestado_year = $atestado->ext_atestado_year;
        $atestado_year_number = $atestado->atestado_year;
        $atestado_mes = $atestado->atestado_mes;
        $ext_atestado_dia = $atestado->ext_atestado_dia;
        $ext_atestado_year = $atestado->ext_atestado_year;



        $bi = $Bis->getByToPDF($bi);

        $bi_number = $bi->ext_bi_number;
        $bi_name = $bi->bi_name;
        $bi_pai = $bi->bi_pai;
        $bi_mae = $bi->bi_mae;
        $bi_nasc_dia = $bi->ext_bi_nasc_dia;
        $bi_nasc_mes = $bi->bi_nasc_mes;
        $bi_nasc_ano = $bi->ext_bi_nasc_ano;


        $bi_nasc_dist = $bi->bi_nasc_dist;
        $bi_nasc_loc = $bi->bi_nasc_loc;
        $bi_emi_dia = $bi->bi_emi_dia;

        $bi_emi_ano = $bi->bi_emi_ano;
        $bi_emi_mes = $bi->bi_emi_mes;

        $bi_emi_dia = $bi->ext_bi_emi_dia;
        $bi_emi_ano = $bi->ext_bi_emi_ano;

        $filho = $bi->bi_filho;
        $nascido = $bi->bi_nascido;

        $estado = $bi->bi_estado;





        $name = sanitize($name);




        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta($type);
        $footer = $this->footer();
        $presidente = $this->presidente();
        $texto_final = $this->textoFinal();
        $data = $this->data($atestado_dia, $atestado_mes, $atestado_year);

        $texto_final = $this->textoFinal();
        $data = $this->data($atestado_dia, $atestado_mes, $atestado_year);

        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta



     <p class='tittle'>
     ------------------------------------A T E S T A D O Nº. $atestado_id  /$atestado_year_number.---------------------------------------
         </p>
    <p class='p-left'>
     ----------$presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ ZÓCHI. ----------------------------------------------------------
     </p>

     <p class='p-left'>----------Atesta para Efeitos de $name que, $bi_name, $estado, natural de
     $bi_nasc_loc, $nascido em $bi_nasc_dia
     de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae, $bi->bi_documento número  $bi_number, passado pelo $bi->bi_emi_entidade, em $bi_emi_dia
     de $bi_emi_mes de $bi_emi_ano, reside efetivamente

     $atestado_casa, na Localidade de $atestado_localidade, Distrito de
     $atestado_distrito, deste Estado$desde.
    </p>
    <p class='p-left'>

        $texto_final
    </p>
    <p class='p-left'>
    $data
    </p>
    <p>
    $footer

    </p>


</body>
</html>";

        //echo $html;
        /**/
//echo $html;


        $dompdf->load_html($html);

//Renderizar o html

        $dompdf->render();


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        /*header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=malanza.pdf");
        set_time_limit(0);
        $file = @fopen($file_to_save, "rb");
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }*/

        return $atestado;
    }



    private function creatAtestado4PDF($params, $id, $bi, $name, $type)

    {
        //dnd(1);

        $Atestados = new Atestados();
        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();
        $Bis = new Bis();


        $atestado = $Atestados->getById($id);






        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;



        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;



        $atestado_casa = $this->setCasa($params['house']);


        $atestado = $Atestados->getAtestadoToPdf($Atestados->getById($id));


        $atestado_id = $atestado->atestado_id;
        $atestado_dia = $atestado->ext_atestado_dia;
        $atestado_year = $atestado->ext_atestado_year;
        $atestado_year_number = $atestado->atestado_year;
        $atestado_mes = $atestado->atestado_mes;
        $ext_atestado_dia = $atestado->ext_atestado_dia;
        $ext_atestado_year = $atestado->ext_atestado_year;



        $bi = $Bis->getByToPDF($bi);

        $bi_number = $bi->ext_bi_number;
        $bi_name = $bi->bi_name;
        $bi_pai = $bi->bi_pai;
        $bi_mae = $bi->bi_mae;
        $bi_nasc_dia = $bi->ext_bi_nasc_dia;
        $bi_nasc_mes = $bi->bi_nasc_mes;
        $bi_nasc_ano = $bi->ext_bi_nasc_ano;


        $bi_nasc_dist = $bi->bi_nasc_dist;
        $bi_nasc_loc = $bi->bi_nasc_loc;
        $bi_emi_dia = $bi->bi_emi_dia;

        $bi_emi_ano = $bi->bi_emi_ano;
        $bi_emi_mes = $bi->bi_emi_mes;

        $bi_emi_dia = $bi->ext_bi_emi_dia;
        $bi_emi_ano = $bi->ext_bi_emi_ano;

        $filho = $bi->bi_filho;
        $nascido = $bi->bi_nascido;

        $estado = $bi->bi_estado;


        $name = sanitize($name);
        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta($type);
        $footer = $this->footer();
        $presidente = $this->presidente();
        $texto_final = $this->textoFinal();
        $data = $this->data($atestado_dia, $atestado_mes, $atestado_year);

        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta



      <p class='tittle'>
     ------------------------------------A T E S T A D O Nº. $atestado_id  /$atestado_year_number.---------------------------------------
         </p>
    <p class='p-left'>
     ----------$presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ ZÓCHI. ----------------------------------------------------------
     </p>

     <p class='p-left'>----------Atesta para Efeitos de $name,

      que, $bi_name, $estado, natural de $bi_nasc_loc, $nascido
      em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de
      $bi_pai e de $bi_mae, $bi->bi_documento número  $bi_number,
      passado pelo $bi->bi_emi_entidade, em $bi_emi_dia de
      $bi_emi_mes de $bi_emi_ano, reside efetivamente
      $atestado_casa, na Localidade de $atestado_localidade,
      Distrito de $atestado_distrito, deste Estado,
      é pobre.</p>
    <p class='p-left'>
        $texto_final
    </p>
    <p class='p-left'>
    $data
    </p>
    <p>
    $footer

    </p>


</body>
</html>";

        //echo $html;
        /**/
//echo $html;


        $dompdf->load_html($html);

//Renderizar o html

        $dompdf->render();


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        /*header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=malanza.pdf");
        set_time_limit(0);
        $file = @fopen($file_to_save, "rb");
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }*/

        return $atestado;
    }
    private function creatAtestado5PDF($params, $id, $bi, $name, $type)

    {


        $Atestados = new Atestados();
        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();
        $Bis = new Bis();


        $atestado_nome_1 = $params['nome-1'];
        $atestado_insti_1 = $params['instituicao'];


        $atestado_casa = $params['house'];

        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;

        $atestado_nome_2 = $params['nome-2'];


        $atestado_loc_2 = $Localidades->getName($params['localidade-2']);
        $atestado_localidade_2 = $atestado_loc_2->localidade_name;

        $atestado_desde = $params['desde'];




        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;

        $atestado_casa = $this->setCasa($params['house']);


        $atestado = $Atestados->getAtestadoToPdf($Atestados->getById($id));


        $atestado_id = $atestado->atestado_id;
        $atestado_dia = $atestado->ext_atestado_dia;
        $atestado_year = $atestado->ext_atestado_year;
        $atestado_year_number = $atestado->atestado_year;
        $atestado_mes = $atestado->atestado_mes;
        $ext_atestado_dia = $atestado->ext_atestado_dia;
        $ext_atestado_year = $atestado->ext_atestado_year;


        $Bis = new Bis();

        $bi = $Bis->getByToPDF($bi);

        $bi_number = $bi->ext_bi_number;
        $bi_name = $bi->bi_name;
        $bi_pai = $bi->bi_pai;
        $bi_mae = $bi->bi_mae;
        $bi_nasc_dia = $bi->ext_bi_nasc_dia;
        $bi_nasc_mes = $bi->bi_nasc_mes;
        $bi_nasc_ano = $bi->ext_bi_nasc_ano;


        $bi_nasc_dist = $bi->bi_nasc_dist;
        $bi_nasc_loc = $bi->bi_nasc_loc;
        $bi_emi_dia = $bi->bi_emi_dia;

        $bi_emi_ano = $bi->bi_emi_ano;
        $bi_emi_mes = $bi->bi_emi_mes;

        $bi_emi_dia = $bi->ext_bi_emi_dia;
        $bi_emi_ano = $bi->ext_bi_emi_ano;

        $filho = $bi->bi_filho;
        $nascido = $bi->bi_nascido;

        $estado = $bi->bi_estado;



        $name = sanitize($name);


        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta($type);

        $footer = $this->footer();
        $presidente = $this->presidente();

        $texto_final = $this->textoFinal();
        $data = $this->data($atestado_dia, $atestado_mes, $atestado_year);


        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta



     <p class='tittle'>
     ------------------------------------A T E S T A D O Nº. $atestado_id  /$atestado_year_number.---------------------------------------
         </p>
    <p class='p-left'>
     ----------$presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ ZÓCHI. ----------------------------------------------------------
     </p>

     <p class='p-left'>----------Atesta para Fins de $name por morte de


     $atestado_nome_1, que  foi trabalhou em $atestado_insti_1, a favor de $bi_name, $estado, natural de $bi_nasc_loc, $nascido em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae, $bi->bi_documento número  $bi_number, passado pelo$bi->bi_emi_entidade, em $bi_emi_dia de $bi_emi_mes de $bi_emi_ano, reside efetivamente $atestado_casa, na Localidade de $atestado_localidade, Distrito de $atestado_distrito, deste Estado, viveu em comunhão de mesa e a exclusivo cargo seu companheiro, $atestado_nome_2, nascido em $atestado_localidade_2, há mais de $atestado_desde.


    </p>
    <p class='p-left'>
    $texto_final
    </p>
    <p class='p-left'>
    $data
    </p>
    <p>
    $footer

    </p>


</body>
</html>";

        //echo $html;
        /**/
//echo $html;


        $dompdf->load_html($html);

//Renderizar o html

        $dompdf->render();


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        /*header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=malanza.pdf");
        set_time_limit(0);
        $file = @fopen($file_to_save, "rb");
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }*/

        return $atestado;
    }
    private function creatAtestado6PDF($params, $id, $bi, $name, $type)

    {
        //dnd(1);

        $Atestados = new Atestados();
        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();







        $atestado_casa = $params['house'];

        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;


        $atestado_servico = $params['servico'];


        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;

        $atestado_casa = $this->setCasa($params['house']);


        $atestado = $Atestados->getAtestadoToPdf($Atestados->getById($id));


        $atestado_id = $atestado->atestado_id;
        $atestado_dia = $atestado->ext_atestado_dia;
        $atestado_year = $atestado->ext_atestado_year;
        $atestado_year_number = $atestado->atestado_year;
        $atestado_mes = $atestado->atestado_mes;
        $ext_atestado_dia = $atestado->ext_atestado_dia;
        $ext_atestado_year = $atestado->ext_atestado_year;


        $Bis = new Bis();

        $bi = $Bis->getByToPDF($bi);

        $bi_number = $bi->ext_bi_number;
        $bi_name = $bi->bi_name;
        $bi_pai = $bi->bi_pai;
        $bi_mae = $bi->bi_mae;
        $bi_nasc_dia = $bi->ext_bi_nasc_dia;
        $bi_nasc_mes = $bi->bi_nasc_mes;
        $bi_nasc_ano = $bi->ext_bi_nasc_ano;


        $bi_nasc_dist = $bi->bi_nasc_dist;
        $bi_nasc_loc = $bi->bi_nasc_loc;
        $bi_emi_dia = $bi->bi_emi_dia;

        $bi_emi_ano = $bi->bi_emi_ano;
        $bi_emi_mes = $bi->bi_emi_mes;

        $bi_emi_dia = $bi->ext_bi_emi_dia;
        $bi_emi_ano = $bi->ext_bi_emi_ano;

        $filho = $bi->bi_filho;
        $nascido = $bi->bi_nascido;

        $estado = $bi->bi_estado;
        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta($type);

        $footer = $this->footer();
        $presidente = $this->presidente();
        $texto_final = $this->textoFinal();
        $data = $this->data($atestado_dia, $atestado_mes, $atestado_year);


        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta



    <p class='tittle'>
     ------------------------------------A T E S T A D O Nº. $atestado_id  /$atestado_year_number.---------------------------------------
         </p>
    <p class='p-left'>
     ----------$presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ ZÓCHI. ----------------------------------------------------------
     </p>

     <p class='p-left'>----------Atesta para Efeitos de $name, à conceder pelos Serviços de $atestado_servico

      que, $bi_name, $estado, natural de $bi_nasc_loc, $nascido
      em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae, $bi->bi_documento número  $bi_number, passado pelo $bi->bi_emi_entidade, em $bi_emi_dia de $bi_emi_mes de $bi_emi_ano, reside efetivamente $atestado_casa, na Localidade de $atestado_localidade, distrito de $atestado_distrito, deste Estado.
    </p>
    <p class='p-left'>
        $texto_final
    </p>
    <p class='p-left'>
    $data
    </p>
    <p>
    $footer

    </p>


</body>
</html>";

        //echo $html;
        /**/
//echo $html;


        $dompdf->load_html($html);

//Renderizar o html

        $dompdf->render();


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        /*header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=malanza.pdf");
        set_time_limit(0);
        $file = @fopen($file_to_save, "rb");
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }*/

        return $atestado;
    }
    private function creatAtestado7PDF($params, $id, $bi, $name, $type)

    {


        $Atestados = new Atestados();
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $Dias = new Dias();
        $Meses = new Meses();
        $Anos = new Anos();

        $this->view->dias = $Dias->find([]);
        $this->view->meses = $Meses->find([]);
        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);


        $atestado = $Atestados->getById($id);








        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;








        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;



        $name = sanitize($name);






        //3039493377




        $atestado = $Atestados->getAtestadoToPdf($Atestados->getById($id));


        $atestado_id = $atestado->atestado_id;
        $atestado_dia = $atestado->ext_atestado_dia;
        $atestado_year = $atestado->ext_atestado_year;
        $atestado_year_number = $atestado->atestado_year;
        $atestado_mes = $atestado->atestado_mes;
        $ext_atestado_dia = $atestado->ext_atestado_dia;
        $ext_atestado_year = $atestado->ext_atestado_year;


        $Bis = new Bis();

        $bi = $Bis->getByToPDF($bi);

        $bi_number = $bi->ext_bi_number;
        $bi_name = $bi->bi_name;
        $bi_pai = $bi->bi_pai;
        $bi_mae = $bi->bi_mae;
        $bi_nasc_dia = $bi->ext_bi_nasc_dia;
        //dnd($bi);
        if($bi_nasc_dia=="um"){
            $bi_nasc_dia=" ao primeiro dia";
        }else{
            $bi_nasc_dia = "aos ".$bi->ext_bi_nasc_dia." dias";
        }




        $bi_nasc_mes = $bi->bi_nasc_mes;
        $bi_nasc_ano = $bi->ext_bi_nasc_ano;


        $bi_nasc_dist = $bi->bi_nasc_dist;
        $bi_nasc_loc = $bi->bi_nasc_loc;
        $bi_emi_dia = $bi->bi_emi_dia;

        $bi_emi_ano = $bi->bi_emi_ano;
        $bi_emi_mes = $bi->bi_emi_mes;

        $bi_emi_dia = $bi->ext_bi_emi_dia;
        $bi_emi_ano = $bi->ext_bi_emi_ano;

        $filho = $bi->bi_filho;
        $nascido = $bi->bi_nascido;

        $estado = $bi->bi_estado;
        $dompdf = new DOMPDF();

        $STYLE = $this->style();




        $HEAD = $this->head();
        $conta = $this->conta($type);

        $footer = $this->footer();

        $presidente = $this->presidente();
        $texto_final = $this->textoFinal();
        $data = $this->data($atestado_dia, $atestado_mes, $atestado_year);


        $filhos = $params['filhos'];
        $netos = $params['netos'];
        $sobrinhos = $params['sobrinhos'];
        $entiados = $params['entiados'];
        $afilhados = $params['afilhados'];
        $tios = $params['tios'];
        $avo = $params['avo'];
        $companheiro = $params['companheiro'];
        $total =  $filhos + $netos + $sobrinhos + $entiados  + $afilhados + $tios + $avo + $companheiro;
        if($total <= 3){
            $STYLE = $this->style();
        }


        $primeiro = 0;

        if($companheiro > 0){
            $primeiro++;
        }


        $companheiro_text = $this->getDetails($companheiro, $params, 'companheir', $primeiro);



        $pai_text = $mae_text = "";
        if($params['pai']  == 1){
            $primeiro++;
            $pai_text = $this->getPai(1, $params, 'pai',  $primeiro);


        }
        if($params['mae'] == 1){
            $primeiro++;
            $mae_text = $this->getMae(1, $params, 'mae',  $primeiro);

        }

        if($avo > 0 ){
            $primeiro++;

        }
        $avo_text = $this->getAvo($avo, $params, 'avo',  $primeiro);


        if($filhos > 0){

            $primeiro++;

        }

        $filho_text = $this->getDetails($filhos, $params, 'filh', $primeiro);



        if($netos > 0 ){
            $primeiro++;
        }
        $neto_text = $this->getDetails($netos, $params, 'net', $primeiro);


        if($sobrinhos> 0 ){
            $primeiro++;
        }
        $sobrinho_text = $this->getDetails($sobrinhos, $params, 'sobrinh', $primeiro);




        if($entiados > 0 ){
            $primeiro++;
        }
        $entiado_text = $this->getDetails($entiados, $params, 'entiad', $primeiro);



        if($afilhados > 0 ){
            $primeiro++;
        }
        $afilhado_text = $this->getDetails($afilhados, $params, 'afilhad', $primeiro);



        if($tios > 0 ){
            $primeiro++;
        }
        $tios_text = $this->getDetails($tios, $params, 'ti', $primeiro);


        $atestado_casa = $this->setCasa($params['house']);






        $atestado_desde = " há mais de " . NumeroEmExtenso($params['desde']) . " anos";



        $bemcomo = $neto_text . $sobrinho_text . $entiado_text . $afilhado_text .
     $tios_text;



        $bemcomo = $bemcomo == ""? "": " bem como " . $rest = substr($bemcomo, 2);    // returns "f"
        //dnd($rest);;


        //dnd($bi);


        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta



     <p class='tittle'>
     ------------------------------------A T E S T A D O Nº. $atestado_id  /$atestado_year_number.---------------------------------------
         </p>
    <p class='p-left'>
     ----------$presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ ZÓCHI. ----------------------------------------------------------
     </p>

     <p class='p-left' id='p-flex'>----------Atesta para Fins de $name que $bi_name, $estado,
     natural de $bi_nasc_loc, $nascido  $bi_nasc_dia  do mês de $bi_nasc_mes do ano $bi_nasc_ano,
     $filho de  $bi_pai e de $bi_mae, $bi->bi_documento número $bi_number, passado pelo
     $bi->bi_emi_entidade, em $bi_emi_dia de $bi_emi_mes de $bi_emi_ano, reside efetivamente
     $atestado_casa, na Localidade de $atestado_localidade, Distrito de $atestado_distrito,
     deste Estado, vive em comunhão de mesa e a exclusivo cargo
      $companheiro_text  $pai_text $mae_text $avo_text
     $filho_text $bemcomo
      $atestado_desde.


    </p>
    <p class='p-left'>
        $texto_final
    </p>
    <p class='p-left'>
    $data
    </p>
    <p>
    $footer
    </p>


</body>
</html>";

        //echo $html;
        /**/
//echo $html;


        $dompdf->load_html($html);

//Renderizar o html

        $dompdf->render();


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        /*header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=malanza.pdf");
        set_time_limit(0);
        $file = @fopen($file_to_save, "rb");
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }*/

        return $atestado;
    }
    private function creatAtestado8PDF($params, $id, $bi, $name, $type)

    {


        $Atestados = new Atestados();
        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();




        $Countries = new Countries();

        $atestado_country = $Countries->getName($params['pais']);
        $atestado_country = $atestado_country->country_name;




        $atestado_casa = $params['house'];

        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;

        $atestado_nome_2 = $params['nome-2'];


        $atestado_loc_2 = $Localidades->getName($params['localidade-2']);
        $atestado_localidade_2 = $atestado_loc_2->localidade_name;

        $atestado_desde = $params['desde'];




        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;

        $atestado_casa = $this->setCasa($params['house']);


        $atestado = $Atestados->getAtestadoToPdf($Atestados->getById($id));


        $atestado_id = $atestado->atestado_id;
        $atestado_dia = $atestado->ext_atestado_dia;
        $atestado_year = $atestado->ext_atestado_year;
        $atestado_year_number = $atestado->atestado_year;
        $atestado_mes = $atestado->atestado_mes;
        $ext_atestado_dia = $atestado->ext_atestado_dia;
        $ext_atestado_year = $atestado->ext_atestado_year;


        $Bis = new Bis();

        $bi = $Bis->getByToPDF($bi);

        $bi_number = $bi->ext_bi_number;
        $bi_name = $bi->bi_name;
        $bi_pai = $bi->bi_pai;
        $bi_mae = $bi->bi_mae;
        $bi_nasc_dia = $bi->ext_bi_nasc_dia;
        $bi_nasc_mes = $bi->bi_nasc_mes;
        $bi_nasc_ano = $bi->ext_bi_nasc_ano;


        $bi_nasc_dist = $bi->bi_nasc_dist;
        $bi_nasc_loc = $bi->bi_nasc_loc;
        $bi_emi_dia = $bi->bi_emi_dia;

        $bi_emi_ano = $bi->bi_emi_ano;
        $bi_emi_mes = $bi->bi_emi_mes;

        $bi_emi_dia = $bi->ext_bi_emi_dia;
        $bi_emi_ano = $bi->ext_bi_emi_ano;

        $filho = $bi->bi_filho;
        $nascido = $bi->bi_nascido;

        $estado = $bi->bi_estado;

        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta($type);

        $footer = $this->footer();
        $presidente = $this->presidente();

        $texto_final = $this->textoFinal();
        $data = $this->data($atestado_dia, $atestado_mes, $atestado_year);

        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta



     <p class='tittle'>
     ------------------------------------A T E S T A D O Nº. $atestado_id  /$atestado_year_number.---------------------------------------
         </p>
    <p class='p-left'>
     ----------$presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ ZÓCHI. ----------------------------------------------------------
     </p>

     <p class='p-left'>----------Atesta para Fins de $name à  $atestado_country que, $bi_name, $estado, natural de
     $bi_nasc_loc, $nascido em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae, $bi->bi_documento número  $bi_number, passado pelo $bi->bi_emi_entidade, em $bi_emi_dia de $bi_emi_mes de $bi_emi_ano, reside efetivamente $atestado_casa, na Localidade de $atestado_localidade, Distrito de $atestado_distrito, deste Estado, tem consigo em comunhão de mesa e habitação e a seu exclusivo cargo sua/seu companheira(o), $atestado_nome_2, nascido em $atestado_localidade_2, há mais de $atestado_desde.


    </p>
    <p class='p-left'>
    $texto_final
    </p>
    <p class='p-left'>
    $data

            </p>
    <p>
    $footer

    </p>


</body>
</html>";

        //echo $html;
        /**/
//echo $html;


        $dompdf->load_html($html);

//Renderizar o html

        $dompdf->render();


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        /*header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=malanza.pdf");
        set_time_limit(0);
        $file = @fopen($file_to_save, "rb");
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }*/

        return $atestado;
    }


    private function getDetails($total, $params, $next_name, $primeiro){
        if($primeiro == 1){
            $primeiro = true;
        }else{
            $primeiro = false;
        }

        $text = "";
        if($total == 0){
            return $text;
        }elseif($total == 1 && $primeiro == false){
            $text =  $this->readSexo($params, 1, $next_name) == 1 ? " e seu ". $next_name . "o,":" e sua " . $next_name . "a,";
        }elseif($total == 1 && $primeiro == true){
            $text =  $this->readSexo($params, 1, $next_name) == 1 ? " do seu ". $next_name . "o,":" da sua " . $next_name . "a,";
        }elseif($total > 1 &&  $primeiro == false){
            $text = " e suas " . $next_name . "as,";
            for($i = 1; $i < $total; $i++){
                if($this->readSexo($params, $i, $next_name) == 1){
                    $text = " e seus ". $next_name . "os,";
                }
            }
        }elseif($total > 1 && $primeiro == true){
            $text = " das suas " . $next_name . "as,";
            for($i = 1; $i < $total; $i++){
                if($this->readSexo($params, $i, $next_name) == 1){
                    $text = " dos seus ". $next_name . "os,";
                }
            }
        }

        $Meses = new Meses();

        for($i = 1; $i <= $total; $i++){
            if($this->readSexo($params, $i, $next_name) == 1){
                $nascidoa = " nascido ";
            }else{
                $nascidoa = " nascida ";
            }
            $text .= " " . $this->readName($params,$i,$next_name) . ", " . $nascidoa . " " .
                DataEmExtenso(
                    $this->readDia($params,$i,$next_name),
                    $Meses->getName($this->readMes($params,$i,$next_name)),
                    $this->readAno($params,$i,$next_name)). ", ";;
        }
        return $text;

    }

    private function getAvo($total, $params, $next_name, $primeiro){

        if($primeiro == 1){
            $primeiro = true;
        }else{
            $primeiro = false;
        }
        $text = "";
        if($total == 0){
            return $text;
        }elseif($total == 1  && $primeiro == false){
            $text =  $this->readSexo($params, 1, $next_name) == 1 ? " e seu avô,":" e sua avó,";
        }elseif($total == 1 && $primeiro == true){
            $text =  $this->readSexo($params, 1, $next_name) == 1 ? " do seu avô,":" da sua avó,";
        }elseif($total > 1 &&  $primeiro == false){
            $text = " e suas avós,";
            for($i = 1; $i < $total; $i++){
                if($this->readSexo($params, 1, $next_name) == 1){
                    $text = " e seus avôs,";
                }
            }
        }elseif($total > 1 && $primeiro == true){
            $text = " das suas  avós,";
            for($i = 1; $i < $total; $i++){
                if($this->readSexo($params, $i, $next_name) == 1){
                    $text = " dos seus  avôs,";
                }
            }
        }

        $Meses = new Meses();

        for($i = 1; $i <= $total; $i++){
            if($this->readSexo($params, $i, $next_name) == 1){
                $nascidoa = " nascido ";
            }else{
                $nascidoa = " nascida ";
            }
            $text .= " " . $this->readName($params,$i,$next_name) . ", " . $nascidoa . " " .
                DataEmExtenso(
                    $this->readDia($params,$i,$next_name),
                    $Meses->getName($this->readMes($params,$i,$next_name)),
                    $this->readAno($params,$i,$next_name)). ", ";;
        }
        return $text;

    }
    private function getPai($total, $params, $next_name, $primeiro){
        $text = "";
        if($primeiro == 1){
            $primeiro = true;
        }else{
            $primeiro = false;
        }
        if($total == 0){
            return $text;

        }elseif($total == 1 && $primeiro == false){
            $text =  " e seu pai,";
        }elseif($total == 1 && $primeiro == true){
            $text =  " do seu pai,";
        }

        $Meses = new Meses();

        $nascidoa = " nascido ";
        $text .= " " . $this->readName($params,1,$next_name) . ", " . $nascidoa . " " .
            DataEmExtenso(
                $this->readDia($params,1,$next_name),
                $Meses->getName($this->readMes($params,1,$next_name)),
                $this->readAno($params,1,$next_name)). ", ";;
        return $text;

    }
    private function getMae($total, $params, $next_name, $primeiro){
        $text = "";
        if($primeiro == 1){
            $primeiro = true;
        }else{
            $primeiro = false;
        }
        if($total == 0){
            return $text;

        }elseif($total == 1 && $primeiro == false){
            $text =  " e sua mãe,";
        }elseif($total == 1 && $primeiro == true){
            $text =  " da sua mãe,";
        }

        $Meses = new Meses();

        $nascidoa = " nascida ";
        $text .= " " . $this->readName($params,1,$next_name) . ", " . $nascidoa . " " .
            DataEmExtenso(
                $this->readDia($params,1,$next_name),
                $Meses->getName($this->readMes($params,1,$next_name)),
                $this->readAno($params,1,$next_name)). ", ";;
        return $text;

    }


    private function readName($params, $position, $name){
        return '<span class="name">' . $params[$name . $position] . '</span>';

    }
    private function readSexo($params, $position, $name){
        return $params[$name . "_sexo" . $position];
    }
    private function readDia($params, $position, $name){
        return $params["nas-dia_".$name . $position];
    }
    private function readMes($params, $position, $name){
        return $params["nas-mes_".$name . $position];
    }
    private function readAno($params, $position, $name){
        return $params["nas-ano_".$name . $position];
    }


    public function setCasa($atestado_casa){

        if(is_numeric($atestado_casa)){
            if($atestado_casa != -1){
                $atestado_casa = "na casa número " . NumeroEmExtenso($atestado_casa);
            }else{
                $atestado_casa = "numa casa não numerada";
            }
        }else{
            $final_text = "na casa número ";
            $dados = explode(' ', $atestado_casa);
            //dnd($dados);
            foreach($dados as $key => $value){
                if(is_numeric($value)){
                    $text = NumeroEmExtenso($value);
                }else{
                    $text = $value;
                }
                $final_text .= " " . $text;
            }
            $atestado_casa = "na casa número " . $final_text;


        }


        return $atestado_casa;
    }
























    public function updateresidenciaAction($atestado, $bi)
    {


        $Bis = new Bis();

        $validation = new Validate();

        $Atestado = new Atestados();


        $atestado = $this->view->atestado = sanitize($atestado);


        $result = $Atestado->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [sanitize($atestado)]]
        );


        if (!$result->atestado_id) {

            Router::redirect('atestado/create');

        }



        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));
        //dnd($this->view->bis);
        if (!$bi) {

            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;


        //dnd(2);


        $posted_values2 = [
            'house' => '',
            'localidade' => ''
        ];

        $this->view->displayErrors = "";
        //dnd($_POST);
        if (Input::exists()) {
            //dnd($_POST);
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($this->view->bi, 1, $atestado);

                        if ($atestado > 0) {
                            //dnd($this->view->bis);
                            $this->creatAtestadoresidenciaPDF($_POST, $atestado, $bi);


                            $this->view->newatestado = $atestado;
                            $link = PROOT . "files/atestados/" . $atestado;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $atestado. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();

        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $bi->bi_estado = $bi->bi_estado == 1 ? "Solteiro" : $bi->bi_estado == 2 ? "Casado" : $bi->bi_estado == 3 ? ($bi->bi_sexo == 1 ? "Divorciado" : "Divorciada") : "Viuva";


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('atestado/18-updateresidencia');
    }

    public function newtransferAction($bi)
    {

        $Bis = new Bis();

        $validation = new Validate();


        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;


        $posted_values2 = [


            'house' => '',
            'localidade' => '',

            'nome-1' => '',
            'localidade-1' => '',
            'pais' => '',
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
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'nome-1' => [
                            'display' => 'nome do funcinário',
                            'require' => true
                        ],
                        'localidade-1' => [
                            'display' => 'localidade de nascimento do companheiro',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'pais' => [
                            'display' => 'país',
                            'require' => true,
                            'selected' => ['countries', 'country_id']
                        ],
                        'estado' => [
                            'display' => 'nome do companheiro',
                            'require' => true
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();

                        $id = $Atestado->saveAtestado($this->view->bi, 14);

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            $this->creatAtestadotransferPDF($_POST, $id, $bi);


                            $this->view->newatestado = $id;
                            $link = PROOT . "files/atestados/" . $id;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");

                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();


        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);
        $Countries = new Countries();
        $this->view->paises = $Countries->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $bi->bi_estado = $bi->bi_estado == 1 ? "Solteiro" : $bi->bi_estado == 2 ? "Casado(a)" : $bi->bi_estado == 3 ? "Divorciado(a)" : "Viuva";


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('atestado/14-newtransfer');
    }
    public function updatetransferAction($atestado, $bi)
    {


        $Bis = new Bis();

        $validation = new Validate();

        $Atestado = new Atestados();


        $atestado = $this->view->atestado = sanitize($atestado);


        $result = $Atestado->findFirst(['conditions' =>
                ['atestado_id = ?'],
                'bind' => [sanitize($atestado)]]
        );


        if (!$result->atestado_id) {
            dnd(2);
            Router::redirect('atestado/create');

        }

        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));
        //dnd($this->view->bis);
        if (!$bi) {

            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;


        //dnd(2);


        $posted_values2 = [

            'house' => '',
            'localidade' => '',
            'nome-1' => '',
            'localidade-1' => '',
            'pais' => '',
            'estado' => ''
        ];

        $this->view->displayErrors = "";
        //dnd($_POST);
        if (Input::exists()) {
            //dnd($_POST);
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'house' => [
                            'display' => 'número da casa',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'nome-1' => [
                            'display' => 'nome do funcinário',
                            'require' => true
                        ],
                        'localidade-1' => [
                            'display' => 'localidade de nascimento do companheiro',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'pais' => [
                            'display' => 'país',
                            'require' => true,
                            'selected' => ['countries', 'country_id']
                        ],
                        'estado' => [
                            'display' => 'nome do companheiro',
                            'require' => true
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($this->view->bi, 14, $atestado);

                        if ($atestado > 0) {
                            //dnd($this->view->bis);
                            $this->creatAtestadotransferPDF($_POST, $atestado, $bi);


                            $this->view->newatestado = $atestado;
                            $link = PROOT . "files/atestados/" . $atestado;

                            $this->view->displayErrors = $validation->displayOkay("Atestado criado com o número $atestado. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");
                        }


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
        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Countries = new Countries();


        $this->view->localidades = $Localidades->find([]);
        $this->view->distritos = $Distritos->find([]);
        $this->view->dias = $Dias->find([]);
        $this->view->paises = $Dias->find([]);


        $this->view->meses = $Meses->find([]);


        $this->view->anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);

        $Distritos = new Distritos();
        $this->view->distritos = $Distritos->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $bi->bi_estado = $bi->bi_estado == 1 ? "Solteiro" : $bi->bi_estado == 2 ? "Casado" : $bi->bi_estado == 3 ? ($bi->bi_sexo == 1 ? "Divorciado" : "Divorciada") : "Viuva";


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('atestado/14-updatetransfer');
    }
    private function creatAtestadotransferPDF($params, $id, $bi)

    {


        $Atestados = new Atestados();
        $Bis = new Bis();
        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();


        $atestado = $Atestados->getById($id);


        $atestado_id = $atestado->atestado_id;
        $atestado_date = $atestado->atestado_date;
        $atestado_dia = GetFromStamp($atestado_date, 'd');
        $atestado_year = GetFromStamp($atestado_date, 'Y');
        $atestado_mes = $Meses->getName(GetFromStamp($atestado_date, 'm'));


        $atestado_nome_1 = $params['nome-1'];


        $atestado_estado = $params['estado'] == 1 ?
            "Solteiro(a)" : $params['estado'] == 2 ?
                "Casado(a)" : $params['estado'] == 3 ?
                    "Divorciado(a)" : "Viuvo(a)";


        $atestado_casa = $params['house'];

        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;



        $atestado_loc_2 = $Localidades->getName($params['localidade-1']);


        $atestado_localidade_2 = utf8_encode($atestado_loc_2->localidade_name);

        $Countries = new Countries();

        $atestado_country = $Countries->getName($params['pais']);
        $atestado_country = utf8_encode($atestado_country->country_name);




        $atestado_localidade = utf8_encode($atestado_loc->localidade_name);
        $atestado_distrito = utf8_encode($Distritos->getName($atestado_dis)->distrito_name);

        $bi_number = $bi->bi_number;
        $bi_name = utf8_encode($bi->bi_name);
        $bi_pai = utf8_encode($bi->bi_pai);
        $bi_mae = utf8_encode($bi->bi_mae);
        $bi_nasc_dia = $bi->bi_nasc_dia;
        $bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi_nasc_ano = $bi->bi_nasc_ano;

        $bi_dis = $Localidades->getName($bi->bi_nasc_loc)->localidade_dist;

        $bi_nasc_dist = utf8_encode($Distritos->getName($bi_dis)->distrito_name);
        $bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));

        $bi_emi_dia = $bi->bi_emi_dia;
        $bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi_emi_ano = $bi->bi_emi_ano;

        $filho = $bi->bi_sexo == 1 ? "filho" : "filha";
        $nascido = $bi->bi_sexo == 1 ? "nascido" : "nascida";


        $dompdf = new DOMPDF();

        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    <style>
        body{
            padding: 20px;
        }

        p, h1{
            text-align: center;
        }
        .p-left{
            text-align: justify;
        }
    </style>

    <p>
    <h1>Atestado para Fins de Transferência de Mesada Monetária</h1>
    </p>

    <p>
    ----------------------------- A T E S T A D O Nº. $atestado_id  /$atestado_year. -----------------------
    </p>
    <p class='p-left'>
     ---------- AMÉRICO CEITA, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ ZÓCHI. ----------
     </p>

     <p class='p-left'>Atesta para Efeitos de Transferência de mesada monetária a efetuar por $atestado_nome_1, $atestado_estado, residente em
$atestado_localidade_2, do Banco do referido País para o de $atestado_country, a favor de $bi_name, natural de $bi_nasc_loc, Distrito de $bi_nasc_dist, São Tomé, $nascido em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae, Bilhete de Identidade número  $bi_number, passado pelo Centro de Identificação Civil e Criminal de São Tomé e Príncipe, em $bi_emi_dia de $bi_emi_mes de $bi_emi_ano, reside efetivamente $atestado_casa, na Localidade de $atestado_localidade, Distrito de $atestado_distrito, deste Estado.


    </p>
    <p class='p-left'>
    ----------- Por ser verdade e ter sido requerido, mandou passar o presente Atestado que, assina, sendo a sua assinatura autenticada com o carimbo em uso nesta Câmara.
    </p>
    <p>
    Câmara Distrital de Mé-Zóchi, na Cidade da Trindade, aos  $atestado_dia de $atestado_mes de $atestado_year
    </p>
    <p>
    O Presidente,

    AMÉRICO CEITA

    </p>


</body>
</html>";

        //echo $html;
        /**/
//echo $html;


        $dompdf->load_html($html);

//Renderizar o html

        $dompdf->render();


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        /*header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=malanza.pdf");
        set_time_limit(0);
        $file = @fopen($file_to_save, "rb");
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }*/

        return $atestado;
    }



    private function creatAtestadoPDF($atestado)
    {


        $Atestado = new Atestados();

        $atestado = $Atestado->getById($atestado);
        $atestado_id = $atestado->atestado_id;
        $atestado_name = $atestado->atestado_name;
        $atestado_pais = $atestado->atestado_pais;
        $atestado_naturalidade = $atestado->atestado_naturalidade;
        $atestado_morada = $atestado->atestado_morada;
        $atestado_bi = $atestado->atestado_bi;


        $dompdf = new DOMPDF();

        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    <style>
        body{
            padding: 20px;
        }

        p, h1{
            text-align: center;
        }
        .p-left{
            text-align: justify;
        }
    </style>

    <p>
    <h1>Atestado de Residência</h1>
    </p>

    <p>
    ----------------------------- A T E S T A D O Nº. $atestado_id  /2020. -----------------------
    </p>
    <p class='p-left'>
     ---------- AMÉRICO CEITA, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ ZÓCHI. ----------
     </p>

     <p class='p-left'>Atesta para Fins de Emprego que, $atestado_name, natural de $atestado_naturalidade, Distrito de Água-Grande, São Tomé, nascido em 29 de Julho de 1962, filho de, portador do Bilhete de Identidade número  $atestado_bi, passado pelo Centro de Identificação Civil e Criminal de São Tomé e Príncipe, em 12 de Agosto 2015, reside efetivamente $atestado_morada, Distrito de Mé-Zochi, deste Estado.
    </p>
    <p class='p-left'>
    ----------- Por ser verdade e ter sido requerido, mandou passar o presente Atestado que, assina, sendo a sua assinatura autenticada com o carimbo em uso nesta Câmara.
    </p>
    <p>
    Câmara Distrital de Mé-Zóchi, na Cidade da Trindade, aos  _____________
    </p>
    <p>
    O Presidente,

    AMÉRICO CEITA

    </p>


</body>
</html>";

        //echo $html;
        /**/
//echo $html;


        $dompdf->load_html($html);

//Renderizar o html

        $dompdf->render();


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/atestados/" . $atestado_id . ".pdf";


        /*header('Content-Type: application/pdf');
        header("Content-Disposition: attachment; filename=malanza.pdf");
        set_time_limit(0);
        $file = @fopen($file_to_save, "rb");
        while (!feof($file)) {
            print(@fread($file, 1024 * 8));
            ob_flush();
            flush();
        }*/

        return $atestado;
    }


    public function doneAction($id)
    {

        $this->view->atestado = $id;
        $Atestado = new Atestados();
        $validation = new Validate();
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values = posted_values($_POST);

                    $validation->check($_POST, [

                        "form__input-1" => [
                            'display' => 'Número de BI',
                            'require' => true
                        ],
                        "form__input-2" => [
                            'display' => 'Nome completo',
                            'require' => true
                        ],
                        "form__input-3" => [
                            'display' => 'Filiação',
                            'require' => true
                        ],
                        "form__input-4" => [
                            'display' => 'Naturalidade',
                            'require' => true
                        ],
                        "form__input-5" => [
                            'display' => 'Residencia',
                            'require' => true
                        ],
                    ]);


                    if ($validation->passed()) {
                        $Atestado = new Atestados();

                        $Atestado->updateAtestado($_POST, $id);

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            $this->creatAtestadoPDF($id);


                            Router::redirect('home/done/' . $id);
                        }


                        //$newBi = $Bi->saveBI($_POST);

                        // Router::redirect('home/documents/'.$newBi);


                    } else {
                        $this->view->displayErrors = $validation->displayErrors();

                    }
                }
            }
        }
        $this->view->atestado = $Atestado->getById($id);

        $this->view->token = Token::generate();


        $this->view->render('atestado/done');
    }


    private function getMessageTypes($type)
    {

        $msg = "";
        switch ($type) {
            case 2:
                $msg = $this->getMessage_2();
                break;
            case 3:
                $msg = $this->getMessage_3();
                break;

            case 4:
                $msg = $this->getMessage_2();
                break;
            case 7:
                $msg = $this->getMessage_7();
                break;

            case 8:
                $msg = $this->getMessage_8();
                break;
            case 11:
                $msg = $this->getMessage_11();
                break;
            case 12:
                $msg = $this->getMessage_12();
                break;

            case 16:
                $msg = $this->getMessage_16();
                break;
            case 19:
                $msg = $this->getMessage_19();
                break;
        }
        return $msg;
    }

    public function getMessage_2()
    {
        $msg =
            ", há mais de "
            . Input::get('maisde')
            . " anos";
        return $msg;
    }


    public function getMessage_3()
    {
        $msg =
            ", não dispõe de recursos para custear despesas com os seus estudos  "
            . Input::get('localestudos');

        return $msg;
    }

    public function getMessage_4()
    {
        $msg =
            ", não dispõe de recursos para custear despesas com os seus estudos na escola "
            . Input::get('escola');

        return $msg;
    }

    public function getMessage_7()
    {
        $msg =
            ", não dispõe de recursos para custear despesas com os seus estudos na escola "
            . Input::get('escola');

        return $msg;
    }

    public function getMessage_8()
    {
        $msg =
            ", desde "
            . Input::get('desde');
        return $msg;
    }

    public function getMessage_11()
    {
        $msg =
            ", é pobre mas consta que esta inscrito um prédio urbano em nome do requerente
            situado na localidade de " .
            Input::get('localidade')
            . ", Distrito de "
            . Input::get('distrito');
        return $msg;
    }


    public function getMessage_12()
    {
        $msg =
            ", viveu em comunhão de mesa e a exclusivo cargo seu companheiro,
        " . Input::get('companheiro') . ", " . Input::get('nascimento') . ", há mais de
         " . Input::get('maisde') . " anos";


        return $msg;
    }

    public function getMessage_16()
    {
        $msg =
            ", viveu em comunhão de mesa e a exclusivo cargo sua companheira,
        " . Input::get('companheiro') . ", " . Input::get('nascimento') . ", há mais de
         " . Input::get('maisde') . " anos";


        return $msg;
    }

    public function getMessage_19()
    {
        $msg =
            ", viveu em comunhão de mesa e a exclusivo cargo sua companheira,
        " . Input::get('companheiro') . ", " . Input::get('nascimento') . ", há mais de
         " . Input::get('maisde') . " anos";


        return $msg;
    }

}