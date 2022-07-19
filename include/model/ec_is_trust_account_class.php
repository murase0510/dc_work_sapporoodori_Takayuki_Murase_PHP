<?php
    class ec_is_trust_account_class{

        public $user;
        public $password;
        
        public function __construct($user,$password){
            $this->ec_c = new ec_const_class();
            $this->user = $user;
            $this->password = $password;
        }
        //参考サイト
        //https://phpspot.net/php/pg%EF%BC%B0%EF%BC%A8%EF%BC%B0%EF%BC%86%E6%AD%A3%E8%A6%8F%E8%A1%A8%E7%8F%BE.html
        //上記サイトの”すべて半角英数字かどうか調べる”参照
        public function is_trust_user(){
            if(preg_match("/^[a-zA-Z0-9]+$/", $this->user) && strlen($this->user) >= 5){
                return true;
            }else{
                return false;
            }
        }

        public function is_trust_password(){
            if(preg_match("/^[a-zA-Z0-9]+$/", $this->password) && strlen($this->password) >= 8){
                return true;
            }else{
                return false;
            }
        }
    }
?>