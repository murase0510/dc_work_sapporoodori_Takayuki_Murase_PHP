<?php
$height = 170; 		//変数$heightを定義し、値を代入
const weight = 70;	//定数weightを定義し、値を代入
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>変数</title>
</head>
<body>
<?php
    $height = 175; 		//変数$heightを定義し、値を代入
    //const weight = 60;	//定数weightを定義し、値を代入

    print '身長 ';
    print $height;
    print 'cm ';
    print '体重 '.weight.'kg';
?>
</body>
</html>