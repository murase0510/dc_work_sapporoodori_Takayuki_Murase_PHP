<?php
    class work34_DBAccesser{
        const DATABASE = 'mysql:dbname=bcdhm_sapporo_pf0001;host=mysql34.conoha.ne.jp';
        const LOGIN_USER = 'bcdhm_sapporo_pf0001';
        const PASSWORD = 'A7c2b#Nw';
        public $pdo;

        public function __construct() { 
            try{
                $this->pdo = new PDO(self::DATABASE,self::LOGIN_USER,self::PASSWORD);
            } catch (PDOException $e){
                echo $e->getMessage();
                exit();
            }
        }

        function authentication($login_id,$password){
            //SELECT文の実行
            $sql = "SELECT password FROM user_table WHERE user_id = :user_id";
            $stmt  = $this->pdo->prepare($sql);
            $stmt -> bindValue(':user_id', $login_id);
            $stmt -> execute();
            while ($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
                if($row["password"] == $password){
                    return true;
                }else{
                    return false;
                }
            }
        }

        function get_user_name($login_id){
            $sql = "SELECT user_name FROM user_table WHERE user_id = :user_id";
            $stmt  = $this->pdo->prepare($sql);
            $stmt -> bindValue(':user_id', $login_id);
            $stmt -> execute();
            while ($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
                $user_name = $row["user_name"];
            }
            return $user_name;
        }
    }
?>