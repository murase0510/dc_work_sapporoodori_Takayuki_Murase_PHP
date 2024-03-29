<?php 


    require_once '../include/config/ec_const_class.php';
    $ec_c = new ec_const_class();
    require_once $ec_c::EC_DBACCESSER_PATH;

    class ec_send_mail_class{
        function is_trust_mail($mail_addless){
            if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail_addless)){
                return false;
            }
            return true;
        }

        //参考：https://note.com/koushikagawa/n/n9c6e396e2687
        function send_preuser_mail($mail_addless){
            $ec_db = new ec_DBAccesser_class();
            $ec_c = new ec_const_class();
            //var_dump($ec_db);
            $url = $ec_c::URL.$ec_db->get_urltoken_by_mailaddless($mail_addless)."&mail=".$mail_addless;
            
            $body = "この度はご登録いただきありがとうございます。下記のURLからご登録下さい。{$url}";
            mb_language($ec_c::LANG_JA);
            mb_internal_encoding($ec_c::ENCODE_UTF8);
            //Fromヘッダーを作成
            $header = "From:".$ec_c::SENDING_MAIL;
            if(mb_send_mail($mail_addless, "本登録のお願い", $body, $header)){      
                //セッション変数を全て解除
                $_SESSION = array();
                //クッキーの削除
                if (isset($_COOKIE[$ec_c::COOKIE_VALIABLE_PHPSESSID])) {
                    setcookie($ec_c::COOKIE_VALIABLE_PHPSESSID, '', time() - 1800, '/');
                }
            }
        }

        function send_change_password_mail($mail){
            $ec_db = new ec_DBAccesser_class();
            $ec_c = new ec_const_class();
            $url = $ec_c::CHANGE_PASS_URL.$ec_db->get_urltoken_at_change_password_by_mailaddless($mail)."&mail=".$mail;
            
            $body = "以下のURLをクリックし、パスワードを変更してください。{$url}";
            mb_language($ec_c::LANG_JA);
            mb_internal_encoding($ec_c::ENCODE_UTF8);
            //Fromヘッダーを作成
            $header = "From:".$ec_c::SENDING_MAIL;
            
            if(mb_send_mail($mail, "パスワードの変更", $body, $header)){      
                //セッション変数を全て解除
                $_SESSION = array();
                //クッキーの削除
                if (isset($_COOKIE[$ec_c::COOKIE_VALIABLE_PHPSESSID])) {
                    setcookie($ec_c::COOKIE_VALIABLE_PHPSESSID, '', time() - 1800, '/');
                }
            }
        }
    }
?>