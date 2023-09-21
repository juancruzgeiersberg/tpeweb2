<form class="form-control container" action="registerUser" method="POST">
    <h1>Registro</h1>
    <p>
        <?php
            if (!empty($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }  
        ?>
    </p>
    <div class="form-group mb-3">
        <label for="password">Username:</label>
        <input class="form-control" type="text" name="user" placeholder="Username" required>
    </div>
    <div class="form-group mb-3">
        <label for="password">Password:</label>
        <input class="form-control" type="password" name="password" placeholder="Password" required>
    </div>
    <button class="btn btn-primary" type="submit">Registrarse</button>
    <p>¿Tienes una cuenta? <a href="login">Inicia Sesión</a></p>
</form>