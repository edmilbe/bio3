<?php

function dnd($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function sanitize($dirty){
    //return htmlentities(utf8_encode($dirty));

    //return htmlentities($dirty);
    //return utf8_encode($dirty);
    return $dirty;
}
function GetDateTime($time){
    if($time != null){
        return(date("Y-m-d H:i:s",$time ));
    }
    return $time;
}
function GetFromStamp($stamp, $pos){


    $d = new DateTime($stamp);



    $time = $d->getTimestamp();

    if($time != null){
        //return(date("Y-m-d H:i:s",$time ));
        return(date($pos,$time ));

    }
    return $time;
}

function currentUser(){

    return Users::currentLoggedInUser();
}

function posted_values($post){
    $clean_ary = [];
    foreach($post as $key => $value){
        if(is_array($value)){
            foreach($value as $k => $v){
                $clean_ary[$key][$k] = sanitize($v);
            }
        }else{
            $clean_ary[$key] = sanitize($value);
        }
    }
    return $clean_ary;
}

function currentPage(){
    $currentPage = $_SERVER['REQUEST_URI'];
    if($currentPage == PROOT || $currentPage == PROOT.'home/index'){
        $currentPage = PROOT . 'home';
    }
    return $currentPage;
}

function postsanitize($array){
    foreach($array as $key => $value){
        if(is_array($value)){
            foreach($value as $k => $v){
                $_POST[$key][$k] = sanitize($v);
            }
        }else{
            $_POST[$key] = sanitize($value);
        }

    }
}
function sanitizearray($array){
    foreach($array as $key => $value){
        $array[$key] = sanitize($value);
    }
    return $array;
}

//Gera chave userkey

function KeyGenerator()
{
    return sha1(rand() . time());
    //sha1 nap pode ser descriptografada
}

function NumeroEmExtenso($numero){
    $F = new NumberFormatter("pt-PT",NumberFormatter::SPELLOUT);




    if($numero > 1000){


        // 10001
        // 123800
        // 123880
        // 123076
        // 100001
        // 110101
        // 10001
        $mil = intval($numero/1000);

        $resto = $numero - ($mil * 1000);

        if($resto % 100 == 0 || $resto <= 99){
            $e = " e ";
        }else{
            $e = ", ";
        }

        return ($mil == 1 ?  "": $F->format($mil) ) . " mil" . $e . $F->format($resto);

    }

    return $F->format($numero);


    //$F = new NumberFormatter("pt-PT",NumberFormatter::DEFAULT_STYLE);


}


function DataEmExtenso($dia, $mes, $ano){
    $text = " aos " . NumeroEmExtenso($dia) . " dias do mês de ".$mes . " do ano " . NumeroEmExtenso($ano);
    return $text;

}

function encode($value){
    return utf8_encode($value);
}

function decode($value){
    return utf8_decode($value);
}