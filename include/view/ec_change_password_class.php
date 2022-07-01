<?php

    require_once '../include/model/ec_DBAccesser_class.php';

    class ec_change_password_class{
        public $ec_db;

        public function __construct(){
            $this->ec_db = new ec_DBAccesser_class();
        }

        public function print_change_password($urltoken){
            if($this->ec_db->is_arrive_from_mail_for_change_password($urltoken)){
                echo '<form  method="post">';
                echo '<label for="password">パスワード</label><input type="text" id="password" name="password"><br>';
                echo '<input type="submit" name="change" value="パスワード変更"><br>';
                echo '</form>';
                return true;
            }else{
                echo '<div class="login_title">異常な形でのアクセスです</div>';
                echo '<div class="login_title">パスワード変更ページからパスワードの変更を申請してください</div>';
                echo '<a href="./Apply_for_change_password.php" class="login_for_link">パスワード変更ページへ</a>';
                echo '<a href="./create_account.php" class="login_for_link">アカウント仮登録ページへ</a>';
                return false;
            }
        }
    }
?>