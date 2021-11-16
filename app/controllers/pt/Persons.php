<?php

class Persons extends  Controller implements InterfacePersons{
    public function __construct($controller, $action){
        parent::__construct($controller, $action);

    }
    public function indexAction(){

        $users = new Users();

        $this->view->users = $users->getAllUser();
        //dnd( $this->view->users);


        $this->view->render('persons/index');
    }
    public function viewAction($id){
        $id = sanitize($id);
        if(is_numeric($id)){
            $users = new Users();
            $this->view->user = $user = $users->findById($id);
            //dnd($user);
            if($user === false){
                $id = currentUser()->user_id;
                $this->view->user = $users->findById([currentUser()->user_id]);

            }

            $admin = new Admin();
            $this->view->btn = true;
            if($admin->isAdmin($id) || $id == currentUser()->user_id){

                $this->view->btn = false;
            }
            //var_dump( $this->view->btn );
            $this->view->users = $users->getAllUser();
            $docs = new UserDocs();
            $this->view->docs = $docs->getByUser($id);
            $this->view->render('persons/view');
        }
    }

    public function setAction($id, $set){
        $user = new Users();
        $id = sanitize($id);
        $set = sanitize($set);
        $admin = new Admin();
        if(!$admin->isAdmin($id)){

               $user->userSetOn($id, $set);
        }
        Router::redirect('persons/view/'.$id);
    }

}