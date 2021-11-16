



<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>






<section class="resgiter container">
    <h1>Criar conta organizacional</h1>
    <div class="msgs">
        <?=utf8_encode($this->displayErrors);?>
    </div>
    <form id="personal" action="<?=PROOT?>register/insertorganization" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fname">Nome da Organização</label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?=$this->post['fname'];?>" placeholder="Associação Mé Nón, Grupo Vilage, Ministerio de Trabalho e Solidariedade">
            </div>

            <div class="form-group col-md-6">
                <label for="country">País de origem</label>
                <select class="custom-select" id="country" name="country" required>
                    <option selected disabled>Escolher...</option>

                    <?php
                    foreach($this->countries as $country):
                    ?>

                        <option value="<?=$country->country_id;?>" <?=$this->post['country'] == $country->country_id ? "selected" : "" ?>><?=$country->country_name;?></option>

                        <?php
                        endforeach;
                    ?>

                </select>
            </div>



        </div>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

        <input type="submit" value="Inserir" class="btn btn-success">

        Ja possui uma organização <a href="<?=PROOT;?>register/beamember"> seja membro.</a>
    </form>



</section>









<?php $this->end(); ?>
