
<?php
include_once "../../system/system.php";
$helper = new Helper();
$db = new DB();
$name = $helper->GetPost('v');

$grupos = $db->DBInner("select *from group1 inner join files on group1_foto = file_id   and  group1_name LIKE '%" . $name ."%'");
if($grupos != false) {
    ?>
    <div class="itens-shopping">
    <?php
    foreach($grupos as $gr){

        ?>
        <a href="gr2.php?on=<?php echo $gr['group1_id']?>" class="item-shopping">
            <div class="item-fotodivs">

                <img src="files/grupo1/<?php echo $gr['file_name']; ?>" alt="" class="item-pr">

            </div>

            <div class="shopping-pr">
                <div class="gps">
                    <span class="s-item-name n-maior"><?php echo $gr['group1_name']?></span>
                </div>
            </div>
        </a>
        <?php
    }
    ?>
    </div>
        <?php
}else{
    ?>
    <div class="itens-shopping">
        <span class="result-busca">Nao Encontrado! :(</span>
    </div>
    <?php
}


