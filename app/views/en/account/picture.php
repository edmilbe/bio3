<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div>

    <form class="form"  action="<?=PROOT?>account/picture" method="post" enctype="multipart/form-data">
        <h3 class="text-center">Change Picture</h3>

        <div class="bg-danger">
            <?=$this->displayErrors; ?>
        </div>

        <div class="form-group">
            <label for="files">Imagem</label>
            <input type="file" name="files" id="files" class="form-control">
        </div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

        <div class="pull-right">
            <input type="submit" value="Update" class="btn   btn-primary btn-large">

        </div>


    </form>
</div>
<?php $this->end(); ?>
