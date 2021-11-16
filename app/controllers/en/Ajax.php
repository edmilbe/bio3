<?php

class Ajax extends Controller implements InterfaceAjax
{
    public function __construct($controller, $action)
    {
        parent::__construct($controller, $action);
    }

    private function writeOpntios($value, $name, $dias, $meses, $anos, $label){
        ?>
        <br>
        <?php
        for($ij = 1; $ij <= $value; $ij++){
            ?>
            <div class='form__group'>
                <label class='form__label' for='desde'><?=$label?> <?=$ij?>
                    <span class='form__label__about'>(campo obrigatório)</span>
                </label>
                <input type='text' autocomplete='off' name='<?=$name?><?=$ij?>'  class='form__input'>

            </div>

            <div class="form__group u-margin-bottom-medium">
                <label class="form__label" for="form2__input-4">Sexo</label>

                <div class="form__radio-group form__group-35">
                    <input type="radio" class="form__radio-input" id="genero_1<?=$name?><?=$ij?>"

                           name="<?=$name?>_sexo<?=$ij?>" value="1">
                    <label for="genero_1<?=$name?><?=$ij?>" class="form__radio-label">
                        <span class="form__radio-button"></span>
                        Masculino
                    </label>
                </div>
                <div class="form__radio-group form__group-35">
                    <input type="radio" class="form__radio-input" id="genero_2<?=$name?><?=$ij?>"

                           name="<?=$name?>_sexo<?=$ij?>"
                           value="2">
                    <label for="genero_2<?=$name?><?=$ij?>" class="form__radio-label">
                        <span class="form__radio-button"></span>
                        Feminino
                    </label>
                </div>
            </div>

            <div class="form__group">


                <label class="form__label" for="form2__input-2">Data de Nascimento</label>

                <div class="form__group form__group-25">

                    <label class="form__label" for="nas-dia_<?=$name?><?=$ij?>">Dia</label>
                    <select class="form__input" id="nas-dia_<?=$name?><?=$ij?>" name="nas-dia_<?=$name?><?=$ij?>">

                        <?php

                        foreach ($dias as $dia):

                            ?>
                            <option value="<?=$dia->dia_id?>" ><?=$dia->dia_name?></option>

                            <?php
                        endforeach;

                        ?>
                    </select>

                </div>
                <div class="form__group form__group-35">

                    <label class="form__label" for="nas-mes_<?=$name?><?=$ij?>">Mês</label>
                    <select class="form__input" id="nas-mes_<?=$name?><?=$ij?>" name="nas-mes_<?=$name?><?=$ij?>">
                        <?php

                        foreach ($meses as $mes):

                            ?>
                            <option value="<?=$mes->mes_id?>"



                                ><?=$mes->mes_name?></option>

                            <?php
                        endforeach;

                        ?>
                    </select>

                </div>

                <div class="form__group form__group-25">

                    <label class="form__label" for="nas-ano_<?=$name?><?=$ij?>">Ano</label>
                    <select class="form__input" id="nas-ano_<?=$name?><?=$ij?>" name="nas-ano_<?=$name?><?=$ij?>">
                        <?php

                        foreach ($anos as $ano):



                            ?>
                            <option value="<?=$ano->ano_name?>"

                                ><?=$ano->ano_name?></option>

                            <?php
                        endforeach;

                        ?>
                    </select>

                </div>


            </div>
            <br>
            <?php
        }




        ?>
        <?php
    }






    public function addagregadosAction(
        $filhos,
        $netos,
        $sobrinhos,
        $entiados,
        $afilhados,
        $tio,
        $avo,
        $companheiro
        )
    {






        $Dias = new Dias();
        $Meses = new Meses();
        $Anos = new Anos();

        $dias = $Dias->find([]);
        $meses = $Meses->find([]);
        $anos = $Anos->find([

            'conditions' => 'ano_name <= ?', 'bind' => [date('Y')]


        ]);
        //$this->writeOpntios($pai, 'pai', $dias, $meses, $anos, 'Pai');
        //$this->writeOpntios($mae, 'mae', $dias, $meses, $anos, 'Mãe');

        $this->writeOpntios($companheiro, 'companheir', $dias, $meses, $anos, 'Companheiro(a)');
        $this->writeOpntios($avo, 'av', $dias, $meses, $anos, 'Avô(ó)');
        $this->writeOpntios($filhos, 'filh', $dias, $meses, $anos, 'Filho(a)');
        $this->writeOpntios($tio, 'ti', $dias, $meses, $anos, 'Tio(a)');
        $this->writeOpntios($netos, 'net', $dias, $meses, $anos, 'Neto(a)');
        $this->writeOpntios($sobrinhos, 'sobrinh', $dias, $meses, $anos, 'Sobrinho(a)');
        $this->writeOpntios($entiados, 'entiad', $dias, $meses, $anos, 'Entiado(a)');
        $this->writeOpntios($afilhados, 'afilhad', $dias, $meses, $anos, 'Afilhado(a)');


    }


    public function newempregoAction($bi, $casa = "_______________",
                                     $dist = "_______________",
                                     $loc = "_______________")
    {

        $Bis = new Bis();

        $bi = $Bis->getBIFull(sanitize($bi));


        $bi->distrito_name = utf8_encode($bi->distrito_name);
        echo "
            Atesta para Fins de Emprego que,

            {$bi->bi_name},
            {$bi->bi_estado},
            natural de {$bi->localidade_name},
            Distrito de {$bi->distrito_name},
            São Tomé, nascido em {$bi->bi_nasc_dia} / {$bi->bi_nasc_mes}/ {$bi->bi_nasc_ano}


            , filho(a) de  {$bi->bi_pai} e de  {$bi->bi_mae},
            portador do Bilhete de Identidade número  {$bi->bi_number},
            passado pelo Centro de Identificação Civil e Criminal de São Tomé e Príncipe, em
            {$bi->bi_emi_dia} / {$bi->bi_emi_mes}/ {$bi->bi_emi_ano}

            , reside efetivamente na casa número
            <span class='response__text--okay'> {$casa} </span>,
            na Localidade de _____________,
            Distrito de ___________________,
            deste Estado.


        ";


    }


    public function buscabiAction($bi)
    {
        $Bis = new Bis();


        $results = $Bis->findBI($bi);

        if ($results) {
            foreach ($results as $result):
                ?>
                <div class="row">
                    <a href="<?= PROOT ?>bi/updatebi/<?= $result->bi_id ?> "
                       class="btn btn-submit u-right-text"><?= $result->bi_number ?> | <?= $result->bi_name ?></a>

                </div>
                <br>
                <?php
            endforeach;
        }
    }

    public function buscaatestadoAction($atestado)
    {
        $Atestados = new Atestados();
        $results = $Atestados->searchAtestados($atestado);


        if ($results) {
            foreach ($results as $result):
                ?>
                <div class="row">
                    <a target="_blank" href="<?=PROOT?>atestado/index/1/<?= $result->atestado_id ?>/#popup"
                       class="btn btn-submit u-right-text"><?= $result->atestado_id ?> |
                        <?= $result->bi_number ?>
                        |
                        <?= $result->bi_name ?></a>

                </div>
                <br>
                <?php
            endforeach;
        }
    }
    public function buscaautoAction($atestado)
    {
        $Atestados = new Certidaos();
        $results = $Atestados->searchAtestados($atestado);


        if ($results) {
            foreach ($results as $result):
                ?>
                <div class="row">
                    <a target="_blank" href="<?=PROOT?>auto/index/1/<?= $result->atestado_id ?>/#popup"
                       class="btn btn-submit u-right-text"><?= $result->atestado_id ?> |
                        <?= $result->bi_number ?>
                        |
                        <?= $result->bi_name ?></a>

                </div>
                <br>
                <?php
            endforeach;
        }
    }


    public function  atestadoexistsAction($bi, $atestado)
    {
        $Atestados = new Atestados();
        $Bis = new Bis();
        $result = $Atestados->findFirst([

            'conditions' => 'atestado_id = ? ', 'bind' => [$atestado]


        ]);
        $result2 = $Bis->findFirst([

            'conditions' => 'bi_number = ? ', 'bind' => [$bi]


        ]);


        //var_dump($result);


        if ($result->atestado_id && $result2->bi_id) {
            echo 1;
        } else {
            echo 0;
        }

    }
    public function  autoexistsAction($bi, $atestado)
    {
        $Atestados = new Certidaos();
        $Bis = new Bis();
        $result = $Atestados->findFirst([

            'conditions' => 'atestado_id = ? ', 'bind' => [$atestado]


        ]);
        $result2 = $Bis->findFirst([

            'conditions' => 'bi_number = ? ', 'bind' => [$bi]


        ]);


        //var_dump($result);


        if ($result->atestado_id && $result2->bi_id) {
            echo 1;
        } else {
            echo 0;
        }

    }


    public function Action($bi)
    {
        $Bis = new Bis();

        $Bis->getByBi($bi);


    }


    public function getbybinameAction($bi)
    {
        $Bis = new Bis();

        $result = $Bis->getByBi($bi);
        echo $result->bi_name;


    }

    public function getbybipaisAction($bi)
    {
        $Bis = new Bis();

        $result = $Bis->getByBi($bi);
        echo $result->bi_pais;


    }

    public function getbybinatureAction($bi)
    {
        $Bis = new Bis();

        $result = $Bis->getByBi($bi);
        echo $result->bi_naturalidade;


    }


    public function getbyatnameAction($atestado)
    {
        $Atestado = new Atestados();
        $result = $Atestado->getByBiNAtes($atestado);
        echo $result->atestado_name;
    }

    public function getbyatbiAction($atestado)
    {
        $Atestado = new Atestados();
        $result = $Atestado->getByBiNAtes($atestado);
        echo $result->atestado_bi;
    }

    public function getbyatpaisAction($atestado)
    {
        $Atestado = new Atestados();
        $result = $Atestado->getByBiNAtes($atestado);
        echo $result->atestado_pais;
    }

    public function getbyatnatureAction($atestado)
    {
        $Atestado = new Atestados();
        $result = $Atestado->getByBiNAtes($atestado);
        echo $result->atestado_naturalidade;
    }

    public function getbyatcasaAction($atestado)
    {
        $Atestado = new Atestados();
        $result = $Atestado->getByBiNAtes($atestado);
        echo $result->atestado_morada;
    }

    public function addCampoFirstAction()
    {
        //var_dump($_SESSION['ali'] );

        if (!isset($_SESSION['ali'])) {
            $_SESSION['ali'] = 1;
        } else {
            $_SESSION['ali'] = $_SESSION['ali'] + 1;
        }
        $last = $_SESSION['ali'];
        ?>

        <label for="g-ali-qtd-<?= $last ?>" class="col-sm-2 col-form-label col-form-label-lg">Item <?= $last ?> </label>

        <div class="form-group col-md-5">
            <label for="g-ali-qtd-<?= $last; ?>">Quantidade</label>
            <input type="number" class="form-control" id="g-ali-qtd-<?= $last; ?>" name="g-ali-qtd-<?= $last; ?>">
        </div>
        <div class="form-group col-md-5">
            <label for="g-ali-designacao-<?= $last; ?>">Designação</label>
            <input type="text" class="form-control" id="g-ali-designacao-<?= $last; ?>"
                   name="g-ali-designacao-<?= $last; ?>">
        </div>
        <div id="valores-<?= $last + 1; ?>" class="form-row">
            <input type="button" id="btn-v-1" value="Adicionar Item" class="btn btn-primary"
                   onclick="addCampoFirst(<?= $last + 1; ?>);">
            <input type="button" id="btn-v-1" value="Remover Item <?= $last; ?>" class="btn btn-danger"
                   onclick="remCampoFirst(<?= $last; ?>);">

        </div>
        <?php


    }

    public function remCampoFirstAction()
    {
        //var_dump($_SESSION['ali'] );
        if ($_SESSION['ali'] > 1):
            $_SESSION['ali'] -= 1;
            $last = $_SESSION['ali'];
            ?>
            <div id="valores-<?= $last + 1; ?>" class="form-row">
                <input type="button" id="btn-v-<?= $last; ?>" value="Adicionar Item" class="btn btn-primary"
                       onclick="addCampoFirst(<?= $last + 1; ?>);">
                <?php if ($last >= 2): ?>
                    <input type="button" id="btn-v-<?= $last; ?>" value="Remover Item <?= $last ?>"
                           class="btn btn-danger" onclick="remCampoFirst(<?= $last; ?>);">
                <?php endif; ?>
            </div>
            <?php
        endif;
    }


    public function addCampoSecondAction()
    {
        //var_dump($_SESSION['ali'] );

        if (!isset($_SESSION['bens'])) {
            $_SESSION['bens'] = 1;
        } else {
            $_SESSION['bens'] = $_SESSION['bens'] + 1;
        }
        $last = $_SESSION['bens'];
        ?>


        <label for="b-mat-qtd-<?= $last ?>" class="col-sm-2 col-form-label col-form-label-lg">Item <?= $last ?> </label>

        <div class="form-group col-md-5">
            <label for="b-mat-qtd-<?= $last; ?>">Quantidade</label>
            <input type="number" class="form-control" id="b-mat-qtd-<?= $last; ?>" name="b-mat-qtd-<?= $last; ?>">
        </div>
        <div class="form-group col-md-5">
            <label for="b-mat-designacao-<?= $last; ?>">Designação</label>
            <input type="text" class="form-control" id="b-mat-designacao-<?= $last; ?>"
                   name="b-mat-designacao-<?= $last; ?>">
        </div>
        <div id="valoressv-<?= $last + 1; ?>" class="form-row">
            <input type="button" id="btn-v-1" value="Adicionar Item" class="btn btn-primary"
                   onclick="addCampoSecond(<?= $last + 1; ?>);">
            <input type="button" id="btn-v-1" value="Remover Item <?= $last; ?>" class="btn btn-danger"
                   onclick="remCampoSecond(<?= $last; ?>);">

        </div>
        <?php


    }

    public function remCampoSecondAction()
    {
        //var_dump($_SESSION['ali'] );
        if ($_SESSION['bens'] > 1):
            $_SESSION['bens'] -= 1;
            $last = $_SESSION['bens'];
            ?>
            <div id="valoressv-<?= $last + 1; ?>" class="form-row">
                <input type="button" id="btn-v-<?= $last; ?>" value="Adicionar Item" class="btn btn-primary"
                       onclick="addCampoSecond(<?= $last + 1; ?>);">
                <?php if ($last >= 2): ?>
                    <input type="button" id="btn-v-<?= $last; ?>" value="Remover Item <?= $last ?>"
                           class="btn btn-danger" onclick="remCampoSecond(<?= $last; ?>);">
                <?php endif; ?>
            </div>
            <?php
        endif;
    }


    public function statusorgAction($id, $value)
    {
        $Organization = new Organization();
        $form['org_active'] = $value;
        $Organization->update($id, $form, "org_id");

        echo $value;
    }

    public function statusmemberAction($id, $value)
    {
        $Members = new Members();
        $form['member_active'] = $value;
        $Members->update($id, $form, "member_id");

        echo $value;
    }

    public function orgAction($user, $org, $token)
    {

        //dnd($org);


        $Organization = new Organization();

        if ($Organization->isActive($org) && $Organization->userIsManagerOf($user, $org)) {
            //
            $members = $Organization->members($org);
            //dnd($members);

            if ($members) {
                ?>


                <form class="row" id="members">

                    <?php

                    foreach ($members as $member):
                        ?>
                        <fieldset disabled class="col-8">
                            <div class="form-row">

                                <div class="form-group  col">
                    <textarea id="memberorg<?= $member->org_id; ?>" class="form-control"
                              placeholder="Associação Amigos do Ambiente"><?= $member->org_name; ?></textarea>
                                </div>
                                <div class="form-group  col">
                    <textarea id="memberuser<?= $member->user_id; ?>" class="form-control"
                              placeholder="João António Miguel"><?= $member->user_fname; ?></textarea>
                                </div>
                                <div class="form-group  col">
                    <textarea id="memberuserbi<?= $member->user_bi; ?>" class="form-control"
                              placeholder="132149"><?= $member->user_bi; ?></textarea>
                                </div>


                            </div>
                        </fieldset>
                        <?php
                        $status = $member->member_active == 1 ? "checked" : "";
                        ?>
                        <div class="custom-control custom-switch col-4">
                            <input type="checkbox" class="custom-control-input"
                                   id="statusmember<?= $member->member_id; ?>"
                                   onchange="statusMember(<?= $member->member_id; ?>);" <?= $status; ?>>
                            <label class="custom-control-label" for="statusmember<?= $member->member_id; ?>"
                                   id="statusmemberLabel<?= $member->member_id; ?>">
                                <?= $member->member_active == 1 ? "Ativa" : "Desativa" ?>

                            </label>
                        </div>

                        <?php


                    endforeach;

                    ?>

                </form>
                <?php
            }

        }
    }


    public function scarrinhoAction()
    {


        $id_key = false;
        $prds = false;
        $sk = new ShoppingKey();


        if (!Session::exists('shopping')) {
            $id_key = $sk->NewShoppingKey();
            echo "0";
        } else {
            $id_key = $sk->GetIdKey();
        }
        if (is_numeric($id_key) != null) {
            $sp = new ShoppingPrds();
            $prds = $sp->find(
                [
                    'conditions' =>
                        [
                            'shopping_p_key = ?',
                            'shopping_p_qt != ?'
                        ],

                    'bind' => [
                        $id_key, 0
                    ]
                ]);

            echo intval(count($prds));

            //$prds = $db->DBRead("shopping_prds", "where shopping_p_key = $id_key and shopping_p_qt != 0");

            //$sp->rows();

        } else {
            $id_key = $sk->NewShoppingKey();
            echo "0";
        }
    }

    public function schangeAction($pr, $qtd)
    {

        $id_key = false;
        $sk = new ShoppingKey();

        if (is_numeric($pr) && is_numeric($qtd)) {
            //echo  $pr . " " . $qtd;
            $spo = new ShoppingPrds();
            echo $spo->setItems($pr, $qtd);
        }
    }

    public function gettotalAction($pr)
    {
        $id_key = false;
        $sk = new ShoppingKey();

        $sk->GetIdKey();

        if (is_numeric($pr) && Prds::existProduct($pr)) {
            //echo  $pr . " " . $qtd;
            $spo = new ShoppingPrds();
            $pr = $spo->getById($pr);

            $prd = new Prds();
            echo number_format($prd->getTotal($pr), 2);
        }
    }

    public function getSubtotalAction()
    {


        $prds = new Prds();

        $items = $prds->box();

        $totalglobal = 0;

        foreach ($items as $item) {

            $totallocal = 0;
            if ($item->shopping_p_qt > 0) {

                ?>

                <?php
                if ($item->prd_opc == 1) {
                    //echo $item->pr_uni_preco;
                    $preco = $item->pr_uni_preco;
                    $totallocal = $preco * $item->shopping_p_qt;
                } elseif ($item->prd_opc == 2) {
                    //echo $item->pr_solto_preco;
                    $preco = $item->pr_solto_preco;
                    $totallocal = $preco * $item->shopping_p_qt;
                } elseif ($item->prd_opc == 3) {
                    //echo $item->pr_o_1_preco;
                    $preco = $item->pr_o_1_preco;
                    $totallocal = $preco * $item->shopping_p_qt;
                } else {
                    $preco = 'none';
                }
                $totalglobal += $totallocal;

            }


        }

        echo number_format($totalglobal, 2);


    }

    public function stlAction($pr, $vl, $preco)
    {
        if (is_numeric($vl) && is_numeric($preco)) {
            echo($vl * $preco);

        }
    }

    public function sclearAction()
    {
        $sk = new ShoppingKey();

        $id_key = $sk->NewShoppingKey();
    }

    public function stgAction()
    {
        $prds = new Prds();
        $items = $prds->box();


        $totalglobal = 0;
        $totallocal = 0;
        $moeda = MOEDA;
        if ($items != false) {
            foreach ($items as $item) {
                if ($item->prd_opc == 1) {
                    //echo $item->pr_uni_preco;
                    $preco = $item->pr_uni_preco;
                    $totallocal = $preco * $item->shopping_p_qt;
                } elseif ($item->prd_opc == 2) {
                    //echo $item->pr_solto_preco;
                    $preco = $item->pr_solto_preco;
                    $totallocal = $preco * $item->shopping_p_qt;
                } elseif ($item->prd_opc == 3) {
                    //echo $item->pr_o_1_preco;
                    $preco = $item->pr_o_1_preco;
                    $totallocal = $preco * $item->shopping_p_qt;
                }
                $totalglobal += $totallocal;
            }
        }
        ?>
        <?= $totalglobal ?>
        <?php

    }

    public function ssearchprAction($name, $on = 0, $onon = 0)
    {
        $name = sanitize($name);
        $on = sanitize(is_numeric($on) ? $on : 0);
        $onon = sanitize(is_numeric($onon) ? $onon : 0);

        $sp = new ShoppingPrds();

        $prds = $sp->findByName($name, $on, $onon);

        $g1 = new Group1();

        //$gps = $g1->findFirst(['conditions' => 'group1_id = ?', 'bind' => $onon]);
        if ($prds != false) {

            foreach ($prds as $item) {
                ?>
                <div class="item-shopping item-min">
                    <div class="item-fotodivs fotodivs-min">

                        <a href="<?= PROOT ?>home/viewfull/<?php echo $item->prd_id;

                        echo ($on != 0) ? '/' . $on : '';
                        if (isset($item->group1_id)) {
                            if ($item->group1_id) {
                                echo '/' . $item->group1_id;
                            }
                        }
                        ?>">
                            <img src="<?= PROOT ?>files/prds/<?= $item->file_name; ?>" alt="" class="item-pr">
                        </a>
                    </div>
                    <div class="gps">
                        <span class="s-item-name n-maior"><?= $item->prd_name ?></span>
                    </div>
                    <form class="shopping-pr shopping-min">

                        <?php
                        if ($item->marca_name != null) {
                            ?>
                            <span class="s-titlo">Mark:</span>
                            <span class="s-item-name"><?= $item->marca_name ?></span>

                            <?php
                        }
                        ?>

                        <div class="gps">
                            <span class="s-titlo">Price:</span>
                                        <span class="s-item-name"><?php
                                            if ($item->prd_opc == 1) {
                                                echo $item->pr_uni_preco;
                                            } elseif ($item->prd_opc == 2) {
                                                echo $item->pr_solto_preco;
                                            } elseif ($item->prd_opc == 3) {
                                                echo $item->pr_o_1_preco;
                                            }

                                            ?><?= MOEDA ?></span>
                        </div>
                        <div class="gps">
                            <span class="s-titlo">Measure:</span>
                                        <span class="s-item-name"><?php
                                            if ($item->pr_uni_id != null) {
                                                echo "Bu Item";
                                            } elseif ($item->m0 != null) {
                                                echo $item->m0;
                                            } else {
                                                echo $item->m2 === null ? $item->m1
                                                    : $item->m3 === null ? $item->m1 . " x " . $item->q2 . " " . $item->m2
                                                        : $item->m1 . " x " . $item->q2 . " x " . $item->m2 . " x " . $item->q3 . " x " . $item->m3;
                                                //echo "{$prd['m1']}";
                                            }


                                            ?>
                        </div>
                        <div class="gps">
                            <label class="s-titlo">Qty:</label>
                            <input type="number" id="shopping-pr<?= $item->prd_id ?>"
                                   class="s-item-preco s-item-name qt-shopping"
                                   value="<?php echo $item->shopping_p_qt != null ? $item->shopping_p_qt : "0"; ?>"
                                   min="0"
                                   step="<?= $item->prd_escala ?>"
                                   onchange="s_from_main(<?= $item->prd_id ?>, this.value)" readonly
                                >
                            <input type="button" value="+"
                                   onclick="s_from_plus(<?= $item->prd_id ?>, <?= $item->prd_escala ?>);" class="sinal">
                            <input type="button" value="-"
                                   onclick="s_from_menos(<?= $item->prd_id ?>,  <?= $item->prd_escala ?>);"
                                   class="sinal">
                            <input type="button" value="OK"
                                   onclick="s_from_okay(<?= $item->prd_id ?>,  <?= $item->prd_escala ?>);"
                                   class="sinal s-execute">


                        </div>

                    </form>
                </div>

                <?php
            }

        }
        ?>
        <script>
            minproduct();
        </script>
        <?php


    }

    public function ssearchgr1Action($name)
    {
        $name = sanitize($name);


        $prds = new Group1();

        $items = $prds->getByNameGr1($name);

        if ($items != false) {
            ?>
            <div class="itens-shopping">
                <?php
                foreach ($items as $gr) {

                    ?>
                    <a href="<?= PROOT ?>home/gr2/<?= $gr->group1_id ?>" class="item-shopping item-min">
                        <div class="item-fotodivs fotodivs-min">

                            <img src="<?= PROOT ?>files/grupo1/<?= $gr->file_name; ?>" alt="" class="item-pr">

                        </div>
                        <div class="gps all-center">
                            <span class="s-item-name n-maior "><?= $gr->group1_name ?></span>
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
        <script>
            minproduct();
        </script>
        <?php

    }

    public function ssearchgr2Action($name, $gr1 = 0)
    {
        $name = sanitize($name);
        $gr1 = sanitize($gr1);

        $prds = new Group2();

        $items = $prds->getByNameGr2($name, $gr1);

        if ($items != false) {
            ?>
            <div class="itens-shopping">
                <?php
                foreach ($items as $gr) {

                    ?>
                    <a href="<?= PROOT ?>home/index/<?= $gr->group2_id ?>/<?= $gr->group1_id ?>"
                       class="item-shopping item-min">
                        <div class="item-fotodivs fotodivs-min">

                            <img src="<?= PROOT ?>files/grupo2/<?= $gr->file_name; ?>" alt="" class="item-pr">

                        </div>
                        <div class="gps all-center">
                            <span class="s-item-name n-maior "><?= $gr->group2_name ?></span>
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
        <script>
            minproduct();
        </script>
        <?php


    }

    public function isemailAction($email)
    {
        $email = sanitize($email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function existsemailAction($email)
    {

        $email = sanitize($email);
        $m = new EmailsUser();

        if ($m->emailExistis($email)) {
            return true;
        }
        return false;
    }

    public function getcompraAction($name = 0)
    {
        $sek = new ShoppedKey();
        if ($name != 0) {
            $prds = $sek->getCompra($name);
        } else {
            $prds = $sek->getOpened();

        }
        if ($prds != false) {
            ?>
            <div class="itens-shopped">
                <?php
                foreach ($prds as $prd) {
                    ?>
                    <div class="item-shopped">


                        <!--
                        <div class="item-fotodiv">
                            <img src="pic/ananas.jpg" alt="" class="item-foto">
                        </div>
                        -->
                        <form class="shopped-pr">
                            <div class="gp">
                                <label>Status</label>

                                <span class="item-name">Pendente</span>
                            </div>
                            <div class="gp">
                                <label>Compra</label>

                                <span class="item-name"><?= $prd->shopped_k_id; ?></span>
                            </div>
                            <div class="gp">
                                <label>Qtd. Produto</label>
                                <span class="item-name"><?= $prd->total; ?></span>
                            </div>
                            <a href="<?= PROOT ?>shopped/statusordered/<?= $prd->shopped_k_id; ?>" class="butoes-one">Ver</a>
                            <a target="_blank" href="../files/facturas/<?= $prd->shopped_k_fac; ?>" class="butoes-one">Factura</a>
                        </form>
                    </div>
                    <?php
                }
                ?>

            </div>
            <?php
        }


    }

    public function setchegadadataAction($dia, $mes, $ano, $id)
    {
        $sep = new ShoppedPrds();

        $sep->updateChegada($dia, $mes, $ano, $id);

    }





























    public function updatepaisesAction($id, $name, $code){
        $Countries = new Countries();

        $params['country_name'] = $name;
        $params['country_code'] = $code;

        $Countries->update($id,$params, 'country_id');


        echo "País atualizado!";
    }
    public function updateuniverAction($id, $name){
        $Univers = new Univers();

        $params['univer_name'] = $name;

        $Univers->update($id,$params, 'univer_id');


        echo "Universidade atualizada!";
    }

    public function updatememberAction($id, $name){
        $Members = new Members();

        $params['member_name'] = $name;

        $Members->update($id,$params, 'member_id');


        echo "Membro atualizado!";
    }

    public function updatedistritosAction($id, $name, $pais){
        $Distritos = new Distritos();

        $params['distrito_name'] = $name;
        $params['distrito_pais'] = $pais;

        $Distritos->update($id,$params, 'distrito_id');


        echo "Distrito atualizado!";
    }
    public function updatelocalidadeAction($id, $name, $dist){
        $Localidades = new Localidades();

        $params['localidade_name'] = $name;
        $params['localidade_dist'] = $dist;

        $Localidades->update($id,$params, 'localidade_id');


        echo "Localidade atualizada!";
    }
    public function updateentidadeAction($id, $name){
        $Entidades = new Entidades();

        $params['entidade_name'] = $name;

        $Entidades->update($id,$params, 'entidade_id');


        echo "Entidade atualizada!";
    }


    public function updatedocumentoAction($id, $name){
        $Documentos = new Documentos();

        $params['documento_name'] = $name;

        $Documentos->update($id,$params, 'documento_id');


        echo "Documento atualizado!";
    }



    public function atestadoaprovarAction($id){
        $Atestados = new Atestados();

        $params['atestado_state'] = 2;

        $Atestados->update($id,$params, 'atestado_id');


        echo "Atestado aprovado!";
    }

    public function atestadoreprovarAction($id){
        $Atestados = new Atestados();

        $params['atestado_state'] = 4;

        $Atestados->update($id,$params, 'atestado_id');


        echo "Atestado rejeitado!";
    }
    public function atestadoconcluirAction($id){
        $Atestados = new Atestados();

        $params['atestado_state'] = 3;

        $Atestados->update($id,$params, 'atestado_id');


        echo "Atestado concluído!";
    }
    public function atestadopendenteAction($id){
        $Atestados = new Atestados();

        $params['atestado_state'] = 1;

        $Atestados->update($id,$params, 'atestado_id');


        echo "Atestado enviado para aprovação!";
    }
    public function atestadosetobsAction($id, $text){
        $Atestados = new Atestados();

        $params['atestado_obs'] = $text;

        $Atestados->update($id,$params, 'atestado_id');


        echo "Observação Inserida!";
    }






    public function autoaprovarAction($id){
        $Atestados = new Certidaos();

        $params['atestado_state'] = 2;

        $Atestados->update($id,$params, 'atestado_id');


        echo "Auto aprovado!";
    }

    public function autoreprovarAction($id){
        $Atestados = new Certidaos();

        $params['atestado_state'] = 4;

        $Atestados->update($id,$params, 'atestado_id');


        echo "Auto rejeitado!";
    }
    public function autoconcluirAction($id){
        $Atestados = new Certidaos();

        $params['atestado_state'] = 3;

        $Atestados->update($id,$params, 'atestado_id');


        echo "Auto concluído!";
    }
    public function autopendenteAction($id){
        $Certidaos = new Certidaos();

        $params['atestado_state'] = 1;

        $Certidaos->update($id,$params, 'atestado_id');


        echo "Auto enviado para aprovação!";
    }
    public function autosetobsAction($id, $text){
        $Atestados = new Atestados();

        $params['atestado_obs'] = $text;

        $Atestados->update($id,$params, 'atestado_id');


        echo "Observação Inserida!";
    }







}