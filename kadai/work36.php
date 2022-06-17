<?php 
    $host = 'mysql34.conoha.ne.jp'; 
    $login_user = 'bcdhm_sapporo_pf0001'; 
    $password = 'A7c2b#Nw';   
    $database = 'bcdhm_sapporo_pf0001';   
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./work28.css">
    <title>work36</title>
</head>
<body>
    <?php
        require_once('./work36_DBAccesser.class.php');
        require_once('./work36_print.class.php');
        $db = new work36_DBAccesser();
        $pr = new work36_print();
        if($_SERVER["REQUEST_METHOD"] == "POST"){    
            if(isset($_POST['post_pic'])){
                $pr->print_error_message($_FILES['upload_image']['size'],$_POST['image_name'],$pr->is_trust_image(($_FILES["upload_image"]["name"])));
            }
        }
    ?> 
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="image_name">
        <p><input type="file" name="upload_image"></p>
        <input type="submit" name="post_pic" value="送信">
    </form>
    <a href="https://portfolio.dc-itex.com/sapporoodori/0001/work36_print_authenticated_image.php"  >写真一覧ページへ</a>
    <?php 
        //echo phpversion();

        $image_list = [];
        if($_SERVER["REQUEST_METHOD"] == "POST"){    
            if(isset($_POST['post_pic'])){
                if (isset($_POST["image_name"]) && $_POST['image_name'] != "" && !$_FILES["upload_image"]["name"] == "" && $pr->is_trust_image($_FILES["upload_image"]["name"])){
                    $type = $_FILES['upload_image']['type'];
                    $content = file_get_contents($_FILES['upload_image']['tmp_name']);
                    $size = $_FILES['upload_image']['size'];
                    $db->set_image($_POST['image_name'],true,$content,$type,$size);
                }

            }elseif(isset($_POST['switch-flag-button'])){
                $image_flag = substr($_POST['switch-flag-button'],0,1);
                $image_id = substr($_POST['switch-flag-button'],1);
                $db->change_flag((int)$image_id,(bool)$image_flag);
            }
        }
        $pr->print_mine_image(1,1);
    ?>
</body>
</html>