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
    public function getAllProyectsView($result,$users){
        require_once './templates/header.phtml'; ?>
        <form action="proyectByCreator" method="POST">
            <select name="creator" class="form-select form-select-sm">
                <option selected>Elegir Creador</option>
            <?php
                if (!empty($users)){
                    foreach ($users as $obj): ?>
                        <option name="creator" value="<?php echo $obj->nombre ?>"><?php echo $obj->nombre ?></option>;
            <?php        
                    endforeach;
                }
            ?>
            </select>
            <button class="btn btn-outline-primary" type="submit">Select</button>
        </form>
        <?php
        require_once './templates/allproyects.phtml';
        ?>
        
        <?php
        
            if(!empty($result)){
            foreach ($result as $obj): ?>
                <tr>
                    <td><?php echo $obj->creator_user; ?></td>
                    <td><?php echo $obj->nombre_proyecto; ?></td>
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
    public function getProyectsView($result){
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
    public function seeMembers($error=null,$members=null,$proyect=null){
        require_once './templates/header.phtml';
        ?>
        <?php
            if(!empty($proyect)){?>
                <div class="card text-dark bg-light mb-3 mt-3" style="max-width: 18rem;">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $proyect->nombre_proyecto; ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $proyect->descripcion; ?></p>
                    </div>
                    <div class="card-footer"><?php echo "<h5>Participantes: </h5>";
                        if(!empty($members)){
                            foreach ($members as $obj):
                                echo "<p>$obj->nombre</p>";
                            endforeach;}else{
                                echo "<p class='container'>Todavía no hay participantes.</p>";
                            }
                            ?>
                    </div>
                </div>
            <?php }else{
                if(!empty($error)){
                    echo "<h4 class='mt-3 container alert alert-danger'>$error</h4>";
                }
            }
         ?>
        </table>
        <?php require_once './templates/footer.phtml';
    }
}

?>