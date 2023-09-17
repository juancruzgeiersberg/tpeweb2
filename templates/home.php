<?php

function home(){
    require "templates/header.php";
    ?>
    <h2>Iniciar sesión</h2>
    <form action="procesar_login.php" method="POST">
        <label for="nombre_usuario">Nombre de usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br><br>
        
        <input type="submit" value="Iniciar sesión">
    </form>
    
    <?php
    require "templates/footer.php";
}

function verify($user, $password){
    require_once 'templates/db.php';
}
