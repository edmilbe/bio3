





<?php $this->start('head'); ?>
<?php $this->siteTitle(''); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>




<section class="form-section" id="form-section">
    <h1 class="section-title">Meus Detalhes</h1>

    <form action="<?=PROOT?>account/details" method="post" class="form">
        <div class="response">
            <?=$this->displayErrors;?>
        </div>
        <div class="form__group">
            <label for="fname" class="form__label">Nome Completo</label>
            <input type="text" class="form__input" id="fname" name="fname" value="<?=$this->user->user_fname;?>"
                   placeholder="Jonas Silva dos Santos">

        </div>
        <div class="form__group">
            <label for="email" class="form__label">Número de Telemóvel</label>
            <input type="email" class="form__input" id="email" name="email" value="<?=$this->email;?>" placeholder="joao_fonseca@gmail">
        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

        <input type="submit" value="Atualizar" class="btn btn-success">

    </form>
</section>


<?php $this->end(); ?>
