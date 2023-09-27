<?php require_once './view/proyectsView.php'; ?>
<form class="container form-control" action="save_edit" method="POST">
        <input type="hidden" name="id_proyecto" value="<?php echo $edit->id_proyecto ?>">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nombre del Proyecto:</label>
            <input type="text" class="form-control" name="edit_name_proyect" value="<?php echo $edit->nombre_proyecto ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="edit_description_proyect" rows="5"><?php echo $edit->descripcion ?></textarea>
        </div>
        <?php
            if(!empty($error)){
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>$error</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
            }
        ?>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Edit</button>
        </div>
</form>