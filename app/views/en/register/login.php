

<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>




<section class="form-section" id="form-section">
    <h1 class="section-title">
        Entrar
    </h1>
    <form action="<?=PROOT?>register/login" method="post" class="form">
        <div class="response">
            <?=$this->displayErrors;?>
        </div>

        <div class="form__group">
            <label for="name" class="form__label">Email</label>
            <input type="email" class="form__input" id="name"
                   name="name" value="<?=$this->post['name'];?>"
                   placeholder="fernandoafonso@gmail.com">
        </div>
        <div class="form__group">
            <label for="password" class="form__label">Senha</label>
            <input type="password" class="form__input" id="password" name="password"/>
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="btn btn-success" value="Entrar">
        <br>
        <a class="form__link" href="<?=PROOT?>register/recoveremail">Esqueci a senha</a>
        <br>
        <a class="form__link" href="<?=PROOT?>register/register">Registrar agora</a>









    </form>


</section>


<?php $this->end(); ?>
