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
            require_once('../include/model/ec_DBAccesser_class.php');

            $from_logout = true;
            $ec_c = new ec_const_class();
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(isset($_POST["logout"])) {
                $session = session_name();
                $_SESSION = [];
                    if (isset($_COOKIE[$session])) {
                        $params = session_get_cookie_params();
                        setcookie($session, '', time() - 30, '/');
                    }
                $from_logout = false;
                }
            }

            if($_SERVER["REQUEST_METHOD"] == "POST" && $from_logout){
                if(!isset($_POST['mail']) ||$_POST['mail'] == ""){
                    echo "<div>メールアドレスが空欄です</div>";
                }else if(authenticate($_POST['mail'],$_POST['password'])){
                    session_start();
                    $_SESSION['mail'] = $_POST['mail'];
                    if($_POST['mail'] == $ec_c::EC_ADMIN){
                        header("Location: https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/admin_form.php");
                    }else{
                        header("Location: https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/product_list.php");
                    }
                }
                if(!isset($_POST['password']) ||$_POST['password'] == ""){
                    echo "<div>パスワードが空欄です</div>";
                }
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