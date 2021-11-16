<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Adicionar País
    </h1>


    <form action="<?=PROOT?>admin/addpais" class="form" method="post">
        <div class="response">
            <?=$this->displayErrors;


            ?>
        </div>



        <div class="form__group">
            <label class="form__label" for="form2__input-1">Nome do País</label>
            <input autocomplete="off" value="<?=$this->post['pais']?>" type="text" class="form__input" id="form2__input-1" name="pais">
        </div>

        <div class="form__group">
            <label class="form__label" for="form2__input-2">Código da País</label>
            <input autocomplete="off" value="<?=$this->post['codigo']?>" type="text" class="form__input" id="form2__input-2" name="codigo">
        </div>



        <input type="hidden" name="token" value="<?= $this->token; ?>">




        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Salvar &rarr;" class="btn btn-submit">
        </div>

    </form>





</section>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Todos os países
    </h1>

    <div class="inseridos">
        <?php
        foreach($this->countries as $country):
            ?>
            <form  class="form" method="post">
                <div class="response" id="response<?=$country->country_id?>">
                    <?=$this->displayErrors;?>
                </div>



                <div class="form__group form__group-35">

                    <input autocomplete="off" value="<?=$country->country_name;?>" type="text" class="form__input" id="form2__input-1<?=$country->country_id;?>" name="pais">
                </div>

                <div class="form__group form__group-25">

                    <input autocomplete="off" value="<?=$country->country_code;?>" type="text" class="form__input" id="form2__input-2<?=$country->country_id;?>" name="codigo">
                </div>
                <input type="hidden" name="token" value="<?= $this->token; ?>">
                <div class="form__group form__group-25">

                    <input type="button" name="submit" id="submit" onclick="updatePaises(<?=$country->country_id;?>);" value="Salvar Alteração" class="btn btn-submit">

                </div>





            </form>

            <script>

                function updatePaises(id){
                    document.getElementById('response'+id).innerHTML = displayError("tentando atualizar...");
                    var pais_name = document.getElementById('form2__input-1'+id).value;
                    var pais_code = document.getElementById('form2__input-2'+id).value;

                    $.post("ajax/updatepaises/" +
                        id + "/" +
                        pais_name + "/" +
                        pais_code
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
