<?php

function deleteProyect(){
    require_once 'templates/db.php';
    $id_proyect = [$_POST['id_proyecto']];
    $query = "DELETE FROM `proyecto` WHERE id_proyecto = ?";
    sqlExecute($query, $id_proyect, $pdo);
    header("Location:". BASE_URL . "proyectos");
}
//no tiene nada todavía, ya se subirá el borrador.
// function editProyect(){
//     require 'templates/db.php';
    
// }

function addProyect(){
    require_once 'templates/db.php';
    session_start();
    $add = [$_POST['name_proyect'],$_POST['description'],$_SESSION['id_usuario']];
    $query = "INSERT INTO `proyecto`(`nombre_proyecto`, `descripcion`, `id_usuario`) VALUES (?,?,?)";
    sqlExecute($query,$add,$pdo);
    header("Location:" . BASE_URL . "proyectos");
}

function sqlExecute($query, $sql, $pdo){
    $stmt = $pdo->prepare($query);
    $stmt->execute($sql);
}

function allProyectsByID($id){
    require_once 'templates/db.php';
    $query = $pdo->prepare("SELECT * FROM proyecto WHERE id_usuario = ?");
    $query->execute(array($id));
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function allProyectsAdmin(){
    require_once 'templates/db.php';
    $query = $pdo->prepare("SELECT * FROM proyecto");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}



?>