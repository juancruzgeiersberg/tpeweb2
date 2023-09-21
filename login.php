<?php
/*  conectamos */
function login(){
include('coneccion.php');

/* var */
$usuario = "";
$mensaje = "";

/* obtener datos del formulario */


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];            /*    verifica metodo post y asigna los valores obtenidos */
    $contraseña = $_POST["contraseña"];



/* Verificar usuario en la base de datos */
    $sql = "SELECT id_usuario, nombre, contraseña FROM Usuario WHERE nombre = ?";
    if ($query = $mysqli->prepare($sql)) {
        $query->bind_param("s", $usuario);
        $query->execute();
        $query->store_result();

        if ($query->num_rows == 1) {/*  comprobacion de si existe o hay dicho id_usuario, nombre*/
            $query->bind_result($id, $nombre, $hashAlmacenado);/*  vincula resultados a variables */
            $query->fetch();/*  obtencion del pedido */

            // Verificar la contraseña con password_verify
            if (password_verify($contraseña, $hashAlmacenado)) {
/*             Iniciaria sesion */
             /*    session_start();
                $_SESSION["id_usuario"] = $id;
                $_SESSION["nombre_usuario"] = $nombre; */
                exit();
            } else {
                $mensaje = "No existe.";
                header("Location: templates/home.php");
                exit;
            }
        } else {
            $mensaje = "No existe.";

        }
        $query->close();/* cierrqa pedido */
    }
}
}
?>

    <h1>Iniciar Sesión</h1>
    <form method="post" action="login">
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo $usuario; ?>" required>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </div>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <p>¿No tienes una cuenta? <a href="registro.php">Regístrate</a></p>

    <p><?php echo $mensaje; ?></p>
