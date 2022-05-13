<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>比較演算子</title>
</head>
<body>
    <?php 
        $num = 10; 
        $str = '10';

        print var_dump($num == $str);	// true
        print var_dump($num === $str);	// false
    ?>
</body>
</html>