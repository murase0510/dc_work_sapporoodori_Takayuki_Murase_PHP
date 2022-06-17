
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
        <div class="login_title">ログイン</div>
        <form  method="post">
            <label for="login_id">ログインID</label><input type="text" id="login_id" name="login_id"><br>
            <label for="password">パスワード</label><input type="text" id="password" name="password"><br>
            <input type="submit" name="login" value="ログイン"><br>
            <a href="./create_account.php" class="login_for_link">アカウントを作る</a>
            <a href="./forgot_pass.html" class="login_for_link">パスワードを忘れた</a>
        </form>
    </div>
</body>
</html>