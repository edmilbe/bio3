

<?php $this->start('body'); ?>
<section class="cont-terceiro">
    <div class="itens-check">
        <form class="bsc-form">
            <input type="text" id="buscar-pr" onkeyup="s_search_pr();" placeholder="Escreva Aqui" class="buscaca-main">
        </form>
    </div>
    <script>
        function s_search_pr(){

            var v = document.getElementById("buscar-pr").value;
            if(v == ''){
                v = 'xxx';
            }
            $.post("ajax/ssearchgr1/"+v,{v:v},function(data){

                $("#itens-shopping").html(data);
            });
        }
    </script>
</section>
<section class="cont-terceiro shopping" id="section">
    <?php
    //$grupos = $db->DBInner("select *from group1 inner join files on group1_foto = file_id");
    if($this->items != false){
        ?>
        <div class="itens-shopping" id="itens-shopping">
            <?php
            foreach($this->items as $gr){

                ?>
                <a href="<?=PROOT?>home/gr2/<?=$gr->group1_id?>" class="item-shopping item-min">
                    <div class="item-fotodivs fotodivs-min">

                        <img src="<?=PROOT?>files/grupo1/<?=$gr->file_name;?>" alt="" class="item-pr">

                    </div>
                    <div class="gps all-center">
                        <span class="s-item-name n-maior "><?=$gr->group1_name?></span>
                    </div>

                    <div class="shopping-pr shopping-min">

                    </div>
                </a>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
    <?php ?>
</section>
<?php $this->end(); ?>

<?php $this->start('bfooter') ?>
<div class="butoes-all">
    <a href="<?=PROOT?>home/gr2" class="butoes-one">Grupos</a>
    <a href="<?=PROOT?>home/index" class="butoes-one">Produtos</a>


</div>

<?php $this->end(); ?>

