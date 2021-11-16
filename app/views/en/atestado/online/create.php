<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Emissão de Atestado
    </h1>

    <form action="<?= PROOT ?>atestado/create" method="post" class="form">

        <div class="response">
            <?=$this->displayErrors;?>
        </div>


        <div class="form__group form__group--1">
            <label class="form__label" for="form__input-1">Nº de Bilhete de Identidade <span class="form__label__about">(campo necessário)</span></label>
            <input type="text" autocomplete="off" class="form__input" name="atestado_bi_number" id="form__input-0"
                   onkeyup="getBi();" required>
        </div>
        <div class="form__group form__group--2">
            <label class="form__label" for="form__input-1">Nome Completo <span class="form__label__about">(campo automático)</span></label>
            <input type="text" autocomplete="off" class="form__input" name="form__input-2" id="form__input-1" readonly
                   required>
        </div>





        <div class="form__group form__group--2">
            <label class="form__label" for="form2__input-5">Atestado <span class="form__label__about">(campo obrigatório)</span></label>

            <select class="form__input" id="form2__input-5" name="atestado_type">
              <option value="1">Fins de Emprego</option>
                <!--  ha mais de 3 anos e nos ultimos 12 meses-->  <option value="2">Bolsa de Estudos </option>
                <option value="3">Bolsa Interna, á conceder pelos Serviços do Ministério de Educação, Cultura e Formação</option>
                <!--  ha mais de 30 dias e nos ultimos 12 meses--> <option value="4">Casamento</option>
                <option value="5">Candidatura à Transporte Público</option>
                <option value="6">Obtenção de Visto</option>
                <option value="7">Escolares</option>
                <option value="8">Fixação de Residência </option>
                <option value="9">Nacionalidade Santomense </option>
                <option value="10">Percepção da Pensão de Aposentação </option>
                <option value="11">Assistência Judiciária </option>
                <option value="12">Percepção da Pensão de Sobrevivência por morte</option>
                <option value="13">Subsídio de Transporte</option>
                <option value="14">Transferência de mesada monetária</option>
                <option value="15">Abertura de Conta Bancária </option>
                <!--  ha mais de 5 anos --><option value="16">Agregado Familiar</option>
                <option value="17">Prova de Vida </option>
                <option value="18">Residência</option>
                <option value="19">Viagem</option>
                <option value="20">Cargo Público </option>
                <option value="21">Profissionais  </option>
            </select>

        </div>


        <input type="hidden" name="token" value="<?= $this->token; ?>">

        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Criar atestado &rarr;" class="btn btn-submit">
        </div>


        <br>
        <ul class="list-others">
            <li class="list-others__item">
                <a href="<?= PROOT ?>bi/newbi" class="list-others__item--link">&rarr; Novo Bilhete de Identidade</a>
            </li>
            <li class="list-others__item">
                <a href="<?= PROOT ?>atestado/" class="list-others__item--link">&rarr; Atestados</a>
            </li>
            <li class="list-others__item">
                <a href="<?= PROOT ?>bi" class="list-others__item--link">&rarr; Bilhetes de Identidade</a>

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

        <form action="<?= PROOT ?>bi/newbi" method="post" class="form">
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
