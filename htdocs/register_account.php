
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
            require_once('../include/config/ec_const_class.php');
            $ec_c = new ec_const_class();
            require_once($ec_c::EC_REGISTER_ACCOUNT_PATH);
            require_once($ec_c::EC_DBACCESSER_PATH);

            $urltoken = isset($_GET[$ec_c::ATTRIBUTE_NAME_URLTOKEN]) ? $_GET[$ec_c::ATTRIBUTE_NAME_URLTOKEN] : NULL;
            $era = new  ec_register_account_class();
            $ec_db = new ec_DBAccesser_class();

            if($era->print_register_account($urltoken)){
                $ec_db->switch_ispre($_GET[$ec_c::ATTRIBUTE_NAME_MAIL]);
                $ec_db->switch_isused($_GET[$ec_c::ATTRIBUTE_NAME_MAIL]);
                $user = $ec_db->get_one_authenticated_user($_GET[$ec_c::ATTRIBUTE_NAME_MAIL]);
                $ec_db->create_cart($user[0][$ec_c::DB_USER_ID]);
            }
        ?>
    </div>

</body>
</html>