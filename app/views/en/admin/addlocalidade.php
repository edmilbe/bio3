<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Adicionar Localidade
    </h1>


    <form action="<?=PROOT?>admin/addlocalidade" class="form" method="post">
        <div class="response">
            <?=$this->displayErrors;


            ?>
        </div>



        <div class="form__group">
            <label class="form__label" for="form2__input-1">Nome da Localidade</label>
            <input autocomplete="off" value="<?=$this->post['localidade']?>" type="text" class="form__input" id="form2__input-1" name="localidade">
        </div>

        <div class="form__group">
            <label class="form__label" for="distrito">Distrito pertecente </label>

            <select  class="form__input" id="distrito" name="distrito">
                <?php

                foreach ($this->distritos as $distrito):

                    ?>
                    <option value="<?=$distrito->distrito_id?>"

                        <?php echo  $this->post['distrito'] ==  $distrito->distrito_id ? "selected": "";   ?>

                        ><?=$distrito->distrito_name?>
                    </option>

                    <?php
                endforeach;

                ?>
            </select>

        </div>



        <input type="hidden" name="token" value="<?= $this->token; ?>">




        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Salvar &rarr;" class="btn btn-submit">
        </div>



    </form>



</section>



<section class="form-section" id="form-section">
    <h1 class="section-title">
        Todos as localidades
    </h1>

    <div class="inseridos">
        <?php
        foreach($this->localidades as $country):
            ?>
            <form  class="form" method="post">
                <div class="response" id="response<?=$country->localidade_id?>">
                    <?=$this->displayErrors;?>
                </div>



                <div class="form__group form__group-35">

                    <input autocomplete="off" value="<?=$country->localidade_name;?>" type="text" class="form__input" id="form2__input-1<?=$country->localidade_id;?>" name="pais">
                </div>




                <div class="form__group form__group-25">

                    <select  class="form__input" id="form2__input-2<?=$country->localidade_id;?>" name="pais">
                        <?php

                        foreach ($this->distritos as $countr):

                            ?>
                            <option value="<?=$countr->distrito_id?>"

                                <?php echo  $country->localidade_dist ==  $countr->distrito_id ? "selected": "";   ?>

                                ><?=$countr->distrito_name?>
                            </option>

                            <?php
                        endforeach;

                        ?>
                    </select>

                </div>



                <input type="hidden" name="token" value="<?= $this->token; ?>">
                <div class="form__group form__group-25">

                    <input type="button" name="submit" id="submit" onclick="updateLocalidade(<?=$country->localidade_id;?>);" value="Salvar Alteração" class="btn btn-submit">

                </div>





            </form>

            <script>

                function updateLocalidade(id){

                    document.getElementById('response'+id).innerHTML = displayError("tentando atualizar...");
                    var localidade_name = document.getElementById('form2__input-1'+id).value;

                    var localidade_dist = document.getElementById('form2__input-2'+id).value;
                    //alert(distrito_name);



                    $.post("ajax/updatelocalidade/" +
                        id + "/" +
                        localidade_name + "/" +
                        localidade_dist
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
