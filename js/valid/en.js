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
        msg = "Type email!";

    }else if(pass1 == ""){
        msg = "Type password!";

    }else if(is_email(name) == false){
        msg = "Insert a valid email!";

    }else{
        flag = true;
    }

    if(flag == true){
        msg_okay.innerText = "Checking...";

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
                msg = "Invalid Item's group!";
                flag = false;
            }else{

                if(document.getElementById("foto-pn").files.length <= 0){
                    msg = "Insert the image!";
                    flag = false;
                }else{
                    flag = true;
                }
            }
        }else{
            msg = "Choose the item's group!";
            flag = false;
        }

    }else{
        msg = "Type item's name!";
        flag = false;
    }



    if(flag == true){
        msg_okay.innerText = "Checking...";

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
            msg = "Insert the image!";
            flag = false;
        }else{
            flag = true;
        }
    }else{
        msg = "Type item's name!";
        flag = false;
    }

    if(flag == true){
        msg_okay.innerText = "Checking...";

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
        msg = "Type name!";
    }else if(tel == ""){
        msg = "Type phone number!";
    }else if(email == ""){
        msg = "Type email!";

    }else if(is_email(email) == false){
        msg = "Type valid email!";

    }else if(exists_email(email) == true){
        msg = "This email is in use!";

    }else if(city < 1){
        msg = "Choose the City!";

    }else if(address == ""){
        msg = "Type the Address!";

    }else if(pcode == ''){
        msg = "Type the Post Code!";

    }else if(pass1 == ""){
        msg = "Type the new password!";

    }else if(pass2 == ""){
        msg = "Confirm the new password!";

    }else if(pass2 !== pass1){
        msg = "New password and confirm does not matches!";

    }else{
        flag = true;
    }

    if(flag == true){
        msg_okay.innerText = "Processing...";

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
        msg = "Type name!";
    }else if(tel == ""){
        msg = "Type phone number!";
    }else if(email == ""){
        msg = "Type email!";

    }else if(is_email(email) == false){
        msg = "Type valid email!";

    }else if(city < 1){
        msg = "Choose the City!";

    }else if(address == ""){
        msg = "Type the Address!";

    }else if(pcode == ''){
        msg = "Type the Post Code!";

    }else{
        flag = true;
    }

    if(flag == true){
        msg_okay.innerText = "Processing...";

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
        msg = "Type name!";
    }else if(tel == ""){
        msg = "Type phone number!";
    }else if(address == ""){
        msg = "Type the Address!";

    }else{
        flag = true;
    }

    if(flag == true){
        msg_okay.innerText = "Processing...";

    }else{
        msg_error.innerText = msg;
    }
    return flag;

}