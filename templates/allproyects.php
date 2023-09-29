<h1 class="container">Acá va el formato de la página proyectos</h1>
<table class="container table table-striped table-hover">
    <tr>
        <th>Creador</th>
        <th>Nombre del Proyecto</th>
        <th>Descripcion</th>
        <?php
        if(!empty($_SESSION['rol'])){
                if($_SESSION['rol']==1){
            ?>
                    <th>Agregar Participante</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
            <?php
            }
        }
        ?>
    </tr>