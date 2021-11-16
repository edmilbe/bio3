

<?php


interface InterfaceHome{
    public function __construct($controller, $action);

    public function langAction($lang);

    public function indexAction($on = false, $onon = false);


    public function boxAction();
    public function gr1Action();
    public function gr2Action($g1 = 0);

    public function closeboxAction();

    public function receiverAction();

    public function facturaAction($session);

    public function invoiceAction($total, $factura, $xxx = false);

    public function saveDetails($params);

}