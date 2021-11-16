<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>



<section class="form-section" id="form-section">
    <h1 class="section-title">
        Alterar a Senha
    </h1>

       <form  class="form" method="post" action="<?=PROOT?>account/password"  enctype="multipart/form-data">
        <div class="response">
            <?=$this->displayErrors;?>
        </div>


        <div class="form__group col-sm-4">
            <label class="form__label">Senha atual:</label>
            <input type="password" id="current" name="current" class="form__input" >

        </div>
        <div class="form__group col-sm-4">
            <label class="form__label">Nova senha:</label>
            <input type="password" id="password" name="password" class="form__input" >

        </div>
        <div class="form__group col-sm-4">
            <label class="form__label">Confirmar a nova senha:</label>
            <input type="password" id="password2" name="password2" class="form__input" >

        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

        <input type="submit" name="save" class="btn btn-success" value="Alterar" >





    </form>

    </section>
<?php $this->end(); ?>



