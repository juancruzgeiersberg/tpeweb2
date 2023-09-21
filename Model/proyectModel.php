<?php

function deleteProyect(){
    require_once 'templates/db.php';
    $id_proyect = [$_POST['id_proyecto']];
    $query = "DELETE FROM `proyecto` WHERE id_proyecto = ?";
    sqlExecute($query, $id_proyect, $pdo);
    header("Location:". BASE_URL . "proyectos");
}

function editByID($id,$pdo){
    $query = "SELECT * FROM proyecto WHERE id_proyecto = ?";
    $sqlexecute = $pdo->prepare($query);
    $sqlexecute->execute($id);
    return $sqlexecute->fetch(PDO::FETCH_OBJ);
}

 function saveEdit(){
     require 'templates/db.php';
     session_start();
     $editProyect = [$_POST['edit_name_proyect'],$_POST['edit_description_proyect'],$_POST['id_proyecto']];
     $query = "UPDATE `proyecto` SET `nombre_proyecto`=?,`descripcion`=? WHERE id_proyecto = ?";
    sqlExecute($query,$editProyect,$pdo);
    header("Location:" . BASE_URL . "proyectos");
 }

function addProyect(){
    require_once 'templates/db.php';
    session_start();
    $add = [$_POST['name_proyect'],$_POST['description'],$_SESSION['id_usuario']];
    $query = "INSERT INTO `proyecto`(`nombre_proyecto`, `descripcion`, `id_usuario`) VALUES (?,?,?)";
    sqlExecute($query,$add,$pdo);
    header("Location:" . BASE_URL . "proyectos");
}

function sqlExecute($query, $sql, $pdo){
    $sqlexecute = $pdo->prepare($query);
    $sqlexecute->execute($sql);
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