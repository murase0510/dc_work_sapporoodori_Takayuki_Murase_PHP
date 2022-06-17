<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>TRY53</title>
</head>
<body>
    <?php
        //セッション開始
        session_start();

        require_once('./work34_DBAccesser.class.php');

        //Cookieの保存期間
        define('EXPIRATION_PERIOD',30);
        $cookie_expiration = time() + EXPIRATION_PERIOD * 60 * 24 * 365;



        $_SESSION['err_flg'] = False;

        //POSTされたフォームの値を変数に格納する
        if (isset($_POST['cookie_confirmation']) === TRUE) {
            $cookie_confirmation = $_POST['cookie_confirmation'];
        } else {
            $cookie_confirmation = '';
        }

        if (isset($_POST['login_id']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['login_id'])) {
            $login_id = $_POST['login_id'];
            $_SESSION['login_id'] =  $login_id;
        } else {
            $login_id = '';
            $_SESSION['err_flg'] = true;
        }

        if (isset($_POST['login_id']) === TRUE) {
            $login_id = $_POST['login_id'];
        } else {
            $login_id = '';
        }

        // ログインIDの入力省略にチェックがされている場合はCookieを保存
        if ($cookie_confirmation === 'checked') {
            setcookie('cookie_confirmation', $cookie_confirmation, $cookie_expiration);
            setcookie('login_id', $cookie_confirmation, $cookie_expiration);
        } else {
            // チェックされていない場合はCookieを削除する
            setcookie('cookie_confirmation', '', time() - 30);
            setcookie('login_id', '', time() - 30);
        }
        $db = new work34_DBAccesser();
        if(isset($_POST['login'])){
            if($db->authentication($_POST["login_id"],$_POST["password"])){
                echo '<p>ログイン（擬似的）が完了しました</p>';
                echo '<p>'.$db->get_user_name($_POST["login_id"]).'さん、ようこそ！</p>';
            }else{
                echo '<p>ログインに失敗しました</p>';
            }
        }

        // ログイン中のユーザーであるかを確認する
        if (!isset($_SESSION['login_id'])) {
                header('Location: work34.php');
                exit();
            } else {
                echo "<p>".$_SESSION['login_id']."さん：ログイン中です。</p>";
        }

    ?>
    <form action="work34.php" method="post">
        <input type="hidden" name="logout" value="logout">
        <input type="submit" value="ログアウト">
   </form>
   
</body>
</html>