<?php



class Dir extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);

    }



    public function aprovadosAction($page = 1, $atestado = -1)
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



        $total = $Atestados->RowsNumber( 'atestado_state', '2');
        $this->view->total_pages = ceil($total != 0 ? $total : 5 / 5);

        $this->view->pageno = $page;

        $this->view->atestado = $Atestados->findAtestados($page, 5, 'atestado_state', '2');

        //$this->view->atestado;






        //dnd(sanitize(Date("d"))) ;
        $this->view->render('atestado/aprovados');
    }
    public function aprovados1Action($page = 1, $atestado = -1)
    {

        if(!is_numeric($page) ){
            $page = 1;
        }
        $this->view->atestadon = $atestado;

        $Atestados = new Certidaos();
        $this->view->atestado_view = false;
        if($atestado != -1){
            $this->view->atestado_view = $Atestados->findAtestado($atestado);
        }


        $total = $Atestados->RowsNumber( 'atestado_state', '2');
        $this->view->total_pages = ceil($total != 0 ? $total : 5 / 5);

        $this->view->pageno = $page;

        $this->view->atestado = $Atestados->findAtestados($page, 5, 'atestado_state', '2');

        //$this->view->atestado;






        //dnd(sanitize(Date("d"))) ;
        $this->view->render('certidaos/aprovados');
    }





}