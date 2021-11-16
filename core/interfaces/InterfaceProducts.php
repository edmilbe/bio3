<?php

interface InterfaceProducts{
    public function __construct($controller, $action);
    public function indexAction($name = '');

    public function newproductAction();

    public function newgroup2Action();

    public function newgroup1Action();

    public function newmarcaAction();

    public function newmedidaAction();
}

