<?php
    require_once '../include/config/ec_const_class.php';
    $ec_c = new ec_const_class();
    require_once $ec_c::EC_DBACCESSER_PATH;
    
    class ec_product_list_class{
        function print_products(){
            $ec_db = new ec_DBAccesser_class();
            $ec_c = new ec_const_class();
            $products = $ec_db->get_all_product();
            echo '<div class="image_line">';
            $products_size = count($products);
            for($i = 0;$i < $products_size;$i++){
                if((bool)$products[$i][$ec_c::DB_PUBLIC_FLAG]){
                    echo '<div class="one_image">';
                    $image = $ec_db->get_one_image($products[$i][$ec_c::DB_PRODUCT_ID]);
                    echo '<img src="data:image/png;base64,'.base64_encode($image[0][$ec_c::DB_IMAGE]).'" class="image">';
                    echo '<div>'.$products[$i][$ec_c::DB_PRODUCT_NAME].'   '.$products[$i][$ec_c::DB_PRICE].'円</div>';
                    $stock = $ec_db->get_one_ec_stock($products[$i][$ec_c::DB_PRODUCT_ID]);
                    if($stock[0][$ec_c::DB_STOCK] == 0){
                        echo"<div>売り切れ</div>";
                    }else{
                        $this->print_in_cart_button($products[$i][$ec_c::DB_PRODUCT_ID]);
                    }
                    echo '</div>';
                    if($products_size == $i + 1){
                        echo '</div>';
                    }elseif($i != 0 && ($i + 1) % 3  == 0){
                        echo '</div>';
                        echo '<div class="image_line">';
                    }
                }
            }
            echo '</div>';
        } 

        function print_in_cart_button($product_id){
            echo '<form method="post">';
            echo '<button type="submit" name="in_cart_button" value="'.$product_id.'">カートに入れる</button>';
            echo '</form>';
        }
    }
?>