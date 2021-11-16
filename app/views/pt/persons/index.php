

<?php $this->start('body'); ?>


<section class="cont-terceiro shopped-all">

    <?php

    if($this->users != false){
        ?>
        <div class="itens-shopped">
            <?php
            foreach($this->users as $user){

                ?>
                <div class="item-shopped">


                    <div class="item-fotodiv">
                        <img src="<?=PROOT?>files/users/<?=$user->file_name; ?>" alt="" class="item-foto">
                    </div>

                    <form class="shopped-pr">
                        <div class="gp">
                            <label>Nome</label>
                            <span class="item-name"><?=$user->user_name;?></span>
                        </div>
                        <div class="gp">
                            <label>Telefone</label>

                            <span class="item-name"><?=$user->tel_u_name; ?></span>
                        </div>
                        <div class="gp">
                            <label>Data</label>
                            <span class="item-name"><?=$user->user_created; ?></span>
                        </div>
                        <div class="gp">
                            <label>Estado</label>
                            <?php
                            if($user->user_active == 0){
                                ?>
                                <span class="item-name">Destativo</span>


                                <?php
                            }else{
                                ?>
                                <span class="item-name">Ativo</span>

                                <?php
                            }

                            ?>
                        </div>
                        <a href="<?=PROOT?>persons/view/<?=$user->user_id;?>" class="butoes-one">Vizualizar</a>
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
