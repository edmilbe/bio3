<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>


<style xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

</style>
<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="help-table">
    <div class="container">

        <form class="help__form text-center" method="post" action="<?= PROOT ?>home/helpssearch/">
            <div class="form-row align-items-center col-md-6">

                <div class="input-group">

                    <input type="text" class="form-control" placeholder="Insira o número do BI que deseja"
                           value="<?= $this->bi; ?>" name="bi">

                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>

                    </div>
                </div>

            </div>
        </form>
        <h1>Inserir Ajuda para cidadão de BI N&ordm; <?= $this->bi; ?></h1>

        <form id="ajuda-insert" method="post" action="<?= PROOT ?>home/ajudas/<?= $this->bi; ?>">
            <div>
                <?= $this->displayErrors; ?>
            </div>




            <div class="form-group form-check">
                <?php
                $checked = isset($this->post['help-type-1']) && $this->post['help-type-1'] == 'on' ? "checked" : "";
                ?>

                <input type="checkbox" <?= $checked; ?> class="form-check-input help-type" id="help-type-1"
                       name="help-type-1">

                <label for="help-type-1">Genero Alimenticios</label>


                <div class="valores">
                    <?php

                    for ($i = 1; $i <= $this->ali; $i++):


                        ?>



                        <div id="valores-<?= $i ?>" class="form-row">

                            <label for="g-ali-qtd-<?= $i ?>" class="col-sm-2 col-form-label col-form-label-lg">Item <?= $i ?> </label>
                            <div class="form-group col-md-5">
                                <label for="g-ali-qtd-<?= $i ?>">Quantidade</label>
                                <input type="number" class="form-control"
                                       value="<?= $this->post["g-ali-qtd-" . $i] ?>" id="g-ali-qtd-<?= $i ?>"
                                       name="g-ali-qtd-<?= $i ?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="g-ali-designacao-<?= $i ?>">Designação</label>
                                <input type="text" class="form-control"
                                       value="<?= $this->post["g-ali-designacao-" . $i] ?>"
                                       id="g-ali-designacao-<?= $i ?>" name="g-ali-designacao-<?= $i ?>">
                            </div>
                        </div>
                        <?php

                    endfor;

                    ?>
                    <div id="valores-<?= $this->ali + 1; ?>" class="form-row">
                        <input type="button" id="btn-v-1" value="Adicionar Item" class="btn btn-primary"
                               onclick="addCampoFirst(<?= $this->ali + 1; ?>);">
                        <?php

                        if ($this->ali >= 2):
                            ?>
                            <input type="button" id="btn-v-1" value="Remover Item <?=$this->ali;?>" class="btn btn-danger"
                                   onclick="remCampoFirst(<?= $this->ali; ?>);">

                            <?php

                        endif;
                        ?>
                    </div>
                </div>

            </div>

            <div class="form-group form-check">

                <?php


                $checked = isset($this->post['help-type-2']) && $this->post['help-type-2'] == 'on' ? "checked" : "";


                ?>


                <input type="checkbox" <?= $checked; ?> class="form-check-input  help-type" id="help-type-2"
                       name="help-type-2">
                <label for="help-type-2">Bens Materias</label>

                <div class="valores">
                    <?php

                    for ($i = 1; $i <= $this->bens; $i++):


                        ?>

                        <div id="valoressv-<?= $i ?>" class="form-row">

                            <label for="b-mat-qtd-<?= $i ?>" class="col-sm-2 col-form-label col-form-label-lg">Item <?= $i ?> </label>

                            <div class="form-group col-md-5">
                                <label for="b-mat-qtd-<?= $i ?>">Quantidade</label>
                                <input type="number" class="form-control"
                                       value="<?= $this->post["b-mat-qtd-" . $i] ?>" id="b-mat-qtd-<?= $i ?>"
                                       name="b-mat-qtd-<?= $i ?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="b-mat-designacao-<?= $i ?>">Designação</label>
                                <input type="text" class="form-control"
                                       value="<?= $this->post["b-mat-designacao-" . $i] ?>"
                                       id="b-mat-designacao-<?= $i ?>" name="b-mat-designacao-<?= $i ?>">
                            </div>

                        </div>
                        <?php
                    endfor;

                    ?>

                    <div id="valoressv-<?= $this->bens + 1; ?>" class="form-row">
                        <input type="button" id="btn-v-2" value="Adicionar Item" class="btn btn-primary"
                               onclick="addCampoSecond(<?= $this->bens + 1; ?>);">
                        <?php

                        if ($this->bens >= 2):
                            ?>
                            <input type="button" id="btn-v-2" value="Remover Item <?= $this->bens; ?>" class="btn btn-danger"
                                   onclick="remCampoSecond(<?= $this->bens; ?>);">

                            <?php

                        endif;
                        ?>
                    </div>


                </div>

            </div>

            <div class="form-group form-check" >

                <?php


                $checked = isset($this->post['help-type-3']) && $this->post['help-type-3'] == 'on' ? "checked" : "";

                ?>


                <input type="checkbox" <?= $checked; ?> class="form-check-input help-type" id="help-type-3"
                       name="help-type-3">
                <label for="help-type-3">Valor Monetario</label>


                <div class="valores" >
                    <div class="form-row">
                        <label for="money-qtd" class="col-sm-2 col-form-label col-form-label-lg">Total</label>

                        <div class="form-group col-md-5">
                            <label for="money-qtd">Valor</label>
                            <input type="number" value="<?= $this->post['money-qtd'] ?>" class="form-control"
                                   id="money-qtd" name="money-qtd">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="money-designacao">Moeda</label>
                            <input type="text" id="money-designacao" class="form-control" name="money-designacao"
                                   value="Dobra" readonly>

                        </div>
                    </div>



                </div>

            </div>

            <div class="form-group form-check">
                <?php


                $checked = isset($this->post['help-type-4']) && $this->post['help-type-4'] == 'on' ? "checked" : "";


                ?>
                <input type="checkbox" <?= $checked; ?> class="form-check-input help-type" id="help-type-4"
                       name="help-type-4">
                <label for="help-type-4">Outros</label>

                <div class="valores">
                    <div class="form-group form-row">
                        <label for="text">Descrição de Ajuda</label>
                        <textarea name="text" id="text" class="form-control"><?= $this->post['text'] ?></textarea>
                    </div>

                </div>
            </div>

            <?php

            if ($this->orgs):
                ?>
                <div class="form-group col-md-6">
                    <label for="org">Iniciativa Pessoal/Organizal</label>
                    <select class="custom-select" id="org" name="org" required>
                        <option selected disabled value="">Escolher...</option>
                        <?php
                        foreach ($this->orgs as $org):
                            ?>

                            <option
                                value="<?= $org->org_id; ?>" <?= $this->post['org'] == $org->org_id ? "selected" : "" ?>><?= $org->org_name; ?></option>

                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">


                <input type="submit" value="Enviar" class="btn btn-success">
                <?php

            else:

                ?>
                <p class="font-weight-bold text-danger">
                    Ainda não pertence à nenhuma organização/grupo, <a href="<?= PROOT ?>register/beamember">inscreva-se
                        numa existente</a> ou <a
                        href="<?= PROOT ?>register/organization"> crie uma nova organização/grupo</a>
                </p>

                <?php
            endif;


            ?>

        </form>
        <br>

    </div>

    <div class="container">
        <h2>Tabela de ajudas concedidas ao cidadão de BI N&ordm; <?= $this->bi; ?></h2>

        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">N&ordm;</th>
                <th scope="col">Data</th>
                <th scope="col">Ajuda</th>
                <th scope="col">Proveniência</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $cont = count($this->allhelps);
            foreach ($this->allhelps as $help):

                ?>
                <tr>
                    <th scope="row"><?= $cont; ?></th>
                    <td><?= $help->help_date; ?></td>
                    <td><?= $help->ajuda_ali_qtd; ?> <?= $help->ajuda_ali_text; ?></td>
                    <td><?= $help->org_name; ?></td>
                </tr>
                <?php
                $cont--;
            endforeach;

            ?>


            </tbody>
        </table>
    </div>


</section>


<?php $this->end(); ?>
