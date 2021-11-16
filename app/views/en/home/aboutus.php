<?php $this->start('head'); ?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v7.0&appId=2468585373389622&autoLogAppEvents=1"
        nonce="PvUoG18B"></script>


<meta property="og:url" content="http://camaramezochi.st/home/postread/<?= $this->post->post_id; ?>"/>
<meta property="og:type" content="Site Informativo"/>
<meta property="og:title" content="<?= $this->post->post_title; ?>"/>
<meta property="og:description" content="Camara Distrital de Mé-Zochi"/>
<meta property="og:image" content="http://camaramezochi.st/files/posts/<?= $this->post->file_name; ?>"/>


<?php $this->end(); ?>

<?php $this->start('body'); ?>


<section class="section-read">
    <div class="read">
        <div class="read__content">


            <div class="read__content__picture"
                 style="background-image: url('<?= PROOT ?>files/posts/'">
            </div>


            <div class="read__content__title" id="whats">

                O que é MB-STP
            </div>
            <div class="read__content__text">

                <p class="paragraph read__content__text__paragraph">
                    O Movimento donomina-se Movimento Bio STP adiante designado por MB-STP, é o Movimento dos
                    produtores,transformadores, importadores, exportadores e comsumidores, todos inseridos na cadeia de
                    valor dos produtos ou todos inseridos no sector biológico de São Tomé e Príncipe.
                </p>


            </div>


            <div class="read__content__title" id="goals">

                Nossos Objectivos
            </div>
            <div class="read__content__text">

                <p class="paragraph read__content__text__paragraph">

                    O MB-STP tem como objetivos:


                </p>



                <ol  class="read__content__text__paragraph--list">
                    <li class="read__content__text__paragraph--list--item">
                        Defender e representar os interesses dos atores do sector a biológico;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Desenvolver a cooperação entre os vários atores do sector biológico;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Contribuir na definição de políticas públicas
                        para promoção do sector biológico;
                    </li>
                    <li class="read__content__text__paragraph--list--item">Promover a capacitação e as habilidades
                        profissionais dos membros;
                    </li>
                    <li class="read__content__text__paragraph--list--item">Zelar pelo aumento da quantidade e promover a
                        qualidade dos produtos provenientes do sector biológico;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Promover a marca nacional de produtos biológicos;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Contribuir para a coleta e disseminação de informações estratégicas e estatísticas sobre o setor
                        biológico ao nível nacional, regional e internacional;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Desenvolver a parceria com qualquer instituição nacional, regional ou internacional que trabalha
                        para a promoção do sector biológico;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Mobilizar e gerir recursos técnicos e financeiros para a promoção do sector biológico;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Contribuir para a criação do sistema de rastreabilidade de produtos no interesse do consumidor;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Realizar qualquer outra ação direta ou indiretamente relacionada com os objetivos do MB-STP.
                    </li>
                </ol>





            </div>



            <div class="read__content__title" id="members">

                Nossos Membros
            </div>
            <div class="read__content__text">

                <p class="paragraph read__content__text__paragraph">
                    O MB-STP tem 43 membros sendo:
                </p>







                <ol class="read__content__text__paragraph--list-1">

                    <?php
                    foreach($this->membros as $country):
                        ?>
                        <li class="read__content__text__paragraph--list-1--item">
                            <?=$country->member_name;?>
                        </li>
                        <?php

                    endforeach;
                    ?>



                </ol>




            </div>



            <div class="read__content__title" id="actions">

                Nossos Meios de Ações
            </div>
            <div class="read__content__text">

                <p class="paragraph read__content__text__paragraph">

                    De acordo com os objetivos, o MB-STP possui os seguintes meios de ação:

                </p>



                <ul class="read__content__text__paragraph--list">
                    <li class="read__content__text__paragraph--list--item">
                        Promover a criação de agrupamento dos seguimentos da cadeia de valor no sector biológico;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Comunicação e informação sobre atividades biológicas;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        A organização de consultas entre os vários atores do sector biológico;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Mobilização de recursos (humanos, materiais,
                        financeiros, etc.);
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        O estabelecimento de mecanismos e ferramentas
                        para o gerenciamento de estatísticas de cadeias
                        de valor biológico;</li>
                    <li class="read__content__text__paragraph--list--item">
                        Treinamento e conscientização sobre boas práticas
                        no sector biológico;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Advocacia e lobby;
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Capacitação dos membros através de apoio técnico e
                        institucional.
                    </li>
                </ul>





            </div>




            <div class="read__content__title" id="sectors">

                Área de Intervenção
            </div>
            <div class="read__content__text">

                <p class="paragraph read__content__text__paragraph">

                    Área de Intervenção sobres


                </p>





            </div>


            <div class="read__content__title" id="composition">

                Órgãos Sociais
            </div>
            <div class="read__content__text">

                <p class="paragraph read__content__text__paragraph">

                    MB-STP é composto pelos seguintes órgãos sociais:

                </p>


                <ul class="read__content__text__paragraph--list">
                    <li class="read__content__text__paragraph--list--item">
                        Assembléia Geral
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Conselho Executivo                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Conselho Fiscal                     </li>

                </ul>

                <p class="paragraph read__content__text__paragraph">

                    A <span class="read__content__text__paragraph__show">
                        Assembléia Geral
                    </span> é o órgão máximo do MB-STP, constituido por todos os membros effetivos em pleno gozo dos seus direitos constitucionais expressamente convocada em termos dos presentes Estatutos e pela mesa da assembleia constituida por um presidente que preside/orienta os trabalhos e um secretário para secretariar e redigir a acta da AG.
                    Reúne-se uma vez por ano, quando convocada pelo presidente. Pode também reunir-se em sessão extraordinária a pedido dos membros do Conselho Executivo (CE) ou por dois terços dos membros.


                </p>
                <p class="paragraph read__content__text__paragraph">

                    Reúne-se uma vez por ano, quando convocada pelo presidente. Pode também reunir-se em sessão extraordinária a pedido dos membros do Conselho Executivo (CE) ou por dois terços dos membros.


                </p>



                <p class="paragraph read__content__text__paragraph">
                    A Conselho Executivo do MB-STP é composta por cinco (5) membros:




                </p>

                <p class="paragraph read__content__text__paragraph">

                    Os membros da Conselho Executivo são eleitos para um mandato de três anos renovável para mais um mandato.


                </p>


                <?php
                foreach ($this->staffs as $staff):
                    if ($staff->post_id <= 9):
                        ?>
                        <a href="#popup-1" class="staff__item">


                            <div class="staff__item__pic"
                                 style="background-image: url('<?= PROOT ?>/files/cargos/<?= $staff->file_name ?>'"></div>
                            <span class="staff__item__name"><?= $staff->post_title ?></span>
                            <h1 class="staff__role staff__name">
                                <?= $staff->post_name ?>
                            </h1>
                        </a>

                        <div class="popup" id="popup-1">
                            <div class="popup__content">
                                <div class="popup__left popup__img"
                                     style="background-image: url('<?= PROOT ?>/files/cargos/<?= $staff->file_name ?>'">
                                    <div class="popup__img"></div>

                                </div>
                                <div class="popup__right">
                                    <a href="#section-tours" class="popup__close">&times;</a>

                                    <div class="federation__item__about">
                                        <h1 class="federation__item__name"><?= $staff->post_title ?></h1>

                                        <h2 class="federation__item__name"><?= $staff->post_name ?></h2>

                                        <p class="federation__item__about--paragraph">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad consequuntur
                                            culpa et iusto nisi, quidem reiciendis saepe? Consequuntur dicta doloribus
                                            est molestiae nesciunt odio omnis porro, provident rem voluptatem! Aut.
                                        </p>

                                        <p class="federation__item__about--paragraph">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad consequuntur
                                            culpa et iusto nisi, quidem reiciendis saepe? Consequuntur dicta doloribus
                                            est molestiae nesciunt odio omnis porro, provident rem voluptatem! Aut.
                                        </p>

                                        <p class="federation__item__about--paragraph">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad consequuntur
                                            culpa et iusto nisi, quidem reiciendis saepe? Consequuntur dicta doloribus
                                            est molestiae nesciunt odio omnis porro, provident rem voluptatem! Aut.
                                        </p>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <?php

                    endif;

                    if ( $staff->post_id == 2 || $staff->post_id == 3  ):
                        ?>
                        <br>

                        <?php

                    endif;
                endforeach;


                ?>







            </div>



            <div class="read__content__title" id="friends">

                Área de Intervenção
            </div>
            <div class="read__content__text">

                <p class="paragraph read__content__text__paragraph">

                    O MB-STP tem 43 membros sendo:


                </p>



                <ul class="read__content__text__paragraph--list">
                    <li class="read__content__text__paragraph--list--item">
                        Defender e representar os
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Desenvolver a cooperação entre os
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Contribuir na definição
                    </li>
                    <li class="read__content__text__paragraph--list--item">Promover a capacitação
                    </li>
                </ul>





            </div>





        </div>

    </div>
    <div class="col-3-of-4">

    </div>
    <div class="col-1-of-4">


    </div>
</section>


<?php $this->end(); ?>
