<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>work34</title>
</head>
<body>
    <?php
        //cookieに値がある場合、変数に格納する
        if (isset($_COOKIE['cookie_confirmation']) === TRUE) {
            $cookie_confirmation = "checked";
        } else {
            $cookie_confirmation = "";
        }

        //セッション開始
        session_start();
        if ($_SESSION['err_flg']) {
            echo "<p>ログインが失敗しました：正しいログインID（半角英数字）を入力してください。</p>";
        }

        $user_id = isset_cookie('user_id');
        $password = isset_cookie('password');
    ?>
   <form action="home.php" method="post">
        <label for="login_id">ログインID</label><input type="text" id="login_id" name="login_id" value="<?php echo $login_id; ?>"><br>
        <label for="password">パスワード</label><input type="text" id="password" name="password" value="<?php echo $password; ?>"><br>
        <input type="checkbox" name="cookie_confirmation" value="checked" <?php print $cookie_check;?>>次回からログインIDの入力を省略する<br>
        <input type="submit" name="login" value="ログイン">
    </form>

   <?php
        function isset_cookie($value){
            if (isset($_COOKIE[$value]) === TRUE) {
                return $_COOKIE[$value];
            } else {
                return  '';
            }
        }

        //ログアウト処理がされた場合
        if(isset($_POST["logout"])) {
    
            // セッション名を取得する
            $session = session_name();
            // セッション変数を削除
            $_SESSION = [];
            
            // セッションID（ユーザ側のCookieに保存されている）を削除
            if (isset($_COOKIE[$session])) {
                // sessionに関連する設定を取得
                $params = session_get_cookie_params();
                
                // cookie削除
                setcookie($session, '', time() - 30, '/');
                echo "<p>ログアウトされました。</p>";
            }
    
        } else {
            // ログイン中のユーザーであるかを確認する
            if (isset($_SESSION['login_id'])) {
                // ログイン中である場合は、top.phpにリダイレクト（転送）する
                header('Location: home.php');
                exit();
            }
        }

    ?>
</body>
</html>