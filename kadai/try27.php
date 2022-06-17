<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TRY27</title>
</head>
<body>
    <?php 
        // データベースへ接続
        $db = new mysqli('mysql34.conoha.ne.jp', 'bcdhm_sapporo_pf0001', 'A7c2b#Nw', 'bcdhm_sapporo_pf0001');
        if ($db->connect_error){
            echo $db->connect_error;
            exit();
        }else{
            print("データベースへの接続に成功しました。");
        }
        $db->close();		// 接続を閉じる
    ?>
</body>
</html>