<?php

function deleteProyect(){
    require 'templates/db.php';
    $id_proyect = $_POST['id_proyecto'];
    $query = "DELETE FROM `proyecto` WHERE id_proyecto = ?";
    deleteOrEdit($query, $id_proyect, $pdo);
    header("Location:". BASE_URL . "proyectos");
}
//no tiene nada todavía, ya se subirá el borrador.
// function editProyect(){
//     require 'templates/db.php';
    
// }


function deleteOrEdit($query, $sql, $pdo){
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($sql));
}



?>