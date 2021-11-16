

<?php $this->start('body'); ?>
<?php

if($this->user != false){
    ?>
    <section class="cont-terceiro shopping">

        <div class="details-user">
            <div >
                <div class="gps">
                    <span class="s-titlo">Nome:</span>
                    <span class="s-item-name n-maior"><?=$this->user->user_name;?></span>
                </div>
                <div class="gps">
                    <span class="s-titlo">Telefone:</span>
                    <span class="s-item-name n-maior"><?=$this->user->tel_u_name;?></span>
                </div>
                <div class="gps">
                    <span class="s-titlo">Email:</span>
                    <span class="s-item-name n-maior"><?=$this->user->email_u_name;?></span>
                </div>
                <div class="gps">
                    <span class="s-titlo">Data:</span>
                    <span class="s-item-name n-maior"><?=$this->user->user_created;?></span>
                </div>

                <div class="gps">
                    <span class="s-titlo">Id:</span>
                    <span class="s-item-name n-maior"><?=$this->user->user_long;?></span>
                </div>
                <div class="gps">
                    <span class="s-titlo">Estado:</span>
                    <?php
                    if($this->user->user_active == 0){
                        ?>
                        <span class="s-item-name n-maior">Destativo</span>


                        <?php
                    }else{
                        ?>
                        <span class="s-item-name n-maior">Ativo</span>

                        <?php
                    }

                    ?>
                </div>




            </div>
            <div class="det-one">
                <div class="img-user-det">
                    <img src="<?=PROOT?>files/users/<?=$this->user->file_name; ?>">

                </div>
            </div>

            <?php

            if($this->docs != false){
                foreach($this->docs as $doc){
                    ?>
                    <div class="det-one">
                        <div class="img-user-det">
                            <img src="<?=PROOT?>files/users/docs/<?=$doc->file_name;?>">
                        </div>
                    </div>
                    <?php
                }

            }
            ?>
            <div >
                <div class="gps">

                    <?php

                    if($this->user->user_active == 0 && $this->btn){
                        ?>
                        <form method="post" action="<?=PROOT?>persons/set/<?=$this->user->user_id;?>/1">
                            <input type="submit" name="on" value="Ativar" class="butoes-one">

                        </form>
                        <?php
                    }elseif($this->user->user_active == 1 && $this->btn){
                        ?>
                        <form method="post" action="<?=PROOT?>persons/set/<?=$this->user->user_id;?>/0">
                            <input type="submit" name="off" value="Desativar" class="butoes-one">
                        </form>
                        <?php
                    }

                    ?>
                </div>

            </div>




        </div>


    </section>
    <?php

}
?>


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
