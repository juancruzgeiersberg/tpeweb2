<?php
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
$errorModel = new ErrorModel();
//Ejecuta el action dependiendo su valor
switch ($params[0]){
    case 'home':
        $proyectController = new ProyectController();
        $proyectController->showHome();
        break;
    case 'login':
        $loginController = new LoginController();
        $loginController->loginView();
        break;
    case 'register':
        $registerController = new RegisterController();
        $registerController->registerView();
        break;
    case 'access':
        $loginController = new LoginController();
        $loginController->authUser();
        break;
    case 'registerUser':
        $registerController = new RegisterController();
        $registerController->newUser();
        break;
    case 'disconect':
        $loginController = new LoginController();
        $loginController->disconect();
        break;
    case 'allproyects':
        $proyectController = new ProyectController();
        $proyectController->showAllProyects();
        break;
    case 'proyects':
        $proyectController = new ProyectController();
        AuthHelper::init();
        $proyectController->showProyects($_SESSION['id_usuario'], $_SESSION['rol']);
        break;
    case 'new_proyect':
        $proyectController = new ProyectController();
        $proyectController->newProyect();
        break;
     case 'add_proyect':
        $proyectController = new ProyectController();
        $proyectController->insertProyect();
        break;
    case 'edit_proyect':
        $proyectController = new ProyectController();
        $proyectController->editProyect();
        break;
    case 'save_edit':
        $proyectController = new ProyectController();
        $proyectController->saveEditProyect();
        break;
    case 'delete_proyect':
        $proyectController = new ProyectController();
        $proyectController->deleteProyect($_POST['id_proyect']);
        break;
    case 'add_user':
        $proyectController = new ProyectController();
        $proyectController->addUserToProyect($_POST['id_proyect']);
        break;
    case 'link_user':
        $proyectController = new ProyectController();
        $proyectController->linkUserProyect($_POST['username']);
        break;
    case 'unlink_user':
        $proyectController = new ProyectController();
        $proyectController->unlinkUser($_POST['id_proyect']);
        break;
    case 'remove_user_proyect':
        $proyectController = new ProyectController();
        $proyectController->removeUser($_POST['username']);
        break;
    case 'members':
        $proyectController = new ProyectController();
        $proyectController->allMembers($_POST['id_proyect']);
        //$proyectController->viewProyect($_POST['id_proyect']);
        break;
    case 'proyectByCreator':
        $proyectController = new ProyectController();
        $proyectController->proyectsByCreator($_POST['creator']);
        break;
    default:
        $proyectController = new ProyectController();
        $proyectController->errorNotFound();
        break;
}