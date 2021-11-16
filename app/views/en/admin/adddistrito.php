<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Adicionar Distrito
    </h1>


    <form action="<?=PROOT?>admin/adddistrito" class="form" method="post">
        <div class="response">
            <?=$this->displayErrors;


            ?>
        </div>



        <div class="form__group">
            <label class="form__label" for="form2__input-1">Nome do distrito</label>
            <input autocomplete="off" value="<?=$this->post['distrito']?>" type="text" class="form__input" id="form2__input-1" name="distrito">
        </div>

        <div class="form__group">
            <label class="form__label" for="pais">País pertecente </label>

            <select  class="form__input" id="pais" name="pais">
                <?php

                foreach ($this->countries as $country):

                    ?>
                    <option value="<?=$country->country_id?>"

                        <?php echo  $this->post['pais'] ==  $country->country_id ? "selected": "";   ?>

                        ><?=$country->country_name?>
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
        Todos os distritos
    </h1>

    <div class="inseridos">
        <?php
        foreach($this->distritos as $country):
            ?>
            <form  class="form" method="post">
                <div class="response" id="response<?=$country->distrito_id?>">
                    <?=$this->displayErrors;?>
                </div>



                <div class="form__group form__group-35">

                    <input autocomplete="off" value="<?=$country->distrito_name;?>" type="text" class="form__input" id="form2__input-1<?=$country->distrito_id;?>" name="pais">
                </div>




                <div class="form__group form__group-25">

                    <select  class="form__input" id="form2__input-2<?=$country->distrito_id;?>" name="pais">
                        <?php

                        foreach ($this->countries as $countr):

                            ?>
                            <option value="<?=$countr->country_id?>"

                                <?php echo  $country->distrito_pais ==  $countr->country_id ? "selected": "";   ?>

                                ><?=$countr->country_name?>
                            </option>

                            <?php
                        endforeach;

                        ?>
                    </select>

                </div>



                <input type="hidden" name="token" value="<?= $this->token; ?>">
                <div class="form__group form__group-25">

                    <input type="button" name="submit" id="submit" onclick="updateDistritos(<?=$country->distrito_id;?>);" value="Salvar Alteração" class="btn btn-submit">

                </div>





            </form>

            <script>

                function updateDistritos(id){

                    document.getElementById('response'+id).innerHTML = displayError("tentando atualizar...");
                    var distrito_name = document.getElementById('form2__input-1'+id).value;

                    var distrito_pais = document.getElementById('form2__input-2'+id).value;
                    //alert(distrito_name);



                    $.post("ajax/updatedistritos/" +
                        id + "/" +
                        distrito_name + "/" +
                        distrito_pais
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
