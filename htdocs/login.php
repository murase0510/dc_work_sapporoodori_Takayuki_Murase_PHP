<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="./ec_site.css">
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <script src="./ec_header_login.js"></script>
    <div class="login_form">
        <?php
            require_once('../include/config/ec_const_class.php');
            $ec_c = new ec_const_class();

            require_once($ec_c::EC_DBACCESSER_PATH);
            $ec_db = new ec_DBAccesser_class();

            require_once($ec_c::EC_PRINT_ERROR_MESSAGE_LOGIN);
            $ec_er = new ec_print_error_message_login();


            session_start();

            if(isset($_SESSION[$ec_c::SESSION_USER_ID])){
                header($ec_c::LOCATION_PRODUCT_LIST);
            }

            
            if($_SERVER[$ec_c::REQUEST_METHOD] == $ec_c::HTTP_POST){
                $ec_er->print_error_message($_POST[$ec_c::ATTRIBUTE_NAME_MAIL],$_POST[$ec_c::ATTRIBUTE_NAME_PASSWORD]);
            }
            
        ?>
        <div class="login_title">ログイン</div>
        <form  method="post">
            <label for="mail">メールアドレス</label><input type="text" id="mail" name="mail"><br>
            <label for="password">パスワード</label><input type="text" id="password" name="password"><br>
            <input type="submit" name="login" value="ログイン"><br>
            <a href="./create_account.php" class="login_for_link">アカウントを作る</a>
            <a href="./Apply_for_change_password.php" class="login_for_link">パスワードを忘れた</a>
        </form>
        <?php
            function authenticate($mail,$password){
                $ec_db = new ec_DBAccesser_class();
                return $ec_db->get_password($mail) == $password;
            }
        ?>
    </div>
</body>
</html>