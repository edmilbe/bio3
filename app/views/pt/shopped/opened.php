<?php $this->setSiteTitle('Register'); ?>
<?php $this->start('head'); ?>
<meta content="test">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<section class="cont-terceiro">
    <div class="itens-check">
        <form class="bsc-form">
            <input type="text" id="buscar-pr" placeholder="Numero da Compra" class="buscaca-main">
            <input type="button" class="butoes-one btn-center" value="Buscar" onclick="s_search_pr();">
            <a href="<?=PROOT?>shopped" class="butoes-one btn-center">Compras</a>
        </form>
    </div>
    <script>
        function s_search_pr(){

            var v = document.getElementById("buscar-pr").value;
            if(v == ''){
                v = 'xxx';
            }
            $.post("ajax/getcompra/"+v,{v:v},function(data){

                $("#section").html(data);
            });
        }
    </script>
</section>
<section class="cont-terceiro shopped-all" id="section">

    <?php
    //dnd($this->prds);
    if($this->prds != false){
        ?>
        <div class="itens-shopped">
            <?php
            foreach($this->prds as $prd){
                ?>
                <div class="item-shopped">


                    <!--
                    <div class="item-fotodiv">
                        <img src="pic/ananas.jpg" alt="" class="item-foto">
                    </div>
                    -->
                    <form class="shopped-pr">
                        <div class="gp">
                            <label>Status</label>

                            <span class="item-name">Pendente</span>
                        </div>
                        <div class="gp">
                            <label>Compra</label>

                            <span class="item-name"><?=$prd->shopped_k_id; ?></span>
                        </div>
                        <div class="gp">
                            <label>Qtd. Produto</label>
                            <span class="item-name"><?=$prd->total; ?></span>
                        </div>
                        <a href="<?=PROOT?>shopped/statusordered/<?=$prd->shopped_k_id; ?>" class="butoes-one">Ver</a>
                        <a target="_blank" href="../files/facturas/<?=$prd->shopped_k_fac;?>" class="butoes-one">Factura</a>
                    </form>
                </div>
                <?php
            }
            ?>

        </div>
        <?php
    }

    ?>


</section>
<?php $this->end(); ?>
