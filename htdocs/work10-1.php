<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work10-1</title>
</head>
<body>
    <?php 
        for ($i = 1; $i <= 100; $i++){
            if($i % 3 == 0 && $i % 4 == 0){
                print 'FizzBuzz';
                echo '<br>';
            }else if($i % 3 == 0 && $i % 4 != 0){
                print 'Fizz';
                echo '<br>';
            }else if($i % 3 != 0 && $i % 4 == 0){
                print 'Buzz';
                echo '<br>';
            }else{
                print $i;
                echo '<br>';
            }
        } 

        $ans = 0;
        for ($i = 1; $i <= 9; $i++){
            for ($s = 1; $s <= 9; $s++){
                $ans = $i * $s;
                printf($i.'*'.$s.'='.$ans);
                echo '<br>';
            }
        } 

        for($i = 1; $i <= 9; $i++){
            print('!');
            echo '<br>';
            for ($s = 1; $s <= $i; $s++){
                print('*');
            }
            echo '<br>';
        }
     ?>
</body>
</html>