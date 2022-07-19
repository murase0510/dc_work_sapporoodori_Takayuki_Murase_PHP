<?php
    require_once '../include/config/ec_const_class.php';
    $ec_c = new ec_const_class();
    require_once $ec_c::EC_SEND_MAIL_PATH;
    require_once $ec_c::EC_DBACCESSER_PATH;

    class ec_print_error_Apply_for_change_password_class{
        function print_error_message($mail){
            $ec_mail = new ec_send_mail_class();
            $ec_db = new ec_DBAccesser_class();
            if($mail == ""){
                echo "<div class='error-message error-color'>メールアドレスが入力されていません</div>";
            }else if(!$ec_mail->is_trust_mail($mail)){
                echo "<div class='error-message error-color'>このメールアドレスの形式が正しくありません。</div>";
            }else if($ec_db->is_used_mail($mail)){
                echo "<div class='error-message error-color'>このメールアドレスは使われていません</div>";
            }
        }
    }
?>