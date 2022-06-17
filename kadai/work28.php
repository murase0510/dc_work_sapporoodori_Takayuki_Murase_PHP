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
    <title>work28</title>
</head>
<body>
    <?php
        require_once('./work28_DBAccesser.class.php');
        require_once('./work28_print_image.class.php');
        $db = new work28_DBAccesser();
        $pr = new work28_print_image();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST['post_pic'])){
                if($_FILES['upload_image']['size'] == 0){
                    echo "<div style='color:red'>画像が指定されていません</div>";
                }
                if($_POST['image_name'] == ""){
                    echo "<div style='color:red'>名前が指定されていません</div>";
                }else if($pr->is_trust_image(($_FILES["upload_image"]["name"])) == false){
                    echo "<div style='color:red'>正しい形式ではありません</div>";
                }
                
            }


        }
    ?> 
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="image_name">
        <p><input type="file" name="upload_image"></p>
        <input type="submit" name="post_pic" value="送信">
    </form>
    <a href="https://portfolio.dc-itex.com/sapporoodori/0001/work28_print_authenticated_image.php"  >写真一覧ページへ</a>
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
        //$image_list = $db->get_all_image();
        //var_dump($image_list);
        $pr->print_mine_image(1,1);

        /*
            $fp = fopen($_FILES['upload_image']['tmp_name'], "rb");
            $img = fread($fp, filesize($_FILES['upload_image']['tmp_name']));//ここで画像を数値化
            fclose($fp);
            $enc_img = base64_encode($img);//数値から画像をエンコード
            $imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);
            echo '<img src="data:' . $imginfo['mime'] . ';base64,' . $enc_img . '" />';
                        var_dump(isset($_POST["image_name"]));
            var_dump( $_POST['image_name'] != "" );
            var_dump(isset($_POST["upload_image"]));
            var_dump($_POST['upload_image'] != "");
            var_dump($_POST["upload_image"]);
        */
    ?>
</body>
    <?
        //$w28_image = $db->get_one_image(1);
    ?>

</html>