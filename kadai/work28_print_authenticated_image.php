<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./work28.css">
    <title>work28_print_authenticated_image</title>
</head>
    <body>
        <?php
                require_once('./work28_print_image.class.php');
                $pr = new work28_print_image();
                $pr->print_authenticated_image();
        ?>
        <a href="https://portfolio.dc-itex.com/sapporoodori/0001/work28.php"  >画像投稿ページへ</a>
    </body>
</html>