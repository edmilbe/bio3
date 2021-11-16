<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>




<div class="head">

    <section class="agenda-section">

        <?php

        foreach($this->agenda as $agenda):
            ?>
            <div class="agenda">
                <div class="agenda__item">
                    <div class="agenda__item__date">

                        <?=$agenda->agenda_dia < 10 ? '0' . $agenda->agenda_dia : $agenda->agenda_dia?>/
                        /
                        <?=$agenda->agenda_mes < 10 ? '0' . $agenda->agenda_mes : $agenda->agenda_mes?>
                        /
                        <?=$agenda->agenda_ano;?>

                    </div>
                    <h1 class="agenda__item__title">
                        <?=$agenda->agenda_title;?>                    </h1>
                </div>


            </div>
            <?php
        endforeach;

        ?>

    </section>
</div>
















<?php $this->end(); ?>
