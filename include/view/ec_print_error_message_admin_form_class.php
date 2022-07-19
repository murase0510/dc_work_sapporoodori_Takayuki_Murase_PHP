<?php
    class ec_print_error_message_admin_form_class{
        function print_register_error($post_things,$file){
            require_once('../include/config/ec_const_class.php');
            $ec_c = new ec_const_class();
            if(isset($post_things[$ec_c::ATTRIBUTE_NAME_POST_PRODUCT])){ 
                if(!isset($post_things[$ec_c::ATTRIBUTE_NAME_PRODUCT_NAME]) || $post_things[$ec_c::ATTRIBUTE_NAME_PRODUCT_NAME] == ""){
                    echo"<div class='error-color'>商品名を入力してください</div>";
                }
                if(!isset($post_things[$ec_c::ATTRIBUTE_NAME_PRODUCT_PRICE]) || $post_things[$ec_c::ATTRIBUTE_NAME_PRODUCT_PRICE] == ""){
                    echo"<div class='error-color'>値段を入力してください</div>";
                }else if(!preg_match('/^0$|^-?[1-9][0-9]*$/', $_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_PRICE]) || 0 > (int)$_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_PRICE]){
                    echo"<div class='error-color'>値段には正の整数を入力してください</div>";
                }
                if(!isset($post_things[$ec_c::ATTRIBUTE_NAME_PRODUCT_STOCK]) || $post_things[$ec_c::ATTRIBUTE_NAME_PRODUCT_STOCK] == ""){
                    echo"<div class='error-color'>在庫数を入力してください</div>";
                }else if(!preg_match('/^0$|^-?[1-9][0-9]*$/', $_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_STOCK])|| 0 > (int)$_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_STOCK]){
                    echo"<div class='error-color'>在庫数には正の整数を入力してください</div>";
                }
                if(!isset($file) || $file == ""){
                    echo"<div class='error-color'>画像を指定してください</div>";
                }
                if(!is_trist_image_format($file)){
                    echo"<div class='error-color'>アップロードできる画像の画像形式はjpgかpngだけです</div>";
                }
            }            
        }

        function print_error_for_stock($stock){
            if($stock == ""){
                echo"<div class='error-color'>在庫数を入力してください</div>";
            }else if(!preg_match('/^0$|^-?[1-9][0-9]*$/',$stock)){
                echo"<div class='error-color'>在庫には半角数字を入力してください</div>";
            }else if(0 > (int)$stock){
                echo"<div class='error-color'>在庫には正の数字を入力してください</div>";
            }
        }

        function is_trist_image_format($file){
            $ec_c = new ec_const_class();
            if($ec_c::IMAGE_FORMAT_JPG == substr($image_name, -4) || $ec_c::IMAGE_FORMAT_PNG == substr($image_name, -4)){
                return true;
            }else{
                return false;
            }
        }
    }
?>