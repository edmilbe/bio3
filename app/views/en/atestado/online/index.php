<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="form-section" id="form-section">
    <h1 class="section-title">
        Emissão de Atestado
    </h1>


    <?php

    foreach ($this->atestado as $atestado):
        $link = PROOT . "files/atestados/" . $atestado->atestado_id . ".pdf";
        
        ?>
        <a target="_blanc" href="<?=$link?>" class="document">
            
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
        <span class="document__detail">
            <?=$atestado->atestado_state?>
        </span>

        </a>

        <?php

    endforeach;
    ?>

    <ul class="pagination">
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>atestado/index/">Ínicio</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>atestado/index/<?=($this->pageno <= 1) ? "": $this->pageno-1?>">&leftarrow; Anterior</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>atestado/index/<?=($this->pageno >= $this->total_pages) ? "": $this->pageno + 1?>">Seguinte &rightarrow;</a>
        </li>
        <li class="pagination__li">
            <a class="pagination__a" href="<?=PROOT?>atestado/index/<?=$this->total_pages?>">Final</a>
        </li>
    </ul>

    <br>
    <ul class="list-others">
        <li class="list-others__item">
            <a href="<?= PROOT ?>atestado/buscar" class="list-others__item--link">&rarr; Buscar por Número/Nome/BI</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>atestado/update" class="list-others__item--link">&rarr; Atualizar Atestado</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>bi/newbi" class="list-others__item--link">&rarr; Novo Bilhete de Identidade</a>
        </li>
        <li class="list-others__item">
            <a href="<?= PROOT ?>atestado/create" class="list-others__item--link">&rarr; Criar Atestado</a>
        </li>

    </ul>
</section>





<?php $this->end(); ?>
