<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="all" id="main-top">

    <div class="game">

        <section class="section box-section">


            <div class="new-cad">

                <div class="new-cad-title">
                    <h4 class="form-title">Contact us</h4>
                    <a href="<?=PROOT?>register/login">Use my account</a>
                </div>
                <div class="msgs">
                    <?= $this->displayErrors;?>
                </div>
                <form action="<?=PROOT?>home/contact" method="post" class="">
                    <div class="fg fg-inline">
                        <label for="name">Name</label>
                        <input type="text" class="form-c1" id="name" name="name" value="<?=$this->post['name'];?>">
                    </div>
                    <div class="fg fg-inline">
                        <label for="email">Email</label>
                        <input type="email" class="form-c1" id="email" name="email" value="<?=$this->post['email'];?>">
                    </div>
                    <div class="fg fg-inline">
                        <label for="msg">Message text</label>
                        <textarea name="msg" id="msg" class="form-c1" ><?=$this->post['msg'];?></textarea>
                    </div>


                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">


                    <input type="submit" value="Send" class="botao botao-inline submit">

                </form>

            </div>


        </section>

    </div>
</div>



<?php $this->end(); ?>


