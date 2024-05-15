<?php

$expiry_time = time() + (1 * 24 * 60 * 60);

setcookie('PHPSESSID', session_id(), $expiry_time, '/');
setcookie('PHPSESSID_EXPIRY', $expiry_time, $expiry_time, '/');

if(isset($_COOKIE['PHPSESSID'])) {
    $phpsessid_value = $_COOKIE['PHPSESSID'];

    if(isset($_COOKIE['PHPSESSID_EXPIRY'])) {
        $expiry_time = $_COOKIE['PHPSESSID_EXPIRY'];

        $current_time = time();

        if($current_time > $expiry_time) {
            setcookie('PHPSESSID', '', time() - 3600, '/');
            setcookie('PHPSESSID_EXPIRY', '', time() - 3600, '/');
        }
    }
}
?>