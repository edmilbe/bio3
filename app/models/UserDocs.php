<?php

class UserDocs extends  Model{


    public function __construct(){
        $table = 'user_docs';
        parent::__construct($table);
    }

    public function getByUser($id){
        $id = sanitize($id);

        return $this->_db->query('
                              select *from user_docs inner join users on user_doc_user = user_id and user_id = ? inner join files on user_doc_file = file_id', [$id])->results();
    }
}