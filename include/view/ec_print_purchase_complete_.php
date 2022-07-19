<?php
    class ec_print_purchase_complete{
        function print_purhcase_products(){
            $ec_db = new ec_DBAccesser_class();
            $cart_in_products = $ec_db->get_cart_product_chukan_by_cartid($cart_id);
            echo '<div>購入が完了しました</div>';
            echo '<div class="cart_in_products">';
            $products_size = count($cart_in_products);
            for($i = 0;$i < $products_size;$i++){
                $product_price = $ec_db->get_one_ec_product($cart_in_products[$i]["product_id"])[0]["price"];
                $purchase_num = $cart_in_products[$i]["Purchase_number"];
                echo '<div class="one_product">';
                $image = $ec_db->get_one_image($cart_in_products[$i]["product_id"]);
                echo '<div class="cart_image"><img src="data:image/png;base64,'.base64_encode($image[0]["image"]).'" class="cart_image_size"></div>';
                echo '<div class="image_name">'.$image[0]['image_name'].'</div>';
                echo '<div class="product_price">価格：¥'.$product_price.'</div>';
                echo '<div style="margin-left:40px" class="purchase_number">'.$cart_in_products[$i]["Purchase_number"].'</div>';
                echo '</div>';
            }
        }
    }
?>