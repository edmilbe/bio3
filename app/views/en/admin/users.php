<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Previlégios
    </h1>


    <form action="<?=PROOT?>admin/users" class="form" method="post">
        <div class="response">
            <?=$this->displayErrors;


            ?>
        </div>





        <div class="form__group">
            <label class="form__label" for="user">Utilizador</label>

            <select  class="form__input" id="user" name="user">
                <?php

                foreach ($this->users as $user):

                    ?>
                    <option value="<?=$user->user_id?>"

                        <?php echo  $this->post['user'] ==  $user->user_id ? "selected": "";   ?>

                        ><?=$user->user_fname?>
                    </option>

                    <?php
                endforeach;

                ?>
            </select>

        </div>


        <div class="form__group">
            <label class="form__label" for="acl">Cargo</label>

            <select  class="form__input" id="acl" name="acl">
                <?php

                foreach ($this->acls as $acl):

                    ?>
                    <option value="<?=$acl->acl_id?>"

                        <?php echo  $this->post['acl'] ==  $acl->acl_id ? "selected": "";   ?>

                        ><?=$acl->acl_name?>
                    </option>

                    <?php
                endforeach;

                ?>
            </select>

        </div>




        <input type="hidden" name="token" value="<?= $this->token; ?>">




        <div class="form__group form__group--3">
            <input type="submit" name="submit" id="submit" value="Salvar &rarr;" class="btn btn-submit">
        </div>



    </form>






</section>

<?php

foreach($this->acls as $acl):



    ?>
    <section class="form-section" id="form-section">
        <h1 class="section-title">
            <?=$acl->acl_name?>
        </h1>

        <?php
        foreach( $this->aclusers[$acl->acl_id] as $acluser):

            ?>
        <form method="post" action="<?=PROOT?>admin/useroff/<?=$acl->acl_id;?>/<?=$acluser->user_id?>" class="form">
                <div class="form__group">
                    <input type="text" class="form__input" value="<?=$acluser->user_fname  ?>">

                </div>
            <input type="hidden" name="token" value="<?= $this->token; ?>">

            <div class="form__group">
                    <input type="submit" class="btn btn__decline" value="Remover">
                </div>
        </form>
            <?php

        endforeach;

        ?>

    </section>


    <?php

endforeach;


?>





<?php $this->end(); ?>
