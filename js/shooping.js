






function s_from_main(pr,vl){

    if(vl == ""){

    }else{
        s_change(pr,vl);
    }
}
function s_from_box_plus(pr,vl, preco, pass){



    vl = document.getElementById("shopping-pr"+pr).value;

    if(vl == ""){

    }else{
        vl = pass + parseFloat(vl);
        document.getElementById("shopping-pr"+pr).value = vl;
        s_change(pr,vl);
    }
    //alert(pr);
    stl(pr,vl, preco);

    tg_change();
}
function s_from_box_minus(pr,vl, preco, pass){


    vl = document.getElementById("shopping-pr"+pr).value;



    if(vl == ""){

    }else{

        if(vl >= pass){
            vl = parseFloat(vl) - pass;
        }
        document.getElementById("shopping-pr"+pr).value = vl;
        s_change(pr,vl);
    }
    //alert(pr);
   stl(pr,vl, preco);
    tg_change();
}
function stl(pr,vl, preco){
    $.post("ajax/stl/"+pr+"/"+vl+"/"+preco,{pr : pr, vl:vl, preco : preco},function(data){
        // $("#shopping-tl"+pr).text(data);
        document.getElementById("shopping-tl"+pr).value = data;

    });
}
function s_from_box(pr,vl, preco){

    if(vl == ""){

    }else{
        s_change(pr,vl);
    }
    //alert(pr);
    stl(pr,vl, preco);
    tg_change();
}
function tg_change(){
    $.post("ajax/stg",{},function(data){
        $("#shopping-tg").text(data);
    });
}
function s_from_full(pr){
    var vl = document.getElementById("shopping-pr"+pr).value;
    if(vl  != ""){
        s_from_main(pr,vl);
        s_carrinho();
    }

}
function s_from_plus(pr){
    alert(pr);
    //var vl = document.getElementById("shopping-pr"+pr).value;

    vl = pass + parseFloat(vl);



    document.getElementById("shopping-pr"+pr).value = vl;
    vl = document.getElementById("shopping-pr"+pr).value;

    s_change(pr,vl);


}
function s_from_okay(pr, pass){

    var vl = document.getElementById("shopping-pr"+pr).value;

    if(vl  != ""){
        s_from_main(pr,vl);
        s_carrinho();
    }
    s_change(pr,vl);
}
function s_from_menos(pr, pass){
    var vl = document.getElementById("shopping-pr"+pr).value;
    if(vl  != "" ){

        if(vl >= pass){
            vl = parseFloat(vl) - pass;

            document.getElementById("shopping-pr"+pr).value = vl;
            vl = document.getElementById("shopping-pr"+pr).value;
            //s_change(pr,vl);
        }
    }


}


function s_clearbox(){
    $.post("ajax/sclear",{},function(data){
        $("#itens-shopped").text("");

    });
    tg_change();
    s_carrinho();

}
function shopping_pay(){
    var name = $("#name-order").val();
    var tel = $("#tel-order").val();
    var ads = $("#adress-order").val();
    var msg = "";
    flag = true;
    if(name == ""){
        flag = false;
        msg = "Insira o nome do Comprador!";
    }else if(tel == ""){
        msg = "Insira o numero de telefone do Comprador!";
        flag = false;
    }else if(ads == ""){
        flag = false;
        msg = "Insira a morada do Comprador!";
    }
    document.getElementById("msg-new-pr-error").innerText = msg;
    return flag;

}

