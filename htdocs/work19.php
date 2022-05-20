<!DOCTYPE  html>
<html lang="ja">
    <head>
    <meta charset="UTF-8"></meta>
    <title>work19</title>
    </head>
    <body>
        <?php
            //array_key_existsが信頼できないため作った関数です
            class work19_func{
                function isKey($key,$inputed){
                    echo $inputed[$key];
                    echo '<br>';
                    if (isset($inputed[(string)$key]) && $inputed[$key] != ''){
                        echo $key.'はキー';
                    }else{
                        echo $key.'はキーでない';
                    }
                    echo '<br>';
                    return (isset($inputed[$key]) && $inputed[$key] != '');
                }
            }

            $w19 = new work19_func();
            $filename = 'inputed.xml';
            $xml = @simplexml_load_file($filename);
            $inputed = [];
            $titles = [];
            $count_size = 0;

            if ($xml) {
                foreach ($xml->pref as $val) {
                    array_unshift($titles, $val->title);
                    $inputed[(string)$val->title] = $val->value;
                    $count_size++;
                    //echo $count_size;
                }
                //echo '読み込み成功';
            } else {
                //echo '読み込み失敗';
            }
        ?>
        <div>入力内容の取得</div>
        <form method="get">
            タイトル<input type="text" name="title_text"></input>
            <br/>
            書き込み欄<input type="text" name="value_text"></input>
            <br/>
            <input type="submit" value="送信"></input>
        </form>
        <form  method="post" action="work20.php" enctype="multipart/form-data">
                <p><input type="file" name="upload_image"></p>
                <p><input type="submit" value="画像アップロード"></p>
            </form>
        <?php

        if($_SERVER["REQUEST_METHOD"] == "GET"){
            if (isset($_GET["title_text"]) && $_GET['title_text'] != "" && isset($_GET["value_text"]) && $_GET['value_text'] != ""){
                //$w19->isKey($_GET["title_text"], $inputed);
                if(array_key_exists($_GET["title_text"], $inputed)){
                    //echo 'キーあり</br>';
                    for($i = 0 ; $i < $count_size; $i++){
                        //echo $xml->pref[$i]->title;
                        //echo '</br>';
                        //echo $_GET["title_text"];
                        if($xml->pref[$i]->title == $_GET["title_text"]){
                        // echo '</br>追加される前：'.$xml->pref[$i]->value;
                            $xml->pref[$i]->value = $xml->pref[$i]->value.$_GET['value_text'];
                            //echo '</br>追加された結果：'.$xml->pref[$i]->value;
                            $xml->asXml($filename);
                            break;
                        }
                    }
                }else{
                    //echo 'キーなし';
                    $addNode = $xml->addChild('pref');
                    $addNode['code'] = $count_size + 1;
                    $addNode->addChild('title',$_GET["title_text"]);
                    $addNode->addChild('value',$_GET["value_text"]);
                    $xml->asXml($filename);
                    array_unshift($titles, $_GET["title_text"]);
                    $inputed[$_GET["title_text"]] = $inputed[$_GET["title_text"]].$_GET["value_text"];
                }
                for($i = 0;$i < sizeof($inputed);$i++){
                    echo '</br>';
                    echo '<div style="display: inline-block;">';
                    echo $titles[$i];
                    echo '</div>';
                    echo ':';
                    echo '<div style="display: inline-block;">';
                    echo $inputed[(string)$titles[$i]];
                    echo '</div>';
                }
            }else{
                echo '入力情報が不足しています';
            }
        }
        ?>
    </body>
</html>