


















<?php $this->start('head'); ?>
<?php $this->siteTitle(''); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>



<section class="container">

    <?php
    if(Session::exists('SLASH')) {
        Session::get('SLASH');
        Session::delete('SLASH');
    }
    ?>
    <div class='row'>
        <div class='col-sm-8'><h1>JetCompras</h1></div>
        <div class='col'>
            <div class="row">
                <div class="col">
                    Pedido Nº
                </div>
                <div class="col-sm">
                    <?=$this->items[0]->shopped_k_id;?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Data
                </div>
                <div class="col-sm">
                    <?=$this->items[0]->shopped_k_data;?>
                </div>
            </div>
        </div>
    </div>

    <table class='table'>
        <thead>
        <tr>
            <th scope='col'>&numero;</th>
            <th scope='col'>Designacao</th>
            <th scope='col'>Quantidade (KG)</th>
            <th scope='col'>Preço</th>
            <th scope='col'>Total</th>
            <th scope='col'>Data de Entrega</th>
        </tr>
        </thead>
        <tbody>

        <?php

        $moeda = MOEDA;

        $totalglobal = 0;
        $cont = 0;
        //dnd($this->items);
        foreach ($this->items as $item) {


            $totallocal = 0;
            if ($item->shopped_p_qt > 0) {
                $cont++;
                ?>

                <?php


                $preco = $item->shopped_p_prc;
                $totallocal = $preco * $item->shopped_p_qt;


                $totalglobal += $totallocal;
                ?>

                <tr>
                    <th scope='row'><?= $cont ?></th>
                    <td><?= $item->prd_name ?></td>
                    <td> <?= $item->shopped_p_qt ?>
                    </td>
                    <td><?= number_format($preco, 2); ?> <?= MOEDA ?> </td>
                    <th> <?= number_format($totallocal, 2); ?> <?= MOEDA ?></th>
                    <th> <?php echo $item->shopped_p_chegada == "1999-12-31 21:00:00" ? "Pendent" : $item->shopped_p_chegada; ?>
                    </th>
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
            <td><?= number_format($totalglobal,2); ?> <?= MOEDA ?></td>
            <td>10.00 <?= MOEDA ?></td>
            <th><?= $tt; ?> <?= MOEDA ?></th>
        </tr>
        </tbody>
    </table>
    <?php
    //dnd($this->items);
    ?>
    <a target="_blank" href="../../files/facturas/<?=$this->items[0]->shopped_k_fac;?>" class="btn btn-primary">Fatura</a>







</section>




<section class="container">
    <form action="#" method="post">
        <?php

        if (currentUser()) {
            $address = currentUser()->user_address;
        } else {
            $address = '';
        }


        ?>

        <div class="form-group">
            <label for="address">Endreço de entrega</label>
            <textarea readonly name="address" id="address" class="form-control"><?= $address; ?></textarea>
        </div>
        <input type="hidden" name="token" value="<?= $this->token; ?>">

        <?php
        if ($totalglobal > 0) {
            ?>

            <?php
        }
        ?>
        <a href="<?= PROOT ?>home/index" class="btn btn-primary">Continuar a compra</a>

    </form>
</section>


<?php $this->end(); ?>
