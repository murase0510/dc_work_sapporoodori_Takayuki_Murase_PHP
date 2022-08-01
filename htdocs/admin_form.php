<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./admin_form.css">
    <meta charset="UTF-8">
    <title>商品登録</title>
</head>
<body>

    <h2>商品登録</h2>
    <?php 
        session_start();

        require_once('../include/config/ec_const_class.php');
        $ec_c = new ec_const_class();
        require_once($ec_c::EC_DBACCESSER_PATH);
        require_once($ec_c::EC_PRINT_ADMIN_FORM_PATH);
        require_once($ec_c::EC_PRINT_ERROR_MESSAGE_ADMIN_FORM);
        
        $ec_db = new ec_DBAccesser_class();
        $prn = new ec_print_admin_form_class();
        $pr_er = new ec_print_error_message_admin_form_class();



        if(isset($_POST[$ec_c::ATTRIBUTE_NAME_POST_PRODUCT])){
            //リロード対策の参考サイト:https://techacademy.jp/magazine/41842
            // POSTされたトークンを取得
            $token = isset($_POST[$ec_c::ATTRIBUTE_NAME_TOKEN]) ? $_POST[$ec_c::ATTRIBUTE_NAME_TOKEN] : "";
            // セッション変数のトークンを取得
            $session_token = isset($_SESSION[$ec_c::SESSION_SESSION_TOKEN]) ? $_SESSION[$ec_c::SESSION_SESSION_TOKEN] : "";
            // セッション変数のトークンを削除
            unset($_SESSION[$ec_c::SESSION_SESSION_TOKEN]);
            if(isset($_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_NAME]) && 
            $_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_NAME] != "" && 
            isset($_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_PRICE])&& 
            $_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_PRICE] != "" &&
            (bool)preg_match('/^0$|^-?[1-9][0-9]*$/', $_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_PRICE]) &&
            (int)$_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_PRICE] >= 0 &&
            isset($_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_STOCK]) && 
            $_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_STOCK] != "" &&
            (bool)preg_match('/^0$|^-?[1-9][0-9]*$/', $_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_STOCK]) && 
            (int)$_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_STOCK] >= 0 &&
            isset($_FILES[$ec_c::ATTRIBUTE_NAME_PRODUCT_IMAGE][$ec_c::FILE_UPLOAD_VALIABLE_NAME]) && 
            $_FILES[$ec_c::ATTRIBUTE_NAME_PRODUCT_IMAGE][$ec_c::FILE_UPLOAD_VALIABLE_NAME] != "" &&
            is_trist_image_format($_FILES[$ec_c::ATTRIBUTE_NAME_PRODUCT_IMAGE][$ec_c::FILE_UPLOAD_VALIABLE_NAME]) &&
            $token != "" && $token == $session_token){
                $image = file_get_contents($_FILES[$ec_c::ATTRIBUTE_NAME_PRODUCT_IMAGE][$ec_c::FILE_UPLOAD_VALIABLE_TMP_NAME]);
                $ec_db->create_product($_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_NAME],$_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_PRICE],$_POST[$ec_c::ATTRIBUTE_NAME_RELEASE]);
                $product_id = $ec_db->get_last_insert_key();
                $ec_db->create_ec_stock($product_id,$_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_STOCK]);
                $ec_db->set_image($product_id,$image,$_POST[$ec_c::ATTRIBUTE_NAME_PRODUCT_NAME]);
                echo"<div class='trust_color'>正常に登録されました</div>";
            }
        }

        function is_trist_image_format($image_name){
            $ec_c = new ec_const_class();
            if($ec_c::IMAGE_FORMAT_JPG == substr($image_name, -4) || $ec_c::IMAGE_FORMAT_PNG == substr($image_name, -4)){
                return true;
            }else{
                return false;
            }
        }
    ?>
    <form method="post" enctype="multipart/form-data">
        <div>商品名　　：<input type="text" name="product_name"></div>
        <div>価格　　　：<input type="text" name="product_price"></div>
        <div>個数　　　：<input type="text" name="product_stock"></div>
        <div>商品画像　：<input type="file" name="product_image"></div>
        <select name="Release">
            <option value="open">公開</option>
            <option value="close">非公開</option>
        </select>
        <?php

            if(!$_SESSION[$ec_c::ATTRIBUTE_NAME_MAIL] == $ec_c::EC_ADMIN){
                header($ec_c::LOCATION_LOGOUT);
            }

            if($_SERVER[$ec_c::REQUEST_METHOD] == $ec_c::HTTP_POST){   
                $post_things = $_POST;
                $pr_er->print_register_error($post_things,$_FILES[$ec_c::ATTRIBUTE_NAME_PRODUCT_IMAGE][$ec_c::FILE_UPLOAD_VALIABLE_NAME]);
            }

            // 二重送信防止用トークンの発行
            $token = uniqid('', true);

            //トークンをセッション変数にセット
            $_SESSION[$ec_c::SESSION_SESSION_TOKEN] = $token;
        ?> 
        <div><input type="submit" name="post_product" value="商品を登録する"></div>
        <input type="hidden" name="token" value="<?php echo $token;?>">
    </form>
    <form action="./logout.php">
        <input type="hidden" name="logout" value="logout">
        <input type="submit" value="ログアウト">
   </form>


    <?php
    if($_SERVER[$ec_c::REQUEST_METHOD] == $ec_c::HTTP_POST){ 
        if(isset($_POST[$ec_c::ATTRIBUTE_NAME_CHANGE_STOCK])){
            $pr_er->print_error_for_stock($_POST[$ec_c::ATTRIBUTE_NAME_STOCK]);
        }
    }
    ?>
    <table>
        <tbody>
            <tr>
                <td>商品画像</td>
                <td>商品名</td>
                <td>価格</td>
                <td>在庫数</td>
                <td>公開フラグ</td>
                <td>削除する</td>
            </tr>
            <?php
                    
                    if($_SERVER[$ec_c::REQUEST_METHOD] == $ec_c::HTTP_POST){
                        if(isset($_POST[$ec_c::ATTRIBUTE_NAME_CHANGE_STOCK]) && $_POST[$ec_c::ATTRIBUTE_NAME_CHANGE_STOCK] != "" && preg_match('/^0$|^-?[1-9][0-9]*$/', $_POST[$ec_c::ATTRIBUTE_NAME_STOCK]) && (int)$_POST[$ec_c::ATTRIBUTE_NAME_STOCK] >= 0){
                            $stock_id = $_POST[$ec_c::ATTRIBUTE_NAME_CHANGE_STOCK];
                            $stock = $_POST[$ec_c::ATTRIBUTE_NAME_STOCK];
                            $ec_db->update_stock($stock_id,$stock);
                            echo"<div class='trust_color'>正常に在庫が変更されました</div>";
                        }elseif(isset($_POST[$ec_c::ATTRIBUTE_NAME_SWITCH_FLAG_BUTTON])){
                            $product_flag = substr($_POST[$ec_c::ATTRIBUTE_NAME_SWITCH_FLAG_BUTTON],0,1);
                            $product_id = substr($_POST[$ec_c::ATTRIBUTE_NAME_SWITCH_FLAG_BUTTON],1);
                            $ec_db->change_product_flag((int)$product_id,(bool)$product_flag);
                            echo"<div class='trust_color'>正常に公開フラグが変更されました</div>";
                        }elseif(isset($_POST[$ec_c::ATTRIBUTE_NAME_DELETE_PRODUCT_BUTTON])){
                            $product_id = $_POST[$ec_c::ATTRIBUTE_NAME_DELETE_PRODUCT_BUTTON];
                            $ec_db->delete_image($product_id);
                            $ec_db->delete_stock($product_id);
                            $ec_db->delete_product($product_id);
                            echo"<div class='trust_color'>正常に商品が削除されました</div>";
                        }
                    }
                    $prn->print_mine_image();
            ?>
        </tbody>
    </table>


</body>
</html>