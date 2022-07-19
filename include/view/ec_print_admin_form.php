<?php 
    require_once('../include/model/ec_DBAccesser.class.php');

    class ec_print_admin_form{
        
        function print_mine_image(){
            $db = new ec_DBAccesser();
            $images = $db->get_all_image();
            $images_size = count($images);
            echo "<tr>";
            for($i = 0;$i < $images_size;$i++){
                $product = $db->get_one_ec_product($images[$i]['product_id']);
                $stock = $db->get_one_ec_stock($images[$i]['product_id']);
                echo '<td><img src="data:image/png;base64,'.base64_encode($images[$i]['image']).'></td>';
                echo '<td>'.$product['product_name'].'</td>';
                echo '<td>'.$product['price'].'</td>';
                echo '<td>'.$stock['stock'].'</td>';
                echo '<td>非表示にする</td>';
                echo '<td>削除する</td>';
            }
            echo '</tr>>';
        } 
    }
?>