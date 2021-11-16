<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<section class="cont-terceiro check-item">
    <div class="itens-check">
        <div class="forms">
            <span class="title-form">Recuperar Conta</span>

            <form class="new-cad" method="post" action="<?=PROOT?>register/recoverpass/<?=$this->key?>"  enctype="multipart/form-data">



                <fieldset><legend>Conta</legend>
                    <div class="gpc">
                        <label class="c-titlo">Nova Senha:</label>
                        <input type="password" id="password" name="password" class="c-item-name form-text" >

                    </div>
                    <div class="gpc">
                        <label class="c-titlo">Confirme a Nova Senha:</label>
                        <input type="password" id="password2" name="password2" class="c-item-name form-text" >

                    </div>
                </fieldset>

                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">




                <div>
                    <span id="msg-new-pr-okay" class="msg msg-success"><?=$this->displayOkay;?> </span>
                    <span id="msg-new-pr-error" class="msg msg-error"><?=$this->displayErrors;?></span>

                </div>
                <div class="gpc">
                    <input type="submit" name="save" class="butoes-one" value="Confirmar" min="0">

                </div>


            </form>
        </div>

    </div>
</section>

<?php $this->end(); ?>
