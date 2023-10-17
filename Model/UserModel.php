<?php
require_once './config.php';


class UserModel {
    //Variable privada
    private $pdo;
    //Constructor con la conexión a la base de datos
    public function __construct() {
        $this->pdo = new PDO("mysql:host=".HOST.";dbname=".DB.";charset=utf8", USER, PASSWORD);
        $this->deploy();
    }
    public function deploy() {
       $query = $this->pdo->query('SHOW TABLES');
        $tables = $query->fetchAll(); // Nos devuelve todas las tablas de la db
        if(count($tables)==0) {
            // Si no hay crearlas
            $sql ='
            --
            -- Estructura de tabla para la tabla `usuario`
            --

            CREATE TABLE `usuario` (
            `id_usuario` int(11) NOT NULL,
            `nombre` varchar(255) NOT NULL,
            `contraseña` varchar(255) NOT NULL,
            `id_rol` int(11) DEFAULT NULL,
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            --
            -- Volcado de datos para la tabla `usuario`
            --

            INSERT INTO `usuario` (`id_usuario`, `nombre`, `contraseña`, `id_rol`) VALUES
            (6, "Miki", "$2y$10$HHYoZ/FyRmaVAk9bUpQwu.lJkSN7d4LPYXsAnSO9SFNVxfyDDwp3K", NULL),
            (7, "mike", "$2y$10$aAFfSiv971VAU5Hnm2IQg.Y2oL3qgz1recQ4rDRTcWxMAAFgcOy7e", NULL),
            (366, "juan", "$2y$10$JQ5xvbbP2XH375xY9e.rl.5VUbC.XZidZVR2wyXoPoH5HnwEMua4O", 2),
            (367, "juanc", "$2y$10$tND9QWdaeOoRTlVYoiHgb.RLb4H.wGMkG9frWXghS57wphPLgX8yu", 2);
            (382, "webadmin", "$2y$10$WT7i1CFPAxzrjnt2HrNofusXBv5jjrTYjaU6WFxEBZ2krRlI4bGVW", 1);
            
            --
                -- Indices de la tabla `usuario`
                --
                ALTER TABLE `usuario`
                ADD PRIMARY KEY (`id_usuario`),
                ADD KEY `id_rol` (`id_rol`);

                --
                -- AUTO_INCREMENT de la tabla `usuario`
                --
                ALTER TABLE `usuario`
                MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;
                
                --
                -- Filtros para la tabla `usuario`
                --
                ALTER TABLE `usuario`
                ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
                COMMIT;';
            $this->pdo->query($sql);
        }
        
    }
    //Verifica si existe el usuario en la base de datos.
    public function verifyUser($user) {
        $sentence = $this->pdo->prepare('SELECT * FROM usuario WHERE nombre = ?');
        $sentence->execute([$user]);
        return $sentence->fetch(PDO::FETCH_OBJ);
    }
    //Verifíca que el usuario no exista
    public function verifyInsert($user){
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM usuario WHERE nombre = ?");
        $query->execute(array($user));
        return $query->fetchColumn();
    }
    //Guarda el nuevo usuario en la base de datos
    public function saveUser($arr){
        $query = $this->pdo->prepare("INSERT INTO `usuario` (`nombre`, `contraseña`, `id_rol`) VALUES (?,?,?)");
        $query->execute($arr);
    }
    //Dado un id devuelve el nombre del usuario
    public function getUserID($user){
        $query = $this->pdo->prepare("SELECT * FROM usuario WHERE nombre = ?");
        $query->execute([$user]);
        return $query->fetch(PDO::FETCH_OBJ)->id_usuario;
    }
    //Retorna el id_rol del usuario
    public function getRolID($id_user){
        $query = $this->pdo->prepare("SELECT nombre_rol FROM roles WHERE id_rol = ?");
        $query->execute([$id_user]);
        return $query->fetch(PDO::FETCH_OBJ)->nombre_rol;
    }
    //Retorna todos los usuarios vinculados a un proyecto
    public function allMembers($sql){
        $query = $this->pdo->prepare("SELECT usuario.nombre
                  FROM usuario
                  INNER JOIN usuario_proyecto 
                  ON usuario.id_usuario = usuario_proyecto.id_usuario
                  WHERE usuario_proyecto.id_proyecto = ?");
        $query->execute([$sql]);
        return  $query->fetchAll(PDO::FETCH_OBJ);
    }

}