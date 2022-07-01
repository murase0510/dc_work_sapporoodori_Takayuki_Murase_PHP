<?php
    require_once '../include/model/ec_DBAccesser_class.php';
    class ec_product_list_class{
        function print_products(){
            $db = new ec_DBAccesser_class();
            $products = $db->get_all_product();
            echo '<div class="image_line">';
            $products_size = count($products);

            for($i = 0;$i < $products_size;$i++){
                if((bool)$products[$i]['public_flag']){
                    echo '<div class="one_image">';
                    $image = $db->get_one_image($products[$i]["product_id"]);
                    echo '<img src="data:image/png;base64,'.base64_encode($image[0]["image"]).'" class="image">';
                    echo '<div class="image_name">'.$products[$i]['product_name'].'</div>';

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
    }
?>