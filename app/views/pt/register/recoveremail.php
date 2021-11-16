<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<section class="cont-terceiro check-item">
    <div class="itens-check">
        <div class="forms">
            <span class="title-form">Recupera Conta</span>

            <form class="new-cad" method="post" action="<?=PROOT?>register/recoveremail" enctype="multipart/form-data" onsubmit="return recemail();">


                <fieldset><legend>Contacto</legend>

                    <div class="gpc">
                        <label class="c-titlo">Email:</label>
                        <input type="email" id="email" name="email" class="c-item-name form-text" value="<?=$this->post['email'];?>" >
                    </div>
                </fieldset>



                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">




                <div>
                    <span id="msg-new-pr-okay" class="msg msg-success"><?=$this->displayOkay;?></span>
                    <span id="msg-new-pr-error" class="msg msg-error"><?=$this->displayErrors;?></span>

                </div>
                <div class="gpc">
                    <input type="submit" name="save" class="butoes-one" value="Enviar" min="0">
                    <a class="msg link-solto" href="<?=PROOT?>register/login">Entrar</a>

                </div>


            </form>
        </div>

    </div>
</section>
<?php $this->end(); ?>
