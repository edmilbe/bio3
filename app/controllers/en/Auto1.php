<?php

require_once("files/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

class Auto extends Controller
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

        $Atestados = new Certidaos2();
        $this->view->atestado_view = false;
        if($atestado != -1){
            $this->view->atestado_view = $Atestados->findAtestados($atestado)[0];
        }



        $total = $Atestados->RowsNumber( 'atestado_state', '4');
        $this->view->total_pages = ceil($total != 0 ? $total : 5 / 5);

        $this->view->pageno = $page;

        $this->view->atestado = $Atestados->findAtestado($page, 5, 'atestado_state', '4');

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
            $this->view->atestado_view = $Atestados->findAtestados($atestado);
            $this->view->atestado_view = $this->view->atestado_view != false ? $this->view->atestado_view[0]:false;

        }

        $total = $Atestados->RowsNumber( 'atestado_state', '1');
        $this->view->total_pages = ceil($total != 0 ? $total : 5 / 5);

        $this->view->pageno = $page;



        $this->view->atestado = $Atestados->findAtestado($page, 5, 'atestado_state', '1');

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
            $this->view->atestado_view = $Atestados->findAtestados($atestado)[0];
        }

        $total = $Atestados->RowsNumber( 'atestado_state', '3');
        $this->view->total_pages = ceil($total != 0 ? $total : 5 / 5);

        $this->view->pageno = $page;

        $this->view->atestado = $Atestados->findAtestado($page, 5, 'atestado_state', '3');

        //$this->view->atestado;






        //dnd(sanitize(Date("d"))) ;
        $this->view->render('atestado/closeds');
    }


    public function buscarAction()
    {

        $Anos = new Anos();
        $Anos->setYear();


        //dnd(sanitize(Date("d"))) ;
        $this->view->render('atestado/buscar');
    }



    private function footer(){
        return "<br>
    <br>
    O Presidente
    <br>
<br>
    <br>
    <br>
    <br>
    AMÉRICO CEITA
    ";
    }

    private function presidente(){
        return "AMÉRICO CEITA";
    }


    public function createAction()
    {


        //dnd(GetFromStamp("2020-12-15 06:10:00", 'd'));


        $Bis = new Bis();


        $posted_values2 = [
            'bi' => '',
            'name' => '',
            'mae' => '',
            'pai' => '',
            'nas-dia' => '',
            'nas-mes' => '',
            'nas-ano' => '',
            'district' => '',
            'nature' => '',
            'genero' => '',
            'emissao-dia' => '',
            'emissao-mes' => '',
            'emissao-ano' => '',
            'estado' => ''
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
                            'display' => 'tipo de certidão ou autorização',
                            'require' => true,
                            'min-value' => 1,
                            'max-value' => 6,
                        ]
                    ]);


                    if ($validation->passed()) {

                        $type = Input::get('atestado_type');
                        $bi = Input::get('atestado_bi_number');
                        switch ($type) {
                            case 1:
                                Router::redirect('auto/newautoconst/' . $bi);
                                break;
                            case 2:
                                Router::redirect('auto/newcertcoval/' . $bi);
                                break;
                            case 3:
                                Router::redirect('auto/newmodcoval/' . $bi);
                                break;
                            case 4:
                                Router::redirect('auto/newregcad/' . $bi);
                                break;
                            case 5:
                                Router::redirect('auto/newlicbarraca/' . $bi);
                                break;
                            case 6:
                                Router::redirect('auto/newautoconst/' . $bi);
                                break;

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
        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();
        //dnd(  $this->view->token);
        $this->view->render('certidaos/create');


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
                                    Router::redirect('atestado/updateemprego/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 2:
                                    Router::redirect('atestado/updatebolsa/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 3:
                                    Router::redirect('atestado/updatebolsainterna/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 4:
                                    Router::redirect('atestado/updatecasamento/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 5:
                                    Router::redirect('atestado/updatetransporte/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 6:
                                    Router::redirect('atestado/updatevisto/' . Input::get('atestado_number') . "/" . $bi);
                                    break;

                                case 7:
                                    Router::redirect('atestado/updateescolares/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 8:
                                    Router::redirect('atestado/updatefixresidencia/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 9:
                                    Router::redirect('atestado/updatenacionalidade/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 10:
                                    Router::redirect('atestado/updatepensao/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 11:
                                    Router::redirect('atestado/updatejustica/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 12:
                                    Router::redirect('atestado/updatepersemorte/' . $bi);
                                    break;
                                case 13:
                                    Router::redirect('atestado/updatesubtransporte/' . Input::get('atestado_number') . "/" . $bi);
                                    break;
                                case 14:
                                    Router::redirect('atestado/updatetransfer/' . $bi);
                                    break;
                                case 15:
                                    Router::redirect('atestado/updateconta/' . Input::get('atestado_number') . "/" . $bi);
                                    break;

                                case 16:
                                    Router::redirect('atestado/updateagrefam/' . $bi);
                                    break;
                                case 17:
                                    Router::redirect('atestado/updateprovavida/' . $bi);
                                    break;
                                case 18:
                                    Router::redirect('atestado/updateresidencia/' . $bi);
                                    break;
                                case 19:
                                    Router::redirect('atestado/updateviagem/' . $bi);
                                    break;
                                case 20:
                                    Router::redirect('atestado/updatecargo/' . $bi);
                                    break;
                                case 21:
                                    Router::redirect('atestado/updateprofe/' . $bi);
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

        $this->view->token = Token::generate();
        //dnd(  $this->view->token);
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

        $this->view->render('atestado/create');
    }



    public function style(){
        $style = "
        <style>
        body{
            padding: 20px;

        }

        p, h1{
            text-align: center;
        }
        .p-left{
        text-indent: 0;
            text-align: justify;
            font-size: 14pt;
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
            padding: 4px;;
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
            $Certidaos = new CertidaoTypes();

            $value =  $Certidaos->findFirst(
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



    public function newautoconstAction($bi)
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

            'estado' => '',
            'localidade-1' => '',



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
                            'display' => 'localidade do requerente',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'tipo' => [
                            'display' => 'modificação ou construção',
                            'require' => true
                        ],
                        'localidade-1' => [
                            'display' => 'localidade de obra',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Certidoes= new Certidaos();

                        $id = $Certidoes->saveCertidoes($this->view->bi, 1);

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            $this->creatAtestadoautoconstPDF($_POST, $id, $bi, 1);


                            $this->view->newatestado = $id;
                            $link = PROOT . "files/certidoes/1/" . $id . ".pdf";

                            $this->view->displayErrors = $validation->displayOkay("Autorização criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");

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
        $bi->bi_nasc_loc = $Localidades->getName($bi->bi_nasc_loc)->localidade_name;
        $bi->bi_emi_mes = $Meses->getName($bi->bi_emi_mes);
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $bi->bi_estado = $bi->bi_estado == 1 ? "Solteiro" : $bi->bi_estado == 2 ? "Casado(a)" : $bi->bi_estado == 3 ? "Divorciado(a)" : "Viuva";


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('certidaos/01-newautoconst');
    }
    public function newcertcovalAction($bi)
    {

        $Bis = new Bis();

        $validation = new Validate();


        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;


        $posted_values2 = [
            'coval' => '',
            'ano' => '',
            'cemiterio' => '',
            'nome' => '',
            'data1' => '',
            'data2' => '',

            'house' => '',
            'localidade' => ''



        ];

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'coval' => [
                            'display' => 'número do coval',
                            'require' => true
                        ],
                        'ano' => [
                            'display' => 'ano do coval',
                            'require' => true,
                            'selected' => ['anos', 'ano_name']
                        ],
                        'cemiterio' => [
                            'display' => 'cemitério',
                            'require' => true,
                            'selected' => ['cemiterios', 'distrito_id']
                        ],
                        'data1' => [
                            'display' => 'data de falecimento',
                            'require' => true
                        ],
                        'data2' => [
                            'display' => 'data de sepultura',
                            'require' => true
                        ],
                        'house' => [
                            'display' => 'número da casa do requerente',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade do requerente',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Certidoes= new Certidaos();

                        $id = $Certidoes->saveCertidoes($this->view->bi, 2);

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            $this->creatAtestadocertcovalPDF($_POST, $id, $bi);


                            $this->view->newatestado = $id;
                            $link = PROOT . "files/certidoes/2/" . $id . ".pdf";

                            $this->view->displayErrors = $validation->displayOkay("Certificado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");

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
        $Cemiterios = new Cemiterios();




        $this->view->localidades = $Localidades->find([]);
        $this->view->cemiterios = $Cemiterios->find([]);
        //dnd($this->view->cemiterios );
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

        $this->view->render('certidaos/02-newcertcoval');
    }
    public function newmodcovalAction($bi)
    {

        $Bis = new Bis();

        $validation = new Validate();


        $this->view->bis = $bi = $Bis->getBIFull(sanitize($bi));

        if (!$bi) {
            Router::redirect('atestado/create');
        }

        $this->view->bi = $bi->bi_number;


        $posted_values2 = [
            'coval' => '',
            'ano' => '',
            'cemiterio' => '',
            'nome' => '',
            'modific' => '',

            'house' => '',
            'localidade' => ''



        ];

        $this->view->displayErrors = "";
        if (Input::exists()) {
            if (Token::check(Input::get('token'))) {
                if ($_POST) {
                    postsanitize($_POST);
                    //dnd($_POST);
                    $posted_values2 = posted_values($_POST);

                    $validation->check($_POST, [
                        'coval' => [
                            'display' => 'número do coval',
                            'require' => true
                        ],
                        'ano' => [
                            'display' => 'ano do coval',
                            'require' => true,
                            'selected' => ['anos', 'ano_name']
                        ],
                        'cemiterio' => [
                            'display' => 'cemitério',
                            'require' => true,
                            'selected' => ['cemiterios', 'distrito_id']
                        ],
                        'modific' => [
                            'display' => 'modificação',
                            'require' => true,
                            'selected' => ['modifics', 'modific_id']
                        ],
                        'house' => [
                            'display' => 'número da casa do requerente',
                            'require' => true
                        ],
                        'localidade' => [
                            'display' => 'localidade do requerente',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ]
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Certidoes= new Certidaos();

                        $id = $Certidoes->saveCertidoes($this->view->bi, 3);

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            $this->creatAtestadomodcovalPDF($_POST, $id, $bi);


                            $this->view->newatestado = $id;
                            $link = PROOT . "files/certidoes/3/" . $id . ".pdf";

                            $this->view->displayErrors = $validation->displayOkay("Certificado criado com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder ao atestado</a>");

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
        $Cemiterios = new Cemiterios();




        $this->view->localidades = $Localidades->find([]);
        $this->view->cemiterios = $Cemiterios->find([]);
        //dnd($this->view->cemiterios );
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


        $Modifics = new Modifics();
        $this->view->modifics = $Modifics->find([]);


        $bi->bi_nasc_mes = $Meses->getName($bi->bi_nasc_mes);
        $bi->bi_nasc_loc = utf8_encode(utf8_encode($Localidades->getName($bi->bi_nasc_loc)->localidade_name));
        $bi->bi_emi_mes = utf8_encode(utf8_encode($Meses->getName($bi->bi_emi_mes)));
        $bi->bi_sexo = $bi->bi_sexo == 1 ? "Masculino" : "Feminino";
        $bi->bi_estado = $bi->bi_estado == 1 ? "Solteiro" : $bi->bi_estado == 2 ? "Casado(a)" : $bi->bi_estado == 3 ? "Divorciado(a)" : "Viuva";


        //dnd( $this->view->distritos);

        $this->view->post = $posted_values2;
        $this->view->token = Token::generate();

        $this->view->render('certidaos/03-newmodcoval');
    }
    public function newlicbarracaAction($bi)
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
            'objecto' => '',
            'localidade-1' => '',
            'tempo' => '',





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
                            'display' => 'localidade do requerente',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'objecto' => [
                            'display' => 'objecto',
                            'require' => true
                        ],
                        'localidade-1' => [
                            'display' => 'localidade do empreendimento',
                            'require' => true,
                            'selected' => ['localidades', 'localidade_id']
                        ],
                        'tempo' => [
                            'display' => 'validade',
                            'require' => true
                        ],
                    ]);

                    if ($validation->passed()) {

                        //$newBi = $Bis->saveBI($_POST);

                        //Router::redirect('atestado/create');
                        $Certidoes= new Certidaos();

                        $id = $Certidoes->saveCertidoes($this->view->bi, 4);

                        if ($id > 0) {
                            // vai buscar por id e faz a impressao

                            //dnd($Atestado->getById($id));
                            $this->creatAtestadolicbarracaPDF($_POST, $id, $bi);


                            $this->view->newatestado = $id;
                            $link = PROOT . "files/certidoes/4/" . $id . ".pdf";

                            $this->view->displayErrors = $validation->displayOkay("Licença criada com o número $id. <a target='_blank' href='$link'>Clique aqui para aceder</a>");

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

        $this->view->render('certidaos/04-newlicbarraca');
    }



    private function creatAtestadoautoconstPDF($params, $id, $bi, $type){


        $Atestados = new Certidaos();

        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();
        $atestado = $Atestados->getById($id);

        $atestado_id = $atestado->atestado_id;
        $atestado_date = $atestado->atestado_date;
        $atestado_dia = GetFromStamp($atestado_date, 'd');
        $atestado_year = GetFromStamp($atestado_date, 'Y');
        $atestado_ext_dia = NumeroEmExtenso(GetFromStamp($atestado_date, 'd'));
        $atestado_ext_year = NumeroEmExtenso(GetFromStamp($atestado_date, 'Y'));
        $atestado_mes = $Meses->getName(GetFromStamp($atestado_date, 'm'));

        //$atestado_nome_1 = $params['nome-1'];

        $atestado_estado =
            $params['tipo'] == 1 ? "Construção" : ($params['tipo'] == 2 ? "Modificação" : "");


        $atestado_casa = NumeroEmExtenso($params['house']);

        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;



        $atestado_loc_2 = $Localidades->getName($params['localidade-1']);


        $atestado_localidade_2 = $atestado_loc_2->localidade_name;






        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;

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
        $documento = $bi->bi_documento;
        $bi_emi_entidade = $bi->bi_emi_entidade;
        $bi_nasc_pais = $bi->bi_nasc_pais;


        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta($type);

        $footer = $this->footer();
        $presidente = $this->presidente();

        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta
    <p>
    ----------------------------- A U T O R I Z A Ç Ã O Nº. $atestado_id  /$atestado_year. -----------------------
    </p>
    <p class='p-left'>
     ---------- $presidente, 333PRESIDENTE DA CÂMARA DISTRITAL DE MÉ-ZÓCHI. ----------
     </p>



     <p class='p-left'>
     Por esta Câmara se faz constar as autoridades e mais pessoas a quem o conhecimento desta competir que foi concedida Autorização à senhor(a)$bi_name,$estado, natural de $bi_nasc_loc, Distrito de $bi_nasc_dist, $bi_nasc_pais, $nascido em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae, portador do $documento número  $bi_number, passado pelo $bi_emi_entidade, em $bi_emi_dia de $bi_emi_mes de $bi_emi_ano, residente em na casa número $atestado_casa, na Localidade de $atestado_localidade, Distrito de $atestado_distrito, deste Estado, para proceder a $atestado_estado da sua barraca em alvenaria, na localidade de $atestado_localidade_2, Distrito de Mé-Zóchi, São Tomé.
    </p>
    <p class='p-left'>
    ----------- Por ser verdade, passou a presente autorização que vai assinada e autenticada com o carimbo em uso desta Câmara.
    </p>
    <p>
    Câmara Distrital de Mé-Zóchi, na Cidade da Trindade, aos  $atestado_ext_dia dias de $atestado_mes de $atestado_ext_year
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


        $file_to_save = "files/certidoes/1/" . $id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/certidoes/1/" . $id . ".pdf";


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
    private function creatAtestadocertcovalPDF($params, $id, $bi){


        $Atestados = new Certidaos();

        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();
        $atestado = $Atestados->getById($id);

        $atestado_id = $atestado->atestado_id;
        $atestado_date = $atestado->atestado_date;
        $atestado_dia = GetFromStamp($atestado_date, 'd');
        $atestado_year = GetFromStamp($atestado_date, 'Y');
        $atestado_ext_dia = NumeroEmExtenso(GetFromStamp($atestado_date, 'd'));
        $atestado_ext_year = NumeroEmExtenso(GetFromStamp($atestado_date, 'Y'));
        $atestado_mes = $Meses->getName(GetFromStamp($atestado_date, 'm'));

        //$atestado_nome_1 = $params['nome-1'];


        $atestado_casa = $params['house'];

        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;






        $numero_coval = $params['coval'];
        $ano_coval = $params['ano'];

        $Cemiterios = new Cemiterios();


        $cemiterio_coval = $Cemiterios->getName($params['cemiterio']);


        $nome_coval = $params['nome'];
        $data1_coval = $params['data1'];
        $data2_coval = $params['data2'];





        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;

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
        $documento = $bi->bi_documento;
        $bi_emi_entidade = $bi->bi_emi_entidade;
        $bi_nasc_pais = $bi->bi_nasc_pais;

        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta(2);


        $footer = $this->footer();
        $presidente = $this->presidente();
        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta
    <p>
    ----------------------------- C E R T I F I C A D O Nº. $atestado_id  /$atestado_year. -----------------------
    </p>
    <p class='p-left'>
     ---------- $presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ-ZÓCHI. ----------
     </p>



     <p class='p-left'>
     Certifico que deu-se por comprado o coval número $numero_coval do ano $ano_coval, do Cemitério $cemiterio_coval, onde se encontram os restos mortais de $nome_coval, falecido(a) em $data1_coval e Sepultado em $data2_coval, ao senhor(a)
$bi->bi_name, $estado, natural de $bi_nasc_loc, distrito de $bi_nasc_dist, $bi_nasc_pais, $nascido em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae, portador do $documento número  $bi_number, passado pelo $bi_emi_entidade, em $bi_emi_dia de $bi_emi_mes de $bi_emi_ano, reside efetivamente $atestado_casa, na localidade de $atestado_localidade, distrito de $atestado_distrito, deste Estado.</p>
    <p class='p-left'>
    ----------- Por ser verdade, passou a presente autorização que vai assinada e autenticada com o carimbo em uso desta Câmara.
    </p>
    <p>
    Câmara Distrital de Mé-Zóchi, na Cidade da Trindade, aos  $atestado_ext_dia de $atestado_mes de $atestado_ext_year
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


        $file_to_save = "files/certidoes/2/" . $id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/certidoes/2/" . $id . ".pdf";


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
    private function creatAtestadomodcovalPDF($params, $id, $bi){


        $Atestados = new Certidaos();

        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();
        $atestado = $Atestados->getById($id);

        $atestado_id = $atestado->atestado_id;
        $atestado_date = $atestado->atestado_date;
        $atestado_dia = GetFromStamp($atestado_date, 'd');
        $atestado_year = GetFromStamp($atestado_date, 'Y');
        $atestado_ext_dia = NumeroEmExtenso(GetFromStamp($atestado_date, 'd'));
        $atestado_ext_year = NumeroEmExtenso(GetFromStamp($atestado_date, 'Y'));
        $atestado_mes = $Meses->getName(GetFromStamp($atestado_date, 'm'));

        //$atestado_nome_1 = $params['nome-1'];


        $atestado_casa = $params['house'];

        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;


        $Modifics = new Modifics();
        $modific = $Modifics->getName($params['modific']);






        $numero_coval = $params['coval'];
        $ano_coval = $params['ano'];

        $Cemiterios = new Cemiterios();


        $cemiterio_coval = $Cemiterios->getName($params['cemiterio']);


        $nome_coval = $params['nome'];





        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;

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
        $documento = $bi->bi_documento;
        $bi_emi_entidade = $bi->bi_emi_entidade;
        $bi_nasc_pais = $bi->bi_nasc_pais;


        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta(3);

        $footer = $this->footer();
        $presidente = $this->presidente();

        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta
    <p>
    ----------------------------- A U T O R I Z A Ç Ã O Nº. $atestado_id  /$atestado_year. -----------------------
    </p>
    <p class='p-left'>
     ---------- $presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ-ZÓCHI. ----------
     </p>



     <p class='p-left'>


Por esta Câmara se faz Constar as autoridades e mais pessoas a quem o conhecimento desta competir que foi concedida Autorização à senhor(a) $bi->bi_name, $estado, natural de $bi_nasc_loc, distrito de $bi_nasc_dist, $bi_nasc_pais, $nascido em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae, portador do $documento número  $bi_number, passado pelo $bi_emi_entidade, em $bi_emi_dia de $bi_emi_mes de $bi_emi_ano, reside efetivamente $atestado_casa, na localidade de $atestado_localidade, distrito de $atestado_distrito, deste Estado.

    </p>
    <p class='p-left'>
    ----------- Por ser verdade, passou a presente autorização que vai assinada e autenticada com o carimbo em uso desta Câmara.
    </p>
    <p>
    Câmara Distrital de Mé-Zóchi, na Cidade da Trindade, aos  $atestado_ext_dia de $atestado_mes de $atestado_ext_year
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


        $file_to_save = "files/certidoes/3/" . $atestado_id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/certidoes/3/" . $atestado_id . ".pdf";


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
    private function creatAtestadolicbarracaPDF($params, $id, $bi){


        $Atestados = new Certidaos();

        $Localidades = new Localidades();
        $Distritos = new Distritos();
        $Meses = new Meses();
        $atestado = $Atestados->getById($id);

        $atestado_id = $atestado->atestado_id;
        $atestado_date = $atestado->atestado_date;
        $atestado_dia = GetFromStamp($atestado_date, 'd');
        $atestado_year = GetFromStamp($atestado_date, 'Y');
        $atestado_ext_dia = NumeroEmExtenso(GetFromStamp($atestado_date, 'd'));
        $atestado_ext_year = NumeroEmExtenso(GetFromStamp($atestado_date, 'Y'));
        $atestado_mes = $Meses->getName(GetFromStamp($atestado_date, 'm'));

        //$atestado_nome_1 = $params['nome-1'];


        $atestado_casa = $params['house'];

        $atestado_loc = $Localidades->getName($params['localidade']);
        $atestado_dis = $Localidades->getName($params['localidade'])->localidade_dist;


        $localidade_2 = $Localidades->getName($params['localidade-1'])->localidade_name;

        $objecto = $params['objecto'];



        $tempo = $params['tempo'];


        $atestado_localidade = $atestado_loc->localidade_name;
        $atestado_distrito = $Distritos->getName($atestado_dis)->distrito_name;

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
        $documento = $bi->bi_documento;
        $bi_emi_entidade = $bi->bi_emi_entidade;
        $bi_nasc_pais = $bi->bi_nasc_pais;


        $dompdf = new DOMPDF();

        $STYLE = $this->style();
        $HEAD = $this->head();
        $conta = $this->conta(4);
        $footer = $this->footer();
        $presidente = $this->presidente();


        $html = "<!DOCTYPE html>
<html lang='pt'>

<body>

    $STYLE
    $HEAD
    $conta
    <p>
    ----------------------------- L I C E N Ç A Nº. $atestado_id  /$atestado_year. -----------------------
    </p>
    <p class='p-left'>
     ---------- $presidente, PRESIDENTE DA CÂMARA DISTRITAL DE MÉ-ZÓCHI. ----------
     </p>



     <p class='p-left'>




Por esta Câmara se faz constar as autoridades e mais pessoas a quem o conhecimento desta competir que foi concedida Autorização ao Senhor (a) $bi->bi_name, $estado, natural de $bi_nasc_loc, distrito de $bi_nasc_dist, $bi_nasc_pais, $nascido em $bi_nasc_dia de $bi_nasc_mes de $bi_nasc_ano, $filho de  $bi_pai e de $bi_mae, portador do $documento número  $bi_number, passado pelo $bi_emi_entidade, em $bi_emi_dia de $bi_emi_mes de $bi_emi_ano, reside efetivamente $atestado_casa, na localidade de $atestado_localidade, distrito de $atestado_distrito, deste Estado, para proceder o funcionamento da $objecto, na localidade de $localidade_2.









    </p>
    <p class='p-left'>
Válida até dia $tempo
    </p>
    <p class='p-left'>
    ----------- Por ser verdade e ter sido requerido, mandou passar a presente Licença que, vai assinada, sendo a sua assinatura autenticada com o carimbo em uso nesta Câmara.
    </p>
    <p>
    Câmara Distrital de Mé-Zóchi, na Cidade da Trindade, aos  $atestado_ext_dia de $atestado_mes de $atestado_ext_year
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


        $file_to_save = "files/certidoes/4/" . $id . ".pdf";


        file_put_contents($file_to_save, $dompdf->output());


        $file_to_save = "files/certidoes/4/" . $id . ".pdf";


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

     <p class='p-left'>Atesta para Fins de Emprego que, $atestado_name, natural de $atestado_naturalidade, Distrito de Água-Grande, São Tomé, nascido em 29 de Julho de 1962, filho de  , portador do Bilhete de Identidade número  $atestado_bi, passado pelo Centro de Identificação Civil e Criminal de São Tomé e Príncipe, em 12 de Agosto 2015, reside efetivamente na casa número $atestado_morada, Distrito de Mé-Zochi, deste Estado.
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