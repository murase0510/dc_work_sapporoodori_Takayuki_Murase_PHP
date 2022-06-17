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
                require_once('../include/model/ec_DBAccesser.class.php');
                require_once('../include/model/ec_send_mail.class.php');

                $ec_db = new ec_DBAccesser();
                $ec_mail = new ec_send_mail();
                if(isset($_POST["mail_addless"])) {
                    if(!$ec_db->is_used_mail($_POST["mail_addless"])){
                        echo "このメールアドレスはすでに利用されております。";
                    }
                    if(!$ec_mail->is_trust_mail($_POST["mail_addless"])){
                        echo "メールアドレスの形式が正しくありません。";
                    }
                }
        ?>
        <form  method="post">
            <label for="mail_addless">メールアドレス</label><input type="text" id="mail_addless" name="mail_addless"><br>
            <input type="submit" name="login" value="アカウント作成"><br>
            <a href="./login.php" class="login_for_link">ログインページへ</a>
        </form>
    </div>
    <?php


        if(isset($_POST["mail_addless"])) {
            if($ec_db->is_used_mail($_POST["mail_addless"]) && $ec_mail->is_trust_mail($_POST["mail_addless"])){
                $ec_db->create_pre_user($_POST["mail_addless"]);
                $ec_mail->send_preuser_mail($_POST["mail_addless"]);
            }
        }

    ?>
</body>
</html>