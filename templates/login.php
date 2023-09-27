
<?php require_once './view/loginView.php' ?>
<form class="container form-control" method="POST" action="access">
    <h1>Iniciar Sesión</h1>
    <div class="form-group mb-3">
        <label for="user" class="form-label">Username: </label>
        <input class="form-control" type="text" name="user" placeholder="Username" required>
    </div>
    <div class="form-group mb-3">
        <label for="contraseña" class="form-label">Password: </label>
        <input class="form-control" type="password" name="password" placeholder="Password" required>
    </div>
    <?php if(!empty($error)){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>$error</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    } ?>
    <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
    <p>¿No tienes una cuenta? <a href="register">Regístrate</a></p>
</form>
