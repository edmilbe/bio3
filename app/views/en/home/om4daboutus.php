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

                O que é OM4D?
            </div>
            <div class="read__content__text">

                <p class="paragraph read__content__text__paragraph">
                    O projeto OM4D (Mercado Orgânico para o Desenvolvimento ) visa a criação de oportunidades para os pobres através da inclusão nos mercados orgânicos nacionais e internacionais e a adaptação a desafios locais e globais existentes e novos, como a desigualdade, as mudanças climáticas, a escassez e o esgotamento dos recursos naturais. Ele usa a oportunidade de uma crescente demanda por produtos orgânicos como um motor para o desenvolvimento. O projeto é implementado pela IFOAM - Organics International com o apoio de sua organização parceira AgroEco - Instituto Louis Bolk (LBI) e inúmeros parceiros locais antigos e novos em quatro países da África Ocidental: Gana, Burkina Faso, Togo e São Tomé. O objetivo é que a agricultura orgânica e os sistemas de mercado relacionados permitam que os pequenos agricultores melhorem suas condições de vida.              </p>


            </div>


            <div class="read__content__title" id="components">

                As componentes do projeto
            </div>
            <div class="read__content__text">

                <p class="paragraph read__content__text__paragraph">

                    O projeto esta composto em 4 componentes á saber:


                </p>



                <ol  class="read__content__text__paragraph--list">
                    <li class="read__content__text__paragraph--list--item">
                        Componente 1: Dinamizar o sector orgânico                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Componente 2: Fornecer alimentos saudáveis aos consumidores locais                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Componente 3: Pequenos agricultores com valores acrescido
                    </li>
                    <li class="read__content__text__paragraph--list--item">Promover a capacitação e as habilidades
                        Componente 4: Desenvolvimento de politicas,Lobbying,Advocacia                    </li>

                </ol>





            </div>



            <div class="read__content__title" id="members">





            </div>



            <div class="read__content__title" id="dones">

                Nossas realizações            </div>
            <div class="read__content__text">




                <ul class="read__content__text__paragraph--list">
                    <li class="read__content__text__paragraph--list--item">
                        	Análise das Parte Interessadas no sector biológico em São Tomé
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        	Atelier com as Partes Interessadas
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        	Inquérito de base Socio Économico com os produtores de Bela Vista
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        	Inquérito de base Socio Économico com os produtores SPG

                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        	Formação sobre a certificação: Sistema Participativo de Garantia (SPG)

                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        	Reunião do Comité Nacional Consultivo
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        	Participação dos actores na 50 Conferencia da África Ocidental sobre a Agricultura Biológica

                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        	Cerimonia de Entrega de Certificação Biológica SPG á 10 produtores

                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        	Assinatura do Protocolo Público Privado Com o Ministério de Agricultura Pesca e Desenvolvimento Rural para STP 100% Bio

                    </li>
                </ul>





            </div>




            <div class="read__content__title" id="friends">

                Nossos Parceiros
            </div>
            <div class="read__content__text">
                <a href="#" class="staff__item">


                    <div class="staff__item__pic"
                         style="background-image: url('<?= PROOT ?>/files/fix/par_01.jpg'"></div>
                    <h1 class="staff__role staff__name">
                        Ministério dos Negocios Estrangeiros País Baixo
                    </h1>
                </a>


                <a href="#" class="staff__item">


                    <div class="staff__item__pic"
                         style="background-image: url('<?= PROOT ?>/files/fix/par_02.png'"></div>
                    <h1 class="staff__role staff__name">
                        Federação Internacional de   Agricultura Biológica
                    </h1>
                </a>

                <a href="#" class="staff__item">


                    <div class="staff__item__pic"
                         style="background-image: url('<?= PROOT ?>/files/fix/par_03.jpg'"></div>
                    <h1 class="staff__role staff__name">
                        AgroEco - Instituto Louis Bolk
                    </h1>
                </a>






            </div>


            <div class="read__content__title" id="team">

                Nossa equipa
            </div>
            <div class="read__content__text">

                <p class="paragraph read__content__text__paragraph">

                    A equipa do projeto é apresentada da seguinte maneira:

                </p>


                <?php
                foreach ($this->staffs as $staff):
                    if ( $staff->post_id == 10):
                        ?>
                        <h1>Gestão</h1>
                        <?php
                    endif;
                if ( $staff->post_id == 11):
                    ?>
                    <h1>Coordenador do projeto</h1>
                    <?php
                endif;


                    if ($staff->post_id == 12):
                        ?>
                        <h1>Componente 1</h1>
                        <?php

                    endif;


                    if (  $staff->post_id == 15):
                        ?>
                        <h1>Componente 2</h1>
                        <?php

                    endif;


                    if ( $staff->post_id == 17):
                        ?>
                        <h1>Componente 3</h1>
                        <?php

                    endif;

                    if ( $staff->post_id == 20):
                        ?>
                        <h1>Componente 4</h1>
                        <?php

                    endif;

                    if ($staff->post_id >= 10 ):
                        ?>
                        <a href="#" class="staff__item">
                            <div class="staff__item__pic"
                                 style="background-image: url('<?= PROOT ?>/files/cargos/<?= $staff->file_name ?>'"></div>
                            <span class="staff__item__name"><?= $staff->post_title ?></span>
                            <h1 class="staff__role staff__name">
                                <?= $staff->post_name ?>
                            </h1>
                        </a>


                        <?php

                    endif;

                    if ( $staff->post_id == 11 || $staff->post_id == 14 || $staff->post_id == 16
                        || $staff->post_id == 19
                    ):
                        ?>
                        <br>

                        <?php

                    endif;
                endforeach;


                ?>

            </div>



            <div class="read__content__title" id="wherefind">

                Onde encontrar produtos bio
            </div>
            <div class="read__content__text">




                <ul class="read__content__text__paragraph--list">
                    <li class="read__content__text__paragraph--list--item">
                        Amparo II
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Água Sampaio
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Santa Clara
                    </li>
                    <li class="read__content__text__paragraph--list--item">
                        Santa Luzia
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
