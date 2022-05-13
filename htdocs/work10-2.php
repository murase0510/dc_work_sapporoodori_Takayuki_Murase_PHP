<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work10-2</title>
</head>
<body>
    <?php 
        $print_str = null;
        $ans = 0;
        for ($i = 1; $i <= 10; $i++){
            for ($s = 1; $s <= 10; $s++){
                $ans = $i * $s;
                if($ans < 10){
                    $ans = '&nbsp;'.$ans;
                }
                $print_str = $print_str.$ans;
            }
            printf($print_str);
            echo '<br>';
            $print_str = null;
        } 
     ?>
</body>
</html>