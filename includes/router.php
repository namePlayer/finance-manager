<?php
$errorMessages = [];
$requestedUrl = $_SERVER['REQUEST_URI'];
$urlPath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$requestedUrl = substr(strstr($requestedUrl, $urlPath), strlen($urlPath));

// var_dump($requestedUrl);

$requestedPage = 'login';
if(strpos($requestedUrl,'/login') !== false){

    $requestedPage = 'login';
}

if(strpos($requestedUrl,'/dashboard') !== false){

    $dashboardPage = 1;
    $urlParts = explode('/', $requestedUrl);

    $dashboardPages = ['finances','transactions','statements'];

    $dashboardPage = 'dashboard';
    if(count($urlParts) > 2 && in_array($urlParts[2], $dashboardPages)) {
        $dashboardPage = $urlParts[2];
    }

    $requestedPage = 'dashboard';
}


if(strpos($requestedUrl,'/logout') !== false){

    unset($_SESSION['user_login']);
    session_destroy();
    header("Location:".$urlPath."/login");
}
require_once __DIR__.'/../action/'.$requestedPage.'.php';