<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>比較</title>
</head>
<body>
    <?php 
        $bool1 = true; 
        $bool2 = false;

        print ("and".$bool1 || $bool2);
        print ("or".$bool1 || $bool2);
        print ("not".$bool1);
    ?>
</body>
</html>