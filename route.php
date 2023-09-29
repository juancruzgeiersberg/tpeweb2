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

//Reconoce el action que envía el usuario
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    // Acción por defecto si el usuario no envió nada
    $action = 'home';
}

$params = explode('/', $action);
//Instanciando las variables que se utilizan
$proyectModel = new proyectModel();
$userModel = new UserModel();
$errorModel = new ErrorModel();
$loginController = new LoginController();
$proyectController = new ProyectController();
$registerController = new RegisterController();
$loginView = new LoginView();
$registerView = new RegisterView();
$proyectView = new ProyectsView();
session_start();
//Ejecuta el action dependiendo su valor
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
    case 'allproyects';
        $proyectController->showAllProyects();
        break;
    case 'proyects':
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
    case 'add_user';
        $proyectController->addUserToProyect($_POST['id_proyect']);
        break;
    case 'link_user';
        $proyectController->linkUserProyect($_POST['id_proyect'],$_POST['username']);
        break;
    case 'unlink_user';
        $proyectController->unlinkUser($_POST['id_proyect']);
        break;
    case 'remove_user_proyect';
        $proyectController->removeUser($_POST['username']);
        break;
    default:
        $errorModel->error404();
        break;
}