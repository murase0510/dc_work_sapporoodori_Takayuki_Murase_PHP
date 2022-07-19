<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./ec_site.css">
    <meta charset="UTF-8">
    <title>商品一覧</title>
</head>
<body>
    <script src="./ec_user_header.js"></script>
    <div class="product_list_form">
        <?php
            session_start();
            require_once('../include/config/ec_const_class.php');
            $ec_c = new ec_const_class();
            require_once($ec_c::EC_DBACCESSER_PATH);
            require_once($ec_c::EC_PRODUCT_LIST_PATH);
            require_once($ec_c::EC_NO_SESSION_PATH);
            $ec_db = new ec_DBAccesser_class();
            $pri_list = new ec_product_list_class();
            $no_session = new ec_no_session_class();
            $no_session->no_session();
            
            if($_SERVER[$ec_c::REQUEST_METHOD] == $ec_c::HTTP_POST){   
                if(isset($_POST[$ec_c::ATTRIBUTE_NAME_IN_CART_BUTTON])){ 
                    $product_id = $_POST[$ec_c::ATTRIBUTE_NAME_IN_CART_BUTTON];
                    $cart_id = $_SESSION[$ec_c::SESSION_CART_ID];
                    if($ec_db->is_in_cart_product_chukan($cart_id,$product_id)){
                        $ec_db->plus_one_cart_product_chukan_Purchase_number($cart_id,$product_id);
                        echo"<div class='trust_color'>".$ec_db->get_one_ec_product($product_id)[0][$ec_c::DB_PRODUCT_NAME]."がカートに一個追加されました</div>";
                    }else{
                        $ec_db->create_cart_product_chukan($cart_id,$product_id);
                        echo"<div class='trust_color'>カートに正常に追加されました</div>";
                    }
                    
                }
            }

            $pri_list->print_products();

        ?>
        
    </div>
</body>
</html>