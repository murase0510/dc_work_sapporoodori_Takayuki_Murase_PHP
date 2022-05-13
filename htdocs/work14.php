<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work14</title>
</head>
<body>
    <?php 
        $stack = [];
        $random = 0;

        for ($i = 1; $i <= 5; $i++){
            $random = rand(1,100);
            array_push($stack,$random);
        }
        for ($i = 0; $i < count($stack); $i++){
            if($stack[$i] % 2 == 0){
                print($stack[$i].'(偶数)');
            }else{
                print($stack[$i].'(奇数)');
            }
            print('<br>');
        }
    ?>
</body>
</html>