<?php
    require_once '../include/config/ec_const_class.php';
    $ec_c = new ec_const_class();
    require_once $ec_c::EC_DBACCESSER_PATH;

    class ec_print_shopping_cart_class{
        function print_cart_in_product($cart_id){
            $ec_c = new ec_const_class();
            $ec_db = new ec_DBAccesser_class();
            $cart_in_products = $ec_db->get_cart_product_chukan_by_cartid($cart_id);
            echo '<div class="cart_in_products">';
            $products_size = count($cart_in_products);
            for($i = 0;$i < $products_size;$i++){
                $product_price = $ec_db->get_one_ec_product($cart_in_products[$i][$ec_c::DB_PRODUCT_ID])[0][$ec_c::DB_PRICE];
                $stock = $ec_db->get_one_ec_stock($cart_in_products[$i][$ec_c::DB_PRODUCT_ID])[0][$ec_c::DB_STOCK];
                $purchase_num = $cart_in_products[$i][$ec_c::DB_PURCHASE_NUMBER];
                echo '<div class="one_product">';
                $image = $ec_db->get_one_image($cart_in_products[$i][$ec_c::DB_PRODUCT_ID]);
                $image_name = $ec_db->get_one_ec_product($cart_in_products[$i][$ec_c::DB_PRODUCT_ID]);
                echo '<div class="cart_image"><img src="data:image/png;base64,'.base64_encode($image[0][$ec_c::DB_IMAGE]).'" class="cart_image_size"></div>';
                echo '<div class="image_name">'.$image_name[0][$ec_c::DB_PRODUCT_NAME].'</div>';
                $this->print_delete_button($cart_in_products[$i][$ec_c::DB_PRODUCT_ID]);
                echo '<div class="product_price">価格：¥'.$product_price.'</div>';
                echo '<div class="product_stock">在庫：'.$stock.'個</div>';
                $this->print_update_num_button($cart_in_products[$i][$ec_c::DB_PRODUCT_ID],$purchase_num);
                echo '</div>';
            }
        }

        function print_delete_button($product_id){
            echo '<form method="post" class="delete_button">';
            echo '<button type="submit" name="delete_button" value="'.$product_id.'">削除する</button>';
            echo '</form>';
        }

        function print_update_num_button($product_id,$purchase_num){
            echo '<form method="post" class="num_button_form">';
            echo '<div class="num_button">数量：<input type="text" name="Purchase_number" value="'.$purchase_num.'"></div>';
            echo '<button type="submit" name="post_Purchase_number" value="'.$product_id.'">変更する</button>';
            echo '</form>';
        }
    }
?>