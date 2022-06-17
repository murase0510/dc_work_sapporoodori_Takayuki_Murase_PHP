<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work33</title>
</head>
<body>
    <?php 
        $random01 = rand(1,10);	
        $ans = rand_math($random01);
        echo $ans;

        function rand_math($random01){
            echo $random01;
            echo '<br>';
            if($random01 % 2 == 0){
                return $random01 * 10;
            }else{
                return$random01 * 100;
            }
        }
    ?>
</body>
</html>