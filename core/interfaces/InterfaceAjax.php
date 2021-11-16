<?php

interface InterfaceAjax{
    public function __construct($controller, $action);


    public function scarrinhoAction();


    public function schangeAction($pr, $qtd);
    public function stlAction($pr, $vl, $preco);
    public function sclearAction();
    public function stgAction();

    public function ssearchprAction($name, $on = 0, $onon = 0);

    public function ssearchgr1Action($name);
    public function ssearchgr2Action($name, $gr1 = 0);

    public function isemailAction($email);

    public function existsemailAction($email);

    public function getcompraAction($name = 0);

    public function setchegadadataAction($dia, $mes, $ano, $id);



}