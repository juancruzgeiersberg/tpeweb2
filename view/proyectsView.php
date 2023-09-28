<?php

class ProyectsView{
    //Vista del inicio de la pagina "home"
    public function redirectHome($error=""){
        require_once 'templates/header.php';
    
        require_once 'templates/login.php';
    
        require_once 'templates/footer.php';
    }
    //Vista de vinculacion de un usuario a un proyecto
    public function addUserView($id_proyect,$error=""){
        require_once 'templates/header.php';
        require_once './templates/link_user.php';
        require_once 'templates/footer.php';
    }
    //Vista para crear un nuevo proyecto
    public function new_proyect($error=""){
        require_once 'templates/header.php';
        require_once 'templates/new_proyect.php';
        require_once 'templates/footer.php';
    }
    //Vista para editar un proyecto
    public function edit_proyect($edit,$error=""){
        require_once 'templates/header.php';
        require_once 'templates/edit_proyect.php';
        require_once 'templates/footer.php';
    }
    //Vista de todos los proyectos de un usuario
    public function getProyectsView($result){
        require_once 'templates/header.php';
        require_once 'templates/proyects.php';
        ?>
        
        <?php
        if(!empty($result)){
        foreach ($result as $obj): ?>
            <tr>
                <td><?php echo $obj->creator_user; ?></td>
                <td><?php echo $obj->nombre_proyecto; ?></td>
                <td><?php echo $obj->descripcion; ?></td>
                <td><?php echo "<form method='POST' action='add_user'>";
                          echo "<input type='hidden' name='id_proyect' value='" . $obj->id_proyecto . "'>";
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
            echo "<p class='container'>Todavía no tiene proyectos.</p>";
        } ?>
        </table>
        <?php require_once 'templates/footer.php';
    }
}


?>