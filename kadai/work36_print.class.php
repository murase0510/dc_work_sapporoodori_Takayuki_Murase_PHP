<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work28</title>
</head>
<?php 
    require_once('./work36_DBAccesser.class.php');

    class work36_print{
        
        function print_mine_image($arg1, $arg2){
            $db = new work36_DBAccesser();
            $image = $db->get_all_image();
            echo '<div class = "images">';
            echo '<div class="image_line">';
            $image_size = count($image);
            for($i = 0;$i < $image_size;$i++){
                if($image[$i]['public_flg']){
                    echo '<div class="one_image background-white">';
                }else{
                    echo '<div class="one_image background-gray">';
                }
                
                echo '<span class="image_name">'.$image[$i]['image_name'].'</span>';
                echo '<img src="data:image/png;base64,'.base64_encode($image[$i]['image']).'" class="image">';
                $this->print_switch_flag($image[$i]['public_flg'],$image[$i]['image_id']);
                echo '</div>';
                if($image_size == $i + 1){
                    echo '</div>';
                }elseif($i != 0 && ($i + 1) % 3  == 0){
                    echo '</div>';
                    echo '<div class="image_line">';
                }
            }
            echo '</div>';
        } 

        function print_authenticated_image(){
            $db = new work36_DBAccesser();
            $image = $db->get_all_image();
            echo '<div class = "images">';
            echo '<div class="image_line">';
            $image_size = count($image);
            for($i = 0;$i < $image_size;$i++){
                if($image[$i]['public_flg']){
                    echo '<div class="one_image background-white">';
                    echo '<span class="image_name">'.$image[$i]['image_name'].'</span>';
                    echo '<img src="data:image/png;base64,'.base64_encode($image[$i]['image']).'" class="image">';
                    echo '</div>';

                    if($image_size == $i){
                        echo '</div>';
                    }elseif($i != 0 && ($i + 1) % 3  == 0){
                        
                        echo '</div>';
                        echo '<div class="image_line">';
                    }
                }
            }
            echo '</div>';
        } 

        function print_switch_flag($public_flg,$image_id){
            if($public_flg == 1){
                echo '<form method="post">';
                echo '<button type="submit" name="switch-flag-button" value="0'.$image_id.'">非表示にする</button>';
                echo '</form>';
            }else{
                echo '<form method="post">';
                echo '<button type="submit" name="switch-flag-button" value="1'.$image_id.'">表示する</button>';
                echo '</form>';
            }
        }

        function is_trust_image($image_name){
            if(substr($image_name,-4) == '.png'||substr($image_name,-4) == '.jpg'){
                return true;
            }else{
                return false;
            }
        }

        function print_error_message($image_size,$image_name,$_image_name_flag){
            if($image_size == 0){
                echo "<div style='color:red'>画像が指定されていません</div>";
            }
            if($image_name == ""){
                echo "<div style='color:red'>名前が指定されていません</div>";
            }else if($_image_name_flag == false){
                echo "<div style='color:red'>正しい形式ではありません</div>";
            }
        }
    }
?>
<body>
</body>
</html>
