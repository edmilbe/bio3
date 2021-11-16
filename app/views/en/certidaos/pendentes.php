<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <ul class="list-others">
        <li class="list-others__item">
            <a href="<?= PROOT ?>auto/index" class="list-others__item--link">&rarr; Devolvidos</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>auto/pendentes" class="list-others__item--link">&rarr; Pendentes</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>dir/aprovados1" class="list-others__item--link">&rarr; Aprovados</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>auto/closed" class="list-others__item--link">&rarr; Concluídos</a>
        </li>
        
    </ul>

    <h1 class="section-title">
        Autorizações por Aprovar
    </h1>


    <?php

    foreach ($this->atestado as $atestado):
        ?>
        <a href="<?=PROOT?>auto/pendentes/<?=$this->pageno?>/<?=$atestado->atestado_id?>/#popup" class="document">
            <span class="document__detail">
            <?=$atestado->atestado_date?>
        </span>
        <span class="document__detail">
            <?=$atestado->bi_name?>
        </span>
        <span class="document__detail">
            <?=$atestado->bi_number?>
        </span>
        <span class="document__detail">
            <?=$atestado->atestado_id?>
        </span>


        </a>

        <?php

    endforeach;
    ?>

    <ul class="pagination">
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>auto/pendentes/">Ínicio</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>auto/pendentes/<?=($this->pageno <= 1) ? "": $this->pageno-1?>">&leftarrow; Anterior</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>auto/pendentes/<?=($this->pageno >= $this->total_pages) ? "": $this->pageno + 1?>">Seguinte &rightarrow;</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>auto/pendentes/<?=$this->total_pages?>">Final</a>
        </li>
    </ul>

    <br>
    <ul class="list-others">
        <li class="list-others__item">
            <a href="<?= PROOT ?>auto/buscar" class="list-others__item--link">&rarr; Buscar por Número/Nome/BI</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>auto/update" class="list-others__item--link">&rarr; Atualizar Autorização</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>bi/newbi" class="list-others__item--link">&rarr; Novo Bilhete de Identidade</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>auto/create" class="list-others__item--link">&rarr; Emitir Autorização</a>
        </li>

    </ul>
</section>



<div class="popup" id="popup">

    <div class="popup__content">
        <div class="form">
            <div class="response" id="response">
                <?=$this->displayErrors;?>
            </div>
            <div class="form__group">
                <label class="form__label">
                    Nome :                 <input type="text" class="form__input" value="<?=$this->atestado_view->bi_name;?>" readonly>
                    BI:                 <input type="text" class="form__input" value="<?=$this->atestado_view->bi_number;?>" readonly>
                    Atestado:                 <input type="text" class="form__input" value="<?=$this->atestado_view->atestado_id;?>" readonly>

                </label>
            </div>

            <div class="form__group">
                <label class="form__label">
                    Observação
                </label>
                <textarea name="obs"



                          onkeyup="auto_setobs(<?=$this->atestado_view->atestado_id;?>);"
                          id="obs<?=$this->atestado_view->atestado_id;?>" cols="30" rows="5" class="form__input"><?=$this->atestado_view->atestado_obs;?></textarea>
            </div>



        </div>
        <ul class="list-others">
            <li class="list-others__item">
                <button onclick="auto_aprovar(<?=$this->atestado_view->atestado_id;?>);" class="btn btn__okay"> Aprovar</button>
            </li>
            <li class="list-others__item">
                <button onclick="auto_reprovar(<?=$this->atestado_view->atestado_id;?>);" class="btn btn__decline"> Rejeitar</button>
            </li>
            <li class="list-others__item">
                <button onclick="auto_imprimir(<?=$this->atestado_view->atestado_id;?>);" class="btn btn__imprimir"> Imprimir</button>
            </li>


            <li class="list-others__item">
                <?php
                $link = PROOT . "files/atestados/" . $this->atestado_view->atestado_id . ".pdf";

                ?>
                <a target="_blank" href='<?=$link?>' class="btn btn__imprimir">Visualizar</a>
            </li>

        </ul>




        <script>

            function auto_imprimir(id){
                window.location.replace("<?=PROOT?>auto/download/certidoes/" +id);
                //location.href =
            }




        </script>






        <div class="popup__right">
            <a href="#section-tours" class="popup__close">&times;</a>
            <h3 class="heading-tertiary u-margin-bottom-small">PDF Vai aprecer aqui</h3>
            <p class="popup__text">

            </p>
        </div>
    </div>
</div>

<?php $this->end(); ?>
