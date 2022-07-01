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
                require_once('../include/model/ec_DBAccesser_class.php');
                require_once('../include/model/ec_send_mail_class.php');

                $ec_db = new ec_DBAccesser_class();
                $ec_mail = new ec_send_mail_class();
                if(isset($_POST["mail"])) { 
                    if($_POST["mail"] == ""){
                        echo "<div class='error-message'>メールアドレスが入力されていません</div>";
                    }else if(!$ec_mail->is_trust_mail($_POST["mail"])){
                        echo "<div class='error-message'>このメールアドレスの形式が正しくありません。</div>";
                    }else  if($ec_db->is_used_mail($_POST["mail"])){
                        echo "<div class='error-message'>このメールアドレスは使われていません</div>";
                    }
                }
        ?>
        <form  method="post">
            <label for="mail">メールアドレス</label><input type="text" id="mail" name="mail"><br>
            <input type="submit" name="login" value="パスワード再設定メールを送る"><br>
            <a href="./login.php" class="login_for_link">ログインページへ</a>
        </form>
    </div>
    <?php


        if(isset($_POST["mail"])) {
            if(!$ec_db->is_used_mail($_POST["mail"])){
                $ec_db->switch_isused_at_change_password($mail);
                $ec_db->create_change_password($_POST["mail"]);
                $ec_mail->send_change_password_mail($_POST["mail"]);
                header("Location: https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/Applied_for_change_password.html");
            }
        }

    ?>
</body>
</html>