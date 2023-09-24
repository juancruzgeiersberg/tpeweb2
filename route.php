<?php
require_once './templates/home.php';
require_once './view/loginView.php';
require_once './view/registerView.php';
require_once './view/proyectsView.php';
require_once './Model/proyectModel.php';
require_once './Model/UserModel.php';
require_once './Controller/loginController.php';
require_once './Controller/proyectsController.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    // Acción por defecto si no envían
    $action = 'home';
}

$params = explode('/', $action);

$proyectModel = new proyectModel();
$userModel = new UserModel();
$loginController = new LoginController();
$proyectController = new ProyectController();
$loginView = new LoginView();
$registerView = new RegisterView();
$proyectView = new ProyectsView();
session_start();
switch ($params[0]){
    case 'home':
        home();
        break;
    case 'login':
        $loginView->showLogin();
        break;
    case 'register':
        $registerView->showRegister();
        break;
    case 'access':
        $loginController->authUser();
        break;
    case 'registerUser':
        $userModel->registerUser();
        break;
    case 'disconect':
        $loginController->disconect();
        break;
    case 'proyectos':
        $proyectController->showProyects($_SESSION['id_usuario'], $_SESSION['rol']);
        break;
    case 'new_proyect';
        $proyectView->new_proyect();
        break;
     case 'add_proyect';
        $proyectModel->addProyect();
        break;
    case 'edit_proyect';
        $proyectController->editProyect();
        break;
    case 'save_edit';
        $proyectModel->saveEdit();
        break;
    case 'delete_proyect';
        $proyectModel->deleteProyect();
        break;
}