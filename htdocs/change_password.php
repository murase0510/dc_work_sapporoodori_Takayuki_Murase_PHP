<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./ec_site.css">
    <meta charset="UTF-8">
    <title>パスワード変更</title>
</head>
<body>
    <script src="./ec_header_login.js"></script>
    <div class="login_form">
        <?php
            require_once('../include/config/ec_const_class.php');
            $ec_c = new ec_const_class();
            require_once($ec_c::EC_DBACCESSER_PATH);
            require_once($ec_c::EC_CHANGE_PASSWORD_PATH);
            require_once($ec_c::EC_IS_TRUST_ACCOUNT_PATH);
            $ec_ita = new ec_is_trust_account_class("aaa",$_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD]);
            $urltoken = isset($_GET[$ec_c::ATTRIBUTE_NAME_URLTOKEN]) ? $_GET[$ec_c::ATTRIBUTE_NAME_URLTOKEN] : NULL;
            $ecp = new  ec_change_password_class();
            $ec_db = new ec_DBAccesser_class();

            if(isset($_POST[$ec_c::ATTRIBUTE_NAME_CHANGE])){
                if(isset($_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD]) && $_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD] == ""){
                    echo "<div class='error-message error-color'>パスワードが入力されていません</div>";
                }else if(!$ec_ita->is_trust_password()){
                    echo "<div class='error-message error-color'>パスワードは半角英数で８文字以上入力してください</div>";
                }
            }

            if(isset($_POST[$ec_c::ATTRIBUTE_NAME_CHANGE]) && isset($_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD]) && $_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD] != "" && $ec_ita->is_trust_password()){
                $ec_db->change_password($_GET[$ec_c::ATTRIBUTE_NAME_MAIL],$_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD]);
                $ec_db->switch_isused_at_change_password($_GET[$ec_c::ATTRIBUTE_NAME_MAIL]);
                header($ec_c::LOCATION_CHANGED_PASSWORD);
            }
            $ecp->print_change_password($urltoken);
            
        ?>
    </div>

</body>
</html>