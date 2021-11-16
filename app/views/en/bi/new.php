<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>

<section class="form-section" id="form-section">
    <ul class="list-others">


        <li class="list-others__item">
            <a href="<?= PROOT ?>bi/index" class="list-others__item--link">&rarr; Documentos de Identificação</a>

        </li>
    </ul>

    <h1 class="section-title">
        Novo Documento de Identificação
    </h1>

    <form action="<?= PROOT ?>bi/newbi" method="post" class="form">
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

                        <?php echo  $this->post['documento'] ==  $documento->documento_id ? "selected": "";   ?>

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

                        <?php echo  $this->post['entidade'] ==  $entidade->entidade_id ? "selected": "";   ?>

                        ><?=$entidade->entidade_name?></option>

                    <?php
                endforeach;

                ?>
            </select>
        </div>


        <div class="form__group">
            <label class="form__label" for="form2__input-0">Nº do Documento de Identificação</label>
            <input value="<?=$this->post['bi']?>" type="text" class="form__input" id="form2__input-0" name="bi" required>
        </div>

        <div class="form__group">
            <label class="form__label" for="form2__input-1">Nome Completo</label>
            <input value="<?=$this->post['name']?>" type="text" class="form__input" id="form2__input-1" name="name">
        </div>



        <div class="form__group">
            <label class="form__label" for="form2__input-3">Pai</label>
            <input value="<?=$this->post['pai']?>"  type="text" class="form__input" id="form2__input-3" name="pai" required>
        </div>

        <div class="form__group">
            <label class="form__label" for="form2__input-2">Mãe</label>
            <input value="<?=$this->post['mae']?>" type="text" class="form__input" id="form2__input-2" name="mae" required>
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
                            <?php echo  $this->post['nas-dia'] ==  $dia->dia_id ? "selected": "";   ?>
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

                            <?php echo  $this->post['nas-mes'] ==  $mes->mes_id ? "selected": "";   ?>

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
                            <?php echo  $this->post['nas-ano'] ==  $ano->ano_name ? "selected": "";   ?>

                            ><?=$ano->ano_name?></option>

                        <?php
                    endforeach;

                    ?>
                </select>

            </div>


        </div>


        <div class="form__group">
            <label class="form__label" for="form2__input-4">Naturalidade</label>
            <select class="form__input" id="form2__input-4" name="nature">
                <?php

                foreach ($this->localidades as $localidade):

                    ?>
                    <option value="<?=$localidade->localidade_id?>"

                        <?php echo  $this->post['nature'] ==  $localidade->localidade_id ? "selected": "";   ?>

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
                    <?php echo !isset($this->post['genero'])   ? "checked":
                        $this->post['genero'] ==  '' || $this->post['genero'] ==  1 ? "checked" : ""  ?>

                       name="estado" value="1">
                <label for="genero_1" class="form__radio-label">
                    <span class="form__radio-button"></span>
                    Masculino
                </label>
            </div>
            <div class="form__radio-group form__group-35">
                <input type="radio" class="form__radio-input" id="genero_2" name="genero"
                    <?php echo  $this->post['genero'] ==  2 ? "checked": "";   ?>

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

                            <?php echo  $this->post['emissao-dia'] ==  $dia->dia_id ? "selected": "";   ?>

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

                            <?php echo  $this->post['emissao-mes'] ==  $mes->mes_id ? "selected": "";   ?>

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
                            <?php echo  $this->post['emissao-ano'] ==  $ano->ano_name ? "selected": "";   ?>

                            ><?=$ano->ano_name?></option>

                        <?php
                    endforeach;

                    ?>
                </select>

            </div>


        </div>

        <br>

        <div class="form__group">

            <label class="form__label" for="form2__input-6">Estado Cívil</label>
            <select class="form__input" id="form2__input-6" name="estado">
                <?php

                foreach ($this->estados as $estado):



                    ?>
                    <option value="<?=$estado->estado_id?>"
                        <?php echo  $this->post['estado'] ==  $estado->estado_id ? "selected": "";   ?>

                        ><?=$estado->estado_name?></option>

                    <?php
                endforeach;

                ?>
            </select>

        </div>

        <input type="hidden" name="token" value="<?= $this->token; ?>">


        <script>

            //getBi();
        </script>
        <br>
        <button onclick="saveBi();" class="btn btn-submit">Salvar</button>
        <div class="error">

        </div>
    </form>
</section>


<?php $this->end(); ?>