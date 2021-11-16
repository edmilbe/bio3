<?php $this->start('head');?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>






<section class="section">
    <h1 class="section-title">
       Documentos
    </h1>

    <form action="<?=PROOT?>home/docs/" method="post" class="form" enctype="multipart/form-data">


        <div class="response">
            <?= $this->displayErrors;?>
        </div>

        <div class="row">

            <div class="form__group">
                <label for="componente">Componente</label>

                <select name="componente" id="componente" class="form__input">
                    <option value="5">Escolher...</option>
                    <option value="1">OM4D</option>
                    <option value="2">MB</option>
                    <option value="3">SPG</option>
                    <option value="4">Outros</option>
                </select>
            </div>
            <div class="form__group">
                <input type="text" class="form__input" id="titulo" name="titulo"
                       placeholder="Nome"  />
                <label for="titulo" class="form__label">Nome</label>

            </div>
            <div class="col-1-of-4"><div class="form__group">
                    <label for="foto">Documento</label>
                    <input type="file" id="photo" name="photo">
                </div>
            </div>
        </div>


        <input type="hidden" name="token" value="<?php echo $this->token; ?>">
        <input type="submit" class="btn btn--white" value="Publicar">



    </form>

</section>






<?php $this->end(); ?>
