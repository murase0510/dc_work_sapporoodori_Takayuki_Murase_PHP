<?php 
    $host = 'mysql34.conoha.ne.jp'; 
    $login_user = 'bcdhm_sapporo_pf0001'; 
    $password = 'A7c2b#Nw';   
    $database = 'bcdhm_sapporo_pf0001';   
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work28</title>
</head>
<body>
    <?php 
        //echo phpversion();
        // データベースへ接続
        $db = new mysqli($host, $login_user, $password, $database)
    ?>

    <form method="post">
        <input type="text" name="image_name">
        <p><input type="file" name="upload_image"></p>
        <input type="submit" value="送信">
    </form>
</body>
</html>