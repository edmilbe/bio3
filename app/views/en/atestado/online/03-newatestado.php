<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Atestado para Fins de <?=$this->name;?>
    </h1>


    <form action="#" class="form">
        <div class="response">
            <?=$this->displayErrors;


            ?>
        </div>

        <div class="form__group form__group--1">
            <label class="form__label" for="form__input-1">Nº de Bilhete de Identidade <span class="form__label__about">(campo necessário)</span></label>
            <input type="text" autocomplete="off" value="<?=$this->bi;?>" class="form__input" name="form__input-1" id="form__input-1"
                   readonly required>
        </div>




        <div class="form__group">
            <label class="form__label" for="form2__input-1">Nome Completo</label>
            <input value="<?=$this->bis->bi_name?>" type="text" class="form__input" id="form2__input-1" name="name">
        </div>

        <div class="form__group">
            <label class="form__label" for="form2__input-2">Mãe</label>
            <input value="<?=$this->bis->bi_mae?>" type="text" class="form__input" id="form2__input-2" name="mae" required>
        </div>


        <div class="form__group">
            <label class="form__label" for="form2__input-3">Pai</label>
            <input value="<?=$this->bis->bi_pai?>"  type="text" class="form__input" id="form2__input-3" name="pai" required>
        </div>


        <div class="form__group">


            <label class="form__label" for="form2__input-2">Sexo</label>
            <input value="<?=$this->bis->bi_sexo?>"
                   type="text" class="form__input" id="form2__input-2" name="genero" readonly>





        </div>

        <div class="form__group">


            <label class="form__label" for="form2__input-2">Data de Nascimento</label>
            <input value="<?=$this->bis->bi_nasc_dia?>/<?=$this->bis->bi_nasc_mes?>/<?=$this->bis->bi_nasc_ano?>"
                   type="text" class="form__input" id="form2__input-2" name="nas-dia" readonly>





        </div>

        <div class="form__group">


            <label class="form__label" for="form2__input-2">Local de Nascimento</label>
            <input value="<?=$this->bis->bi_nasc_loc?>"  type="text" class="form__input" id="form2__input-2" name="nature" readonly>


        </div>

        <div class="form__group">
            <label class="form__label" for="form2__input-2">Estado Civíl</label>
            <input value="<?=$this->bis->bi_estado?>"  type="text" class="form__input" id="form2__input-2" name="emissao" readonly>
        </div>
        <div class="form__group">
            <label class="form__label" for="form2__input-2">Data de Emissão</label>
            <input value="<?=$this->bis->bi_emi_dia?>/<?=$this->bis->bi_emi_mes?>/<?=$this->bis->bi_emi_ano?>"  type="text" class="form__input" id="form2__input-2" name="emissao" readonly>
        </div>








    </form>

    <form action="<?= PROOT ?>atestado/newatestado3/<?=$this->bi;?>/<?=$this->type;?>" method="post" class="form">

        <div class="response">
            <?=$this->displayErrors;?>
        </div>



        <div class="form__group form__group--2">
            <label class="form__label" for="house">Nº de Casa <span class="form__label__about">(campo obrigatório)</span></label>
            <input type="text" onkeyup="newemprego(<?php echo $this->bi;?>);" value="<?=$this->post['house']?>" autocomplete="off" class="form__input" name="house" id="house" required>
        </div>

        <div class="form__group">
            <label class="form__label" for="localidade">Localidade </label>

            <select onchange="newemprego(<?php echo $this->bi;?>);" class="form__input" id="localidade" name="localidade">
                <?php

                foreach ($this->localidades as $localidade):

                    ?>
                    <option value="<?=$localidade->localidade_id?>"

                        <?php echo  $this->post['localidade'] ==  $localidade->localidade_id ? "selected": "";   ?>

                        ><?=utf8_encode($localidade->localidade_name)?></option>

                    <?php
                endforeach;

                ?>
            </select>

        </div>

        <div class="form__group form__group--2">
            <label class="form__label" for="tempo">Tempo/Desde <span class="form__label__about">(campo obrigatório)</span></label>
            <input type="text" onkeyup="newemprego(<?php echo $this->bi;?>);" value="<?=$this->post['tempo']?>" autocomplete="off" class="form__input" name="tempo" id="tempo" required>
        </div>
















        <div class="text">
            <p class="paragraph" id="atestado-corp">

            </p>
        </div>

        <script>
            newemprego(<?php echo $this->bi;?>);
        </script>




        <input type="hidden" name="token" value="<?= $this->token; ?>">


        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Salvar e Enviar &rarr;" class="btn btn-submit">
        </div>

    </form>


</section>




<?php $this->end(); ?>
