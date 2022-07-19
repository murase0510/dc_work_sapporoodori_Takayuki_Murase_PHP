<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./ec_site.css">
    <meta charset="UTF-8">
    <title>パスワード再設定</title>
</head>
<body>
    <script src="./ec_header_login.js"></script>
    <div class="login_form">
        <div class="login_title">パスワード再設定</div>
        <?php
                require_once('../include/config/ec_const_class.php');
                $ec_c = new ec_const_class();
                require_once($ec_c::EC_DBACCESSER_PATH);
                require_once($ec_c::EC_SEND_MAIL_PATH);
                require_once($ec_c::EC_PRINT_ERROR_MESSAGE_APPLY_FOR_CHANGE_PASSWORD);

                $ec_db = new ec_DBAccesser_class();
                $ec_mail = new ec_send_mail_class();
                $pr_er = new ec_print_error_Apply_for_change_password_class();

                if(isset($_POST[$ec_c::ATTRIBUTE_NAME_MAIL])) {
                    $pr_er->print_error_message($_POST[$ec_c::ATTRIBUTE_NAME_MAIL]);
                }
        ?>
        <form  method="post">
            <label for="mail">メールアドレス</label><input type="text" id="mail" name="mail"><br>
            <input type="submit" name="login" value="パスワード再設定メールを送る"><br>
            <a href="./index.php" class="login_for_link">ログインページへ</a>
        </form>
    </div>
    <?php


        if(isset($_POST[$ec_c::ATTRIBUTE_NAME_MAIL])) {
            if(!$ec_db->is_used_mail($_POST[$ec_c::ATTRIBUTE_NAME_MAIL])){
                $ec_db->switch_isused_at_change_password($_POST[$ec_c::ATTRIBUTE_NAME_MAIL]);
                $ec_db->create_change_password($_POST[$ec_c::ATTRIBUTE_NAME_MAIL]);
                $ec_mail->send_change_password_mail($_POST[$ec_c::ATTRIBUTE_NAME_MAIL]);
                header($ec_c::LOCATION_APPLIED_FOR_CHANGE_PASSWORD);
            }
        }

    ?>
</body>
</html>