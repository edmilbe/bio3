<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<section class="cont-terceiro check-item">
    <div class="itens-check itens-edit">

        <div class="item-check item-edit">
            <div class="pegado">
                <h1>Novo Group 1</h1>


                <form class="check-pr" method="post" onsubmit="return valforgr1();" enctype="multipart/form-data" >
                    <div class="gpc">
                        <label class="c-titlo">Nome:</label>
                        <textarea  class="c-item-name n-maior text-area-edit" name="pr-name" id="pr-name" placeholder="Nome do Produto"><?=$this->post['pr-name'];?></textarea>
                    </div>

                    <br>
                    <label for="foto-pn" id="foto-pn-lab" class="label-b" title="Imagens do Produto">Inserir Imagem</label>
                    <input type="file" class="input-hidden"  accept="image/x-png,image/gif,image/jpeg,image/jpg" name="foto-pn" id="foto-pn">
                    <script>
                        $(document).ready(
                            function(){
                                $("#foto-pn").on("change", function(){
                                    $("#foto-pn-lab").text("Imagem Anexada");
                                });
                            }
                        );
                    </script>
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

<script>
    if(document.getElementById("foto-pn").files.length == 1){
        $("#foto-pn-lab").text("Imagem Anexada");
    }

</script>