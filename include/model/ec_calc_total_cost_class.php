<?php
    require_once '../include/config/ec_const_class.php';
    $ec_c = new ec_const_class();

    require_once $ec_c::EC_DBACCESSER_PATH;
    class ec_calc_total_cost_class{
        function print_total_cost($cart_id){
            $ec_c = new ec_const_class();   
            $ec_db = new ec_DBAccesser_class();
            $cart_in_products = $ec_db->get_cart_product_chukan_by_cartid($cart_id);
            $products_size = count($cart_in_products);
            $cost = 0;
            for($i = 0;$i < $products_size;$i++){
                $product = $ec_db->get_one_ec_product($cart_in_products[$i][$ec_c::DB_PRODUCT_ID]);
                $cost += $product[0][$ec_c::DB_PRICE] * $cart_in_products[$i][$ec_c::DB_PURCHASE_NUMBER];
            }
            return $cost;
        }
    }
?>