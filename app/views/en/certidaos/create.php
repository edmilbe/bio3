<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Emissão de Certidões/Autorizações/Licenças
    </h1>

    <form action="<?= PROOT ?>auto/create" method="post" class="form">

        <div class="response">
            <?=$this->displayErrors;?>
        </div>


        <div class="form__group form__group--1">
            <label class="form__label" for="form__input-1">Nº de Bilhete de Identidade <span class="form__label__about">(campo necessário)</span></label>
            <input type="text" autocomplete="off" class="form__input" name="atestado_bi_number" id="form__input-0"
                   onkeyup="getBi();" required>
        </div>
        <div class="form__group form__group--2">
            <label class="form__label" for="form__input-1">Nome Completo <span class="form__label__about">(campo automático)</span></label>
            <input type="text" autocomplete="off" class="form__input" name="form__input-2" id="form__input-1" readonly
                   required>
        </div>





        <div class="form__group form__group--2">
            <label class="form__label" for="form2__input-5">Certidões/Autorizações/Licenças <span class="form__label__about">(campo obrigatório)</span></label>

            <select class="form__input" id="form2__input-5" name="atestado_type">
                <option value="1">Autorização de Construção</option>
                <option value="2">Certificado de Compra de Coval </option>
                <option value="3">Autorização para Modificar o Coval</option>
                <option value="4">Registo do enterramento de cadável</option>
                <option value="5">Licenças Para Barraca</option>
                <option value="6">Autorização modificação, construção da sua barraca em alvenaria</option>

            </select>

        </div>


        <input type="hidden" name="token" value="<?= $this->token; ?>">

        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Emitir Autorização &rarr;" class="btn btn-submit">
        </div>


        <br>
        <ul class="list-others">
            <li class="list-others__item">
                <a href="<?= PROOT ?>bi/newbi" class="list-others__item--link">&rarr; Novo Documento de Identificação</a>
            </li>
            <li class="list-others__item">
                <a href="<?= PROOT ?>auto/" class="list-others__item--link">&rarr; Autorizações</a>
            </li>
            <li class="list-others__item">
                <a href="<?= PROOT ?>bi/" class="list-others__item--link">&rarr; Bilhetes de Identidade</a>

            </li>
        </ul>

    </form>


</section>



<?php $this->end(); ?>
