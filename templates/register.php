<form class="form-control container" action="registerUser" method="POST">
    <h1>Registro</h1>
    <div class="form-group mb-3">
        <label for="password" class="form-label">Username:</label>
        <input class="form-control" type="text" name="user" placeholder="Username" required>
    </div>
    <div class="form-group mb-3">
        <label for="password" class="form-label">Password:</label>
        <input class="form-control" type="password" name="password" placeholder="Password" required>
    </div>
    <?php
        if (!empty($error)) {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>$error</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }  
    ?>
    <button class="btn btn-primary" type="submit">Registrarse</button>
    <p>¿Tienes una cuenta? <a href="login">Inicia Sesión</a></p>
</form>