<h1 class="container">Acá va el formato de la página proyectos</h1>
<table class="container table table-striped table-hover">
    <tr>
        <th>Creador</th>
        <th>Nombre del Proyecto</th>
        <th>Descripcion</th>
        <th>Ver Participantes</th>
        <?php
            if(!empty($_SESSION['user'])){
        ?>
                <th>Agregar Participante</th>
                <th>Quitar</th>
                <th>Editar</th>
                <th>Eliminar</th>
        <?php
            }
        ?>
    </tr>