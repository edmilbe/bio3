<?php

class Posts extends  Model{


    public function __construct(){
        $table = 'posts';
        parent::__construct($table);
    }


    public function newPost($params, $photo_id){


        $form['post_photo'] = $photo_id;
        $form['post_text'] = $params['text'];
        $form['post_title'] = sanitize($params['titulo']);

        $this->save($form);
        return $this->_db->lastID();
    }

    public function RowsNumberr(){
        //dnd($this->_modelName);
        $query = "SELECT COUNT(post_id) as num FROM " . strtolower($this->_modelName);

        //dnd($query);

        return $this->_db->query($query, [])->results()[0]->num;



    }

    public function getPost($id_post){
        $result = $this->_db->query("
SELECT * FROM posts JOIN files ON post_id = ? AND file_id = post_photo",[$id_post])->results();
        //dnd($result);
        if($result){
            return $result[0];
        }
        return $result;
    }


    public function getPostList($pageno, $value = 10){
        $no_of_records_per_page = $value;
        $offset = ($pageno-1) * $no_of_records_per_page;



        return $this->_db->query("
SELECT * FROM posts
JOIN files ON file_id = post_photo LIMIT
$offset, $no_of_records_per_page ",[])->results();
    }


    public function getPosts($limit = 6, $status = null){
        if($status){
            $status = $status == 1 ? " AND post_public = 1" : " AND post_public == 0";

        }
        $result = $this->_db->query("
SELECT * FROM posts JOIN files ON file_id = post_photo $status ORDER BY post_id DESC LIMIT $limit",[])->results();
        //dnd($result);
        if($result){
            return $result;
        }
        return [];
    }
    public function getDestaque($limit = 3){
        $result = $this->_db->query("
SELECT * FROM posts JOIN files ON file_id = post_photo AND post_destaque = ? ORDER BY post_id DESC LIMIT $limit",[1])->results();
        //dnd($result);

        if($result){
            return $result;
        }
        return [];
    }

    public function getPostsByGroup($group = 1, $limit = 6, $status = null){
        if($status){
            $status = $status == 1 ? " AND post_public = 1" : " AND post_public = 0";

        }
        $result = $this->_db->query("
SELECT * FROM posts JOIN files ON file_id = post_photo JOIN post_group on pg_id = post_group and pg_id = ?  $status ORDER BY post_id DESC LIMIT ?",[$group, $limit])->results();
        //dnd($result);
        if($result){
            return $result;
        }
        return [];
    }
    public function getPostsByGroupPage($group = 1, $limit = 6, $no_of_records_per_page = 1, $status = null){
        if($status){
            $status = $status == 1 ? " AND post_public = 1" : " AND post_public == 0";
        }
        $result = $this->_db->query("
SELECT * FROM posts JOIN files ON file_id = post_photo JOIN post_group on pg_id = post_group and pg_id = ?  $status ORDER BY post_id DESC LIMIT ?, ?",[$group, $limit, $no_of_records_per_page])->results();
        //dnd($result);
        if($result){
            return $result;
        }
        return [];
    }
}