<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./ec_site.css">
    <meta charset="UTF-8">
    <title>購入が完了しました</title>
</head>
<body>
    <script src="./ec_user_header.js"></script>
    <div class="cart_form">
        <?php
                session_start();
                require_once('../include/config/ec_const_class.php');
                $ec_c = new ec_const_class();
                require_once($ec_c::EC_NO_SESSION_PATH);
                require_once($ec_c::EC_PRINT_PURCHASE_COMPLETE_PATH);
                require_once($ec_c::EC_CALC_TOTAL_COST_PATH);
                require_once($ec_c::EC_DBACCESSER_PATH);
                $calc_total = new ec_calc_total_cost_class();
                $pri_comp = new ec_print_purchase_complete_class();
                $no_session = new ec_no_session_class();
                $no_session->no_session();
                $pri_comp->print_purhcase_products($_SESSION[$ec_c::SESSION_CART_ID]);
                $cart_id = $_SESSION[$ec_c::SESSION_CART_ID];
        ?>

        <div>
            <span class="cost">小計：<?php echo $calc_total->print_total_cost($cart_id) ?>円</span>
            <input onclick=location.href="./product_list.php" value="商品一覧に戻る" class="btn message" type="submit">
        </div>
        <?php
            $ec_db = new ec_DBAccesser_class();
            $products = $ec_db->get_cart_product_chukan_by_cartid($cart_id);
            $products_size = count($products);
            for($i = 0;$i < $products_size;$i++){
                $product_id = $products[$i][$ec_c::DB_PRODUCT_ID];
            }
            $ec_db->update_cart_product_chukan_purchase_date($cart_id);
        ?>
    </div>
</body>
</html>