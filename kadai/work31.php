<?php 
    $dsn = 'mysql:dbname=bcdhm_sapporo_pf0001;host=mysql34.conoha.ne.jp';
    $login_user = 'bcdhm_sapporo_pf0001'; 
    $password = 'A7c2b#Nw';  
 ?>
<!DOCTYPE  html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>work31</title>
    </head>
    <body>
        <?php 
            // データベースへ接続
            $db=new PDO($dsn,$login_user,$password);
            //PDOのエラー時にPDOExceptionが発生するように設定
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $db->beginTransaction();	// トランザクション開始
            $sql = "SELECT product_name, price FROM product WHERE category_id = :id";
            $stmt = $db -> prepare($sql);
            $stmt -> bindValue(':id', 2);
            $stmt -> execute();
            // 連想配列を取得
            while ($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
                echo $row["product_name"] . $row["price"] . "<br>";
            }
            
        ?>
    </body>
</html>