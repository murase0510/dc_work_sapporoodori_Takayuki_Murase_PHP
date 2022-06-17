<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work8-2</title>
</head>
<body>
    <?php 
        $random01 = rand(0,10);	
        $random02 = rand(0,10);
        $print_str = null;	
        print '<p>random01 = '.$random01.',';
        print 'random02 = '.$random02.'です</p>';
        switch($random01){
            case($random01 > $random02):
                $print_str = '<p>random01の方が大きいです。';
                break;
            case($random01 < $random02):
                $print_str = '<p>random02の方が大きいです。';
                break;
            case($random01 == $random02):
                $print_str = '<p> 2つは同じ数です。';
                break;
        }
        switch($random01){
            case($random01 % 3 == 0 && $random02 % 3 == 0):
                $print_str .= '2つの数字の中には3の倍数が2つ含まれています。</p>';
                break;
            case(($random01 % 3 == 0 && $random02 % 3 != 0)||($random01 % 3 != 0 && $random02 % 3 == 0)):
                $print_str .= '2つの数字の中には3の倍数が1つ含まれています。</p>';
                break;
            default:
                $print_str .= '2つの数字の中に3の倍数が含まれていません</p>';
        }
        print $print_str;

    ?>
</body>
</html>