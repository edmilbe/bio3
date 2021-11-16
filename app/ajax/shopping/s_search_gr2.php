
<?php
include_once "../../system/system.php";
$helper = new Helper();
$db = new DB();
$name = $helper->GetPost('v');
$on = $helper->GetPost('onn');

$session = $helper->ReturnSession();

if(isset($on)){
    if(is_numeric($on) && $on != 0) {

        $grupos = $db->DBInner("select *from group1  inner join group2 inner join group12 inner join files on group2_foto = file_id and group12_2 = group2_id and group12_1 = $on and group12_1 = group1_id  and  group2_name LIKE '%" . $name ."%' ");
    }else{
        $grupos = $db->DBInner("select *from group1  inner join group2 inner join group12 inner join files on group2_foto = file_id and group12_2 = group2_id and group12_1 = group1_id  and  group2_name LIKE '%" . $name ."%' ");
    }
}else{

    $grupos = $db->DBInner("select *from group1  inner join group2 inner join group12 inner join files on group2_foto = file_id and group12_2 = group2_id and group12_1 = group1_id  and  group2_name LIKE '%" . $name ."%' ");
}


if($grupos != false){
    ?>
    <div class="itens-shopping">
        <?php
        foreach($grupos as $gr){

            ?>
            <a href="index.php?on=<?php echo $gr['group2_id']?>&onon=<?php echo $gr['group1_id']?>" class="item-shopping">
                <div class="item-fotodivs">

                    <img src="files/grupo2/<?php echo $gr['file_name']; ?>" alt="" class="item-pr">

                </div>

                <div class="shopping-pr">
                    <div class="gps">
                        <span class="s-item-name n-maior"><?php echo $gr['group2_name']?></span>
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


