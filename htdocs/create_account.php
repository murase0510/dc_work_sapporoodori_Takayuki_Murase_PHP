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
                require_once('../include/model/ec_DBAccesser_class.php');
                require_once('../include/model/ec_send_mail_class.php');

                $ec_db = new ec_DBAccesser_class();
                $ec_mail = new ec_send_mail_class();
                if(isset($_POST["mail"])) {
                    if(!$ec_db->is_used_mail($_POST["mail"])){
                        echo "<div class='error-message'>このメールアドレスはすでに利用されております。</div>";
                    }
                    if($_POST["mail"] == ""){
                        echo "<div class='error-message'>メールアドレスが入力されていません</div>";
                    }else if(!$ec_mail->is_trust_mail($_POST["mail"])){
                        echo "<div class='error-message'>このメールアドレスの形式が正しくありません。</div>";
                    }
                    if(isset($_POST["user_name"]) && $_POST["user_name"] == ""){
                        echo "<div class='error-message'>ユーザ名が入力されていません<div>";
                    }
                    if(isset($_POST["password"]) && $_POST["password"] == ""){
                        echo "<div class='error-message'>パスワードが入力されていません<div>";
                    }
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


        if(isset($_POST["mail"])&&$_POST["user_name"]&&$_POST["password"]) {
            if($ec_db->is_used_mail($_POST["mail"]) && $ec_mail->is_trust_mail($_POST["mail"])){
                $ec_db->create_pre_user($_POST["mail"]);
                $ec_mail->send_preuser_mail($_POST["mail"]);
                $ec_db->create_authenticated_account($_POST["user_name"],$_POST["password"],$_POST["mail"]);
                header("Location: https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/created_pre_account.html");
            }
        }

    ?>
</body>
</html>