<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="container">


    <table class='table'>
        <thead>
        <tr>
            <th scope='col'>&numero;</th>
            <th scope='col'>Designacao</th>
            <th scope='col'>Quantidade (KG)</th>
            <th scope='col'>Preço</th>
            <th scope='col'>Total</th>
        </tr>
        </thead>
        <tbody>

        <?php

        $moeda = MOEDA;

        $totalglobal = 0;
        $cont = 0;

        foreach ($this->items as $item) {

            $totallocal = 0;
            if ($item->shopping_p_qt > 0) {
                $cont++;
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
                ?>

                <tr>
                    <th scope='row'><?= $cont ?></th>
                    <td><?= $item->prd_name ?></td>
                    <td>                    <form action="<?= PROOT ?>home/updatebox/<?= $item->prd_id ?>" method="post" class="form">

                            <select name="quantity" id="quantity<?= $item->prd_id ?>" class="rounded" onchange=addfrombox(<?= $item->prd_id ?>);>
                                <option value="0">None</option>
                                <?php


                                $max = 10;
                                $step = 0.5;

                                do {
                                    $select = $item->shopping_p_qt == $step ? "selected" : "";
                                    ?>
                                    <option value="<?= $step; ?>" <?= $select; ?>><?= $step; ?></option>
                                    <?php
                                    $step += 0.5;

                                } while ($step <= 10);


                                ?>

                            </select>
                            <input type="hidden" name="token" value="<?= $this->token; ?>">
                        </form>
                    </td>
                    <td><?= number_format($preco, 2); ?> <?= MOEDA ?> </td>
                    <th id="total<?= $item->prd_id ?>"> <?= number_format($totallocal, 2); ?> <?= MOEDA ?></th>
                </tr>


                <?php
            }




        }

        ?>


        <?php
        $tt = number_format($totalglobal + 10, 2);
        ?>
        </tbody>
    </table>

    <table class='table'>
        <thead>
        <tr>
            <th scope='col'>Subtotal</th>
            <th scope='col'>Transporte</th>
            <th scope='col'>Total a pagar</th>

        </tr>
        </thead>
        <tbody>
        <tr>
            <td id="subtotal"><?= number_format($totalglobal,2); ?> <?= MOEDA ?></td>
            <td>10.00 <?= MOEDA ?></td>
            <th id="total_final"><?= $tt; ?> <?= MOEDA ?></th>
        </tr>
        </tbody>
    </table>







</section>




<section class="container">
    <form action="<?= PROOT ?>home/box" method="post">
        <?php

        if (currentUser()) {
            $address = currentUser()->user_address;
        } else {
            $address = '';
        }

        if(currentUser()) {

            ?>

            <div class="form-group">
                <label for="address">Endreço de entrega</label>
                <textarea required name="address" id="address" class="form-control"><?= $address; ?></textarea>
            </div>
            <input type="hidden" name="token" value="<?= $this->token; ?>">

            <?php
            if ($totalglobal > 0) {
                ?>
                <input type="submit" class="btn btn-success d-inline" value="Terminar a compra">

                <?php
            }
        }elseif($totalglobal > 0){
            ?>
            <a href="<?= PROOT ?>register/register" class="btn btn-success">Entrar e concluir o pedido</a>

            <?php
        }
        ?>
        <a href="<?= PROOT ?>home/index" class="btn btn-primary">Continuar a compra</a>

    </form>
</section>


<?php $this->end(); ?>

