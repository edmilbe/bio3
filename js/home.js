function set_chegada_data(id) {
    var dia = $("#dia-c" + id).val();
    var mes = $("#mes-c" + id).val();
    var ano = $("#ano-c" + id).val();
    //alert(dia + " " + mes + " " + ano);
    if (dia != 0 && mes != 0 && ano != 0) {
        $.post("ajax/setchegadadata/" + dia + "/" + mes + "/" + ano + "/" + id, {
            dia: dia,
            mes: mes,
            ano: ano,
            id: id
        }, function (data) {
            //alert(data);
        });
    }

}


function statusOrg(id, token) {

    //var value = $("#statusOrg"+id).checked();
    var input = document.getElementById("statusOrg" + id);

    var value = input.checked == true ? 1 : 0;
    input.checked = value == 1 ? 0 : 1;
    //alert(value);

    $.post(
        "ajax/statusorg/" + id + "/" + value,
        {},
        function (data) {
            //alert(data);
            data == 1 ? input.checked = true : input.checked = false;
            $("#statusOrgLabel" + id).text(input.checked == true ? "Ativa" : "Desativa")
        }
    );


}


function statusMember(id) {

    //var value = $("#statusOrg"+id).checked();
    var input = document.getElementById("statusmember" + id);

    var value = input.checked == true ? 1 : 0;
    input.checked = value == 1 ? 0 : 1;
    //alert(value);

    $.post(
        "ajax/statusmember/" + id + "/" + value,
        {},
        function (data) {
            //alert(data);
            data == 1 ? input.checked = true : input.checked = false;
            $("#statusmemberLabel" + id).text(input.checked == true ? "Ativa" : "Desativa")
        }
    );


}


function members(user, token) {

    var org = $("#org").val();

    //alert(token, user, org);
    $.post(
        "ajax/org/" + user + "/" + org + "/" + token,
        {},
        function (data) {
            document.getElementById("members").innerHTML = data;
        }
    );

}

function addCampoFirst(loc) {
    //alert(loc);
    $.post(
        "ajax/addCampoFirst/",
        {},
        function (data) {
            //alert(data);
            document.getElementById("valores-" + loc).innerHTML = data;
        }
    );
}
function remCampoFirst(loc) {
    //alert(loc);
    if (loc > 1) {
        var b = loc + 1;
        document.getElementById("valores-" + b).innerHTML = "";
        $.post(
            "ajax/remCampoFirst/",
            {},
            function (data) {
                //alert(data);
                document.getElementById("valores-" + loc).innerHTML = data;


            }
        );
    }
}

function addCampoSecond(loc) {
    //alert(loc);
    $.post(
        "ajax/addCampoSecond/",
        {},
        function (data) {
            //alert(data);
            document.getElementById("valoressv-" + loc).innerHTML = data;
        }
    );
}
function remCampoSecond(loc) {
    //alert(loc);
    if (loc > 1) {
        var b = loc + 1;
        document.getElementById("valoressv-" + b).innerHTML = "";
        $.post(
            "ajax/remCampoSecond/",
            {},
            function (data) {
                //alert(data);
                document.getElementById("valoressv-" + loc).innerHTML = data;


            }
        );
    }
}

/**/

function addfromindex(id) {
    //alert(window.location.href);

    var qtd = $("#item" + id).val();


    $.post(
        "ajax/schange/" + id + "/" + qtd,
        {},
        function (data) {
            //alert(data);
            if (data == 1) {

                s_carrinho();
            }
        }
    );
}


function addfrombox(id) {
    //alert(window.location.href);

    var qtd = $("#quantity" + id).val();

    //alert(qtd);
    $.post(
        "ajax/schange/" + id + "/" + qtd,
        {},
        function (data) {
            //alert(data);
            if (data == 1) {

                s_carrinho();
            }
        }
    );

    setTotal(id);
    setSubtotal();
    getTotalFinal();


}


function setTotal(pr) {

    $.post(
        "ajax/gettotal/" + pr,
        {},
        function (data) {
            $("#total" + pr).text(data);
        }
    );
}

function setSubtotal() {
    $.post(
        "ajax/getSubtotal",
        {},
        function (data) {
            $("#subtotal").text(data);
        }
    );
}

function getTotalFinal() {
    $.post(
        "ajax/getSubtotal",
        {},
        function (data) {
            //alert((parseFloat(data) + 10.00).toPrecision(2));
            $("#total_final").text((parseFloat(data) + 10).toFixed(2));
        }
    );
}


function s_change(pr) {

    $.post("ajax/schange/" + pr, {}, function (data) {
        //alert(data);
        if (data == 1) {
            s_carrinho();
        }
    });
}

function s_carrinho() {

    $.post("ajax/scarrinho", {}, function (dataa) {


        $("#box-qt").text((dataa > 0) ? dataa : 0);


    });
}


function getAtestado() {
    var bi = document.getElementById("form__input-0").value;
    bi = bi == "" ? "*" : bi;
    var atestado = document.getElementById("form__input-1").value;


    $.post("ajax/atestadoexists/" + bi + "/" + atestado, {}, function (dataa) {
        //alert(bi + 8);
        document.getElementById("response").innerHTML =

            dataa == 1 ? dataa + "<span class='response__text response__text--okay'>Encontrado</span>" :
            dataa + "<span class='response__text response__text--error'>Não encontrado</span>"
        ;
        //alert(dataa);


    });


}

function getAuto() {
    var bi = document.getElementById("form__input-0").value;
    bi = bi == "" ? "*" : bi;
    var atestado = document.getElementById("form__input-1").value;


    $.post("ajax/autoexists/" + bi + "/" + atestado, {}, function (dataa) {
        //alert(bi + 8);
        document.getElementById("response").innerHTML =

            dataa == 1 ? dataa + "<span class='response__text response__text--okay'>Encontrado</span>" :
            dataa + "<span class='response__text response__text--error'>Não encontrado</span>"
        ;
        //alert(dataa);


    });


}

function buscaAtestado() {
    var atestado = document.getElementById("form__input-0").value;


    //alert(bi);
    //            <a href="#" class="btn btn-submit">numero|nome</a>


    $.post("ajax/buscaatestado/" + atestado, {}, function (dataa) {
        //alert(bi + 8);
        //$("#atestado-corpo").innerHTML(dataa);
        //alert(dataa);

        document.getElementById("bis").innerHTML = atestado != '' ? dataa : "";
    });
}


function buscaAuto() {
    var atestado = document.getElementById("form__input-0").value;


    //alert(bi);
    //            <a href="#" class="btn btn-submit">numero|nome</a>


    $.post("ajax/buscaauto/" + atestado, {}, function (dataa) {
        //alert(bi + 8);
        //$("#atestado-corpo").innerHTML(dataa);
        //alert(dataa);

        document.getElementById("bis").innerHTML = atestado != '' ? dataa : "";
    });
}

function getBi() {
    var input_0 = document.getElementById("form__input-0");
    var input_1 = document.getElementById("form__input-1");
    var input_2 = document.getElementById("form__input-2");
    var input_3 = document.getElementById("form__input-3");

    var bi = input_0.value;

    //alert(bi);
    setName(bi);
    //alert(bi);
    setPais(bi);
    setNature(bi);


}


function buscaBis() {
    var input_0 = document.getElementById("form__input-0");


    var bi = input_0.value;

    //alert(bi);
    //            <a href="#" class="btn btn-submit">numero|nome</a>


    $.post("ajax/buscabi/" + bi, {}, function (dataa) {
        //alert(bi + 8);
        //$("#atestado-corpo").innerHTML(dataa);
        //alert(dataa);

        document.getElementById("bis").innerHTML = bi != '' ? dataa : "";
    });

    //alert(bi);
    setPais(bi);
    setNature(bi);


}

function newemprego(bi) {



}





function displayOkay(msg){
    return  '<span class="response__text response__text--okay">' + msg + '</span>';
}

function displayError(msg){
    return  '<span class="response__text response__text--error">' + msg + '</span>';
}


function setName(bi) {

    $.post("ajax/getbybiname/" + bi, {}, function (dataa) {
        //alert(bi + 8);
        $("#form__input-1").val(dataa);
        //alert(dataa);


    });
}

function setPais(bi) {
    $.post("ajax/getbybipais/" + bi, {}, function (dataa) {

        $("#form__input-2").val(dataa);


    });
}

function setNature(bi) {
    $.post("ajax/getbybinature/" + bi, {}, function (dataa) {

        $("#form__input-3").val(dataa);


    });
}


function getAtestadoByAt() {
    var input_6 = document.getElementById("form__input-6");


    var atestado = input_6.value;

    //alert(bi);
    setBIAtestado(atestado);

    setNameAtestado(atestado);
    //alert(bi);
    setPaisAtestado(atestado);
    setNatureAtestado(atestado);
    setCasaAtestado(atestado);


}

function setBIAtestado(atestado) {

    $.post("ajax/getbyatbi/" + atestado, {}, function (dataa) {
        //alert(bi + 8);
        $("#form__input-0").val(dataa);
        //alert(dataa);


    });
}

function setNameAtestado(atestado) {

    $.post("ajax/getbyatname/" + atestado, {}, function (dataa) {
        //alert(bi + 8);
        $("#form__input-1").val(dataa);
        //alert(dataa);


    });
}

function setPaisAtestado(atestado) {
    $.post("ajax/getbyatpais/" + atestado, {}, function (dataa) {

        $("#form__input-2").val(dataa);


    });
}

function setNatureAtestado(atestado) {
    $.post("ajax/getbyatnature/" + atestado, {}, function (dataa) {

        $("#form__input-3").val(dataa);


    });
}


function setCasaAtestado(atestado) {
    $.post("ajax/getbyatcasa/" + atestado, {}, function (dataa) {

        $("#form__input-4").val(dataa);


    });
}


function saveBi() {
    //alert(1);
}



function atestado_aprovar(id){

    //alert(id);

    document.getElementById('response').innerHTML = displayError("tentando aprovar...");

    $.post("ajax/atestadoaprovar/" +id, {}, function (dataa) {
        document.getElementById('response').innerHTML = displayOkay(dataa);});
}



function atestado_reprovar(id){

    document.getElementById('response').innerHTML = displayError("tentando rejeitar...");

    $.post("ajax/atestadoreprovar/" +id, {}, function (dataa) {
        document.getElementById('response').innerHTML = displayOkay(dataa);});
}

function atestado_concluir(id){

    document.getElementById('response').innerHTML = displayError("tentando concluir...");

    $.post("ajax/atestadoconcluir/" +id, {}, function (dataa) {
        document.getElementById('response').innerHTML = displayOkay(dataa);});
}
function atestado_pendente(id){

    document.getElementById('response').innerHTML = displayError("tentando enviar...");

    $.post("ajax/atestadopendente/" +id, {}, function (dataa) {
        document.getElementById('response').innerHTML = displayOkay(dataa);});
}
function atestado_setobs(id){

    document.getElementById('response').innerHTML = displayError("tentando salvar...");
    var text1 = document.getElementById('obs'+id).value;

    $.post("ajax/atestadosetobs/" +id + "/"+ text1 , {}, function (dataa) {
        document.getElementById('response').innerHTML = displayOkay(dataa);});
}

function atestado_imprimir(id){
    window.location.replace("http:://localhost/camara/01/home/download/atestados/" +id + ".pdf");
    //location.href =
}






function auto_reprovar(id){

    document.getElementById('response').innerHTML = displayError("tentando rejeitar...");

    $.post("ajax/autoreprovar/" +id, {}, function (dataa) {
        document.getElementById('response').innerHTML = displayOkay(dataa);});
}

function auto_concluir(id){

    //alert(id);

    document.getElementById('response').innerHTML = displayError("tentando concluir...");

    $.post("ajax/autoconcluir/" +id, {}, function (dataa) {
        document.getElementById('response').innerHTML = displayOkay(dataa);});
}
function auto_pendente(id){
    //alert(id);

    document.getElementById('response').innerHTML = displayError("tentando enviar...");

    $.post("ajax/autopendente/" +id, {}, function (dataa) {
        document.getElementById('response').innerHTML = displayOkay(dataa);});
}
function auto_setobs(id){

    document.getElementById('response').innerHTML = displayError("tentando salvar...");
    var text1 = document.getElementById('obs'+id).value;

    $.post("ajax/autosetobs/" +id + "/"+ text1 , {}, function (dataa) {
        document.getElementById('response').innerHTML = displayOkay(dataa);});
}


function auto_aprovar(id){

    //alert(id);

    document.getElementById('response').innerHTML = displayError("tentando aprovar...");

    $.post("ajax/autoaprovar/" +id, {}, function (dataa) {
        document.getElementById('response').innerHTML = displayOkay(dataa);});
}










