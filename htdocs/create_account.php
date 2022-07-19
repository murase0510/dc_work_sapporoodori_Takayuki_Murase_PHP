<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./ec_site.css">
    <meta charset="UTF-8">
    <title>アカウント仮登録</title>
</head>
<body>
    <script src="./ec_header_login.js"></script>
    <div class="login_form">
        <div class="login_title">アカウント仮登録</div>
        <?php
                require_once('../include/config/ec_const_class.php');
                $ec_c = new ec_const_class();
                require_once($ec_c::EC_DBACCESSER_PATH);
                require_once($ec_c::EC_SEND_MAIL_PATH);
                require_once($ec_c::EC_PRINT_ERROR_MESSAGE_CREATE_ACCOUNT);
                require_once($ec_c::EC_IS_TRUST_ACCOUNT_PATH);
                $ec_ita = new ec_is_trust_account_class($_POST[$ec_c::ATTRIBUTE_NAME_USER_NAME],$_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD]);
                $ec_db = new ec_DBAccesser_class();
                $ec_mail = new ec_send_mail_class();
                $pr_er = new ec_print_error_message_create_account();
                if(isset($_POST[$ec_c::ATTRIBUTE_NAME_MAIL])) {
                    $pr_er->print_error_message($_POST[$ec_c::ATTRIBUTE_NAME_MAIL],$_POST[$ec_c::ATTRIBUTE_NAME_USER_NAME],$_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD]);
                }
        ?>
        <form  method="post">
            <label for="user_name">ユーザ名</label><input type="text" id="user_name" name="user_name"><br>
            <label for="password">パスワード</label><input type="text" id="password" name="password"><br>
            <label for="mail">メールアドレス</label><input type="text" id="mail" name="mail"><br>
            <input type="submit" name="login" value="アカウント作成"><br>
            <a href="./login.php" class="login_for_link">ログインページへ</a>
        </form>
    </div>
    <?php


        if(isset($_POST[$ec_c::ATTRIBUTE_NAME_MAIL])&&$_POST[$ec_c::ATTRIBUTE_NAME_USER_NAME]&&$_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD]) {
            if($ec_db->is_used_mail($_POST[$ec_c::ATTRIBUTE_NAME_MAIL]) && $ec_mail->is_trust_mail($_POST[$ec_c::ATTRIBUTE_NAME_MAIL]) && $ec_ita->is_trust_user() && $ec_ita->is_trust_password()){
                $ec_db->create_pre_user($_POST[$ec_c::ATTRIBUTE_NAME_MAIL]);
                $ec_mail->send_preuser_mail($_POST[$ec_c::ATTRIBUTE_NAME_MAIL]);
                $ec_db->create_authenticated_account($_POST[$ec_c::ATTRIBUTE_NAME_USER_NAME],$_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD],$_POST[$ec_c::ATTRIBUTE_NAME_MAIL]);
                header($ec_c::LOCATION_CREATE_PRE_ACCOUNT);
            }
        }

    ?>
</body>
</html>