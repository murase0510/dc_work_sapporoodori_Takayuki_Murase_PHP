<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work13</title>
</head>
<body>
    <?php 
        $i = 1; 
        while($i <= 100):
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
            $i++;
        endwhile;

        $ans = 0;
        $i2 = 1;
        while($i2 <= 9):
            $s = 1; 
            while($s <= 9):
                $ans = $i2 * $s;
                printf($i2.'*'.$s.'='.$ans);
                echo '<br>';
                $s++;
            endwhile;
            $i2++;
        endwhile;

        $i3 = 1;
        $s3 = 1;
        while($i3 <= 9):
            print('!');
            echo '<br>';
            $s3 = 1;
            while($s3 <= $i3):
                print('*');
                $s3++;
            endwhile;
            echo '<br>';
            $i3++;
        endwhile;
     ?>
</body>
</html>