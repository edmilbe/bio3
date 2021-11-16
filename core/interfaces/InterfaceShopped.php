

<?php



interface InterfaceShopped{
    public function __construct($controller, $action);

    public function indexAction();

    public function statusorderedAction($id);

    public function viewfullAction($on = false);
    public function pendentAction($id, $key);

    public function boxAction();
    public function gr1Action();
    public function gr2Action($g1 = 0);

    public function closeboxAction();





    function finishShopping($params);



    public function saveDetails($params);

}