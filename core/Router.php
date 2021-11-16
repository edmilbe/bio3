<?php

class Router{
    public static function  route($url){
        //controller
        //var_dump($url);

        //var_dump(array_search('ajax',$url));
        if(currentUser()){

            if(currentUser()->user_active == 0){
                //var_dump(currentUser()->user_active);

                self::redirect('register/logout');
            }
        }
        if(!is_array($url)){
            $url = array();
            $url[0] = DEFAULT_CONTROLLER;
            $url[1] = 'index';

        }

        $valor = array_search('ajax',$url);

        if($valor){
            if($valor == 0){
                $controller =  ucwords($url[0]);
                array_shift($url);
            }elseif($valor == 1){
                $controller =  ucwords($url[1]);
                array_shift($url);
            }elseif($valor >= 2){
                $controller = ucwords($url[$valor]);
                for($i = 0; $i < $valor; $i++){
                    array_shift($url);
                }
            }
            //dnd($controller);
        }
        $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;



        $controller_name = $controller;


        array_shift($url);//take off the first array's element


        //action

        $action = (isset($url[0])  && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
        $action_name = (isset($url[0]) && $url[0] != '') ? $url[0] : 'index';
        array_shift($url);//take off the first array's element


        //acl check
        //var_dump($controller_name);
        //var_dump($action_name);
        $grantAccess = self::hasAccess($controller_name, $action_name);

        if(!$grantAccess){
            $controller_name = $controller = ACCESS_RESTRICTED;
            $action = 'indexAction';
        }



        //params
        $queryParams = $url;

        $dispatch = new $controller($controller_name, $action);

        if(method_exists($controller, $action)){
            call_user_func_array([$dispatch, $action], $queryParams);
        }else{
            die('That method does not exist in the controller \"'.$controller_name.'\"' .  $action);
        }
        //$dispatch->registerAction($queryParams);



        //dnd($url);
        //die();
    }

    public static function redirect($location){

        if(!headers_sent()){
            header('Location: ' .PROOT.$location);


        }else{
            echo '<script type="text/javascript">';
            echo 'window.location.href="' .PROOT .$location.'";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url='. $location .'" />';
            echo '</noscript>';
            exit;

        }
    }

    public static function hasAccess($controller_name, $action_name = 'index'){

        $acl_file = file_get_contents(ROOT. DS . 'app' . DS . 'views' . DS . 'acl.json');

        $acl = json_decode($acl_file, true);

        //dnd($acl);

        $current_user_acls = ["Guest"];

        $grantAccess = false;

        if(Session::exists(CURRENT_USER_SESSION_NAME)){
            $current_user_acls[] = "LoggedIn";
            foreach(currentUser()->acls() as $a){
                $current_user_acls[] = $a;
            }
        }

        //dnd($current_user_acls);
        //check if exist

        foreach($current_user_acls as $level){
            if(array_key_exists($level, $acl) && array_key_exists($controller_name, $acl[$level])){
                if(in_array($action_name, $acl[$level][$controller_name]) || in_array("*", $acl[$level][$controller_name])){
                    //dnd('yep');
                    $grantAccess = true;
                    break;
                }
            }
        }

        //check for denied

        foreach($current_user_acls as $level){
            $denied = $acl[$level]['denied'];
            if(!empty($denied) && array_key_exists($controller_name, $denied) && in_array($action_name, $denied[$controller_name])){
                $grantAccess = false;
                break;
            }
        }

        return $grantAccess;
    }

    public static function getMenu($menu){

        $menuAry = [];
        $menuFile = file_get_contents(ROOT. DS . 'app' .DS. 'views'.DS. Session::get(LANG) . DS .$menu . '.json');
        //var_dump($menuFile);
        $acl = json_decode($menuFile, true);


        //dnd($acl);


        foreach($acl as $key => $val){
            if(is_array($val)){
                $sub = [];
                foreach($val as $k => $v){
                    if($k == 'separator' && !empty($sub)){
                        $sub[$k] = '';
                        continue;
                    }else if($finalVal = self::get_link($v)){
                        $sub[$k] = $finalVal;
                    }
                }
                if(!empty($sub)){
                    $menuAry[$key] = $sub;
                }
            }else{
                if($finalVal = self::get_link($val)){
                    $menuAry[$key] = $finalVal;
                }
            }
        }
        return $menuAry;
    }

    private static function get_link($val){
        //check if external link
        if(preg_match('/https?:\/\//', $val) == 1){
            return $val;
        }else{
        //aqui
            //dnd(DS);
           $uAry = explode('/', $val);
            $controller_name = ucwords($uAry[0]);
            $action_name = (isset($uAry[1])) ? $uAry[1] : '';
            if(self::hasAccess($controller_name, $action_name)){
                return PROOT . $val;
            }
            return false;
        }
    }
}