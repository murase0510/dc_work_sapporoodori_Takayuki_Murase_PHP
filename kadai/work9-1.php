<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work9-1</title>
</head>
<body>
    <?php $rand_int = rand(0,100); ?>
        <p>$rand_int = <?php print $rand_int ?></p>
        <?php switch($rand_int):
            case ($rand_int % 3  == 0 && $rand_int % 6  == 0):?>
                <p>3と6の倍数です</p>
                <?php break;
            case ($rand_int % 3  == 0 && $rand_int % 6  != 0):?>
                <p>3の倍数で、6の倍数ではありません</p>
                <?php break; 
            default:?>
                <p>倍数ではありません</p>
        <?php endswitch; ?>
        
</body>
</html>