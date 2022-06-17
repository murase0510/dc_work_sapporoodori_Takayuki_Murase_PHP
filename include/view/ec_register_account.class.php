<?php

    require_once '../include/model/ec_DBAccesser.class.php';

    class ec_register_account{
        public $trust_arrive;
        public $ec_db;

        public function __construct($urltoken){
            $this->ec_db = new ec_DBAccesser();
            $this->trust_arrive = $this->ec_db->is_arrive_from_mail($urltoken);
            if($this->trust_arrive){
                header("Location: https://portfolio.dc-itex.com/sapporoodori/0001/htdocs/invalid_access.php");
            }
        }
    }

?>