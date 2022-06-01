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
            echo '<div class = "images">';
            echo '<div class="image_line">';
            $image_size = count($image);
            for($i = 0;$i < $image_size;$i++){
                $public_flag = $image[$i]['public_flag'];
                //$enc_img = base64_encode($w28_image->image);//数値から画像をエンコード
                //$imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);
                //echo '<img src="data:' . $imginfo['mime'] . ';base64,' . $enc_img . '" />';
                echo '<div class="one_image">';
                echo '<span class="image_name">'.$image[$i]['image_name'].'</span>';
                echo '<img src="data:image/png;base64,'.base64_encode($image[$i]['image']).'" class="image">';
                echo '</div>';
                if($image_size == $i + 1){
                    echo '</div>';
                }elseif($i != 0 && $i % 3  == 0){
                    echo '</div>';
                    echo '<div class="image_line">';
                }

            }
            echo '</div>';
        } 

        function print_flag_switch($i){
            //trueの時
            if($i == 1){
                echo '<form method="post">';
                echo '<input type="submit" value="送信">';
                echo '</form>';
            }else{

            }
        }
    }
?>
<body>
</body>
</html>
