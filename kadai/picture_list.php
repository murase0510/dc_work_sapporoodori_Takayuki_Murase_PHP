<html>
<head><title>写真表示</title></head>
<body>
<h1>写真表示</h1>
<?php 
    $host = 'mysql34.conoha.ne.jp'; 
    $login_user = 'bcdhm_sapporo_pf0001'; 
    $password = 'A7c2b#Nw';   
    $database = 'bcdhm_sapporo_pf0001';   
    $error_msg = [];
    $product_name;
    $price;
    $price_val;
 ?>
<?php
//MySQLに接続
$dbc=mysql_connect($host,$login_user,$password) or die("MySQL接続失敗 :".mysql_error());

//データベースに接続
mysql_select_db($database);

//「li_image」というテーブルの、ID選択する
$sql="SELECT id FROM image_table";
$res=mysql_query($sql,$dbc);

//取得した配列を表示する
while($dat=mysql_fetch_array($res,MYSQL_NUM)){

//動的URLでアクセスする場合
//	print '<a href="picture_view.php?id='.$dat[0].'">';

//.htaccessで静的URLにリネームされたURLにアクセスする場合
	print '<a href="'.$dat[0].'.jpeg">';
	print $dat[0] ."　の画像";
	print '</a><br />' ;

}
mysql_free_result($res);
?>

</body>
</html>
