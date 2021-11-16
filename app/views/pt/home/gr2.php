

<?php $this->start('body'); ?>
<section class="cont-terceiro">
    <div class="itens-check">
        <form class="bsc-form">
            <input type="text" id="buscar-pr" onkeyup="s_search_pr();" placeholder="Escreva Aqui" class="buscaca-main">
        </form>
    </div>
    <script>


        function s_search_pr(){
            var onn = <?=$this->g1;?>;
            var v = document.getElementById("buscar-pr").value;
            if(v == ''){
                v = 'xxx';
            }
            $.post("ajax/ssearchgr2/"+v+"/"+onn,{v:v, onn:onn},function(data){

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
                <a href="<?=PROOT?>home/index/<?=$gr->group2_id?>/<?=$gr->group1_id?>" class="item-shopping item-min">
                    <div class="item-fotodivs fotodivs-min">

                        <img src="<?=PROOT?>files/grupo2/<?=$gr->file_name;?>" alt="" class="item-pr">

                    </div>
                    <div class="gps all-center">
                        <span class="s-item-name n-maior "><?=$gr->group2_name?></span>
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
    <a href="<?=PROOT?>home/gr1" class="butoes-one">Grupos Iniciais</a>
    <a href="<?=PROOT?>home/gr2" class="butoes-one">Todos</a>

</div>
<?php $this->end(); ?>

