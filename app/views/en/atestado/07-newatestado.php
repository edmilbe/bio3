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
            <label class="form__label" for="form__input-1">Nº de Documento de Identificação <span class="form__label__about">(campo necessário)</span></label>
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


    
    <form action="<?= PROOT ?>atestado/newatestado7/<?=$this->bi;?>/<?=$this->type;?>" method="post" class="form">

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

                        ><?=$localidade->localidade_name?></option>

                    <?php
                endforeach;

                ?>
            </select>

        </div>


        <div class="row">
            <div class="col-1-of-2">
                <?php

                $name = 'pai';
                $ij = 1;
                ?>


                <div class="form__group u-margin-bottom-medium">
                    <label class="form__label" for="form2__input-4"> Reside com o seu  pai?</label>

                    <div class="form__radio-group form__group-35">
                        <input type="radio"   class="form__radio-input" id="pai1" onclick="checkMe();"

                               name="pai" value="1">
                        <label for="pai1" class="form__radio-label">
                            <span class="form__radio-button"></span>
                            Sim
                        </label>
                    </div>
                    <div class="form__radio-group form__group-35">
                        <input type="radio" class="form__radio-input" id="pai2"

                               name="pai"
                               value="2"  checked  onclick="checkMe();">
                        <label for="pai2" class="form__radio-label">
                            <span class="form__radio-button"></span>
                            Não
                        </label>
                    </div>
                </div>




                <div class="fields" id="pai-field">
                    <div class='form__group'>

                        <label class='form__label' for='desde'> Pai
                            <span class='form__label__about'>(campo obrigatório)</span>
                        </label>
                        <input type='text' autocomplete='off' name='<?=$name?><?=$ij?>'  class='form__input'>

                    </div>

                    <div class="form__group">


                        <label class="form__label" for="form2__input-2">Data de Nascimento</label>

                        <div class="form__group form__group-25">

                            <label class="form__label" for="nas-dia_<?=$name?><?=$ij?>">Dia</label>
                            <select class="form__input" id="nas-dia_<?=$name?><?=$ij?>" name="nas-dia_<?=$name?><?=$ij?>">

                                <?php

                                foreach ($this->dias as $dia):

                                    ?>
                                    <option value="<?=$dia->dia_id?>" ><?=$dia->dia_name?></option>

                                    <?php
                                endforeach;

                                ?>
                            </select>

                        </div>
                        <div class="form__group form__group-35">

                            <label class="form__label" for="nas-mes_<?=$name?><?=$ij?>">Mês</label>
                            <select class="form__input" id="nas-mes_<?=$name?><?=$ij?>" name="nas-mes_<?=$name?><?=$ij?>">
                                <?php

                                foreach ($this->meses as $mes):

                                    ?>
                                    <option value="<?=$mes->mes_id?>"



                                        ><?=$mes->mes_name?></option>

                                    <?php
                                endforeach;

                                ?>
                            </select>

                        </div>

                        <div class="form__group form__group-25">

                            <label class="form__label" for="nas-ano_<?=$name?><?=$ij?>">Ano</label>
                            <select class="form__input" id="nas-ano_<?=$name?><?=$ij?>" name="nas-ano_<?=$name?><?=$ij?>">
                                <?php

                                foreach ($this->anos as $ano):



                                    ?>
                                    <option value="<?=$ano->ano_name?>"

                                        ><?=$ano->ano_name?></option>

                                    <?php
                                endforeach;

                                ?>
                            </select>

                        </div>


                    </div>
                </div>


            </div>
            <div class="col-1-of-2">
                <?php

                $name = 'mae';
                $ij = 1;
                ?>


                <div class="form__group u-margin-bottom-medium">
                    <label class="form__label" for="form2__input-4">Reside com a sua mãe?</label>

                    <div class="form__radio-group form__group-35">
                        <input type="radio" class="form__radio-input" id="mae1"

                               name="mae"  value="1" onclick="checkMe();">
                        <label for="mae1" class="form__radio-label">
                            <span class="form__radio-button"></span>
                            Sim
                        </label>
                    </div>
                    <div class="form__radio-group form__group-35">
                        <input  checked  type="radio" class="form__radio-input" id="mae2"

                               name="mae"
                               value="2" onclick="checkMe();">
                        <label for="mae2" class="form__radio-label">
                            <span class="form__radio-button"></span>
                            Não
                        </label>
                    </div>
                </div>

                <div class="fields" id="mae-field">
                    <div class='form__group'>
                        <label class='form__label' for='desde'> Mãe
                            <span class='form__label__about'>(campo obrigatório)</span>
                        </label>
                        <input type='text' autocomplete='off' name='<?=$name?><?=$ij?>'  class='form__input'>

                    </div>


                    <div class="form__group">


                        <label class="form__label" for="form2__input-2">Data de Nascimento</label>

                        <div class="form__group form__group-25">

                            <label class="form__label" for="nas-dia_<?=$name?><?=$ij?>">Dia</label>
                            <select class="form__input" id="nas-dia_<?=$name?><?=$ij?>" name="nas-dia_<?=$name?><?=$ij?>">

                                <?php

                                foreach ($this->dias as $dia):

                                    ?>
                                    <option value="<?=$dia->dia_id?>" ><?=$dia->dia_name?></option>

                                    <?php
                                endforeach;

                                ?>
                            </select>

                        </div>
                        <div class="form__group form__group-35">

                            <label class="form__label" for="nas-mes_<?=$name?><?=$ij?>">Mês</label>
                            <select class="form__input" id="nas-mes_<?=$name?><?=$ij?>" name="nas-mes_<?=$name?><?=$ij?>">
                                <?php

                                foreach ($this->meses as $mes):

                                    ?>
                                    <option value="<?=$mes->mes_id?>"



                                        ><?=$mes->mes_name?></option>

                                    <?php
                                endforeach;

                                ?>
                            </select>

                        </div>

                        <div class="form__group form__group-25">

                            <label class="form__label" for="nas-ano_<?=$name?><?=$ij?>">Ano</label>
                            <select class="form__input" id="nas-ano_<?=$name?><?=$ij?>" name="nas-ano_<?=$name?><?=$ij?>">
                                <?php

                                foreach ($this->anos as $ano):



                                    ?>
                                    <option value="<?=$ano->ano_name?>"

                                        ><?=$ano->ano_name?></option>

                                    <?php
                                endforeach;

                                ?>
                            </select>

                        </div>


                    </div>
                    <br>
                </div>
            </div>
        </div>


        <script>

            function checkMe(){
                if(!document.getElementById("pai1").checked) {
                    document.getElementById("pai-field").style.display = "none";
                }else{
                    document.getElementById("pai-field").style.display = "block";

                }


                if(!document.getElementById("mae1").checked) {
                    document.getElementById("mae-field").style.display = "none";
                }else{
                    document.getElementById("mae-field").style.display = "block";

                }


            }

            checkMe();

        </script>


        <div class="form__group form__group--min">
            <label class="form__label" for="companheiro">Número de companheiro (a)</span></label>
            <input type="number" min="0" value="0" max="1"  autocomplete="off" class="form__input" name="companheiro" id="companheiro" />
        </div>
        <div class="form__group form__group--min">
            <label class="form__label" for="filhos">Número de Filhos</span></label>
            <input type="number" min="0" value="0" autocomplete="off" class="form__input" name="filhos" id="filhos" />
        </div>
        <div class="form__group form__group--min">
            <label class="form__label" for="netos">Número de Netos</span></label>
            <input type="number" min="0"  value="0" autocomplete="off" class="form__input" name="netos" id="netos" />
        </div>
        <div class="form__group form__group--min">
            <label class="form__label" for="sobrinhos">Número de Sobrinhos</span></label>
            <input type="number"  min="0" value="0"  autocomplete="off" class="form__input" name="sobrinhos" id="sobrinhos" />
        </div>
        <div class="form__group form__group--min">
            <label class="form__label" for="entiados">Número de Entidados</span></label>
            <input type="number" min="0" value="0" autocomplete="off" class="form__input" name="entiados" id="entiados" />
        </div>
        <div class="form__group form__group--min">
            <label class="form__label" for="afilhados">Número de afilhados</span></label>
            <input type="number" min="0" value="0"  autocomplete="off" class="form__input" name="afilhados" id="afilhados" />
        </div>




        <div class="form__group form__group--min">
            <label class="form__label" for="tios">Número de tios</span></label>
            <input type="number" min="0" value="0"  autocomplete="off" class="form__input" name="tios" id="tios" />
        </div>


        <div class="form__group form__group--min">
            <label class="form__label" for="avo">Número de avôs</span></label>
            <input type="number" min="0" value="0"  autocomplete="off" class="form__input" name="avo" id="avo" />
        </div>
        <br><br>
        <span class="btn btn-submit" onclick="filhosaddmore();">Nomear agregados</span>
        <br><br>



        <div class="form__autoinput">


        </div>

        <div class="form__group">
            <label class="form__label" for="desde">Há mais de (anos) <span class="form__label__about">(campo obrigatório)</span></label>
            <input type="number" min="1" value="<?=$this->post['desde']?>" autocomplete="off" class="form__input" name="desde" id="desde" required />
        </div>
        <br>




        <script>


        function filhosaddmore(){



                var sub = document.getElementById('submit');

                sub.disabled = true;



                var filhos = document.getElementById('filhos').value;

                //var mae = document.getElementById('mae').value;
                //var pai = document.getElementById('pai').value;
                var tio = document.getElementById('tios').value;
                var avo = document.getElementById('avo').value;
                var companheiro = document.getElementById('companheiro').value;



                var netos = document.getElementById('netos').value;
                var sobrinhos = document.getElementById('sobrinhos').value;
                var entiados = document.getElementById('entiados').value;
                var afilhados = document.getElementById('afilhados').value;
                var form__autoinput = document.getElementsByClassName('form__autoinput')[0];

                $.post("ajax/addagregados/" +
                    filhos + "/" +
                    netos + "/" +
                    sobrinhos + "/" +
                    entiados + "/" +
                    afilhados + "/" +
            tio + "/" +
                avo + "/" +
                companheiro
                    , {}, function (dataa) {
            //alert(1);
                    //alert(dataa);
                    form__autoinput.innerHTML =  dataa;
                        sub.disabled = false;

                        //alert(dataa);


                });




            }


        </script>




        <input type="hidden" name="token" value="<?= $this->token; ?>">


        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Salvar e Enviar &rarr;" class="btn btn-submit">
        </div>

    </form>
    <br>
    <ul class="list-others">
        <li class="list-others__item">
            <a href="<?= PROOT ?>atestado/buscar" class="list-others__item--link">&rarr; Buscar por Número/Nome/BI</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>atestado/update" class="list-others__item--link">&rarr; Atualizar Atestado</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>bi/newbi" class="list-others__item--link">&rarr; Novo Documento de Identificação</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>atestado/create" class="list-others__item--link">&rarr; Criar Atestado</a>
        </li>

    </ul>

</section>



<?php $this->end(); ?>
