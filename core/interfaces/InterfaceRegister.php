<?php

interface InterfaceRegister{
    public function __construct($controller, $action);

    public function indexAction();
    public  function loginAction();


    public function logoutAction();

    public function registerAction();
    public function recoveremailAction();

    public function recoverpassAction($link);
}