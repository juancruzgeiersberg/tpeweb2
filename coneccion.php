<?php
$mysqli = new mysqli("localhost", "root", "", "gestiondedatos");

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
?>
