<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Adicionar Estado Cívil
    </h1>


    <form action="<?=PROOT?>admin/addestado" class="form" method="post">
        <div class="response">
            <?=$this->displayErrors;

            ?>
        </div>



        <div class="form__group">
            <label class="form__label" for="form2__input-1">Nome do estado cívil</label>
            <input autocomplete="off" value="<?=$this->post['estado']?>" type="text" class="form__input" id="form2__input-1" name="estado">
        </div>







        <input type="hidden" name="token" value="<?= $this->token; ?>">




        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Salvar &rarr;" class="btn btn-submit">
        </div>



    </form>



</section>
<section class="form-section" id="form-section">
    <h1 class="section-title">
        Todos os estados civís
    </h1>

    <div class="inseridos">
        <?php
        foreach($this->estados as $country):
            ?>
            <form  class="form" method="post">
                <div class="response" id="response<?=$country->estado_id?>">
                    <?=$this->displayErrors;?>
                </div>



                <div class="form__group form__group-35">

                    <input autocomplete="off" value="<?=$country->estado_name;?>" type="text" class="form__input" id="form2__input-1<?=$country->estado_id;?>" name="pais">
                </div>




                <input type="hidden" name="token" value="<?= $this->token; ?>">
                <div class="form__group form__group-25">

                    <input type="button" name="submit" id="submit" onclick="updateEstados(<?=$country->estado_id;?>);" value="Salvar Alteração" class="btn btn-submit">

                </div>





            </form>

            <script>

                function updateEstados(id){

                    document.getElementById('response'+id).innerHTML = displayError("tentando atualizar...");
                    var entidade_name = document.getElementById('form2__input-1'+id).value;

                    //alert(distrito_name);



                    $.post("ajax/updateestado/" +
                        id + "/" +
                        entidade_name
                        , {}, function (dataa) {

                            document.getElementById('response'+id).innerHTML = displayOkay(dataa);


                            //alert(dataa);


                        });
                }

            </script>
            <?php

        endforeach;
        ?>
    </div>










</section>




<?php $this->end(); ?>
