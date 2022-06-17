<?php 


    require_once '../include/config/ec_const.class.php';

    class ec_DBAccesser{
        public $pdo;
        public $ec_c;
        
        public function __construct(){
            $this->ec_c = new ec_const();
            try{
                $this->pdo = new PDO($this->ec_c::HOST,$this->ec_c::LOGIN_USER,$this->ec_c::PASSWORD);    
            } catch (PDOException $e){
                echo $e->getMessage();
                exit();
            }
        }
  
        //参考サイト：https://note.com/koushikagawa/n/n9c6e396e2687
        public function create_pre_user($mail_addless){
            $urltoken = hash('sha256',uniqid(rand(),1));
            $select = $this->ec_c::CREATE_PRE_USER;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':urltoken',$urltoken, PDO::PARAM_STR);
            $result->bindValue(':mail',$mail_addless, PDO::PARAM_STR);
            $result->execute();
        }

        public function is_used_mail($mail_addless){
            //DB確認  
            $sql = $this->ec_c::IS_USED_MAIL;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':mail', $mail_addless, PDO::PARAM_STR);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            //user テーブルに同じメールアドレスがある場合、エラー表示
            if(isset($result["id"])){
                    return false; 
            }
            return true;
        }

        public function get_urltoken_by_mailaddless($mail_addless){
            $select = $this->ec_c::GET_URLTOKEN_BY_MAILADDLESS;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':mail',$mail_addless, PDO::PARAM_STR);
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $urltoken = $row["urltoken"];
            }
            return $urltoken;
        }
         
        public function is_arrive_from_mail($urltoken){
            $sql = $this->ec_c::IS_ARRIVE_FROM_MAIL;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            if(isset($result["id"])){
                    return true; 
            }
            return false;
        }

        public function is_used_id($user_id){
            if($user_id == "" || strlen($user_id) == 0){
                return false;
            }
            $sql = $this->ec_c::IS_USED_IDL;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':user_id', $user_id, PDO::PARAM_STR);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            if(isset($result["user_id"])){
                    return true; 
            }
            return false;
        }

        public function create_account($user_id,$user_name,$password){
            $select = $this->ec_c::CREATE_AUTHENTICATED_USER;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':user_id',$user_id, PDO::PARAM_STR);
            $result->bindValue(':user_name',$user_name, PDO::PARAM_STR);
            $result->bindValue(':password',$password, PDO::PARAM_STR);
            $result->execute();
        }
    }
?>