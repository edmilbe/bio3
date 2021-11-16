<?php

interface InterfaceViews{
    public function __construct($controller, $action);
    public function indexAction($name = '');

    public function facturasAction($name = '');
}

