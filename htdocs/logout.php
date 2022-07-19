<?php
    session_start();
    require_once('../include/config/ec_const_class.php');
    $ec_c = new ec_const_class();
    $session = session_name();
    $_SESSION = [];
    if (isset($_COOKIE[$session])) {
        $params = session_get_cookie_params();
        setcookie($session, '', time() - 30, '/');
    }

    session_destroy();
    header($ec_c::LOCATION_INDEX);
?>