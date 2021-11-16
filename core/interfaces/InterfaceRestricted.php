<?php

interface InterfaceRestricted{
    public function __construct($controller, $action);
    public function indexAction($name = '');
}

