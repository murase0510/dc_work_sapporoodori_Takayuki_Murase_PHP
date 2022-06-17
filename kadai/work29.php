<?php 
    $dsn = 'mysql:dbname=bcdhm_sapporo_pf0001;host=mysql34.conoha.ne.jp';
    $login_user = 'bcdhm_sapporo_pf0001'; 
    $password = 'A7c2b#Nw';   
 ?>
<!DOCTYPE  html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>work29</title>
    </head>
    <body>
        <?php 
        try{
            // データベースへ接続
            $db=new PDO($dsn,$login_user,$password);
        } catch (PDOException $e){
            echo $e->getMessage();
            exit();
        }
        //SELECT文の実行
        $sql = "SELECT product_name, price FROM product WHERE category_id = 1";
        if ($result = $db->query($sql)) {
            // 連想配列を取得
            while ($row = $result->fetch()) {
                echo $row["product_name"] . $row["price"] . "<br>";
            }
        }
        ?>
    </body>
</html>