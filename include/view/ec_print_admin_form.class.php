<?php 
    require_once('../include/model/ec_DBAccesser.class.php');

    class ec_print_admin_form{
        
        function print_mine_image(){
            $db = new ec_DBAccesser();
            $images = $db->get_all_image();
            $images_size = count($images);            
            
            for($i = 0;$i < $images_size;$i++){
                $product = $db->get_one_ec_product($images[$i]['product_id']);
                $stock = $db->get_one_ec_stock($images[$i]['product_id']);
                if((bool)$product[0]['public_flag']){
                    echo "<tr>";
                }else{
                    echo "<tr class='background_gray'>";
                }
                echo '<td><img src="data:image/png;base64,'.base64_encode($images[$i]['image']).'" class="image"></td>';
                echo '<td>'.$product[0]['product_name'].'</td>';
                echo '<td>'.$product[0]['price'].'</td>';
                $this->print_change_stock_switch($stock);
                $this->print_switch_flag($product[0]['public_flag'],$product[0]['product_id']);
                $this->delete_product($product[0]['product_id']);
                echo '</tr>';
            }
        } 

        function print_change_stock_switch($stock){
            echo '<form method="post">';
            echo '<td><input type="text" name="stock" value='.$stock[0]["stock"].'>';
            echo '<button type="submit" name="change_stock" value='.$stock[0]["stock_id"].'>変更する</button>';
            echo '</td>';
            echo '</form>';
        }
        
        function print_switch_flag($public_flg,$product_id){
            if((bool)$public_flg){
                echo '<form method="post">';
                echo '<td>';
                echo '<button type="submit" name="switch-flag-button" value="0'.$product_id.'">非表示にする</button>';
                echo '</td>';
                echo '</form>';
            }else{
                echo '<form method="post">';
                echo '<td>';
                echo '<button type="submit" name="switch-flag-button" value="1'.$product_id.'">表示する</button>';
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