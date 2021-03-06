<?php

class Controller extends Application{
    protected $_controler, $_action;
    public $view;

    public function __construct($controller, $action){
        parent::__construct();
        $this->_controler = $controller;
        $this->_action = $action;

        $this->view = new View();
    }

    protected function load_model($model){
        if(class_exists($model)){
            $this->{$model.'Model'} = new $model(strtolower($model));
        }
    }



}