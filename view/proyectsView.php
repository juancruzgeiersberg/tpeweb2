<?php

class ProyectsView{
    public function home(){
        require_once './templates/header.phtml';
        require_once './templates/home.phtml';
        require_once './templates/footer.phtml';
    }
    //Vista del inicio de la pagina "home"
    public function redirectHome($error=""){
        require_once './templates/header.phtml';
        require_once './templates/login.phtml';
        require_once './templates/footer.phtml';
    }
    //Vista de vinculacion de un usuario a un proyecto
    public function addUserView($error=""){
        require_once './templates/header.phtml';
        require_once './templates/link_user.phtml';
        require_once './templates/footer.phtml';
    }
    //Vista para crear un nuevo proyecto
    public function new_proyect($error=""){
        require_once './templates/header.phtml';
        require_once './templates/new_proyect.phtml';
        require_once './templates/footer.phtml';
    }
    //Vista para editar un proyecto
    public function edit_proyect($edit,$error=""){
        require_once './templates/header.phtml';
        require_once './templates/edit_proyect.phtml';
        require_once './templates/footer.phtml';
    }
    //Vista para remover un usuario de un proyecto
    public function unlinkView($error=""){
        require_once './templates/header.phtml';
        require_once './templates/remove_user.phtml';
        require_once './templates/footer.phtml';
    }
    //Vista de todos los proyectos que existen
    public function getAllProyectsView($result){
        require_once './templates/header.phtml';
        require_once './templates/allproyects.phtml';
        ?>
        
        <?php
        
            if(!empty($result)){
            foreach ($result as $obj): ?>
                <tr>
                    <td><?php echo $obj->creator_user; ?></td>
                    <td><?php echo $obj->nombre_proyecto; ?></td>
                    <td><?php echo $obj->descripcion; ?></td>
                    <td><?php echo "<form method='POST' action='members'>";
                                echo "<input type='hidden' name='id_proyect' value='" . $obj->id_proyecto . "'>";
                                echo "<input type='submit' class='btn btn-outline-danger' value='Ver'>";
                                echo "</form>"?></td>
                <?php 
                    if(!empty($_SESSION['rol'])){ 
                        if($_SESSION['rol'] == 1){
                ?>
                        <td><?php echo "<form method='POST' action='add_user'>";
                                echo "<input type='hidden' name='id_proyect' value='" . $obj->id_proyecto . "'>";
                                echo "<input type='submit' class='btn btn-outline-primary' value='Agregar'>";
                                echo "</form>";
                                echo "<form method='POST' action='unlink_user'>";
                                echo "<input type='hidden' name='id_proyect' value='" . $obj->id_proyecto . "'>";
                                echo "<input type='submit' class='btn btn-outline-danger' value=' Quitar  '>";
                                echo "</form>"?></td>
                        <td><?php echo "<form method='POST' action='edit_proyect'>";
                                echo "<input type='hidden' name='id_proyecto' value='" . $obj->id_proyecto . "'>";
                                echo "<input type='submit' class='btn btn-outline-success' value='Editar'>";
                                echo "</form>"?></td>
                        <td><?php echo "<form method='POST' action='delete_proyect'>";
                                echo "<input type='hidden' name='id_proyecto' value='" . $obj->id_proyecto . "'>";
                                echo "<input type='submit' class='btn btn-outline-danger' value='Eliminar'>";
                                echo "</form>"?></td>
                <?php   
                        }
                    } 
                ?>
                </tr>
            <?php endforeach;}else{
                echo "<p class='container'>Todavía no hay proyectos.</p>";
            }
         ?>
        </table>
        <?php require_once './templates/footer.phtml';
    }
    //Vista de todos los proyectos de un usuario
    public function getProyectsView($result,){
        require_once './templates/header.phtml';
        require_once './templates/proyects.phtml';
        ?>
        
        <?php
        
            if(!empty($result)){
            foreach ($result as $obj): ?>
                <tr>
                    <td><?php echo $obj->creator_user; ?></td>
                    <td><?php echo $obj->nombre_proyecto; ?></td>
                    <td><?php echo $obj->descripcion; ?></td>
                    <td><?php echo "<form method='POST' action='members'>";
                            echo "<input type='hidden' name='id_proyect' value='" . $obj->id_proyecto . "'>";
                            echo "<input type='submit' class='btn btn-outline-danger' value='Ver'>";
                            echo "</form>"?></td>
                <?php 
                    if(!empty($_SESSION['user'])){ 
                ?>
                        <td><?php echo "<form method='POST' action='add_user'>";
                                echo "<button type='submit' name='id_proyect' class='btn btn-outline-primary' value='$obj->id_proyecto'>Add</button>";
                                echo "</form>";?></td>
                        <td><?php echo "<form method='POST' action='unlink_user'>";
                                echo "<input type='hidden' name='id_proyect' value='" . $obj->id_proyecto . "'>";
                                echo "<input type='submit' class='btn btn-outline-danger' value='Quitar'>";
                                echo "</form>"?></td>
                        <td><?php echo "<form method='POST' action='edit_proyect'>";
                                echo "<input type='hidden' name='id_proyect' value='" . $obj->id_proyecto . "'>";
                                echo "<input type='submit' class='btn btn-outline-success' value='Edit'>";
                                echo "</form>"?></td>
                        <td><?php echo "<form method='POST' action='delete_proyect'>";
                                echo "<input type='hidden' name='id_proyecto' value='" . $obj->id_proyecto . "'>";
                                echo "<input type='submit' class='btn btn-outline-danger' value='Del'>";
                                echo "</form>"?></td>
                <?php   
                    } 
                ?>
                </tr>
            <?php endforeach;}else{
                echo "<p class='container'>Todavía no hay proyectos.</p>";
            }
         ?>
        </table>
        <?php require_once './templates/footer.phtml';
    }
    //Vista de los miembros de un proyecto
    public function seeMembers($result){
        require_once './templates/header.phtml';
        require_once './templates/all_members.phtml';
        ?>
        <?php
            if(!empty($result)){
            foreach ($result as $obj): ?>
                <tr>
                    <td><?php echo $obj->nombre; ?></td>
                </tr>
            <?php endforeach;}else{
                echo "<p class='container'>Todavía no hay proyectos.</p>";
            }
         ?>
        </table>
        <?php require_once './templates/footer.phtml';
    }
}

?>