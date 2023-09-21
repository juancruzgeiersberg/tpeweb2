<?php

function registerUser(){
    require 'templates/db.php';
    $arr = [$_POST['user'],password_hash($_POST['password'], PASSWORD_BCRYPT)];
    $rol = 2;

    if(verifyInsert($arr[0], $pdo)){
        saveUser($arr,$rol);
        header("Location:". BASE_URL . "home");
    }else{
        session_start();
        $_SESSION['error'] = "El usuario ingresado ya existe.";
        header("Location:". BASE_URL . "register");
    }
}

function verifyInsert($user, $pdo){
    $checkQuery = "SELECT COUNT(*) FROM usuario WHERE nombre = ?";
    $query = $pdo->prepare($checkQuery);
    $query->execute(array($user));
    if($query->fetchColumn() == 0){
        return true;
    }else{
        return false;
    }
}

function saveUser($arr, $rol){
    require 'templates/db.php';
    $query = $pdo->prepare("INSERT INTO `usuario` (`nombre`, `contraseña`, `id_rol`) VALUES (?,?,?)");
    $query->execute(array($arr[0],$arr[1],$rol));
}

?>