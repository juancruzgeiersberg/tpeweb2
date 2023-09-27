<?php
require_once './templates/home.php';
require_once './view/loginView.php';
require_once './view/registerView.php';
require_once './view/proyectsView.php';
require_once './Model/proyectModel.php';
require_once './Model/UserModel.php';
require_once './Controller/loginController.php';
require_once './Controller/proyectsController.php';
require_once './Controller/registerController.php';

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
$registerController = new RegisterController();
$loginView = new LoginView();
$registerView = new RegisterView();
$proyectView = new ProyectsView();
session_start();
switch ($params[0]){
    case 'home':
        home();
        break;
    case 'login':
        $loginController->loginView();
        break;
    case 'register':
        $registerController->registerView();
        break;
    case 'access':
        $loginController->authUser();
        break;
    case 'registerUser':
        $registerController->newUser();
        break;
    case 'disconect':
        $loginController->disconect();
        break;
    case 'proyectos':
        $proyectController->showProyects($_SESSION['id_usuario'], $_SESSION['rol']);
        break;
    case 'new_proyect';
        $proyectController->newProyect();
        break;
     case 'add_proyect';
        $proyectController->insertProyect();
        break;
    case 'edit_proyect';
        $proyectController->editProyect();
        break;
    case 'save_edit';
        $proyectController->saveEditProyect();
        break;
    case 'delete_proyect';
        $proyectController->deleteProyect($_POST['id_proyect']);
        break;
}