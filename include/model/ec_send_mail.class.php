<?php 


    require_once '../include/config/ec_const.class.php';
    require_once '../include/model/ec_DBAccesser.class.php';

    class ec_send_mail{
        function is_trust_mail($mail_addless){
            if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $mail_addless)){
                return false;
            }
            return true;
        }

        //参考：https://note.com/koushikagawa/n/n9c6e396e2687
        function send_preuser_mail($mail_addless){
            $ec_db = new ec_DBAccesser();
            $ec_c = new ec_const();
            $url = $ec_c::URL.$ec_db->get_urltoken_by_mailaddless($mail_addless);
            
            $body = "この度はご登録いただきありがとうございます。下記のURLからご登録下さい。{$url}";
            mb_language('ja');
            mb_internal_encoding('UTF-8');
            //Fromヘッダーを作成
            $header = "From:".$ec_c::SENDING_MAIL;
            
            if(mb_send_mail($mail_addless, "本登録のお願い", $body, $header)){      
                //セッション変数を全て解除
                $_SESSION = array();
                //クッキーの削除
                if (isset($_COOKIE["PHPSESSID"])) {
                    setcookie("PHPSESSID", '', time() - 1800, '/');
                }
            }
            

        }
    }
?>