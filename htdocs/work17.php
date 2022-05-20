<?php
    $text = null;
    $choice;
    if (isset($_POST['display_text'])) {
        $text = htmlspecialchars($_POST['display_text'], ENT_QUOTES, 'UTF-8');
    }

    if (isset($_POST['choice'])) {
        $choice = htmlspecialchars(implode("、",$_POST['choice']), ENT_QUOTES, 'UTF-8');
    }
?>

<!DOCTYPE  html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <title>work17</title>
    </head>
    <body>
        <div>入力内容の取得</div>
        <form method="post">
            <input type="text" name="display_text">
            <br>
            <input type="checkbox" name="choice[]" value="選択肢01"> 選択肢01　
            <input type="checkbox" name="choice[]" value="選択肢02"> 選択肢02
            <input type="checkbox" name="choice[]" value="選択肢03"> 選択肢03
            <br>
            <input type="submit" value="送信">
        </form>
        <?php if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset( $_POST['display_text'] ) && $_POST['display_text'] != ""){
                print  '<div>'; 
                echo $text; 
                print  '</div>'; 
            }else {
                print '入力されていません';
                print('<br>');
            }
        
            if(isset($_POST['choice'])){
                print  '<div>'; 
                echo implode("、",$_POST['choice']); 
                print  '</div>'; 
            }else {
                print '入力されていません';
                print('<br>');
            }
        } ?>
    </body>
</html>