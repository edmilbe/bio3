

<?php



class Shopped extends  Controller implements InterfaceShopped{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);
    }

    public function indexAction(){

        $sek = new ShoppedKey();
        $this->view->prds = $sek->getOpened();


        $this->view->render('shopped/opened');
    }

    public function statusorderedAction($id){
        $sep = new ShoppedPrds();
        $this->view->items = $sep->boxed($id, true);
        $this->view->notfound = '';
        if($this->view->items == false){
            $this->view->notfound = 'Compra desconhecida!';

        }
        $dias = new Dias();

        $this->view->dias = $dias->find([]);

        $meses = new Meses();

        $this->view->meses = $meses->find([]);

        $anos = new Anos();

        $this->view->anos = $anos->find(['conditions' => ['ano_name >= ?'], 'bind' => [2018]]);
        $this->view->render('shopped/statusordered');
    }

    public function viewfullAction($on = false){


        $sp = new ShoppingPrds();
        $prds = new Prds();

        $on = sanitize($on);
        if(is_numeric($on)){
            $this->view->item =  $sp->getById($on);
            $this->view->gps = $prds->getByIdGroups1($on);

            if($this->view->item){
                $this->view->fotos = [];
                $this->view->render('home/view');
            }else{
                $this->view->render('home/index');
            }
        }else{
            $this->view->render('home/index');
        }

    }
    public function pendentAction($id, $key){
        $id = sanitize($id);
        $sep = new ShoppedPrds();

        //dnd($id);
        $sep->updateChegada(31,12,1999,$id);
        Router::redirect('shopped/statusordered/'.$key);

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





    function finishShopping($params){

        $this->saveDetails($params);
        $this->makePayment();
        $this->printRecive();
    }





    public function makePayment(){
        return true;
    }

    private function printRecive(){

    }
    public function saveDetails($params){





    }

}