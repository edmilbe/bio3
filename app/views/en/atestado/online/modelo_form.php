<?php $this->start('head');?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>





<section class="form-section" id="form-section">
    <h1 class="section-title">
        Emissão de Certidão de Residência
    </h1>
    <form action="<?=PROOT?>home/documents" method="post" class="form">

        <div class="response">
            <span class="response__text response__text--error">Insira o Número do Bilhete de Identidade do Utente!</span>
            <span class="response__text response__text--okay">Atestado concluído com sucesso!</span>
        </div>


        <div class="form__group form__group--1">
            <label class="form__label" for="form__input-1" >Nº de Bilhete de Identidade <span class="form__label__about">(campo necessário)</span></label>
            <input type="text" autocomplete="off" class="form__input" name="form__input-1" id="form__input-0" onkeyup="getBi();" required>
        </div>
        <div class="form__group form__group--2" >
            <label class="form__label" for="form__input-1">Nome Completo <span class="form__label__about">(campo automático)</span></label>
            <input type="text" autocomplete="off" class="form__input" name="form__input-2" id="form__input-1" readonly required>
        </div>
        <div class="form__group form__group--2" >
            <label class="form__label" for="form__input-2">Filiação <span class="form__label__about">(campo automático)</span></label>
            <input type="text" autocomplete="off" class="form__input" name="form__input-3" id="form__input-2" readonly required>
        </div>
        <div class="form__group form__group--2" >
            <label class="form__label" for="form__input-3">Naturalidade <span class="form__label__about">(campo automático)</span></label>
            <input type="text" autocomplete="off" class="form__input" name="form__input-4" id="form__input-3" readonly required>
        </div>
        <div class="form__group form__group--2" >
            <label class="form__label" for="form__input-4">Residência <span class="form__label__about">(campo obrigatório)</span></label>
            <input type="text" autocomplete="off" class="form__input" name="form__input-5" id="form__input-4" required>
        </div>
        <input type="hidden" name="token" value="<?=$this->token;?>">
        <div class="form__group form__group--3" >
            <input type="submit" name="submit" id="submit" value="Salvar e Enviar &rarr;" class="btn btn-submit">
        </div>
        <div class="form__group u-margin-bottom-medium">
            <div class="form__radio-group">
                <input type="radio" class="form__radio-input" id="small" name="size">
                <label for="small" class="form__radio-label">
                    <span class="form__radio-button"></span>
                    Small tour group
                </label>
            </div>

            <div class="form__radio-group">
                <input type="radio" class="form__radio-input" id="large" name="size">
                <label for="large" class="form__radio-label">
                    <span class="form__radio-button"></span>
                    Large tour group
                </label>
            </div>
        </div>



        <br>
        <ul class="list-others">
            <li class="list-others__item">
                <a href="#popup" class="list-others__item--link">&rarr; Novo Bilhete de Identidade</a>
            </li>
            <li class="list-others__item">
                <a href="<?= PROOT ?>home/atestados" class="list-others__item--link">&rarr; Atestados</a>
            </li>
            <li class="list-others__item">
                <a href="<?= PROOT ?>home/ver BI" class="list-others__item--link">&rarr; Bilhetes de Identidade</a>

            </li>
        </ul>

    </form>






</section>

<div class="popup" id="popup">
    <div class="popup__content">
        <a href="#section-tours" class="popup__close">&times;</a>

        <h1 class="section-title">
            Novo Bilhete de Identidade
        </h1>
        <form action="<?=PROOT?>home/newbi" method="post" class="form">


            <div class="form__group">
                <label class="form__label" for="form2__input-1" >Nº de Bilhete de Identidade</label>
                <input type="text" class="form__input" id="form2__input-0" name="bi" required>
            </div>

               <div class="form__group" >
                   <label class="form__label" for="form2__input-1">Nome Completo</label>
                   <input type="text" class="form__input" id="form2__input-1" name="name" required>
               </div>
               <div class="form__group" >
                   <label class="form__label" for="form2__input-2">Filiação</label>
                   <input type="text" class="form__input" id="form2__input-2" name="pais" required>
               </div>
               <div class="form__group" >
                   <label class="form__label" for="form2__input-3">Naturalidade</label>
                   <input type="text" class="form__input" id="form2__input-3" name="nature" required>
               </div>
            <input type="hidden" name="token" value="<?=$this->token;?>">



            <script>

               //getBi();
            </script>
            <button onclick="saveBi();" class="btn btn-submit">Salvar</button>
            <div class="error">

            </div>
        </form>
    </div>
</div>



<?php $this->end(); ?>
