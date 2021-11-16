<?php $this->setSiteTitle('Register'); ?>
<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<section class="cont-terceiro check-item">
    <div class="itens-check">
        <div class="forms">
            <span class="title-form">Detailhes</span>

            <form class="new-cad" method="post" action="<?=PROOT?>home/receiver" enctype="multipart/form-data" onsubmit="return valid_receiver();">

                <fieldset><legend>Informatções</legend>
                    <div class="gpc">
                        <label class="c-titlo">Nome Completo:</label>
                        <input type="text" class="c-item-name form-text" value="<?=$this->detail->user_name;?>" name="name" id="name">
                    </div>

                </fieldset>
                <fieldset><legend>Contactos</legend>
                    <div class="gpc">
                        <label class="c-titlo">Telefone:</label>
                        <input type="tel" id="tel" name="tel" class="c-item-name form-text" value="<?=$this->detail->tel_u_name?>"  >
                    </div>

                </fieldset>

                <?php
                //$paises = $db->DBRead("countries", "WHERE country_active = 1 order by country_name asc");


                ?>

                <fieldset><legend>Endrereço</legend>

                    <div class="gpc">
                        <label class="c-titlo">Endereço Completo:</label>
                        <textarea id="address" name="address" class="c-item-name form-text"><?=$this->detail->city_name;?>, <?=$this->detail->country_name;?>, <?=$this->detail->user_address;?>, <?=$this->detail->user_pcode;?></textarea>
                    </div>

                </fieldset>


                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">




                <div>
                    <span id="msg-new-pr-okay" class="msg msg-success"><?=$this->displayOkay;?> </span>
                    <span id="msg-new-pr-error" class="msg msg-error"><?=$this->displayErrors;?></span>

                </div>
                <div class="gpc">
                    <input type="submit" name="save" class="butoes-one" value="Confirmar" min="0">
                    <a class="msg link-solto" href="<?=PROOT?>home/index">Cancelar</a>

                </div>


            </form>
        </div>

    </div>
</section>
<?php $this->end(); ?>
