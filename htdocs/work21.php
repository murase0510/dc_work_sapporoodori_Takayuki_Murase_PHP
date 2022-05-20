<?php
  $check_data ='';	
  $phone_num = '';
  if(isset($_POST['check_data'])){
    $check_data = htmlspecialchars($_POST['check_data'], ENT_QUOTES, 'UTF-8');
  }
  if(isset($_POST['phone_num'])){
    $check_data = htmlspecialchars($_POST['phone_num'], ENT_QUOTES, 'UTF-8');
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>work21</title>
    </head>
    <body>
        <form method="post">
            <div>半角英数字で入力を行ってください。</div>
            <input type="text" name="check_data" value= <?php echo $check_data ?>>
            <input type="submit" value="送信">
        </form>
        <form method="post">
            <div>電話番号を入力して下さい。</div>
            <input type="text" name="phone_num" value= <?php echo $phone_num ?>>
            <input type="submit" value="送信">
        </form>
        <?php
            if (preg_match("/^[a-zA-Z]+$/", $check_data) && $check_data !== '') {
                if(preg_match("/dc/", $check_data)){
                    echo "<div>ディーキャリアが含まれています。</div>";
                }else if(preg_match("/end+$/", $check_data)){
                    echo "<div>終了です！</div>";
                }
            }else{
                echo "<div>正しい入力形式ではありません。</div>";
            }
            if ($check_data !== '') {
                if(preg_match("/^090-/", $check_data)||preg_match("/^080-/", $check_data)||preg_match("/^070-/", $check_data) ){
                    if(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}+$/", $check_data)){
                        echo "<div>携帯電話番号の番号です</div>";
                    }else{
                        echo "<div>携帯電話番号の形式ではありません</div>";
                    }
                }else{
                    echo "<div>携帯電話番号の形式ではありません</div>";
                }
            }else{
                echo "<div>携帯電話番号の形式ではありません</div>";
            }
        ?>
    </body>
</html>