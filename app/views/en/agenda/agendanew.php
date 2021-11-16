<?php $this->start('head'); ?>

<?php $this->siteTitle('New Agenda'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="admin-section">
    <h1 class="section-title section-title--red">
        Nova Agenda
    </h1>
    <div class="news-admin">
        <form action="<?=PROOT?>agenda/" class="news-admin__form form" method="post"
              enctype="multipart/form-data">

            <div>
                <?=$this->displayErrors;?>
            </div>
            <div class="form__group form__group--2">
                <label for="titlo" class="form__label">Título</label>

                <input type="text" id="titlo" name="titlo" class="form__input">

            </div>
            <div class="form__group">
                <div class="form__group  form__group-25">
                    <label for="dia">Dia</label>
                    <select class="custom-select form__input" id="dia" name="dia" required>

                        <option selected disabled>Escolher...</option>

                        <?php
                        foreach($this->dias  as $pg):
                            ?>
                            <option value="<?=$pg->dia_id;?>" <?=$this->post['dia'] == $pg->dia_id ? "selected" : "" ?>><?=$pg->dia_name;?></option>
                            <?php
                        endforeach;
                        ?>

                    </select>
                </div>
                <div class="form__group  form__group-35">
                    <label for="mes">Mês</label>
                    <select class="custom-select form__input" id="mes" name="mes" required>
                        <option selected disabled>Escolher...</option>
                        <?php
                        foreach($this->meses  as $pg):
                            ?>
                            <option value="<?=$pg->mes_id;?>" <?=$this->post['mes'] == $pg->mes_id ? "selected" : "" ?>><?=$pg->mes_name;?></option>
                            <?php
                        endforeach;
                        ?>

                    </select>
                </div>
                <div class="form__group  form__group-25">
                    <label for="ano">Ano</label>
                    <select class="custom-select form__input" id="ano" name="ano" required>
                        <option selected disabled>Escolher...</option>
                        <?php
                        foreach($this->anos  as $pg):
                            ?>

                            <option value="<?=$pg->ano_name;?>" <?=$this->post['ano'] == $pg->ano_name ? "selected" : "" ?>><?=$pg->ano_name;?></option>

                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>








            <input type="hidden" name="token" value="<?=$this->token;?>">
            <br>

            <input type="submit" id="submit" name="submit" value="Salvar" class="btn btn-success">

        </form>


    </div>
</section>


<?php $this->end(); ?>
