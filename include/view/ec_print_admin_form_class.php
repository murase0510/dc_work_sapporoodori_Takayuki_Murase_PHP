<?php 
    require_once '../include/config/ec_const_class.php';
    $ec_c = new ec_const_class();
    require_once $ec_c::EC_DBACCESSER_PATH;

    class ec_print_admin_form_class{
        
        function print_mine_image(){
            $ec_c = new ec_const_class();
            $db = new ec_DBAccesser_class();
            $images = $db->get_all_image();
            $images_size = count($images);            
            
            for($i = 0;$i < $images_size;$i++){
                $product = $db->get_one_ec_product($images[$i][$ec_c::DB_PRODUCT_ID]);
                $stock = $db->get_one_ec_stock($images[$i][$ec_c::DB_PRODUCT_ID]);
                if((bool)$product[0][$ec_c::DB_PUBLIC_FLAG]){
                    echo "<tr>";
                }else{
                    echo "<tr class='background_gray'>";
                }
                echo '<td><img src="data:image/png;base64,'.base64_encode($images[$i][$ec_c::DB_IMAGE]).'" class="image"></td>';
                echo '<td>'.$product[0][$ec_c::DB_PRODUCT_NAME].'</td>';
                echo '<td>'.$product[0][$ec_c::DB_PRICE].'</td>';
                $this->print_change_stock_switch($stock);
                $this->print_switch_flag($product[0][$ec_c::DB_PUBLIC_FLAG],$product[0][$ec_c::DB_PRODUCT_ID]);
                $this->delete_product($product[0][$ec_c::DB_PRODUCT_ID]);
                echo '</tr>';
            }
        } 

        function print_change_stock_switch($stock){
            $ec_c = new ec_const_class();
            echo '<form method="post">';
            echo '<td><input type="text" name="stock" value='.$stock[0][$ec_c::DB_STOCK].'>';
            echo '<button type="submit" name="change_stock" value='.$stock[0][$ec_c::DB_STOCK_ID].'>変更する</button>';
            echo '</td>';
            echo '</form>';
        }
        
        function print_switch_flag($public_flg,$product_id){
            if((bool)$public_flg){
                echo '<form method="post">';
                echo '<td>';
                echo '<button type="submit" name="switch_flag_button" value="0'.$product_id.'">非表示にする</button>';
                echo '</td>';
                echo '</form>';
            }else{
                echo '<form method="post">';
                echo '<td>';
                echo '<button type="submit" name="switch_flag_button" value="1'.$product_id.'">表示する</button>';
                echo '</td>';
                echo '</form>';
            }
        }

        function delete_product($product_id){
            echo '<form method="post">';
            echo '<td>';
            echo '<button type="submit" name="delete_product_button" value='.$product_id.'>削除する</button>';
            echo '</td>';
            echo '</form>';
        }
    }
?>