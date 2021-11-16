<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Adicionar Universidade
    </h1>


    <form action="<?=PROOT?>admin/adduniver" class="form" method="post">
        <div class="response">
            <?=$this->displayErrors;


            ?>
        </div>



        <div class="form__group">
            <label class="form__label" for="form2__input-1">Nome da Universidade</label>
            <input autocomplete="off" value="<?=$this->post['univer']?>" type="text" class="form__input" id="form2__input-1" name="univer">
        </div>




        <input type="hidden" name="token" value="<?= $this->token; ?>">




        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Salvar &rarr;" class="btn btn-submit">
        </div>

    </form>





</section>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Todas as Universidades
    </h1>

    <div class="inseridos">
        <?php
        foreach($this->univers as $country):
            ?>
            <form  class="form" method="post">
                <div class="response" id="response<?=$country->univer_id?>">
                    <?=$this->displayErrors;?>
                </div>



                <div class="form__group form__group-35">

                    <input autocomplete="off" value="<?=$country->univer_name;?>" type="text" class="form__input" id="form2__input-1<?=$country->univer_id;?>" name="pais">
                </div>


                <input type="hidden" name="token" value="<?= $this->token; ?>">
                <div class="form__group form__group-25">

                    <input type="button" name="submit" id="submit" onclick="updateUniversidade(<?=$country->univer_id;?>)" value="Salvar Alteração" class="btn btn-submit">

                </div>





            </form>

            <script>

                function updateUniversidade(id){
                    alert(id);
                    document.getElementById('response'+id).innerHTML = displayError("tentando atualizar...");
                    var pais_name = document.getElementById('form2__input-1'+id).value;


                    $.post("ajax/updateuniver/" +
                        id + "/" + pais_name , {}, function (dataa) {

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
