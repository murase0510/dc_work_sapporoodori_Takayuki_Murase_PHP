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
            if(isset($result["user_id"])){
                    return false; 
            }
            return true;
        }

        public function get_urltoken_by_mailaddless($mail){
            $select = $this->ec_c::GET_URLTOKEN_BY_MAILADDLESS;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':mail',$mail, PDO::PARAM_STR);
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $urltoken = $row["urltoken"];
            }
            return $urltoken;
        }

        public function get_urltoken_at_change_password_by_mailaddless($mail){
            $select = $this->ec_c::GET_URLTOKEN_AT_CHANGE_PASSWORD_BY_MAILADDLESS;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':mail',$mail, PDO::PARAM_STR);
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

        public function is_arrive_from_mail_for_change_password($urltoken){
            $sql = $this->ec_c::IS_ARRIVE_FROM_MAIL_FOR_CHANGE_PASSWORD;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':urltoken', $urltoken, PDO::PARAM_STR);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            if(isset($result["cp_id"])){
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

        public function create_authenticated_account($user_name,$password,$mail){
            $select = $this->ec_c::CREATE_AUTHENTICATED_USER;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':user_name',$user_name, PDO::PARAM_STR);
            $result->bindValue(':password',$password, PDO::PARAM_STR);
            $result->bindValue(':mail',$mail,PDO::PARAM_STR);
            $result->execute();
        }

        public function switch_ispre($mail){
            $sql = $this->ec_c::SWITCH_ISPRE;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':mail', $mail, PDO::PARAM_STR);
            $stm->execute();
        }

        public function switch_isused($mail){
            $sql = $this->ec_c::SWITCH_ISUSED;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':mail', $mail, PDO::PARAM_STR);
            $stm->execute();
        }

        public function switch_isused_at_change_password($mail){
            $sql = $this->ec_c::SWITCH_ISUSED_AT_CHANGE_PASSWORD;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':mail', $mail, PDO::PARAM_STR);
            $stm->execute();
        }

        public function create_change_password($mail){
            $urltoken = hash('sha256',uniqid(rand(),1));
            $select = $this->ec_c::CREATE_CHANGE_PASSWORD;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':urltoken',$urltoken, PDO::PARAM_STR);
            $result->bindValue(':mail',$mail, PDO::PARAM_STR);
            $result->execute();
        }

        public function change_password($mail,$password){
            $sql = $this->ec_c::CHANGE_PASSWORD;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue(':mail', $mail, PDO::PARAM_STR);
            $stm->bindValue(':password', $password, PDO::PARAM_STR);
            $stm->execute();
        }

        public function get_password($mail){
            $select = $this->ec_c::GET_PASSWORD;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':mail',$mail, PDO::PARAM_STR);
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $password = $row["password"];
            }
            return $password;
        }

        public function create_product($product_name,$price,$public_flag){
            $select = $this->ec_c::CREATE_PRODUCT;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':product_name',$product_name, PDO::PARAM_STR);
            $result->bindValue(':price',$price, PDO::PARAM_STR);
            $result->bindValue(':public_flag',$public_flag,PDO::PARAM_BOOL);
            $result->execute();
        }

        public function get_last_insert_key(){
            return $this->pdo->lastInsertId();
        }

        function set_image($product_id,$image,$image_name){
            $select = $this->ec_c::SET_IMAGE;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':product_id',(int)$product_id, PDO::PARAM_INT);
            $result->bindValue(':image',$image,PDO::PARAM_STR);
            $result->bindValue(':image_name',$image_name, PDO::PARAM_STR);
            $result->execute();
        }

        function get_all_image(){
            $select = $this->ec_c::GET_ALL_IMAGE;
            $result = $this->pdo->prepare($select);
            $result->execute();
            $images = $result->fetchAll();
            return $images;
        }

        function get_one_ec_product($product_id){
            $select = $this->ec_c::GET_ONE_EC_PRODUCT;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':product_id',(int)$product_id, PDO::PARAM_INT);
            $result->execute();
            $product = $result->fetchAll();
            return $product;
        }

        function create_ec_stock($product_id,$stock){
            $select = $this->ec_c::CREATE_EC_STOCK;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':product_id',(int)$product_id, PDO::PARAM_INT);
            $result->bindValue(':stock',(int)$stock, PDO::PARAM_INT);
            $result->execute();
        }

        function get_one_ec_stock($product_id){
            $select = $this->ec_c::GET_ONE_EC_STOCK;
            $result = $this->pdo->prepare($select);
            $result->bindValue(':product_id',(int)$product_id, PDO::PARAM_INT);
            $result->execute();
            $stock = $result->fetchAll();
            return  $stock;
        }

        function update_stock($stock_id,$stock){
            $sql = $this->ec_c::UPDATE_STOCK;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue('stock_id', $stock_id, PDO::PARAM_INT);
            $stm->bindValue(':stock', $stock, PDO::PARAM_INT);
            $stm->execute();
        }

        function change_product_flag($product_id,$public_flag){
            $update = $this->ec_c::CHANGE_PRODUCT_FLAG;
            $result = $this->pdo->prepare($update);
            $result->bindValue(':product_id', (int)$product_id, PDO::PARAM_INT);
            $result->bindValue(':public_flag', (bool)$public_flag, PDO::PARAM_BOOL);
            $result->execute();
        }

        function delete_product($product_id){
            $delete = $this->ec_c::DELETE_PRODUCT;
            $result = $this->pdo->prepare($delete);
            $result->bindValue(':product_id', (int)$product_id, PDO::PARAM_INT);
            $result->execute();
        }

        function delete_stock($product_id){
            $delete = $this->ec_c::DELETE_STOCK;
            $result = $this->pdo->prepare($delete);
            $result->bindValue(':product_id', (int)$product_id, PDO::PARAM_INT);
            $result->execute();
        }

        function delete_image($product_id){
            $delete = $this->ec_c::DELETE_IMAGE;
            $result = $this->pdo->prepare($delete);
            $result->bindValue(':product_id', (int)$product_id, PDO::PARAM_INT);
            $result->execute();
        }

        function get_all_product(){
            $select = $this->ec_c::GET_ALL_PRODUCT;
            $result = $this->pdo->prepare($select);
            $result->execute();
            $images = $result->fetchAll();
            return $images;
        }

        function get_one_image($product_id){
            $select = $this->ec_c::GET_ONE_IMAGE;
            $result = $this->pdo->prepare($select);

            $result->bindValue(':product_id',(int)$product_id, PDO::PARAM_INT);
            $result->execute();
            $stock = $result->fetchAll();
            return  $stock;
        }
    }
?>