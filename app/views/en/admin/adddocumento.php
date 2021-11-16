<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Adicionar documento de Identificação
    </h1>


    <form action="<?=PROOT?>admin/adddocumento" class="form" method="post">
        <div class="response">
            <?=$this->displayErrors;


            ?>
        </div>



        <div class="form__group">
            <label class="form__label" for="form2__input-1">Nome do documento de Identificação</label>
            <input autocomplete="off" value="<?=$this->post['documento']?>" type="text" class="form__input" id="form2__input-1" name="documento">
        </div>







        <input type="hidden" name="token" value="<?= $this->token; ?>">




        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Salvar &rarr;" class="btn btn-submit">
        </div>



    </form>



</section>




<section class="form-section" id="form-section">
    <h1 class="section-title">
        Todos os documentos
    </h1>

    <div class="inseridos">
        <?php
        foreach($this->documentos as $country):
            ?>
            <form  class="form" method="post">
                <div class="response" id="response<?=$country->documento_id?>">
                    <?=$this->displayErrors;?>
                </div>



                <div class="form__group form__group-35">

                    <input autocomplete="off" value="<?=$country->documento_name;?>" type="text" class="form__input" id="form2__input-1<?=$country->documento_id;?>" name="pais">
                </div>


                <input type="hidden" name="token" value="<?= $this->token; ?>">
                <div class="form__group form__group-25">

                    <input type="button" name="submit" id="submit" onclick="updateDocumentos(<?=$country->documento_id;?>);" value="Salvar Alteração" class="btn btn-submit">

                </div>





            </form>

            <script>

                function updateDocumentos(id){

                    document.getElementById('response'+id).innerHTML = displayError("tentando atualizar...");
                    var documento_name = document.getElementById('form2__input-1'+id).value;

                    //alert(distrito_name);



                    $.post("ajax/updatedocumento/" +
                        id + "/" +
                        documento_name
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
