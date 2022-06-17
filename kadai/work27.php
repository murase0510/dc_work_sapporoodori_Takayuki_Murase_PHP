<?php 
    $host = 'mysql34.conoha.ne.jp'; 
    $login_user = 'bcdhm_sapporo_pf0001'; 
    $password = 'A7c2b#Nw';   
    $database = 'bcdhm_sapporo_pf0001';   
    $esharotto_is_in = false;
    $error_msg = [];
    $product_name;
    $price;
    $price_val;
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work27</title>
</head>
<body>
    <?php 
        //echo phpversion();
        // データベースへ接続
        $db = new mysqli($host, $login_user, $password, $database);
        if ($db->connect_error){
            echo $db->connect_error;
            exit();
        } else {
            $db->set_charset("utf8");
        }


        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $db->begin_transaction();	// トランザクション開始
            if(isset($_POST['insert'])){
                //生成処理
                $insert = "INSERT INTO product(product_id,product_code,product_name,price,category_id) VALUE(21,1021,'エシャロット',200,1);";
                if($result = $db->query($insert)) {
                    $row = $db->affected_rows;
                } else {
                    $error_msg[] = 'insert実行エラー [実行SQL]' . $insert;
                }
                //$error_msg[] = '強制的にエラーメッセージを挿入';
    
                //エラーメッセージ格納の有無によりトランザクションの成否を判定
                if (count($error_msg) == 0) {
                    echo $row.'件更新しました。'; 
                    $db->commit();	// 正常に終了したらコミット
                } else {
                    echo '更新が失敗しました。'; 
                    $db->rollback();	// エラーが起きたらロールバック
                }
                // 下記はエラー確認用。エラー確認が必要な際にはコメントを外してください。
                var_dump($error_msg); 
            }elseif(isset($_POST['delete'])){
                //削除処理
                $delete = "DELETE from product WHERE product_id = 21";
                if($result = $db->query($delete )) {
                    $row = $db->affected_rows;
                } else {
                    $error_msg[] = 'delete実行エラー [実行SQL]' . $delete ;
                }
                //$error_msg[] = '強制的にエラーメッセージを挿入';
    
                //エラーメッセージ格納の有無によりトランザクションの成否を判定
                if (count($error_msg) == 0) {
                    echo $row.'件更新しました。'; 
                    $db->commit();	// 正常に終了したらコミット
                } else {
                    echo '更新が失敗しました。'; 
                    $db->rollback();	// エラーが起きたらロールバック
                }
                // 下記はエラー確認用。エラー確認が必要な際にはコメントを外してください。
                var_dump($error_msg); 
            }
        }   
        $db->close();		// 接続を閉じる

    ?>

    <form method="post">
        <input type="submit" name="insert" value="生成">
        <input type="submit" name="delete" value="削除">
    </form>
</body>
</html>