<?php

class MsgIn extends  Model{


    public function __construct(){
        $table = 'msg_in';
        parent::__construct($table);
    }



    public function inNewMsg($params)
    {
        //$this->assign($params);
        //postsanitize($params);


        $form = array();
        $form['msg_i_user'] = currentUser()->user_id;
        $form['msg_i_text'] = sanitize($params['msg']);

        $this->save($form);
        $id = $this->_db->lastID();

        if (is_numeric($id)) {
            return $id;
        }
        return false;
    }

    public function replyMsg($user, $params)
    {
        //$this->assign($params);
        //postsanitize($params);

        if($this->selectMsg(sanitize($user)) != false){
            $form = array();
            $form['msg_i_user'] = sanitize($user);
            $form['msg_i_text'] = sanitize($params['msg']);
            $form['msg_i_reply'] = 1;

            $this->save($form);
            $id = $this->_db->lastID();

            if (is_numeric($id)) {
                return $id;
            }
        }
        return false;


    }


    public function selectMsg($user)
    {
        $sql = "Select *from msg_in inner join users on msg_i_user = ? and user_id = msg_i_user order by msg_i_id asc";
        return $this->_db->query($sql, [sanitize($user)])->results();

    }

    public function viewUpdate($user){
        $form['msg_i_view'] = 1;
        $this->update(sanitize($user),$form,'msg_i_user');
        //dnd('aqui');
    }

    public function selectMsgUnread()
    {
        $sql = "select * from msg_in inner join users on user_id = msg_i_user and msg_i_reply = 0 and msg_i_view = 0 order by msg_i_id asc";
        return $this->_db->query($sql, [])->results();

    }
}