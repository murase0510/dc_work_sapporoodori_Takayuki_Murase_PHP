<!DOCTYPE html>
<html lang="ja">
<head>
   <meta charset="UTF-8">
   <title>work35</title>
</head>
<body>
    <?php
        // ログイン中のユーザーであるかを確認する
        if (isset($_SESSION['login_id'])) {
            // ログイン中である場合は、top.phpにリダイレクト（転送）する
            header('Location: homne.php');
            exit();
        }
    ?>
   
</body>
</html>