<?php

class Views extends Controller implements InterfaceViews{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);

    }
    public function indexAction($name = ''){


    }

    public function facturasAction($name = ''){
        $this->view->name = "files/factura/" . $name;
        $this->view->render('view/view');
    }
}

