

<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="all" id="main-top">

    <div class="game">

        <section class="section box-section">


            <div class="new-cad">

                <div class="new-cad-title">
                    <h4 class="form-title">Recover Account</h4>
                    <a href="<?=PROOT?>register/login">Log In</a>
                </div>
                <div class="msgs">
                    <?= $this->displayErrors;?>
                </div>
                <form action="<?=PROOT?>register/recoveremail" method="post">


                    <div class="fg fg-inline">
                        <label for="email">Email</label>
                        <input type="text" class="form-c1" id="email" placeholder="Email" name="email" value="<?=$this->post['email'];?>">
                    </div>


                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">


                    <input type="submit" value="Send" class="botao botao-inline submit">


                </form>

            </div>


        </section>

    </div>
</div>


<?php $this->end(); ?>

