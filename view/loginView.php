<?php
require_once './Model/registerUser.php';
require_once './Model/UserModel.php';



function showLogin(){
    require_once 'templates/header.php';

    require_once 'templates/login.php';

    require_once 'templates/footer.php';
}



function authUser(){
    if(!empty($_POST['user']) && !empty($_POST['password'])){
        $user = $_POST['user'];
        $password = $_POST['password'];
        $userModel = new UserModel();
        $userBD = $userModel->verifyUser($user);
        if (!empty($userBD) && password_verify($password, ($userBD->contraseña))){
            session_start();
            $_SESSION['id_usuario'] = $userBD->id_usuario;
            $_SESSION['nombre'] = $userBD->nombre;
            $_SESSION['rol'] = $userBD->id_rol;
            header("Location: home");
        }
    }else{
        session_start();
        $_SESSION['error'] = "User or Password Incorrect.";
        showLogin($_SESSION['error']);
    }
}

function disconect(){
    session_start();
    // unset($_SESSION['id_usuario']);
    // unset($_SESSION['rol']);
    session_destroy();
    header("Location:". BASE_URL . "login");
}

?>