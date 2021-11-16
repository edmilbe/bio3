<?php

class View{
    protected $_head, $_body, $_siteTitle = SITE_TITLE, $_outputBuffer, $_layout = DEFAULT_LAYOUT, $_bfooter;
    public $displayErrors;
    public function __construct(){

    }
    public function render($viewName){
        $viewAry = explode('/', $viewName);
        $viewString = implode(DS, $viewAry);

        if(file_exists(ROOT . DS . 'app'. DS . 'views' . DS . Session::get(LANG). DS . $viewString . '.php')){
            include(ROOT . DS . 'app'. DS . 'views' . DS . Session::get(LANG).DS . $viewString . '.php');
            include(ROOT . DS . 'app'. DS . 'views' . DS . Session::get(LANG).DS . 'layouts' . DS . $this->_layout . '.php');

        }else{
            die('The view \"' . $viewName . '\"does not exist.');
        }

    }
    public function content($type){

        if($type == 'head'){
            return $this->_head;
        }elseif($type == 'body'){
            return $this->_body;
        }elseif($type == 'bfooter'){
            return $this->_bfooter;
        }
        return false;
    }

    public function start($type){
        $this->_outputBuffer = $type;
        ob_start();
    }
    public function end(){
        if($this->_outputBuffer == 'head'){
            $this->_head = ob_get_clean();
        }elseif($this->_outputBuffer == 'body'){
            $this->_body = ob_get_clean();
        }elseif($this->_outputBuffer == 'bfooter'){
            $this->_bfooter = ob_get_clean();
        }else{
            die('You must first run the start method.');
        }

    }
    public function siteTitle(){

        return $this->_siteTitle;
    }
    public function setSiteTitle($title){
        $this->_siteTitle = $title;
    }
    public function setLayout($path){
        $this->_layout = $path;
    }

}