<?php $this->siteTitle(''); ?>

<?php $this->start('head'); ?>

<?php $this->end(); ?>

<?php $this->start('body'); ?>




<div class="all" id="main-top">

    <div class="game">

        <section class="section box-section">


            <div class="new-cad">

                <div class="new-cad-title">
                    <h4 class="form-title">Your message details</h4>
                    <a href="<?=PROOT?>home/contact">Send another message</a>

                </div>
                <div class="msgs">
                    <?= $this->displayErrors;?>
                </div>
                <form action="#" method="post" class="">
                    <div class="fg fg-inline">
                        <label for="name">Name</label>
                        <input type="text" class="form-c1" id="name" readonly name="name" value="<?=$this->post['name'];?>">
                    </div>
                    <div class="fg fg-inline">
                        <label for="email">Email</label>
                        <input type="email" class="form-c1" id="email" readonly name="email" value="<?=$this->post['email'];?>">
                    </div>
                    <div class="fg fg-inline">
                        <label for="msg">Message text</label>
                        <textarea name="msg" id="msg" readonly class="form-c1" ><?=$this->post['msg'];?></textarea>
                    </div>



                </form>

            </div>


        </section>

    </div>
</div>

<?php $this->end(); ?>


