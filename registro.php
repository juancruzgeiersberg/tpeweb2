<?php
/* Pagina de Resgistro  */
include('coneccion.php'); //configuración y añadido de la base de datos

$nombre = "";
$contraseña = "";
$mensaje = "";


   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];                     /* mismo proposito que en loigin */
    $contraseña = $_POST["contraseña"];
 /* guard name y contra */

    //nombre de usuario ya existe en la base de datos?
    $sql = "SELECT id_usuario FROM Usuario WHERE nombre = ?";
    if ($query = $mysqli->prepare($sql)) {
        $query->bind_param("s", $nombre); /* vincula o anexa el  */
        $query->execute();/*  ejecucion de pedido a la BDD */

        $query->store_result();/* almacena el resultado de la consulta */

        if ($query->num_rows > 0) { /* recorre parametro en busca de usuario = usuarionuevo */
            $mensaje = "ya existe."; /* si es mayor a 0 ya existe dicho usuario */
        } else {
            // Insertar el nuevo usuario en la base de datos
            $sql = "INSERT INTO Usuario (nombre, contraseña) VALUES (?, ?)";
            if ($query = $mysqli->prepare($sql)) {
                $hashedContraseña = password_hash($contraseña, PASSWORD_DEFAULT); // Hash de la contraseña
                $query->bind_param("ss", $nombre, $hashedContraseña);/* se obtienen resultados anidados y en string (s) */

                if ($query->execute()) {
                    $mensaje = "¡ exitoso!<a href='login.php'> iniciar sesión</a>.";
                } else {
                    $mensaje = " error al registrar";
                }
            }
        }

        $query->close();/*  cierra consulta */

    }}
?>
    parte<!--  web -->
<!DOCTYPE html>
<html>
<head>
    <title>Registrate</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Registro</h1>
    <form method="post" action="">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </div>
        <button type="submit">Registrarse</button>
    </form>
    <p><?php echo $mensaje; ?></p>
    <p>¿Tienes una cuenta? <a href="login.php">Inicia Sesión</a></p>
</body>
</html>
