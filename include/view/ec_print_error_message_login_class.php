<?php
    class ec_print_error_message_login{
        function print_error_message($mail,$password){
            session_start();
            require_once('../include/config/ec_const_class.php');
            $ec_c = new ec_const_class();

            require_once($ec_c::EC_DBACCESSER_PATH);
            $ec_db = new ec_DBAccesser_class();
            if(!isset($mail) ||$mail == ""){
                echo "<div class='error-color'>メールアドレスが空欄です</div>";
            }else if(authenticate($mail,$password)){
                $_SESSION[$ec_c::SESSION_MAIL] = $mail;
                if($mail == $ec_c::EC_ADMIN){
                    header($ec_c::LOCATION_ADMIN_FORM);
                }else if(!$ec_db->is_Authenticated_user($mail)){
                    $user = $ec_db->get_one_authenticated_user($mail);
                    $_SESSION[$ec_c::SESSION_USER_ID] = $user[0][$ec_c::DB_USER_ID];
                    $cart = $ec_db->get_one_cart($_SESSION[$ec_c::SESSION_USER_ID]);
                    $_SESSION[$ec_c::SESSION_CART_ID] = $cart[0][$ec_c::DB_CART_ID];
                    header($ec_c::LOCATION_PRODUCT_LIST);
                }else if($ec_db->is_Authenticated_user($mail)){
                    "<div class='error-color'>まだ認証されていないユーザです</div>";
                }
            }else if(!authenticate($mail,$password)){
                echo "<div class='error-color'>メールアドレス、またはパスワードが違います</div>";
            }
            if(!isset($password) ||$password == ""){
                echo "<div class='error-color'>パスワードが空欄です</div>";
            }
        }

        function authenticate($mail,$password){
            $ec_db = new ec_DBAccesser_class();
            return $ec_db->get_password($mail) == $password;
        }
    }
?>