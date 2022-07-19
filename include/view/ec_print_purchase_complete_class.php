<?php
    require_once '../include/config/ec_const_class.php';
    $ec_c = new ec_const_class();
    require_once $ec_c::EC_DBACCESSER_PATH;

    class ec_print_purchase_complete_class{
        function print_purhcase_products($cart_id){
            $ec_c = new ec_const_class();
            $ec_db = new ec_DBAccesser_class();

            $cart_in_products = $ec_db->get_cart_product_chukan_by_cartid($cart_id);
            echo '<div class="purchase_message">購入が完了しました</div>';
            echo '<div class="cart_in_products">';
            $products_size = count($cart_in_products);
            for($i = 0;$i < $products_size;$i++){
                $product_price = $ec_db->get_one_ec_product($cart_in_products[$i][$ec_c::DB_PRODUCT_ID])[0][$ec_c::DB_PRICE];
                $purchase_num = $cart_in_products[$i][$ec_c::DB_PURCHASE_NUMBER];
                echo '<div class="one_product">';
                $image = $ec_db->get_one_image($cart_in_products[$i][$ec_c::DB_PRODUCT_ID]);
                $image_name = $ec_db->get_one_ec_product($cart_in_products[$i][$ec_c::DB_PRODUCT_ID]);
                echo '<div class="product_image"><img src="data:image/png;base64,'.base64_encode($image[0][$ec_c::DB_IMAGE]).'" class="product_image_size"></div>';
                echo '<div class="purchased_image_name">'.$image_name[0][$ec_c::DB_PRODUCT_NAME].'</div>';
                echo '<div class="product_price">価格：¥'.$product_price.'</div>';
                echo '<div class="purchase_number">'.$cart_in_products[$i][$ec_c::DB_PURCHASE_NUMBER].'</div>';
                echo '</div>';
            }
        }
    }
?>