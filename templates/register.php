<h1>Registro</h1>
<p>
    <?php
        if (!empty($_SESSION['error'])) {
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        }  
    ?>
</p>
<form action="registerUser" method="POST">
    <div class="form-group">
        <label for="password">Username:</label>
        <input type="text" name="user" placeholder="Username" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Password" required>
    </div>
    <button class="btn btn-primary" type="submit">Registrarse</button>
</form>

<p>¿Tienes una cuenta? <a href="login">Inicia Sesión</a></p>