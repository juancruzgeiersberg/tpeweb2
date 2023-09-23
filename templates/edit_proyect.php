<?php require_once 'view/proyectosView.php'; ?>
<form class="container form-control" action="save_edit" method="POST">
        <input type="hidden" name="id_proyecto" value="<?php echo $edit->id_proyecto ?>">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Correo electrónico</label>
            <input type="text" class="form-control" name="edit_name_proyect" value="<?php echo $edit->nombre_proyecto ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea class="form-control" name="edit_description_proyect" rows="5"><?php echo $edit->descripcion ?></textarea>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Edit</button>
        </div>
</form>