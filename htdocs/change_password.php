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
            require_once('../include/view/ec_change_password_class.php');
            require_once('../include/model/ec_DBAccesser_class.php');

            $urltoken = isset($_GET["urltoken"]) ? $_GET["urltoken"] : NULL;
            $ecp = new  ec_change_password_class();
            $ec_db = new ec_DBAccesser_class();

            if(isset($_POST["password"]) && $_POST["password"] == ""){
                echo "<div class='error-message'>パスワードが入力されていません<div>";
            }


            if(isset($_POST["change"]) && isset($_POST["password"]) && $_POST["password"] != ""){
                $ec_db->change_password($_GET["mail"],$_POST["password"]);
                $ec_db->switch_isused_at_change_password($_GET["mail"]);
                header("Location: https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/changed_password.html");
            }
            $ecp->print_change_password($urltoken);
            
        ?>
    </div>

</body>
</html>