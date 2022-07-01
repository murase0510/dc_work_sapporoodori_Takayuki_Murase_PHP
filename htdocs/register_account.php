
<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./ec_site.css">
    <meta charset="UTF-8">
    <title>アカウント作成</title>
</head>
<body>
    <script src="./ec_header_login.js"></script>
    <div class="login_form">
        <?php
            require_once('../include/view/ec_register_account_class.php');
            require_once('../include/model/ec_DBAccesser_class.php');

            $urltoken = isset($_GET["urltoken"]) ? $_GET["urltoken"] : NULL;
            $era = new  ec_register_account_class();
            $ec_db = new ec_DBAccesser_class();

            if($era->print_register_account($urltoken)){
                $ec_db->switch_ispre($_GET["mail"]);
                $ec_db->switch_isused($_GET["mail"]);
            }
        ?>
    </div>

</body>
</html>