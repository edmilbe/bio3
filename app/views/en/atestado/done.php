<?php $this->start('head');?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>





<div class="form-section" id="form-section">
    <h1 class="section-title">
        Revisão e Impressão de Atestado de Residência
    </h1>
    <form action="<?=PROOT?>home/done/<?=$this->atestado->atestado_id;?>" method="post" class="form">



        <div class="form__group">
            <label class="form__label" for="form__input-6" >Nº de Atestado</label>
            <input type="text" class="form__input" name="form__input-6" value="<?=$this->atestado->atestado_id?>" id="form__input-6" onkeyup="getAtestadoByAt();" required>
        </div>


        <div class="form__group">
            <label class="form__label" for="form__input-0" >Novo Número de BI</label>
            <input type="text" class="form__input" name="form__input-1" value="<?=$this->atestado->atestado_bi?>" id="form__input-0" onkeyup="getBi();" required>
        </div>
        <div class="form__group" >
            <label class="form__label" for="form__input-2">Nome Completo</label>
            <input type="text" class="form__input" name="form__input-2" value="<?=$this->atestado->atestado_name?>" id="form__input-1" readonly required>
        </div>
        <div class="form__group" >
            <label class="form__label" for="form__input-2">Filiação</label>
            <input type="text" class="form__input" name="form__input-3" value="<?=$this->atestado->atestado_pais?>" id="form__input-2" readonly required>
        </div>
        <div class="form__group" >
            <label class="form__label" for="form__input-3">Naturalidade</label>
            <input type="text" class="form__input" name="form__input-4" value="<?=$this->atestado->atestado_naturalidade?>" id="form__input-3" readonly required>
        </div>
        <div class="form__group" >
            <label class="form__label" for="form__input-4">Residência</label>
            <input type="text" class="form__input" name="form__input-5" value="<?=$this->atestado->atestado_morada?>" id="form__input-4" required>
        </div>
        <input type="hidden" name="token" value="<?=$this->token;?>">
        <br>
        <input type="submit" name="submit" id="submit" value="Salvar e Enviar" class="btn btn-submit">
        <a target="_blank" class="btn" href="../../files/atestados/<?=$this->atestado->atestado_id;?>.pdf">Ver e Imprimir</a>
        <a href="<?= PROOT ?>home/verbi">Ver BI</a>
    </form>

</div>





<?php $this->end(); ?>
