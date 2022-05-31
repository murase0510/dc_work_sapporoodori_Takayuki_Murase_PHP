<?php 


    //require_once('./work28_image.class.php');

    class work28_DBAccesser{
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
            //print_r($this->db->errorInfo());
        }

        /*
        function get_one_image($image_id){
            $w28_image = new work28_image();
            $select = "SELECT * FROM image_table WHERE image_id = ?";
            $result = $this->pdo->prepare($select);
            $result->bindValue(1,$image_id);
            $result->execute();
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $w28_image->image_id = $row["image_id"];
                $w28_image->image_name = $row["image_name"];
                $w28_image->image_flag = $row["public_flg"]; 
                $w28_image->create_date = $row["create_date"];
                $w28_image->update_date = $row["update_date"];
                //echo $row["image"];
                //$w28_image->image = $row["image"];
            }
            return $w28_image;
        }
        */

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
            var_dump($type);
            var_dump($size);
            //print_r($this->db->errorInfo());
            //$img = fread($fp, filesize($_FILES['upload_image']['tmp_name']));//ここで画像を数値化
            //fclose($fp);
            $result = $this->pdo->prepare("INSERT INTO image_table(image_name,public_flg,create_date,update_date,image,image_type,image_size) VALUES(:image_name,:public_flg,:create_date,:update_date,:image,:image_type,:image_size)");
            $result->bindValue(':image_name', $image_name, PDO::PARAM_STR);
            $result->bindValue(':public_flg', $image_flag, PDO::PARAM_BOOL);
            $result->bindValue(':create_date', date("Y-m-d"), PDO::PARAM_STR);
            $result->bindValue(':update_date', date("Y-m-d"), PDO::PARAM_STR);
            $result->bindValue(':image', $content, PDO::PARAM_STR);
            $result->bindValue(':image_type', $type, PDO::PARAM_STR);            
            $result->bindValue(':image_size', $size, PDO::PARAM_INT); 
            $result->execute();
            $result->close();
        }

        
        function change_flag($image_id,$image_flag){
            $update = "UPDATE image_table SET public_flg = :public_flg WHERE image_id = :image_id;";
            $result->bindValue(':image_name', $image_name, PDO::PARAM_STR);
            $result->bindValue(':public_flg', $image_flag, PDO::PARAM_BOOL);
            $result->execute();
            $result->close();
        }
        
    }
 ?>