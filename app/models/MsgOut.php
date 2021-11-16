<?php

class MsgOut extends  Model{


    public function __construct(){
        $table = 'msg_out';
        parent::__construct($table);
    }

    public function index(){
        dnd($this->find([]));
    }

    public function outNewMsg($params)
    {
        //$this->assign($params);
        //postsanitize($params);


        $form = array();
        $form['msg_o_name'] = sanitize($params['name']);
        $form['msg_o_email'] = sanitize($params['email']);
        $form['msg_o_text'] = sanitize($params['msg']);


        $this->save($form);
        $id = $this->_db->lastID();

        if (is_numeric($id)) {
            return $id;
        }
        return false;
    }
    public function viewUpdate($msg){
        $form['msg_o_view'] = 1;
        $this->update(sanitize($msg),$form,'msg_o_id');
        //dnd('aqui');
    }
    public function selectMsgUnread()
    {
        $sql = "select * from msg_out where msg_o_view = 0 order by msg_o_id asc";
        return $this->_db->query($sql, [])->results();

    }
    public function selectMsg($msg)
    {
        $sql = "select * from msg_out where msg_o_id = ?";
        return $this->_db->query($sql, [sanitize($msg)])->results();

    }
}