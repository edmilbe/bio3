<?php



Interface InterfaceAccount {
    public function __construct($controller, $action);
    public function indexAction();
    public function detailsAction();

    public function passwordAction();


    public function orderedAction();

    public function statusorderedAction($id_key);
}