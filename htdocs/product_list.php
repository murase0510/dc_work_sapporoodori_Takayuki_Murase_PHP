<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./ec_site.css">
    <meta charset="UTF-8">
    <title>商品一覧</title>
</head>
<body>
    <script src="./ec_header_login.js"></script>
    <div class="product_list_form">
        <?php
            require_once('../include/view/ec_product_list_class.php');
            $pri_list = new ec_product_list_class();
            $pri_list->print_products();
        ?>
    </div>
</body>
</html>