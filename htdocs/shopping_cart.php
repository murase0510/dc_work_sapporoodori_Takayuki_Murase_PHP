<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./ec_site.css">
    <meta charset="UTF-8">
    <title>ショッピングカート</title>
</head>
<body>
    <script src="./ec_user_header.js"></script>
    <div class="cart_form">
        <?php
            session_start();
            require_once('../include/config/ec_const_class.php');
            $ec_c = new ec_const_class();
            require_once($ec_c::EC_DBACCESSER_PATH);
            require_once($ec_c::EC_NO_SESSION_PATH);
            require_once($ec_c::EC_PRINT_SHOPPING_CART_PATH);
            require_once($ec_c::EC_CALC_TOTAL_COST_PATH);
            $calc_total = new ec_calc_total_cost_class();
            $no_session = new ec_no_session_class();
            $pri_list = new ec_print_shopping_cart_class();
            $ec_db = new ec_DBAccesser_class();
            $cart_id = $_SESSION[$ec_c::SESSION_CART_ID];
            $no_session->no_session();

            if($_SERVER[$ec_c::REQUEST_METHOD] == $ec_c::HTTP_POST){   
                if(isset($_POST[$ec_c::ATTRIBUTE_NAME_POST_PURCHASE_NUMBER])){ 
                    $Purchase_number = $_POST[$ec_c::ATTRIBUTE_NAME_PURCHASE_NUMBER];
                    //参考サイト：https://wepicks.net/phpsample-preg-integer/
                    if(preg_match('/^0$|^-?[1-9][0-9]*$/', $_POST[$ec_c::ATTRIBUTE_NAME_PURCHASE_NUMBER]) &&(int)$_POST[$ec_c::ATTRIBUTE_NAME_PURCHASE_NUMBER] >= 0){
                        $ec_db->update_cart_product_chukan_Purchase_number($cart_id,$_POST[$ec_c::ATTRIBUTE_NAME_POST_PURCHASE_NUMBER],(int)$Purchase_number);
                        echo"<div class='trust_color'>カートに正常に追加されました</div>";
                    }else{
                        echo"<div class='error-color'>正の整数以外の値を入れないでください</div>";
                    }
                }
                if(isset($_POST[$ec_c::ATTRIBUTE_NAME_DELETE_BUTTON])){
                    $ec_db->delete_cart_product_chukan($cart_id,$_POST[$ec_c::ATTRIBUTE_NAME_DELETE_BUTTON]);
                    echo"<div class='trust_color'>正常に削除されました</div>";
                }

                
                if(isset($_POST[$ec_c::ATTRIBUTE_NAME_ADJUSTMENT])){
                    $cart_in_products = $ec_db->get_cart_product_chukan_by_cartid($cart_id);
                    $products_size = count($cart_in_products);
                    $i = 0;
                    $over = true;
                    while($products_size > $i){
                        $product = $ec_db->get_one_ec_product($cart_in_products[$i][$ec_c::DB_PRODUCT_ID]);
                        
                        if(0 > is_stock_more_than_purchase_number($cart_in_products[$i][$ec_c::DB_PURCHASE_NUMBER],$cart_in_products[$i][$ec_c::DB_PRODUCT_ID])){
                            echo"<div class='error-color'>".$product[0][$ec_c::DB_PRODUCT_NAME]."の在庫が十分ではありません</div>";
                            $over = false;
                        }
                        $i++;
                        if($i == $products_size && $over){
                            $s = 0;
                            while($products_size > $s){
                                $product = $ec_db->get_one_ec_product($cart_in_products[$s][$ec_c::DB_PRODUCT_ID]);
                                $ec_db->minus_stock($cart_in_products[$s][$ec_c::DB_PURCHASE_NUMBER],$product[0][$ec_c::DB_PRODUCT_ID]);
                                $s++;
                            }
                            header($ec_c::LOCATION_PURCHASE_COMPLETE);
                        }
                        
                    }

                }
            }
            
            $pri_list->print_cart_in_product($cart_id);
            function calc_difference_purchase_number($product_id,$cart_id,$num){
                $ec_c = new ec_const_class();
                $ec_db = new ec_DBAccesser_class();
                $cart = $ec_db->get_one_cart_product_chukan($cart_id,$product_id);
                return (int)$num - (int)$cart[0][$ec_c::DB_PURCHASE_NUMBER];
            }

            function is_stock_more_than_purchase_number($num,$product_id){
                $ec_c = new ec_const_class();
                $ec_db = new ec_DBAccesser_class();           
                $stock = $ec_db->get_one_ec_stock($product_id);
                return $stock[0][$ec_c::DB_STOCK] - $num;
            }
        ?>
    </div>
    <div>
        <span class="cost">小計：<?php echo $calc_total->print_total_cost($cart_id) ?>円</span>
        <form method="post">
            <input value="購入する" name="adjustment" class="btn message" type="submit">
        </form>
        <input onclick=location.href="./product_list.php" value="商品一覧に戻る" class="btn message cart_back_to_product_list" type="submit">
    </div>
</body>
</html>