<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TRY10</title>
</head>
<body>
    <?php 
        $score = rand(0,100);		// 0～100までのランダムな数値を取得
        $bool = true;
        print '<p>$score: '.$score.'</p>'; 
        print '<p>$score == 100 : ';
        var_dump($score == 100);
        print ' </p>';
        print '<p>$score >= 60 : ';
        var_dump($score >= 60);
        print '</p>';
        var_dump($bool);
        if ($score == 100) {
            print '<p>満点です。</p>';
        } else if ($score >= 60) {
            print '<p>合格です。</p>';
        } else {
            print '<p>不合格です</p>';
        }
    ?>
</body>
</html>