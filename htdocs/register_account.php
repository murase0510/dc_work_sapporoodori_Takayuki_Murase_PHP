
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
        <div class="login_title">アカウント作成</div>
        <?php
            if(isset($_POST["create"])) {
                if(isset($_POST["user_id"])){
                    echo "<div>ユーザIDが入力されていません<div>";
                }else if($ec_db->is_used_id($_POST["user_id"])){
                    echo "<div>このIDは使用されています<div>";
                }
                if(isset($_POST["user_name"])){
                    echo "<div>ユーザ名が入力されていません<div>";
                }
                if(isset($_POST["password"])){
                    echo "<div>パスワードが入力されていません<div>";
                }
            }
        ?>
        <form  method="post">
            <label for="user_id">ログインID</label><input type="text" id="user_id" name="user_id"><br>
            <label for="user_name">ユーザ名</label><input type="text" id="user_name" name="user_name"><br>
            <label for="password">パスワード</label><input type="text" id="password" name="password"><br>
            <input type="submit" name="create" value="アカウント作成"><br>
        </form>
    </div>
<?php
    require_once('../include/view/ec_register_account.class.php');
    require_once('../include/model/ec_DBAccesser.class.php');

    $urltoken = isset($_GET["urltoken"]) ? $_GET["urltoken"] : NULL;
    $era = new  ec_register_account($urltoken);
    $ec_db = new ec_DBAccesser();

    if(isset($_POST["create"])) {
        echo"cc";
       if(isset($_POST["user_id"])&&isset($_POST["user_name"])&&isset($_POST["password"])){
           echo"aa";
            $ec_db->create_account($_POST["user_id"],$_POST["user_name"],$_POST["password"]);
        }
    }
?>

</body>
</html>