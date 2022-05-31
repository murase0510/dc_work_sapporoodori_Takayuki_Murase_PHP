<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work28</title>
</head>
<?php 
    require_once('./work28_DBAccesser.class.php');
    require_once('./work28_image.class.php');

    class work28_print_image{
        
        function print_image($arg1, $arg2){
            $db = new work28_DBAccesser();
            $image = $db->get_all_image();
            //var_dump($image);
            echo '<div class = images>';
            echo '<div class="one_image">';
            $image_size = count($image);
            for($i = 0;$i < $image_size;$i++){
                //$enc_img = base64_encode($w28_image->image);//数値から画像をエンコード
                //$imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);
                //echo '<img src="data:' . $imginfo['mime'] . ';base64,' . $enc_img . '" />';
                echo '<p class="image_name">'.$image[$i]['image_name'].'</p>';
                echo '<img src="data:image/png;base64,'.base64_encode($image[$i]['image']).'" width="30%" height="30%">';
                if($image_size == $i + 1){
                    var_dump($i + 1);
                    echo '</div>';
                }elseif($i != 0 && $i % 3  == 0){
                    echo '</div>';
                    echo '<div class="one_image">';
                }

            }
            echo '</div>';
        } 
    }
?>
<body>
</body>
</html>
