<form class="container form-control" action="add_proyect" method="POST">
    <div class="mb-3">
        <label for="name_proyect" class="form-label">Nombre del Proyecto:</label>
        <input type="text" class="form-control" name="name_proyect" placeholder="Nombre del Proyecto">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Decripción del Proyecto:</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Agregar</button>
</form>