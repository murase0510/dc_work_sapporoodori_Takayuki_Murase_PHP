<?php
class ec_is_more_stock_than_purchase_number(){
    function Comparison_purchase_number_and_stock($stock,$num){
        if($stock >= $num){
            return true;
        }else{
            return false;
        }
    }
}
?>