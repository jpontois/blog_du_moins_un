<?php
if (PHP_SESSION_NONE === session_status()) {
    session_start();
}

$requestedPage = '/';

if (isset($_SERVER['REQUEST_URI'])) {
    $requestedPage = explode('?', $_SERVER['REQUEST_URI']);
}

$subRequestedPage = explode('/',$requestedPage[0]);

if ('article' === $subRequestedPage[1]) {
    $requestedPage[0] = '/article';
    $idArticle = $subRequestedPage[2];
}

switch ($requestedPage[0]) {
    case '/':
        require_once(__DIR__ . '/controler/home_controler.php');
        break;
    case '/admin':
        require_once(__DIR__ . '/controler/admin_controler.php');
        break;
    case '/article':
        require_once(__DIR__ . '/controler/consult_controler.php');
        break;
    case '/creation':
        require_once(__DIR__ . '/controler/create_controler.php');
        break;
    case '/edition':
        require_once(__DIR__ . '/controler/edit_controler.php');
        break;
    case '/suppression':
        require_once(__DIR__ . '/controler/delete_controler.php');
        break;
    case '/connexion':
        require_once(__DIR__ . '/controler/login_controler.php');
        break;
    case '/deconnexion':
        require_once(__DIR__ . '/controler/logout_controler.php');
        break;
    case '/inscription':
        require_once(__DIR__ . '/controler/signup_controler.php');
        break;
    default:
        require_once(__DIR__ . '/View/general/404.php');
}

?>