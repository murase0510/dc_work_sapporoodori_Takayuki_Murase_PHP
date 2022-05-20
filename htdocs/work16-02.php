<!DOCTYPE  html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>work16-02.php</title>
    </head>
    <body>
        <div>入力内容の取得</div>
        <?php
            if( isset( $_GET['display_text'] ) && $_GET['display_text'] != "") {
                print '入力した内容： ' . $_GET['display_text'];
            } else {
                print '入力されていません';
            }
            print '<br>';
            if( isset($_GET['choice'] ) && implode("、",$_GET['choice']) != "") {
                print '入力した内容： ' . implode("、",$_GET['choice']);
            } else {
                print '入力されていません';
            }
        ?>
    </body>
</html>