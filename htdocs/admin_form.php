<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./admin_form.css">
    <meta charset="UTF-8">
    <title>商品登録</title>
</head>
<body>

    <h2>商品登録</h2>
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
            session_start();

            require_once('../include/config/ec_const_class.php');
            require_once('../include/model/ec_DBAccesser_class.php');
            require_once('../include/view/ec_print_admin_form_class.php');
            $ec_c = new ec_const_class();
            $ec_db = new ec_DBAccesser_class();
            $prn = new ec_print_admin_form_class();

            if(!$_SESSION['mail'] == $ec_c::EC_ADMIN){
                if(isset($_POST["logout"])) {
                    $session = session_name();
                    $_SESSION = [];
                        if (isset($_COOKIE[$session])) {
                            $params = session_get_cookie_params();
                            setcookie($session, '', time() - 30, '/');
                        }
                    }
                header("Location: ./login.php");
            }

            if($_SERVER["REQUEST_METHOD"] == "POST"){   
                if(isset($_POST['post_product'])){ 
                    if(!isset($_POST['product_name']) || $_POST['product_name'] == ""){
                        echo"<div>商品名を入力してください</div>";
                    }
                    if(!isset($_POST['product_price']) || $_POST['product_price'] == ""){
                        echo"<div>値段を入力してください</div>";
                    }
                    if(!isset($_POST['product_stock']) || $_POST['product_stock'] == ""){
                        echo"<div>在庫数を入力してください</div>";
                    }
                    if(!isset($_FILES["product_image"]["name"]) || $_FILES["product_image"]["name"] == ""){
                        echo"<div>画像を指定してください</div>";
                    }
                }
            }
        ?> 
        <div><input type="submit" name="post_product" value="商品を登録する"></div>
    </form>
    <?php 
        $image_list = [];
        if($_SERVER["REQUEST_METHOD"] == "POST"){   
            if(isset($_POST['post_product'])){
                if(isset($_POST['product_name']) && $_POST['product_name'] != "" && isset($_POST['product_price'])&& $_POST['product_price'] != "" && isset($_POST['product_stock']) && $_POST['product_stock'] != "" &&isset($_FILES["product_image"]["name"]) && $_FILES["product_image"]["name"] != ""){
                    $image = file_get_contents($_FILES['product_image']['tmp_name']);
                    $ec_db->create_product($_POST['product_name'],$_POST['product_price'],$_POST['Release']);
                    $product_id = $ec_db->get_last_insert_key();
                    $ec_db->create_ec_stock($product_id,$_POST['product_stock']);
                    $ec_db->set_image($product_id,$image,$_POST['product_name']);
                }
            }
        }
    ?>
    <form action="./login.php" method="post">
        <input type="hidden" name="logout" value="logout">
        <input type="submit" value="ログアウト">
   </form>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){   
        if(isset($_POST['change_stock'])){
            if( $_POST['stock'] == "" ){
                echo"<div>在庫数を入力してください</div>";
            }
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
                    
                    if($_SERVER["REQUEST_METHOD"] == "POST"){   
                        if(isset($_POST['change_stock']) && $_POST['stock'] != ""){
                            $stock_id = $_POST['change_stock'];
                            $stock = $_POST['stock'];
                            $ec_db->update_stock($stock_id,$stock);
                        }elseif(isset($_POST['switch-flag-button'])){
                            $product_flag = substr($_POST['switch-flag-button'],0,1);
                            $product_id = substr($_POST['switch-flag-button'],1);
                            $ec_db->change_product_flag((int)$product_id,(bool)$product_flag);
                        }elseif(isset($_POST['delete_product_button'])){
                            $product_id = $_POST['delete_product_button'];
                            $ec_db->delete_image($product_id);
                            $ec_db->delete_stock($product_id);
                            $ec_db->delete_product($product_id);
                        }
                    }
                    $prn->print_mine_image();
            ?>
        </tbody>
    </table>


</body>
</html>