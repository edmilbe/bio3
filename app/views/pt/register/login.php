<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<section class="cont-terceiro check-item">
    <div class="itens-check">
        <div class="forms">
            <form class="check-pr new-cad" method="post" action="<?=PROOT?>register/login" onsubmit="return valid_login();">
                <div class="gpc">
                    <label class="c-titlo">Login:</label>
                    <input type="email" placeholder="Email" value="<?=$this->post['name']?>" class="c-item-name form-text" name="name" id="name">
                </div>

                <div class="gpc">
                    <label class="c-titlo">Senha:</label>
                    <input type="password" id="password" name="password" class="c-item-name form-text" >
                    <a class="msg link-solto" href="<?=PROOT?>register/recoveremail">Esqueci a Senha</a>

                </div>

                <div>
                    <span id="msg-new-pr-okay" class="msg msg-success"></span>
                    <span id="msg-new-pr-error" class="msg msg-error"><?=$this->displayErrors;?></span>

                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                <div class="gpc">
                    <input type="submit" name="save" class="butoes-one" value="Enter" min="0">
                    <a class="msg link-solto" href="<?=PROOT?>register/register">Registrar</a>
                </div>


            </form>
        </div>


    </div>
</section>
<?php $this->end(); ?>
