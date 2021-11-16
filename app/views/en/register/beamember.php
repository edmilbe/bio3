




<?php $this->start('head'); ?>
<?php $this->siteTitle(''); ?>


<?php $this->end(); ?>

<?php $this->start('body'); ?>








<section class="resgiter container">
    <p class="text-danger">
        <?=$this->slash;?>
    </p>
    <h1>Ser Membro</h1>
    <div class="msgs">
        <?=utf8_encode($this->displayErrors);?>
    </div>
    <form id="personal" action="<?=PROOT?>register/beamember" method="post">
        <div class="form-row">


            <div class="form-group">
                <label for="org">Organização</label>
                <select class="custom-select" id="org" name="org" required>

                    <option selected disabled>Escolher...</option>

                    <?php
                    foreach($this->orgs as $org):
                        ?>

                        <option value="<?=$org->org_id;?>" <?=$this->post['org'] == $org->org_id ? "selected" : "" ?>><?=$org->org_name;?></option>

                        <?php
                    endforeach;
                    ?>

                </select>
            </div>



        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

        <input type="submit" value="Inserir" class="btn btn-success">

    </form>

    Ainda não possui uma organização? <a href="<?=PROOT;?>register/organization"> Criar.</a>


</section>



<?php $this->end(); ?>
