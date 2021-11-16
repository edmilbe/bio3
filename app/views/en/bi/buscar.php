<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Buscar Documentos de identificação
    </h1>

    <form action="<?= PROOT ?>bi/buscar" method="post" class="form">

        <div class="response">
            <?=$this->displayErrors;?>
        </div>


        <div class="form__group form__group--1">
            <label class="form__label" for="form__input-1">Nº do Documento <span class="form__label__about">(campo necessário)</span></label>
            <input type="text" autocomplete="off" class="form__input" name="atestado_bi_number" id="form__input-0"

                   placeholder="Escreva número do documento ou nome da pessoa"
                   onkeyup="buscaBis();" required>
        </div>


        <div class="bis" id="bis">

        </div>







        <input type="hidden" name="token" value="<?=Token::generate(); ?>">




        <br>
        <ul class="list-others">
            <li class="list-others__item">
                <a href="<?= PROOT ?>bi/newbi" class="list-others__item--link">&rarr; Novo Bilhete de Identidade</a>
            </li>


        </ul>

    </form>


</section>

<div class="popup" id="popup">
    <div class="popup__content">
        <a href="#section-tours" class="popup__close">&times;</a>

        <h1 class="section-title">
            Novo Bilhete de Identidade
        </h1>

        <form action="<?= PROOT ?>atestado/newbi" method="post" class="form">
            <div class="response">
                <?=$this->displayErrors;


                ?>
            </div>


            <div class="form__group">
                <label class="form__label" for="form2__input-0">Nº de Bilhete de Identidade</label>
                <input value="<?=$this->post['bi']?>" type="text" class="form__input" id="form2__input-0" name="bi" required>
            </div>

            <div class="form__group">
                <label class="form__label" for="form2__input-1">Nome Completo</label>
                <input value="<?=$this->post['name']?>" type="text" class="form__input" id="form2__input-1" name="name">
            </div>

            <div class="form__group">
                <label class="form__label" for="form2__input-2">Mãe</label>
                <input value="<?=$this->post['mae']?>" type="text" class="form__input" id="form2__input-2" name="mae" required>
            </div>


            <div class="form__group">
                <label class="form__label" for="form2__input-3">Pai</label>
                <input value="<?=$this->post['pai']?>"  type="text" class="form__input" id="form2__input-3" name="pai" required>
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
                <label class="form__label" for="form2__input-4">Local de Nascimento</label>
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

            <div class="form__group u-margin-bottom-medium">
                <div class="form__radio-group">
                    <input type="radio" class="form__radio-input" id="estado_0"
                        <?php echo !isset($this->post['estado'])   ? "checked":
                            $this->post['estado'] ==  '' || $this->post['estado'] ==  1 ? "checked" : ""  ?>

                           name="estado" value="1">
                    <label for="estado_0" class="form__radio-label">
                        <span class="form__radio-button"></span>
                        Solteiro (a)
                    </label>
                </div>

                <div class="form__radio-group">
                    <input type="radio" class="form__radio-input" id="estado_1" name="estado"
                        <?php echo  $this->post['estado'] ==  2 ? "checked": "";   ?>

                           value="2">
                    <label for="estado_1" class="form__radio-label">
                        <span class="form__radio-button"></span>
                        Casado (a)
                    </label>
                </div>
            </div>

            <div class="form__group u-margin-bottom-medium">
                <div class="form__radio-group">
                    <input type="radio" class="form__radio-input" id="estado_2" name="estado"
                        <?php echo  $this->post['estado'] ==  3 ? "checked": "";   ?>

                           value="3">
                    <label for="estado_2" class="form__radio-label">
                        <span class="form__radio-button"></span>
                        Divorciado(a)
                    </label>
                </div>
                <div class="form__radio-group">
                    <input type="radio" class="form__radio-input" id="estado_3" name="estado"
                        <?php echo  $this->post['estado'] ==  4 ? "checked": "";   ?>

                           value="4">
                    <label for="estado_3" class="form__radio-label">
                        <span class="form__radio-button"></span>
                        Viuva
                    </label>
                </div>
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
    </div>
</div>


<?php $this->end(); ?>
