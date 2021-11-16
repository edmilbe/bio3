

<?php $this->start('body'); ?>
<h3 class="text-center">My Profile</h3>

<div class="persons">
    <div class="person">
        <div class="pic-center">
            <img src="<?=PROOT?>files/<?=$this->user->file_name?> " alt="" class="img-user">
        </div>
        <div class="details">
            <div class="detail">
                <div class="det"><?=$this->user->user_fname?> <?=$this->user->user_lname?></div>
            </div>
            <div class="detail">
                <div class="det"><?=$this->user->espec_name?></div>
            </div>
            <div class="detail">
                <div class="det"><?=$this->user->user_email?></div>
            </div>


        </div>
    </div>
</div>
<h3 class="text-center">Other Users</h3>

<?php foreach($this->users as $user):?>

    <div class="persons">
        <div class="person">
            <div class="pic">
                <img src="<?=PROOT?>files/<?=$user->file_name?> " alt="" class="img-user">
            </div>
            <div class="details">
                <div class="detail">
                    <div class="det"><?=$user->user_fname?> <?=$user->user_lname?></div>
                </div>
                <div class="detail">
                    <div class="det"><?=$user->espec_name?></div>
                </div>
                <div class="detail">
                    <div class="det"><?=$user->user_email?></div>
                </div>
                <div class="detail btn-d">
                    <div><a href="<?=PROOT?>persons/view/<?=$user->user_id?>" class="btn   btn-primary btn-large">View</a></div>
                </div>

            </div>
        </div>
    </div>
<?php endforeach;?>

<?php $this->end(); ?>
