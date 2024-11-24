<?php 

ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Strict');

session_set_cookie_params([

    'lifetime' => 1800,
    'domain' => '192.168.5.11',
    'path' => '/',
 /* 'secure' => true   */   //if you have https
     'httponly' => true 

]);

?>