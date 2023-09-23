<?php
require_once 'Model/proyectModel.php';

function new_proyect(){
    require_once 'templates/header.php';
    require_once 'templates/new_proyect.php';
    require_once 'templates/footer.php';
}

function edit_proyect(){
    require_once 'templates/db.php';
    require_once 'templates/header.php';
    $id = [$_POST['id_proyecto']];
    $edit = editByID($id,$pdo);
    require_once 'templates/edit_proyect.php';
    require_once 'templates/footer.php';
}

function showProyects(){
    require_once 'templates/header.php';
    require_once 'templates/proyectos.php';
    $id = $_SESSION['id_usuario'];
    $id_rol = $_SESSION['rol'];
    if($id_rol == 1){
        $result = allProyectsAdmin();
    }else{
        $result = allProyectsByID($id);
    }
    
    ?>
    
    <?php
    if(!empty($result)){
    foreach ($result as $obj): ?>
        <tr>
        <?php
            if ($id_rol == 1){
                ?>
                <td><?php echo $obj->creator_user; ?></td>
                <?php
            }
        ?>
            <td><?php echo $obj->nombre_proyecto; ?></td>
            <td><?php echo $obj->descripcion; ?></td>
            <td><?php echo "<form method='POST' action='edit_proyect'>";
                      echo "<input type='hidden' name='id_proyecto' value='" . $obj->id_proyecto . "'>";
                      echo "<input type='submit' class='btn btn-outline-primary' value='Agregar'>";
                      echo "</form>"?></td>
            <td><?php echo "<form method='POST' action='edit_proyect'>";
                      echo "<input type='hidden' name='id_proyecto' value='" . $obj->id_proyecto . "'>";
                      echo "<input type='submit' class='btn btn-outline-success' value='Editar'>";
                      echo "</form>"?></td>
            <td><?php echo "<form method='POST' action='delete_proyect'>";
                      echo "<input type='hidden' name='id_proyecto' value='" . $obj->id_proyecto . "'>";
                      echo "<input type='submit' class='btn btn-outline-danger' value='Eliminar'>";
                      echo "</form>"?></td>
        </tr>
    <?php endforeach;}else{
        echo "<p>Todavía no tiene proyectos.</p>";
    } ?>
    </table>
    <?php require_once 'templates/footer.php';
}

?>