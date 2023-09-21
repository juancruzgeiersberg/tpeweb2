<?php
require_once 'templates/home.php';
require_once 'view/loginView.php';
require_once 'view/registerView.php';
require_once 'view/proyectosView.php';
require_once 'Model/registerUser.php';
require_once 'Model/proyectModel.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    // Acción por defecto si no envían
    $action = 'home';
}

$params = explode('/', $action);


switch ($params[0]){
    case 'home':
        home();
        break;
    case 'login':
        showLogin();
        break;
    case 'register':
        showRegister();
        break;
    case 'access':
        authUser();
        break;
    case 'registerUser':
        registerUser();
        break;
    case 'disconect':
        disconect();
        break;
    case 'proyectos':
        showProyects();
        break;
    case 'delete_proyect';
        editProyect();
        break;
    case 'delete_proyect';
        deleteProyect();
        break;
}