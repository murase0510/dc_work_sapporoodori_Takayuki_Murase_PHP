<?php
    require_once '../include/config/ec_const_class.php';
    $ec_c = new ec_const_class();
    require_once $ec_c::EC_SEND_MAIL_PATH;
    require_once $ec_c::EC_DBACCESSER_PATH;
    require_once $ec_c::EC_IS_TRUST_ACCOUNT_PATH;

    class ec_print_error_message_create_account{
        function print_error_message($mail,$user_name,$password){
            $ec_db = new ec_DBAccesser_class();
            $ec_mail = new ec_send_mail_class();
            $ec_ita = new ec_is_trust_account_class($user_name,$password);
            if(!$ec_db->is_used_mail($mail,$user_name,$password)){
                echo "<div class='error-color'>このメールアドレスはすでに利用されております。</div>";
            }
            if($mail == ""){
                echo "<div class='error-color'>メールアドレスが入力されていません</div>";
            }else if(!$ec_mail->is_trust_mail($mail)){
                echo "<div class='error-color'>このメールアドレスの形式が正しくありません。</div>";
            }
            if(isset($user_name) && $user_name == ""){
                echo "<div class='error-color'>ユーザ名が入力されていません</div>";
            }
            if(isset($password) && $password == ""){
                echo "<div class='error-color'>パスワードが入力されていません</div>";
            }
            if(!$ec_ita->is_trust_user()){
                echo "<div class='error-color'>ユーザ名は５文字以上の半角英数字を入力してください</div>";
            }
            if(!$ec_ita->is_trust_password()){
                echo "<div class='error-color'>パスワードは８文字以上の半角英数字を入力してください</div>";
            }
        }
    }

?>