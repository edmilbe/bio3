




<?php $this->start('head'); ?>
<?php $this->siteTitle(''); ?>


<?php $this->end(); ?>

<?php $this->start('body'); ?>




<section class="resgiter container">
    <h1>Gerir Organização</h1>

    <form class="row" id="members">

        <?php

        foreach($this->orgs as $org):
            ?>
            <fieldset disabled class="col-8">
                <div class="form-row">

                    <div class="form-group  col">
                    <textarea id="orgname<?=$org->org_id;?>" class="form-control"
                              placeholder="Associação Amigos do Ambiente"><?=$org->org_name;?></textarea>
                    </div>
                    <div class="form-group  col">
                    <textarea id="orgmanager<?=$org->user_id;?>" class="form-control"
                              placeholder="João António Miguel"><?=$org->user_fname;?> (<?=$org->email_u_name;?>)</textarea>
                    </div>
                    <div class="form-group  col">
                    <textarea id="orgmanagerbi<?=$org->user_bi;?>" class="form-control"
                              placeholder="132149"><?=$org->user_bi;?></textarea>
                    </div>


                </div>
            </fieldset>
            <?php
            $status = $org->org_active == 1 ? "checked" : "";
        ?>
            <div class="custom-control custom-switch col-4">
                <input type="checkbox" class="custom-control-input" id="statusOrg<?=$org->org_id;?>" onchange="statusOrg(<?=$org->org_id;?>, '<?=$this->token;?>');" <?=$status;?>>
                <label class="custom-control-label" for="statusOrg<?=$org->org_id;?>" id="statusOrgLabel<?=$org->org_id;?>">
<?=$org->org_active == 1 ? "Ativa" : "Desativa"?>

                </label>
            </div>

            <?php


        endforeach;

        ?>

    </form>



</section>








<?php $this->end(); ?>
