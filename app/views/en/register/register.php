



<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>






<section class="form-section" id="form-section">
    <h1 class="section-title">
        Registrar
    </h1>
    <form id="personal" class="form" action="<?=PROOT?>register/register" method="post">
        <div class="response">
            <?=$this->displayErrors;?>
        </div>
        <div class="form__group col-md-6">
            <label for="fname" class="form__label">Nome Completo</label>
            <input type="text" class="form__input" id="fname" name="fname" value="<?=$this->post['fname'];?>" placeholder="João António Miguel">
        </div>
        <div class="form__group col-md-6">
            <label for="email" class="form__label">Email</label>
            <input type="email" class="form__input" id="email" name="email" value="<?=$this->post['email'];?>" placeholder="joao@gmail.com">
        </div>





        <div class="form__group col-md-6">
            <label for="password" class="form__label">Senha</label>
            <input type="password" class="form__input" id="password" name="password">
        </div>
        <div class="form__group col-md-6">
            <label for="password-c" class="form__label">Repita a senha</label>
            <input type="password" class="form__input" id="password-c" name="password-c">
        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

        <input type="submit" value="Criar Conta" class="btn btn-success">

        <p class="form__link">Clicando no butão "Criar conta", aceita as políticas de <a href="#">privacidade</a> da AjudaCerta!</p>

        <a class="form__link" href="<?=PROOT;?>register/login">Ja possui uma conta efectuar login.</a>
    </form>



</section>









<?php $this->end(); ?>
