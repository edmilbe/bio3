<?php $this->start('head'); ?>
<meta content="test">
<style>
    #unidades, #outros, #solto{
        display: none;
    }

    #outros3{
        display: none;
    }

</style>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<section class="cont-terceiro check-item">
    <div class="itens-check itens-edit">

        <div class="item-check item-edit">
            <div class="pegado">
                <h1>Novo Produto</h1>

                <!-- onsubmit="return valformpr();" -->
                <form class="check-pr" method="post"  enctype="multipart/form-data">
                    <div class="gpc">
                        <label class="c-titlo">Nome:</label>
                        <textarea  class="c-item-name n-maior text-area-edit" name="pr-name" id="pr-name" placeholder="Nome do Produto"></textarea>
                    </div>
                    <div class="gpc">
                        <label class="c-titlo">Descricao:</label>
                        <textarea  class="c-item-name n-maior text-area-edit" name="pr-desc" id="pr-desc" placeholder="Descricao do Produto"></textarea>
                    </div>
                    <?php
                    ?>
                    <div class="gpc">
                        <label class="c-titlo">Grupo:</label>
                        <select class="select-edit c-item-name" name="grupo" id="grupo">
                            <option value="0">Grupos</option>
                            <?php
                            if($this->grupos != false){
                                foreach($this->grupos as $gr){
                                    ?>
                                    <option value="<?=$gr->group2_id;?>" ><?=$gr->group2_name;?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="gpc" id="escalas">
                        <span class="c-titlo" >Escala:</span>
                        <input type="number" name="escala" id="escala" class="c-item-preco c-item-name" value="1" min="0.1" step="0.1">
                    </div>
                    <div class="gpc">
                        <label class="c-titlo">Marca:</label>
                        <input type="radio" name="marca" id="marca1" value="1" onclick="marcaf();"><label onclick="marcaf();" for="marca1">Sim</label>
                        <br>
                        <input type="radio" name="marca" id="marca2" value="0" onclick="marcaf();"><label onclick="marcaf();" for="marca2">Nao</label>

                    </div>

                    <div class="gpc" id="marcas">
                        <?php

                        ?>
                        <label class="c-titlo">Marca do Produto:</label>
                        <select class="select-edit c-item-name" id="marca-opc" name="marca-opc">
                            <option value="0">Marcas</option>
                            <?php
                            if($this->marcas != false){
                                foreach($this->marcas as $mr){
                                    ?>
                                    <option value="<?=$mr->marca_id;?>" > <?=$mr->marca_name;?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                    </div>
                    <div class="gpc">
                        <label class="c-titlo">Por:</label>
                        <input type="radio" name="unidade" id="unidade1" value="1" onclick="checka();"><label onclick="checka();" for="unidade1">Unidade</label>
                        <br>
                        <input type="radio" name="unidade" id="unidade2" value="2" onclick="checka();"><label onclick="checka();" for="unidade2">Solto</label>
                        <br>
                        <input type="radio" name="unidade"  id="unidade3" value="3" onclick="checka();"><label onclick="checka();" for="unidade3" >Outras Medidas</label>
                    </div>

                    <div class="gpc" id="unidades">
                        <span class="c-titlo" >Preco:</span>
                        <input type="number" name="uni-preco" id="uni-preco" class="c-item-preco c-item-name"  min="0.1" step="0.1">
                    </div>

                    <?php
                    ?>

                    <div class="gpc" id="solto">
                        <span class="c-titlo">Qtd:</span>
                        <input type="number" name="solto-qt" id="solto-qt" class="c-item-preco c-item-name" value="1" min="0.1" step="0.1">
                        <label class="c-titlo">Medida On:</label>
                        <select class="select-edit c-item-name" id="solto-med" name="solto-med">
                            <option value="0">Medidas</option>
                            <?php
                            if($this->medidas != false){
                                foreach($this->medidas as $med){
                                    ?>
                                    <option value="<?=$med->med_id;?>"><?=$med->med_name;?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="c-titlo">Preco:</span>
                        <input type="number" id="solto-preco" name="solto-preco" class="c-item-preco c-item-name"  min="0.1" step="0.1">
                    </div>
                    <div class="gpc" id="outros">

                        <div id="outros1">
                            <span class="c-titlo">Qtd:</span>
                            <input type="number" id="d1-qt" name="d1-qt" class="c-item-preco c-item-name" value="1" min="0.1" step="0.1">
                            <label class="c-titlo">Medida On:</label>
                            <select class="select-edit c-item-name" name="d1-med" id="d1-med">
                                <option value="0">Medidas</option>

                                <?php
                                if($this->medidas != false){
                                    foreach($this->medidas as $med){
                                        ?>
                                        <option value="<?=$med->med_id;?>"><?=$med->med_name;?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <span class="c-titlo">Preco:</span>
                            <input type="number" id="d1-preco" name="d1-preco" class="c-item-preco c-item-name"  min="0.1" step="0.1">
                        </div>
                        <!--<input type="checkbox" name="d[]" id="d3" value="3">-->

                        <label for="d3">D2</label>

                        <div id="outros2">
                            <span class="c-titlo">Qtd:</span>
                            <input type="number"  id="d2-qt" name="d2-qt" class="c-item-preco c-item-name" value="1" min="0.1" step="0.1">
                            <label class="c-titlo">Medida On:</label>
                            <select class="select-edit c-item-name" name="d2-med" id="d2-med">
                                <option value="0">Medidas</option>

                                <?php
                                if($this->medidas != false){
                                    foreach($this->medidas as $med){
                                        ?>
                                        <option value="<?=$med->med_id;?>" ><?=$med->med_name;?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <input type="checkbox" name="d[]" id="d2" value="2"><label for="d2">D3</label>


                        <div id="outros3">


                            <span class="c-titlo">Qtd:</span>
                            <input type="number" id="d3-qt" name="d3-qt" class="c-item-preco c-item-name" value="1" min="0.1" step="0.1">
                            <label class="c-titlo">Medida On:</label>
                            <select class="select-edit c-item-name" name="d3-med" id="d3-med">
                                <option value="0">Medidas</option>

                                <?php
                                if($this->medidas != false){
                                    foreach($this->medidas as $med){
                                        ?>
                                        <option value="<?=$med->med_id;?>"><?=$med->med_name;?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <br>
                    <label for="foto-pn" id="foto-pn-lab" class="label-b" title="Imagens do Produto">Inserir Imagens</label>
                    <input type="file" class="input-hidden"  accept="image/x-png,image/jpeg,image/jpg" name="foto-pn[]" multiple id="foto-pn">
                    <script>
                        $(document).ready(
                            function(){
                                $("#foto-pn").on("change", function(){
                                    $("#foto-pn-lab").text("Imagem Anexada(s)");
                                });
                            }
                        );

                    </script>
                    <br><br>
                    <div>
                        <span id="msg-new-pr-okay" class="msg msg-success"><?=$this->displayOkay?></span>
                        <span id="msg-new-pr-error" class="msg msg-error"><?=$this->displayErrors?></span>

                    </div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                    <br><br>
                    <input type="submit" name="submit" class="butoes-one opc-b" value="Salvar" min="0">
                </form>
            </div>
        </div>



    </div>
</section>

<script>
    var uni1 = document.getElementById("unidade1");
    var uni2 = document.getElementById("unidade2");
    var uni3 = document.getElementById("unidade3");

    var unis = document.getElementById("unidades");
    var solto = document.getElementById("solto");
    var outros = document.getElementById("outros");

    checka();

    function checka(){
        outros.style.display = "none";
        solto.style.display = "none";
        unis.style.display = "none";

        if(uni1.checked){
            unis.style.display = "block";
        }else if(uni2.checked){
            solto.style.display = "block";
        }else if(uni3.checked){
            outros.style.display = "block";
        }
    }
    var outrosd2 = document.getElementById("d2");
    var outrosd3 = document.getElementById("d3");

    var outros3 = document.getElementById("outros3");

    outrosd2.onclick = function(){
        if(outrosd2.checked){
            outros3.style.display = "block";
        }else{
            outros3.style.display = "none";
            outrosd3.checked = false;
        }
    };

    var marca1 = document.getElementById("marca1");
    var marca2 = document.getElementById("marca2");
    var marcas = document.getElementById("marcas");
    marcaf();
    function marcaf(){
        if(marca1.checked){
            marcas.style.display = "block";
        }else{
            marcas.style.display = "none";
        }
    }
    if(document.getElementById("foto-pn").files.length > 0){
        $("#foto-pn-lab").text("Imagem Anexada(s)");
    }

</script>
<?php $this->end(); ?>


