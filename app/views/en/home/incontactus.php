<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="all" id="main-top">

    <div class="game">

        <section class="section box-section">


            <div class="new-cad">

                <div class="new-cad-title">
                    <h4 class="form-title">JetCompras conectado</h4>
                    <a href="<?= PROOT ?>home">Continuar a compra</a>
                </div>

                <div class="chat">

                    <?php

                    if ($this->msgs != false):
                        $cont = 0;
                        foreach ($this->msgs as $msg):
                            $cont++;
                            if ($msg->msg_i_reply == 1):
                                ?>
                                <div class="chat-msg">
                        <span class="chat-name">
                            JetCompras
                        </span>
                        <span class="chat-text">
                            <?= $msg->msg_i_text; ?>
                        </span>
                                </div>
                                <?php
                            else:
                                ?>
                                <div class="chat-msg self">
                        <span class="chat-name">
                            <?=CurrentUser()->user_fname?>
                        </span>
                        <span class="d-block text-left border rounded p-2" >
                            <?= $msg->msg_i_text; ?>
                        </span>
                                </div>
                                <?php

                            endif;
                        if($cont == 4):

                            endif;
                        endforeach;

                    endif;

                    ?>

                </div>

                <div class="msgs">
                    <?= $this->displayErrors; ?>
                </div>
                <form action="<?= PROOT ?>home/contact" method="post" class="">

                    <div class="form-group">
                        <label for="msg">Message text</label>
                        <textarea name="msg" id="msg" class="form-control"></textarea>
                    </div>


                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">


                    <input type="submit" value="Send" class="btn btn-success">

                </form>

            </div>
        </section>

    </div>
</div>


<?php $this->end(); ?>


