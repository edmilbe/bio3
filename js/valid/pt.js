function valid_login(){
    var name = $("#name").val();

    var pass1 = $("#password").val();

    var msg_okay = document.getElementById("msg-new-pr-okay");
    var msg_error = document.getElementById("msg-new-pr-error");
    msg_okay.innerText = "";
    msg_error.innerText = "";

    var msg = "";
    var flag = false;
    if(name == ""){
        msg = "Insira o Email!";

    }else if(pass1 == ""){
        msg = "Insira Senha!";

    }else if(is_email(name) == false){
        msg = "Insira um Email valido!";

    }else{
        flag = true;
    }

    if(flag == true){
        msg_okay.innerText = "Entrando...";

    }else{
        msg_error.innerText = msg;
    }
    return flag;

}

function is_email(email){
    $.post("ajax/isemail/"+email,{},function(data){
        //alert(data);
        if(data == 1){
            return true;
        }else{
            return false;
        }

    });
}
function exists_email(email){
    $.post("ajax/existsemail/"+email,{},function(data){
        //alert(data);
        if(data == 1){
            return true;
        }else{
            return false;
        }

    });
}
function valforgr2(){
    var grupo = $("#grupo").val();

    var prname = $("#pr-name").val();
    var msg_okay = document.getElementById("msg-new-pr-okay");
    var msg_error = document.getElementById("msg-new-pr-error");
    msg_okay.innerText = "";
    msg_error.innerText = "";


    var msg = "";
    var flag = false;
    if(prname != ""){
        if(grupo != ""){
            if(grupo <= 0){
                msg = "Grupo do Produto Invalido!";
                flag = false;
            }else{

                if(document.getElementById("foto-pn").files.length <= 0){
                    msg = "Insira a imagem!";
                    flag = false;
                }else{
                    flag = true;
                }
            }
        }else{
            msg = "Grupo do Produto!";
            flag = false;
        }

    }else{
        msg = "Nome do Produto!";
        flag = false;
    }



    if(flag == true){
        msg_okay.innerText = "Analizando...";

    }else{
        msg_error.innerText = msg;
    }
    return flag;

}
function valformarca(){


    var prname = $("#pr-name").val();
    //alert(55);
    var msg_okay = document.getElementById("msg-new-pr-okay");
    var msg_error = document.getElementById("msg-new-pr-error");
    msg_okay.innerText = "";
    msg_error.innerText = "";


    var msg = "";
    var flag = false;

    if(prname != ""){
        msg_okay.innerText = "Analizando...";
        return true;
    }else{
        msg = "Insira a marca!";
        flag = false;
    }

    if(flag == true){
        msg_okay.innerText = "Analizando...";

    }else{
        msg_error.innerText = msg;
    }
    return flag;
}
function valformedidas(){


    var prname = $("#pr-name").val();
    //alert(55);
    var msg_okay = document.getElementById("msg-new-pr-okay");
    var msg_error = document.getElementById("msg-new-pr-error");
    msg_okay.innerText = "";
    msg_error.innerText = "";
    var prsigla = $("#pr-sigla").val();


    var msg = "";
    var flag = false;

    if(prname != ""){
        if(prsigla != ""){
            flag = true;
        }else{
            msg = "Insira a Sigla";
            flag = false;
        }
    }else{
        msg = "Insira a medida!";
        flag = false;
    }

    if(flag == true){
        msg_okay.innerText = "Analizando...";

    }else{
        msg_error.innerText = msg;
    }
    return flag;
}
function valforgr1(){


    var prname = $("#pr-name").val();
    //alert(55);
    var msg_okay = document.getElementById("msg-new-pr-okay");
    var msg_error = document.getElementById("msg-new-pr-error");
    msg_okay.innerText = "";
    msg_error.innerText = "";


    var msg = "";
    var flag = false;

    if(prname != ""){
        if(document.getElementById("foto-pn").files.length <= 0){
            msg = "Insira a imagem!";
            flag = false;
        }else{
            flag = true;
        }
    }else{
        msg = "Nome do Produto!";
        flag = false;
    }

    if(flag == true){
        msg_okay.innerText = "Analizando...";

    }else{
        msg_error.innerText = msg;
    }
    return flag;
}
function recemail(){
    var email = $("#email").val();


    var msg_okay = document.getElementById("msg-new-pr-okay");
    var msg_error = document.getElementById("msg-new-pr-error");
    msg_okay.innerText = "";
    msg_error.innerText = "";


    var msg = "";
    var flag = false;
    if(email == ""){
        msg = "Insira o email!";

    }else{
        flag = true;
    }

    if(flag == true){
        msg_okay.innerText = "Verificando...";

    }else{
        msg_error.innerText = msg;
    }
    return flag;

}
function valid_sign(){
    var name = $("#name").val();
    var tel = $("#tel").val();
    var email = $("#email").val();
    var city = $("#city").val();
    var pcode = $("#pcode").val();
    var address = $("#address").val();
    var pass1 = $("#password").val();
    var pass2 = $("#password2").val();
    var msg_okay = document.getElementById("msg-new-pr-okay");
    var msg_error = document.getElementById("msg-new-pr-error");
    msg_okay.innerText = "";
    msg_error.innerText = "";


    var msg = "";
    var flag = false;
    if(name == ""){
        msg = "Insira o nome!";
    }else if(tel == ""){
        msg = "Insira o telefone";
    }else if(email == ""){
        msg = "Insira o email!";

    }else if(is_email(email) == false){
        msg = "Insira um Email valido!";

    }else if(exists_email(email) == true){
        msg = "Este email ja esta registrado!";

    }else if(city < 1){
        msg = "Escolha a cidade!";

    }else if(address == ""){
        msg = "Insira o endereço!";

    }else if(pcode == ''){
        msg = "Inisra a caixa postal!";

    }else if(pass1 == ""){
        msg = "Nova Senha!";

    }else if(pass2 == ""){
        msg = "Repita a senha!";

    }else if(pass2 !== pass1){
        msg = "Insira senhas identicas";

    }else{
        flag = true;
    }

    if(flag == true){
        msg_okay.innerText = "Processando...";

    }else{
        msg_error.innerText = msg;
    }
    return flag;

}

function valid_detail(){
    //alert(5);
    var name = $("#name").val();
    var tel = $("#tel").val();
    var email = $("#email").val();
    var city = $("#city").val();
    var pcode = $("#pcode").val();
    var address = $("#address").val();

    var msg_okay = document.getElementById("msg-new-pr-okay");
    var msg_error = document.getElementById("msg-new-pr-error");
    msg_okay.innerText = "";
    msg_error.innerText = "";


    var msg = "";
    var flag = false;
    if(name == ""){
        msg = "Insira o nome!";
    }else if(tel == ""){
        msg = "Insira o telefone";
    }else if(email == ""){
        msg = "Insira o email!";

    }else if(is_email(email) == false){
        msg = "Insira um Email valido!";

    }else if(city < 1){
        msg = "Escolha a cidade!";

    }else if(address == ""){
        msg = "Insira o endereço!";

    }else if(pcode == ''){
        msg = "Inisra a caixa postal!";

    }else{
        flag = true;
    }

    if(flag == true){
        msg_okay.innerText = "Processando...";

    }else{
        msg_error.innerText = msg;
    }
    return flag;

}

function valid_receiver(){
    var name = $("#name").val();
    var tel = $("#tel").val();
    var city = $("#city").val();
    var address = $("#address").val();

    var msg_okay = document.getElementById("msg-new-pr-okay");
    var msg_error = document.getElementById("msg-new-pr-error");
    msg_okay.innerText = "";
    msg_error.innerText = "";


    var msg = "";
    var flag = false;
    if(name == ""){
        msg = "Insira o nome!";
    }else if(tel == ""){
        msg = "Insira o telefone";
    }else if(address == ""){
        msg = "Insira o endereço!";

    }else{
        flag = true;
    }

    if(flag == true){
        msg_okay.innerText = "Processando...";

    }else{
        msg_error.innerText = msg;
    }
    return flag;

}