<?php

interface InterfacePersons{
    public function __construct($controller, $action);
    public function indexAction();
    public function viewAction($id);
    public function setAction($id, $set);

}