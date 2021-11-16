




<?php $this->start('head'); ?>
<?php $this->siteTitle(''); ?>


<?php $this->end(); ?>

<?php $this->start('body'); ?>




<section class="resgiter container">
    <h1>Gerir Membros</h1>


    <form id="personal" action="#" method="post">
        <div class="form-row">


            <div class="form-group">
                <label for="org">Escolha Organização</label>
                <select class="custom-select" id="org" name="org" required onchange="members(<?=$this->user;?>,
                    '<?php echo Token::generate(); ?>'
                    )">

                    <option selected disabled>Escolher...</option>

                    <?php
                    foreach($this->orgs as $org):
                        ?>

                        <option value="<?=$org->org_id;?>"><?=$org->org_name;?></option>

                        <?php
                    endforeach;
                    ?>

                </select>
            </div>



        </div>


    </form>


    <div class="row" id="members">



    </div>





</section>








<?php $this->end(); ?>
