<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work6-1</title>
</head>
<body>
    <?php 
        $rand_int = rand(0,100);	
        print '<p>'.$rand_int.'</p>';
        if ($rand_int % 3  == 0 && $rand_int % 6  == 0):
            print '<p>3と6の倍数です</p>';
        elseif ($rand_int % 3  == 0 && $rand_int % 6  != 0):
            print '<p>3の倍数で、6の倍数ではありません</p>';
        else:
            print '<p>倍数ではありません</p>';
        endif;
    ?>
</body>
</html>