<?php
require_once 'Model/registerUser.php';

function showLogin(){
    require_once 'templates/header.php';

    require_once 'templates/login.php';

    require_once 'templates/footer.php';
}

function verifyUser($user){
    require 'templates/db.php';
    $sentence = $pdo->prepare('SELECT * FROM usuario WHERE nombre = ?');
    $sentence->execute(array($user));
    $userVerify = $sentence->fetch(PDO::FETCH_OBJ);
    return $userVerify;
}

function authUser(){
    if(!empty($_POST['user']) && !empty($_POST['password'])){
        $user = $_POST['user'];
        $password = $_POST['password'];

        $userBD = verifyUser($user);
        if (!empty($userBD) && password_verify($password, ($userBD->contraseña))){
            session_start();
            $_SESSION['id_usuario'] = $userBD->id_usuario;
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
    unset($_SESSION['id_usuario']);
    unset($_SESSION['rol']);
    header("Location:". BASE_URL . "login");
}

?>