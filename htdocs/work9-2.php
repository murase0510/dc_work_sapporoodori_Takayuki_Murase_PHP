<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work9-2</title>
</head>
<body>
    <?php 
        $random01 = rand(0,10);	
        $random02 = rand(0,10);
	?>
        <p>random01 = <?php print $random01 ?>,random02 = <?php print $random02?>です</p>
        <?php switch($random01):
            case($random01 > $random02): ?>
                <p>random01の方が大きいです。</p>
                <?php break;
            case($random01 < $random02): ?>
                <p>random02の方が大きいです。</p>
                <?php break;
            case($random01 == $random02): ?>
                <p> 2つは同じ数です。</p>
                <?php  break;
        endswitch; ?>

        <?php switch($random01):
            case($random01 % 3 == 0 && $random02 % 3 == 0): ?>
                <p>2つの数字の中には3の倍数が2つ含まれています。</p>
                <?php break;
            case(($random01 % 3 == 0 && $random02 % 3 != 0)||($random01 % 3 != 0 && $random02 % 3 == 0)): ?>
                <p> '2つの数字の中には3の倍数が1つ含まれています。</p>
                <?php break;
            default: ?>
                <p> 2つの数字の中に3の倍数が含まれていません</p>
            <?php endswitch; ?>
</body>
</html>