<?php
require_once './config.php';

class ProyectModel{

    private $pdo;
    private $deploy;

    //Constructor con la conexión a la base de datos
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=".HOST.";dbname=".DB.";charset=utf8", USER, PASSWORD);
        $this->deploy();
    }
    //Crea las tablas si no existen
    public function deploy() {
        $query = $this->pdo->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables)==0) {
            $sql =<<<END
                --
                -- Estructura de tabla para la tabla `proyecto`
                --

                CREATE TABLE `proyecto` (
                `id_proyecto` int(11) NOT NULL,
                `nombre_proyecto` varchar(255) NOT NULL,
                `descripcion` text DEFAULT NULL,
                `id_usuario` int(11) DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

                --
                -- Volcado de datos para la tabla `proyecto`
                --

                INSERT INTO `proyecto` (`id_proyecto`, `nombre_proyecto`, `descripcion`, `id_usuario`) VALUES
                (2, 'TPE Web 2', 'Terminar la parte final del tpe', 366),
                (5, 'TPE Ingles', 'Terminar la parte final del tpe', 366),
                (6, 'Página Web', 'Crear una página web', 367),

                -- --------------------------------------------------------

                --
                -- Estructura de tabla para la tabla `roles`
                --

                CREATE TABLE `roles` (
                `id_rol` int(11) NOT NULL,
                `nombre_rol` varchar(50) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

                --
                -- Volcado de datos para la tabla `roles`
                --

                INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
                (1, 'admin'),
                (2, 'usuario');

                ----------------------------------------------------------
                --
                -- Índices para tablas volcadas
                --

                --
                -- Indices de la tabla `proyecto`
                --
                ALTER TABLE `proyecto`
                ADD PRIMARY KEY (`id_proyecto`),
                ADD KEY `id_usuario` (`id_usuario`);

                --
                -- Indices de la tabla `roles`
                --
                ALTER TABLE `roles`
                ADD PRIMARY KEY (`id_rol`);

                --
                -- AUTO_INCREMENT de las tablas volcadas
                --

                --
                -- AUTO_INCREMENT de la tabla `proyecto`
                --
                ALTER TABLE `proyecto`
                MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

                --
                -- AUTO_INCREMENT de la tabla `roles`
                --
                ALTER TABLE `roles`
                MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


                --
                -- Restricciones para tablas volcadas
                --

                --
                -- Filtros para la tabla `proyecto`
                --
                ALTER TABLE `proyecto`
                ADD CONSTRAINT `proyecto_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

                --
                -- Filtros para la tabla `usuario`
                --
                COMMIT;
            END;
            $this->pdo->query($sql);
        }
        
    }
    //Elimina un proyecto por id
    public function delete($id_proyect){
        $this->sqlExecute("DELETE FROM `proyecto` WHERE id_proyecto = ?", $id_proyect);
    }
    //Retorna el proyecto que el usuario quiere editar.
    public function editByID($id){
        $sqlexecute = $this->pdo->prepare("SELECT * FROM proyecto WHERE id_proyecto = ?");
        $sqlexecute->execute($id);
        return $sqlexecute->fetch(PDO::FETCH_OBJ);
    }
    //Guarda el proyecto editado por el usuario
    public function saveEdit($editProyect){
        $this->sqlExecute("UPDATE `proyecto` SET `nombre_proyecto`=?,`descripcion`=? WHERE id_proyecto = ?",$editProyect);
    }
    //Agrega un nuevo proyecto
    public function addProyect($query){
        $this->sqlExecute("INSERT INTO `proyecto`(`nombre_proyecto`, `descripcion`, `id_usuario`) VALUES (?,?,?)",$query);
    }
    //Obtiene el id del ultimo proyecto agregado
    public function lastInsertId(){
        return $this->pdo->lastInsertId();
    }
    //Vincula un usuario con un proyecto en la tabla usuario_proyecto
    public function linkProyect($date){
        $query = $this->pdo->prepare("INSERT INTO `usuario_proyecto` (`id_usuario`, `id_proyecto`) VALUES (?,?)");
        $query->execute($date);
    }
    //Desvincula un usuario con un proyecto en la tabla usuario_proyecto
    public function unlinkProyect($data){
        $query = $this->pdo->prepare("DELETE FROM `usuario_proyecto` WHERE `id_usuario` = ? AND `id_proyecto` = ?");
        $query->execute($data);
    }
    //Verifica si el usuario está o no vinculado al proyecto
    public function verifyLink($sql){
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM usuario_proyecto WHERE id_usuario=? AND id_proyecto=?");
        $query->execute($sql);
        return $query->fetchColumn();
    }
    //Hace las ejecuciones sql
    public function sqlExecute($query, $sql){
        $sqlexecute = $this->pdo->prepare($query);
        $sqlexecute->execute($sql);
    }
    //Devuelve todos los proyectos que tiene un usuario
    public function getProyectsByID($id){
        $query = $this->pdo->prepare("SELECT
        proyecto.id_proyecto,
        proyecto.nombre_proyecto,
        proyecto.descripcion,
        usuario.nombre AS creator_user
        FROM proyecto 
        INNER JOIN usuario 
        ON proyecto.id_usuario = usuario.id_usuario
        WHERE proyecto.id_usuario = ?");
        $query->execute(array($id));
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //Devuelve todos los proyectos que tiene la base de datos
    public function getProyects(){
        $query = $this->pdo->prepare("SELECT
        proyecto.id_proyecto,
        proyecto.nombre_proyecto,
        proyecto.descripcion,
        usuario.nombre AS creator_user
        FROM proyecto
        INNER JOIN usuario ON proyecto.id_usuario = usuario.id_usuario");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //Devuelve todos los proyectos que tiene la base de datos
    public function getAllProyects(){
        $query = $this->pdo->prepare("SELECT * FROM proyecto");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //Devuelve 1 si existe el proyecto o 0 si no existe
    public function verifyProyectExistence($id_proyect){
        $query = $this->pdo->prepare("SELECT COUNT(*) FROM proyecto WHERE id_proyecto = ?");
        $query->execute([$id_proyect]);
        return $query->fetchColumn();
    }
}

?>