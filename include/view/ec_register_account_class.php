<?php
    require_once '../include/config/ec_const_class.php';
    $ec_c = new ec_const_class();
    require_once $ec_c::EC_DBACCESSER_PATH;

    class ec_register_account_class{
        public $ec_db;

        public function __construct(){
            $this->ec_db = new ec_DBAccesser_class();
        }

        public function print_register_account($urltoken){
            if($this->ec_db->is_arrive_from_mail($urltoken)){
                echo '<div class="login_title">アカウントの作成が完了しました</div>';
                echo '<div class="login_title">作成したアカウントでログインしてください</div>';
                echo '<a href="./index.php" class="login_for_link">ログインページへ</a>';
                return true;
            }else{
                echo '<div class="login_title">異常な形でのアクセスです</div>';
                echo '<div class="login_title">アカウント作成ページからアカウントを作成してください</div>';
                echo '<a href="./index.php" class="login_for_link">ログインページへ</a>';
                echo '<a href="./create_account.php" class="login_for_link">アカウント仮登録ページへ</a>';
                return false;
            }
        }
    }
?>