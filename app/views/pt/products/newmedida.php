<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<section class="cont-terceiro check-item">
    <div class="itens-check itens-edit">

        <div class="item-check item-edit">
            <div class="pegado">
                <h1>Nova Medida</h1>


                <form class="check-pr" method="post" onsubmit="return valformedidas();" enctype="multipart/form-data" >
                    <div class="gpc">
                        <label class="c-titlo">Medida:</label>
                        <input  class="c-item-name n-maior text-area-edit" name="pr-name" id="pr-name" value="<?=$this->post['pr-name'];?>" placeholder="Nome da Medida">
                    </div>

                    <div class="gpc">
                        <label class="c-titlo">Sigla:</label>
                        <input  class="c-item-name n-maior text-area-edit" name="pr-sigla" value="<?=$this->post['pr-sigla'];?>" id="pr-sigla" placeholder="Nome do Produto" >                    </div>
                    <br><br>
                    <div>
                        <span id="msg-new-pr-okay" class="msg msg-success"><?=$this->displayOkay?></span>
                        <span id="msg-new-pr-error" class="msg msg-error"><?=$this->displayErrors?></span>

                    </div>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

                    <br><br>
                    <input type="submit" name="submit" class="butoes-one opc-b" value="Salvar" min="0">
                </form>
            </div>
        </div>



    </div>
</section>
<?php $this->end(); ?>
