<form class="form-control container" action="registerUser" method="POST">
    <h1>Registro</h1>
    <?php
            if (!empty($_SESSION['error'])) {?>
                <p><?php echo $_SESSION['error']; ?></p>
                <?php unset($_SESSION['error']);
            }  
        ?>
    <div class="form-group mb-3">
        <label for="password" class="form-label">Username:</label>
        <input class="form-control" type="text" name="user" placeholder="Username" required>
    </div>
    <div class="form-group mb-3">
        <label for="password" class="form-label">Password:</label>
        <input class="form-control" type="password" name="password" placeholder="Password" required>
    </div>
    <button class="btn btn-primary" type="submit">Registrarse</button>
    <p>¿Tienes una cuenta? <a href="login">Inicia Sesión</a></p>
</form>