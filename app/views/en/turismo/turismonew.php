<?php $this->start('head');?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>






<section class="section">
    <h1 class="section-title">
        Nova Associação
    </h1>
    <form action="<?=PROOT?>turismo/" method="post" class="form" enctype="multipart/form-data">


        <div class="response">
            <?= $this->displayErrors;?>
        </div>



        <div class="form__group">
            <input type="text" class="form__input" id="titulo" name="titulo"
                   placeholder="Titulo da Notícia" required />
            <label for="titulo" class="form__label">Nome da Associação</label>

        </div>
        <div class="form__group">
            <label for="foto">Fotografia</label>
            <input type="file" id="photo" name="photo">
        </div>




<textarea id="mytextarea" name="text">

    </textarea>

        <script>
            tinymce.init({
                selector: '#mytextarea',
                plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
                toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
                toolbar_mode: 'floating',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name'
            });

        </script>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" class="btn btn--white" value="Publicar">



    </form>

</section>






<?php $this->end(); ?>
