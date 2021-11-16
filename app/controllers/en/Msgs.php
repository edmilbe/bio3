<?php

class Msgs extends Controller
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }


    public function indexAction()
    {


        $msg = new MsgIn();


        $this->view->all = $msg->selectMsgUnread();
        $exists = $this->view->msgs = array();
        foreach ($this->view->all as $msg):
            if (!array_key_exists($msg->msg_i_user,$exists)):
                $this->view->msgs[] = $msg;
                $exists[$msg->msg_i_user] = 'exists';
            endif;
        endforeach;

        $validation = new Validate();


        $this->view->displayErrors = $validation->displayErrors();
        $this->view->render('msgs/index');


    }

    public function outAction(){
        $msg = new MsgOut();


        $this->view->msgs = $msg->selectMsgUnread();

        $this->view->render('msgs/indexout');
    }

    public function viewoutAction($msg){
        $msg = sanitize($msg);


        if(is_numeric($msg)){
            $msgO = new MsgOut();

            $this->view->msgs = $msgO->selectMsg($msg);
            $this->view->msgs = $msgO->viewUpdate($msg);
        }
        Router::redirect('msgs/out');
    }

    public function viewAction($user){
        $user = sanitize($user);
        $msg = new MsgIn();
        if(is_numeric($user)){

            $msg = new MsgIn();
            $validation = new Validate();

            $posted_values = [
                'msg' => ''
            ];
            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    if ($_POST) {

                        postsanitize($_POST);
                        $posted_values = posted_values($_POST);
                        $validation->check($_POST, [
                            'msg' => [
                                'display' => 'Message text',
                                'require' => true
                            ],
                        ]);

                        if ($validation->passed()) {
                            $msg = new MsgIn();

                            if (!is_numeric($msg->replyMsg($user,$_POST))) {
                                $validation->addError('Was not possible send the message, please try latter!');
                            }

                        }
                    }
                }
            }else{
                $msg->viewUpdate($user);
            }

            $this->view->id = sanitize($user);

            $this->view->post = $posted_values;


            $this->view->msgs = $msg->selectMsg($user);


            $this->view->displayErrors = $validation->displayErrors();
            $this->view->render('msgs/view');
        }




    }

    public function contactAction()
    {
        if (currentUser()) {
            $msg = new MsgIn();
            $validation = new Validate();

            $posted_values = [
                'msg' => ''
            ];
            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    if ($_POST) {
                        postsanitize($_POST);
                        $posted_values = posted_values($_POST);
                        $validation->check($_POST, [
                            'msg' => [
                                'display' => 'Message text',
                                'require' => true
                            ],
                        ]);

                        if ($validation->passed()) {
                            $msg = new MsgIn();

                            if (!is_numeric($msg->inNewMsg($_POST))) {
                                $validation->addError('Was not possible send the message, please try latter!');
                            }

                        }
                    }
                }
            }


            $this->view->post = $posted_values;
            $this->view->msgs = $msg->selectMsg(currentUser()->user_id);

            $this->view->displayErrors = $validation->displayErrors();
            $this->view->render('home/incontactus');
        } else {

            $validation = new Validate();

            $posted_values = [
                'name' => '', 'email' => '', 'msg' => ''
            ];
            if (Input::exists()) {
                if (Token::check(Input::get('token'))) {
                    if ($_POST) {
                        postsanitize($_POST);
                        $posted_values = posted_values($_POST);
                        $validation->check($_POST, [
                            'name' => [
                                'display' => 'Your name',
                                'require' => true
                            ],
                            'email' => [
                                'display' => 'Email',
                                'require' => true,
                                'valid_email' => true,
                            ],
                            'msg' => [
                                'display' => 'Message text',
                                'require' => true
                            ],
                        ]);

                        if ($validation->passed()) {
                            $msg = new MsgOut();

                            if (!is_numeric($msg->outNewMsg($_POST))) {
                                $validation->addError('Was not possible send the message, please try latter!');
                            }

                        }
                    }
                }
            }


            $this->view->post = $posted_values;

            if ($validation->passed()) {
                $this->view->displayErrors = $validation->displayOkay('Thank You! Your message was successfully sent!');
                $this->view->render('home/outcontacdone');

            } else {
                $this->view->displayErrors = $validation->displayErrors();
                $this->view->render('home/outcontactus');


            }

        }
    }


}