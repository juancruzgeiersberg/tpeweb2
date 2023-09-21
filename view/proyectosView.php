<?php

function allProyects($id){
    require_once 'templates/db.php';
    $query = $pdo->prepare("SELECT * FROM proyecto WHERE id_usuario = ?");
    $query->execute(array($id));
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function showProyects(){
    require_once 'templates/header.php';
    require_once 'templates/proyectos.php';
    $id = $_SESSION['id_usuario'];
    $result = allProyects($id);
    ?>
    <table border="1">
    <tr>
        <th>Nombre del Proyecto</th>
        <th>Descripcion</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
    <?php
    foreach ($result as $obj): ?>
        <tr>
            <td><?php echo $obj->nombre_proyecto; ?></td>
            <td><?php echo $obj->descripcion; ?></td>
            <td><?php echo "<form method='POST' action='edit_proyect'>";
                      echo "<input type='hidden' name='id_proyecto' value='" . $obj->id_proyecto . "'>";
                      echo "<input type='submit' value='Editar'>";
                      echo "</form>"?></td>
            <td><?php echo "<form method='POST' action='delete_proyect'>";
                      echo "<input type='hidden' name='id_proyecto' value='" . $obj->id_proyecto . "'>";
                      echo "<input type='submit' value='Eliminar'>";
                      echo "</form>"?></td>
        </tr>
    <?php endforeach; ?>
    </table>
    <?php require_once 'templates/footer.php';
}

?>