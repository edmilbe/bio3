<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="all" id="main-top">

    <div class="game">

        <section class="section box-section">


            <div class="new-cad">

                <div class="new-cad-title">
                    <h4 class="form-title">2X-Shopping connect</h4>
                    <a href="<?= PROOT ?>home">Back home</a>
                </div>

                <div class="chat">

                    <?php

                    if ($this->msgs != false):
                        $cont = 0;
                        foreach ($this->msgs as $msg):
                            $cont++;
                            if ($msg->msg_i_reply == 0):
                                ?>
                                <div class="chat-msg">
                        <span class="chat-name">
                            <?= $msg->user_fname;?>
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
                            Me
                        </span>
                        <span class="chat-text">
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
                <form action="<?= PROOT ?>msgs/view/<?=$this->id;?>" method="post" class="">

                    <div class="fg fg-inline">
                        <label for="msg">Message reply</label>
                        <textarea name="msg" id="msg" class="form-c1"></textarea>
                    </div>


                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">


                    <input type="submit" value="Send" class="botao botao-inline submit">

                </form>

            </div>
        </section>

    </div>
</div>


<?php $this->end(); ?>


