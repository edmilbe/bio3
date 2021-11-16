<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<section class="cont-terceiro check-item">
    <div class="itens-check">
        <div class="forms">
            <span class="title-form">Registrar</span>

            <form class="new-cad" method="post" action="<?PROOT?>register/register" enctype="multipart/form-data" onsubmit="return valid_sign();">

                <fieldset><legend>Informações</legend>
                    <div class="gpc">
                        <label class="c-titlo">Nome Completo:</label>
                        <input type="text" class="c-item-name form-text" value="<?=$this->post['name'];?>" name="name" id="name">
                    </div>

                </fieldset>
                <fieldset><legend>Contacts</legend>
                    <div class="gpc">
                        <label class="c-titlo">Telfone:</label>
                        <input type="tel" id="tel" name="tel" class="c-item-name form-text" value="<?=$this->post['tel'];?>"  >
                    </div>
                    <div class="gpc">
                        <label class="c-titlo">Email:</label>
                        <input type="email" id="email" name="email" class="c-item-name form-text" value="<?=$this->post['email'];?>" >
                    </div>
                </fieldset>

                <?php
                //$paises = $db->DBRead("countries", "WHERE country_active = 1 order by country_name asc");


                ?>

                <fieldset><legend>Address</legend>
                    <div class="gpc">
                        <label class="c-titlo">Cidade:</label>

                                <span class="juntos">
                                    <select class="c-item-name form-text" name="city" id="city">
                                        <option value="0">Escolher...</option>
                                        <?php

                                        if($this->p){
                                            foreach($this->p as $pais => $cities){

                                                if(is_array($cities)) {
                                                    ?>
                                                    <optgroup label="<?=$pais;?>">
                                                        <?php
                                                        foreach($cities as $city){
                                                            ?>
                                                            <option value="<?=$city->city_id;?>" <?php echo $city->city_id == $this->post['city'] ? "selected" : "";?>><?=$city->city_name;?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </optgroup>
                                                    <?php
                                                }
                                                ?>

                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </span>

                    </div>
                    <div class="gpc">
                        <label class="c-titlo">Endereço:</label>
                        <input type="text" id="address" name="address" value="<?=$this->post['address'];?>" class="c-item-name form-text" >
                    </div>
                    <div class="gpc">
                        <label class="c-titlo">Caixa Postal:</label>
                        <input type="text" id="pcode" name="pcode" value="<?=$this->post['pcode'];?>"  class="c-item-name form-text" >
                    </div>
                </fieldset>

                <fieldset><legend>Conta</legend>
                    <div class="gpc">
                        <label class="c-titlo">Escolha uma Senha:</label>
                        <input type="password" id="password" name="password" class="c-item-name form-text" >

                    </div>
                    <div class="gpc">
                        <label class="c-titlo">Confirme a Senha:</label>
                        <input type="password" id="password2" name="password2" class="c-item-name form-text" >

                    </div>
                </fieldset>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">




                <div>
                    <span id="msg-new-pr-okay" class="msg msg-success"></span>
                    <span id="msg-new-pr-error" class="msg msg-error"><?=$this->displayErrors;?></span>

                </div>
                <div class="gpc">
                    <input type="submit" name="save" class="butoes-one" value="Registrar" min="0">
                    <a class="msg link-solto" href="<?=PROOT?>register/login">Entrar</a>

                </div>


            </form>
        </div>

    </div>
</section>
<?php $this->end(); ?>
