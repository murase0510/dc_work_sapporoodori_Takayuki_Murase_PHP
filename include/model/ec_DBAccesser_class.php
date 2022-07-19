<?php 


    require_once '../include/config/ec_const_class.php';

    class ec_DBAccesser_class{
        public $pdo;
        public $ec_c;
        
        public function __construct(){
            $this->ec_c = new ec_const_class();
            try{
                $this->pdo = new PDO($this->ec_c::HOST,$this->ec_c::LOGIN_USER,$this->ec_c::PASSWORD);    
            } catch (PDOException $e){
                echo $e->getMessage();
                exit();
            }
        }
  
        /**
         * プレユーザを作成するメソッド
         * 参考サイト：https://note.com/koushikagawa/n/n9c6e396e2687
         */
        public function create_pre_user($mail_addless){
            $urltoken = hash('sha256',uniqid(rand(),1));
            $select = $this->ec_c::CREATE_PRE_USER;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_URLTOKEN,$urltoken, PDO::PARAM_STR);
            $result->bindValue($this->ec_c::DB_BIND_MAIL,$mail_addless, PDO::PARAM_STR);
            $result->execute();
        }

        /**
         * 既に使われているメールアドレスかを確認する
         */
        public function is_used_mail($mail_addless){
            //DB確認  
            $sql = $this->ec_c::IS_USED_MAIL;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue($this->ec_c::DB_BIND_MAIL, $mail_addless, PDO::PARAM_STR);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            //user テーブルに同じメールアドレスがある場合、falseを返す
            if(isset($result[$this->ec_c::DB_USER_ID])){
                    return false; 
            }
            return true;
        }

        /**
         * プレユーザテーブルからまだ使われていないurlトークンをメールアドレス結びついたメールアドレスから取得する
         */
        public function get_urltoken_by_mailaddless($mail){
            $select = $this->ec_c::GET_URLTOKEN_BY_MAILADDLESS;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_MAIL,$mail, PDO::PARAM_STR);
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $urltoken = $row[$this->ec_c::DB_URLTOKEN];
            }
            return $urltoken;
        }

        /**
         * changepasswordテーブルからまだ使われていないurlトークンを結びついたメールアドレスから取得する
         */
        public function get_urltoken_at_change_password_by_mailaddless($mail){
            $select = $this->ec_c::GET_URLTOKEN_AT_CHANGE_PASSWORD_BY_MAILADDLESS;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_MAIL,$mail, PDO::PARAM_STR);
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $urltoken = $row[$this->ec_c::DB_URLTOKEN];
            }
            return $urltoken;
        }
        
        /**
         * ブラウザからURLトークンを取得してメールからアクセスしたかを確認する
         */
        public function is_arrive_from_mail($urltoken){
            $sql = $this->ec_c::IS_ARRIVE_FROM_MAIL;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue($this->ec_c::DB_BIND_URLTOKEN, $urltoken, PDO::PARAM_STR);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            if(isset($result[$this->ec_c::DB_ID])){
                    return true; 
            }
            return false;
        }

         /**
         * ブラウザからURLトークンを取得してメールからアクセスしたかを確認する
         * こちらはパスワード変更時に用いるメソッド
         */
        public function is_arrive_from_mail_for_change_password($urltoken){
            $sql = $this->ec_c::IS_ARRIVE_FROM_MAIL_FOR_CHANGE_PASSWORD;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue($this->ec_c::DB_BIND_URLTOKEN, $urltoken, PDO::PARAM_STR);
            $stm->execute();
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            if(isset($result[$this->ec_c::DB_CP_ID])){
                    return true; 
            }
            return false;
        }

        /**
         * 認証積みユーザを作る
         */
        public function create_authenticated_account($user_name,$password,$mail){
            $select = $this->ec_c::CREATE_AUTHENTICATED_USER;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_USER_NAME,$user_name, PDO::PARAM_STR);
            $result->bindValue($this->ec_c::DB_BIND_PASSWORD,$password, PDO::PARAM_STR);
            $result->bindValue($this->ec_c::DB_BIND_MAIL,$mail,PDO::PARAM_STR);
            $result->execute();
        }

        /**
         * ec_Authenticated_userテーブルのメールアドレスに対応したispreをfalseにする
         */
        public function switch_ispre($mail){
            $sql = $this->ec_c::SWITCH_ISPRE;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue($this->ec_c::DB_BIND_MAIL, $mail, PDO::PARAM_STR);
            $stm->execute();
        }

        /**
         * pre_userテーブルのメールアドレスに対応したisusedをfalseにする
         */        
        public function switch_isused($mail){
            $sql = $this->ec_c::SWITCH_ISUSED;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue($this->ec_c::DB_BIND_MAIL, $mail, PDO::PARAM_STR);
            $stm->execute();
        }

        /**
         * change_passwordテーブルのメールアドレスに対応したisusedをfalseにする
         */
        public function switch_isused_at_change_password($mail){
            $sql = $this->ec_c::SWITCH_ISUSED_AT_CHANGE_PASSWORD;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue($this->ec_c::DB_BIND_MAIL, $mail, PDO::PARAM_STR);
            $stm->execute();
        }

        /**
         * パスワード変更の申請を受けた時にurlトークンを発酵する
         */
        public function create_change_password($mail){
            $urltoken = hash('sha256',uniqid(rand(),1));
            $select = $this->ec_c::CREATE_CHANGE_PASSWORD;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_URLTOKEN,$urltoken, PDO::PARAM_STR);
            $result->bindValue($this->ec_c::DB_BIND_MAIL,$mail, PDO::PARAM_STR);
            $result->execute();
        }

        /**
         * パスワードの変更を行う
         */
        public function change_password($mail,$password){
            $sql = $this->ec_c::CHANGE_PASSWORD;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue($this->ec_c::DB_BIND_MAIL, $mail, PDO::PARAM_STR);
            $stm->bindValue($this->ec_c::DB_BIND_PASSWORD, $password, PDO::PARAM_STR);
            $stm->execute();
        }

        /**
         * パスワードを取得する
         */
        public function get_password($mail){
            $select = $this->ec_c::GET_PASSWORD;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_MAIL,$mail, PDO::PARAM_STR);
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $password = $row[$this->ec_c::DB_PASSWORD];
            }
            return $password;
        }

        /**
         * 商品を登録する
         */
        public function create_product($product_name,$price,$public_flag){
            $select = $this->ec_c::CREATE_PRODUCT;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_NAME,$product_name, PDO::PARAM_STR);
            $result->bindValue($this->ec_c::DB_BIND_PRICE,$price, PDO::PARAM_STR);
            $result->bindValue($this->ec_c::DB_BIND_PUBLIC_FLAG ,$public_flag,PDO::PARAM_BOOL);
            $result->execute();
        }

        /**
         * 最後に登録された主キーを返す
         */
        public function get_last_insert_key(){
            return $this->pdo->lastInsertId();
        }

        /**
         * 商品の画像をDBに保存する
         */
        function set_image($product_id,$image,$image_name){
            $select = $this->ec_c::SET_IMAGE;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_IMAGE,$image,PDO::PARAM_STR);
            $result->bindValue($this->ec_c::DB_BIND_IMAGE_NAME,$image_name, PDO::PARAM_STR);
            $result->execute();
        }

        /**
         * 全ての商品の画像を取得する
         */
        function get_all_image(){
            $select = $this->ec_c::GET_ALL_IMAGE;
            $result = $this->pdo->prepare($select);
            $result->execute();
            $images = $result->fetchAll();
            return $images;
        }

        /**
         * ec_productテーブルからproduct_idに対応した商品を取得する
         */
        function get_one_ec_product($product_id){
            $select = $this->ec_c::GET_ONE_EC_PRODUCT;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->execute();
            $product = $result->fetchAll();
            return $product;
        }

        /**
         * product_idに対応したstockテーブルを生成する
         */
        function create_ec_stock($product_id,$stock){
            $select = $this->ec_c::CREATE_EC_STOCK;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_STOCK,(int)$stock, PDO::PARAM_INT);
            $result->execute();
        }

        /**
         * ec_stockテーブルからproduct_idに対応したstockを返す
         */
        function get_one_ec_stock($product_id){
            $select = $this->ec_c::GET_ONE_EC_STOCK;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->execute();
            $stock = $result->fetchAll();
            return  $stock;
        }

        /**
         * ec_stockテーブルのstockを更新する
         */
        function update_stock($stock_id,$stock){
            $sql = $this->ec_c::UPDATE_STOCK;
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue($this->ec_c::DB_BIND_STOCK_ID, $stock_id, PDO::PARAM_INT);
            $stm->bindValue($this->ec_c::DB_BIND_STOCK, $stock, PDO::PARAM_INT);
            $stm->execute();
        }

        /**
         * ec_productテーブルのpublic_flagを更新する
         */
        function change_product_flag($product_id,$public_flag){
            $update = $this->ec_c::CHANGE_PRODUCT_FLAG;
            $result = $this->pdo->prepare($update);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID, (int)$product_id, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_PUBLIC_FLAG , (bool)$public_flag, PDO::PARAM_BOOL);
            $result->execute();
        }

        /**
         * ec_productテーブルのproduct_idに対応した商品を削除する
         */
        function delete_product($product_id){
            $delete = $this->ec_c::DELETE_PRODUCT;
            $result = $this->pdo->prepare($delete);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID, (int)$product_id, PDO::PARAM_INT);
            $result->execute();
        }

        /**
         * ec_stockテーブルのproduct_idに対応した在庫を削除する
         */
        function delete_stock($product_id){
            $delete = $this->ec_c::DELETE_STOCK;
            $result = $this->pdo->prepare($delete);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID, (int)$product_id, PDO::PARAM_INT);
            $result->execute();
        }

        /**
         * product_imageテーブルのproduct_idに対応した画像を削除する
         */
        function delete_image($product_id){
            $delete = $this->ec_c::DELETE_IMAGE;
            $result = $this->pdo->prepare($delete);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID, (int)$product_id, PDO::PARAM_INT);
            $result->execute();
        }

        /**
         * ec_productテーブルから全ての商品を取得する
         */
        function get_all_product(){
            $select = $this->ec_c::GET_ALL_PRODUCT;
            $result = $this->pdo->prepare($select);
            $result->execute();
            $products = $result->fetchAll();
            return $products;
        }

        /**
         * product_imageテーブルからproduct_idに対応した画像を取得する
         */
        function get_one_image($product_id){
            $select = $this->ec_c::GET_ONE_IMAGE;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->execute();
            $image = $result->fetchAll();
            return  $image;
        }

        /**
         * cartテーブルにuser_idでec_Authenticated_userテーブルと紐付いたカラムを作成する
         */
        function create_cart($user_id){
            $select = $this->ec_c::CREATE_CART;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_USER_ID,(int)$user_id, PDO::PARAM_INT);
            $result->execute();
        }

        /**
         * cart_product_chukanテーブルにcart_idとproduct_idでcartテーブルとec_productテーブルと紐付いたカラムを作成する
         */
        function create_cart_product_chukan($cart_id,$product_id){
            $select = $this->ec_c::CREATE_CART_PRODUCT_CHUKAN;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_CART_ID,(int)$cart_id, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->execute();
        }

        /**
         * ec_Authenticated_userテーブルからメールアドレスに対応したカラムを取得する
         */
        function get_one_authenticated_user($mail){
            $select = $this->ec_c::GET_ONE_AUTHENTICATED_USER;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_MAIL,$mail, PDO::PARAM_STR);
            $result->execute();
            $user = $result->fetchAll();
            return  $user;
        }

        /**
         * cartテーブルからuser_idに紐付いたカラムを取得する
         */
        function get_one_cart($user_id){
            $select = $this->ec_c::GET_ONE_CART;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_USER_ID,$user_id, PDO::PARAM_STR);
            $result->execute();
            $cart = $result->fetchAll();
            return  $cart;
        }

        /**
         * cart_product_chukanテーブルからcart_idに紐付いたカラムを取得する
         */
        function get_cart_product_chukan_by_cartid($cart_id){
            $select = $this->ec_c::GET_CART_PRODUCT_CHUKAN_BY_CARTID;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_CART_ID,(int)$cart_id, PDO::PARAM_INT);
            $result->execute();
            $cart_product_chukan = $result->fetchAll();
            return $cart_product_chukan;
        }

        /**
         * cart_product_chukanテーブルのcart_idとproduct_idに紐付いたPurchase_numberを更新する
         */
        function update_cart_product_chukan_Purchase_number($cart_id,$product_id,$Purchase_number){
            $update = $this->ec_c::UPDATE_CART_PRODUCT_CHUKAN_PURCHASE_NUMBER;
            $result = $this->pdo->prepare($update);
            $result->bindValue($this->ec_c::DB_BIND_CART_ID,(int)$cart_id, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_PURCHASE_NUMBER, (int)$Purchase_number, PDO::PARAM_INT);
            $result->execute();
        }

         /**
         * cart_product_chukanテーブルのcart_idとproduct_idに紐付いたカラムを削除する
         */
        function delete_cart_product_chukan($cart_id,$product_id){
            $update = $this->ec_c::DELETE_CART_PRODUCT_CHUKAN;
            $result = $this->pdo->prepare($update);
            $result->bindValue($this->ec_c::DB_BIND_CART_ID,(int)$cart_id, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->execute();
        }

        /**
         * cart_product_chukanテーブルのcart_idとproduct_idに紐付いたカラムを取得する
         */
        function get_one_cart_product_chukan($cart_id,$product_id){
            $select = $this->ec_c::GET_ONE_CART_PRODUCT_CHUKAN;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_CART_ID,(int)$cart_id, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->execute();
            $cart_product_chukan = $result->fetchAll();
            return $cart_product_chukan;
        }

         /**
         * cart_product_chukanテーブルのcart_idとproduct_idに紐付いたPurchase_numberに１を足す
         */
        function plus_one_cart_product_chukan_Purchase_number($cart_id,$product_id){
            $update = $this->ec_c::PLUS_ONE_CART_PRODUCT_CHUKAN_PURCHASE_NUMBER;
            $result = $this->pdo->prepare($update);
            $result->bindValue($this->ec_c::DB_BIND_CART_ID,(int)$cart_id, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->execute();
        }

         /**
         * cart_product_chukanテーブルのcart_idとproduct_idに紐付いたカラムがあればtrueを返す
         */
        function is_in_cart_product_chukan($cart_id,$product_id){
            $select = $this->ec_c::GET_ONE_CART_PRODUCT_CHUKAN;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_CART_ID,(int)$cart_id, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->execute();
            $result = $result->fetch(PDO::FETCH_ASSOC);
            if(isset($result[$this->ec_c::DB_CART_ID])){
                return true; 
            }
            return false;
        }

        //購入日時を更新する
        function update_cart_product_chukan_purchase_date($cart_id){
            $update = $this->ec_c::UPDATE_PRODUCT_CHUKAN_PURCHASE_DATE ;
            $result = $this->pdo->prepare($update);
            $result->bindValue($this->ec_c::DB_BIND_CART_ID,(int)$cart_id, PDO::PARAM_INT);
            $result->execute();
        }

        //購入された分だけec_stockテーブルのstockから差し引く
        function minus_stock($num,$product_id){
            $update = $this->ec_c::MINUS_STOCK;
            $result = $this->pdo->prepare($update);
            $result->bindValue($this->ec_c::DB_BIND_NUM,(int)$num, PDO::PARAM_INT);
            $result->bindValue($this->ec_c::DB_BIND_PRODUCT_ID,(int)$product_id, PDO::PARAM_INT);
            $result->execute();
        }

        //そのユーザがプレユーザかを確認する
        function is_Authenticated_user($mail){
            $select= $this->ec_c::IS_AUTHENTICATED_USER;
            $result = $this->pdo->prepare($select);
            $result->bindValue($this->ec_c::DB_BIND_MAIL,$mail, PDO::PARAM_STR);
            $result->execute();
            $ispre = $result->fetchAll();
            return (bool)$ispre[0]["isPre"];
        }
    }
?>