<?php

class ProyectsView{

    public function redirectHome($error=""){
        require_once 'templates/header.php';
    
        require_once 'templates/login.php';
    
        require_once 'templates/footer.php';
    }

    public function new_proyect(){
        require_once 'templates/header.php';
        require_once 'templates/new_proyect.php';
        require_once 'templates/footer.php';
    }
    
    public function edit_proyect($edit){
        require_once 'templates/header.php';
        require_once 'templates/edit_proyect.php';
        require_once 'templates/footer.php';
    }
    
    public function getProyectsView($result){
        require_once 'templates/header.php';
        require_once 'templates/proyectos.php';
        ?>
        
        <?php
        if(!empty($result)){
        foreach ($result as $obj): ?>
            <tr>
                <td><?php echo $obj->creator_user; ?></td>
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
            echo "<p class='container'>Todavía no tiene proyectos.</p>";
        } ?>
        </table>
        <?php require_once 'templates/footer.php';
    }
}


?>