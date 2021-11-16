<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Atualização do Documento de Identificação

    </h1>


    <form action="<?=PROOT?>bi/updatebi/<?=$this->bis->bi_id?>" class="form" method="post">
        <div class="response">
            <?=$this->displayErrors;


            ?>
        </div>

        <div class="form__group">
            <label class="form__label" for="form2__input-4">Documento de Identificação</label>
            <select class="form__input" id="form2__input-4" name="documento">
                <?php

                foreach ($this->documentos as $documento):

                    ?>
                    <option value="<?=$documento->documento_id?>"

                        <?php echo  $this->bis->bi_documento ==  $documento->documento_id ? "selected": "";   ?>

                        ><?=$documento->documento_name?></option>

                    <?php
                endforeach;

                ?>
            </select>
        </div>


        <div class="form__group">
            <label class="form__label" for="form2__input-4">Entidade Emissora</label>
            <select class="form__input" id="form2__input-4" name="entidade">
                <?php

                foreach ($this->entidades as $entidade):

                    ?>
                    <option value="<?=$entidade->entidade_id?>"

                        <?php echo  $this->bis->bi_local_emi ==  $entidade->entidade_id ? "selected": "";   ?>

                        ><?=$entidade->entidade_name?></option>

                    <?php
                endforeach;

                ?>
            </select>
        </div>

        <div class="form__group form__group--1">
            <label class="form__label" for="form__input-1">Nº de Bilhete de Identidade <span class="form__label__about">(campo necessário)</span></label>
            <input type="text" autocomplete="off" value="<?=$this->bis->bi_number?>" class="form__input" name="bi" id="form__input-1"
                    required>
        </div>




        <div class="form__group">
            <label class="form__label" for="form2__input-1">Nome Completo</label>
            <input value="<?=$this->bis->bi_name?>" type="text" class="form__input" id="form2__input-1" name="name">
        </div>
        <div class="form__group">
            <label class="form__label" for="form2__input-3">Pai</label>
            <input value="<?=$this->bis->bi_pai?>"  type="text" class="form__input" id="form2__input-3" name="pai" required>
        </div>
        <div class="form__group">
            <label class="form__label" for="form2__input-2">Mãe</label>
            <input value="<?=$this->bis->bi_mae?>" type="text" class="form__input" id="form2__input-2" name="mae" required>
        </div>






        <div class="form__group">


            <label class="form__label" for="form2__input-2">Data de Nascimento</label>

            <div class="form__group form__group-25">

                <label class="form__label" for="form2__input-2">Dia</label>
                <select class="form__input" id="form2__input-5" name="nas-dia">

                    <?php

                    foreach ($this->dias as $dia):

                        ?>
                        <option value="<?=$dia->dia_id?>"
                            <?php echo  $this->bis->bi_nasc_dia ==  $dia->dia_id ? "selected": "";   ?>
                            ><?=$dia->dia_name?></option>

                        <?php
                    endforeach;

                    ?>
                </select>

            </div>
            <div class="form__group form__group-35">

                <label class="form__label" for="form2__input-2">Mês</label>
                <select class="form__input" id="form2__input-5" name="nas-mes">
                    <?php

                    foreach ($this->meses as $mes):

                        ?>
                        <option value="<?=$mes->mes_id?>"

                            <?php echo  $this->bis->bi_nasc_mes ==  $mes->mes_id ? "selected": "";   ?>

                            ><?=$mes->mes_name?></option>

                        <?php
                    endforeach;

                    ?>
                </select>

            </div>

            <div class="form__group form__group-25">

                <label class="form__label" for="form2__input-2">Ano</label>
                <select class="form__input" id="form2__input-5" name="nas-ano">
                    <?php

                    foreach ($this->anos as $ano):



                        ?>
                        <option value="<?=$ano->ano_name?>"
                            <?php echo  $this->bis->bi_nasc_ano ==  $ano->ano_name ? "selected": "";   ?>

                            ><?=$ano->ano_name?></option>

                        <?php
                    endforeach;

                    ?>
                </select>

            </div>


        </div>


        <div class="form__group">
            <label class="form__label" for="form2__input-4">Local de Nascimento</label>
            <select class="form__input" id="form2__input-4" name="nature">
                <?php

                foreach ($this->localidades as $localidade):

                    ?>
                    <option value="<?=$localidade->localidade_id?>"

                        <?php echo  $this->bis->bi_nasc_loc ==  $localidade->localidade_id ? "selected": "";   ?>

                        ><?=$localidade->localidade_name?></option>

                    <?php
                endforeach;

                ?>
            </select>
        </div>






        <div class="form__group u-margin-bottom-medium">
            <label class="form__label" for="form2__input-4">Sexo</label>

            <div class="form__radio-group form__group-35">
                <input type="radio" class="form__radio-input" id="genero_1" name="genero"
                    <?php echo  $this->bis->bi_sexo ==  1 ? "checked" : ""  ?>

                       name="estado" value="1">
                <label for="genero_1" class="form__radio-label">
                    <span class="form__radio-button"></span>
                    Masculino
                </label>
            </div>
            <div class="form__radio-group form__group-35">
                <input type="radio" class="form__radio-input" id="genero_2" name="genero"
                    <?php echo  $this->bis->bi_sexo ==  2 ? "checked": "";   ?>

                       value="2">
                <label for="genero_2" class="form__radio-label">
                    <span class="form__radio-button"></span>
                    Feminino
                </label>
            </div>
        </div>




        <div class="form__group">


            <label class="form__label" for="form2__input-2">Emissão do BI</label>

            <div class="form__group form__group-25">

                <label class="form__label" for="form2__input-2">Dia</label>
                <select class="form__input" id="form2__input-5" name="emissao-dia">


                    <?php

                    foreach ($this->dias as $dia):

                        ?>
                        <option value="<?=$dia->dia_id?>"

                            <?php echo  $this->bis->bi_emi_dia ==  $dia->dia_id ? "selected": "";   ?>

                            ><?=$dia->dia_name?></option>

                        <?php
                    endforeach;

                    ?>
                </select>

            </div>
            <div class="form__group form__group-35">

                <label class="form__label" for="form2__input-2">Mês</label>
                <select class="form__input" id="form2__input-5" name="emissao-mes">
                    <?php

                    foreach ($this->meses as $mes):

                        ?>
                        <option value="<?=$mes->mes_id?>"

                            <?php echo  $this->bis->bi_emi_mes ==  $mes->mes_id ? "selected": "";   ?>

                            ><?=$mes->mes_name?></option>

                        <?php
                    endforeach;

                    ?>
                </select>

            </div>

            <div class="form__group form__group-25">

                <label class="form__label" for="form2__input-2">Ano</label>
                <select class="form__input" id="form2__input-5" name="emissao-ano">
                    <?php

                    foreach ($this->anos as $ano):



                        ?>
                        <option value="<?=$ano->ano_name?>"
                            <?php echo  $this->bis->bi_emi_ano ==  $ano->ano_name ? "selected": "";   ?>

                            ><?=$ano->ano_name?></option>

                        <?php
                    endforeach;

                    ?>
                </select>

            </div>


        </div>


        <div class="form__group">

            <label class="form__label" for="form2__input-6">Estado Cívil</label>
            <select class="form__input" id="form2__input-6" name="estado">
                <?php

                foreach ($this->estados as $estado):



                    ?>
                    <option value="<?=$estado->estado_id?>"
                        <?php echo  $this->bis->bi_estado ==  $estado->estado_id ? "selected": "";   ?>

                        ><?=$estado->estado_name?></option>

                    <?php
                endforeach;

                ?>
            </select>

        </div>



        <input type="hidden" name="token" value="<?= $this->token; ?>">


        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Atualizar &rarr;" class="btn btn-submit">
        </div>






    </form>



</section>




<?php $this->end(); ?>
