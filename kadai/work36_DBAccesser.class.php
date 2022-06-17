<?php 


    //require_once('./work28_image.class.php');

    class work36_DBAccesser{
        // データベースへ接続
        public $host;
        public $login_user; 
        public $password;   
        public $database;   
        public $db;

        public function __construct() {
            $this->host = 'mysql34.conoha.ne.jp'; 
            $this->login_user = 'bcdhm_sapporo_pf0001'; 
            $this->password = 'A7c2b#Nw';   
            $this->database = 'bcdhm_sapporo_pf0001';   
            $this->pdo = new PDO('mysql:dbname=bcdhm_sapporo_pf0001;host=mysql34.conoha.ne.jp',$this->login_user, $this->password);
        }

        function get_all_image(){
            $select = "SELECT * FROM image_table;";
            $result = $this->pdo->prepare($select);
            $result->execute();
            $images = $result->fetchAll();
            return $images;
        }
        

        function set_image($image_name,$image_flag,$content,$type,$size){
            //生成処理
            date_default_timezone_set('Asia/Tokyo');
            $result = $this->pdo->prepare("INSERT INTO image_table(image_name,public_flg,create_date,update_date,image,image_type,image_size) VALUES(:image_name,:public_flg,:create_date,:update_date,:image,:image_type,:image_size)");
            $result->bindValue(':image_name', $image_name, PDO::PARAM_STR);
            $result->bindValue(':public_flg', $image_flag, PDO::PARAM_BOOL);
            $result->bindValue(':create_date', date("Y-m-d"), PDO::PARAM_STR);
            $result->bindValue(':update_date', date("Y-m-d"), PDO::PARAM_STR);
            $result->bindValue(':image', $content, PDO::PARAM_STR);
            $result->bindValue(':image_type', $type, PDO::PARAM_STR);            
            $result->bindValue(':image_size', $size, PDO::PARAM_INT); 
            $result->execute();
        }

        
        function change_flag($image_id,$image_flag){
            date_default_timezone_set('Asia/Tokyo');
            $update = "UPDATE image_table SET public_flg = :public_flg WHERE image_id = :image_id;";
            $result = $this->pdo->prepare($update);
            $result->bindValue(':image_id', $image_id, PDO::PARAM_INT);
            $result->bindValue(':public_flg', $image_flag, PDO::PARAM_BOOL);
            $result->execute();
        }
        
    }
 ?>