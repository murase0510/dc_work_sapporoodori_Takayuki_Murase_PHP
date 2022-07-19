<?php
    require_once '../include/config/ec_const_class.php';
    

    class ec_no_session_class{
        
        function no_session(){
            $ec_c = new ec_const_class();
            if (($_SESSION[$ec_c::SESSION_USER_ID] == '') || (!isset($_SESSION[$ec_c::SESSION_USER_ID]))) {
                header($ec_c::LOCATION_LOGIN);
            }
        }
    }
?>