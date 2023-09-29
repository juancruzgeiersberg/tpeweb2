<?php


class ProyectModel{

    private $pdo;

    //Constructor con la conexión a la base de datos
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=gestiondedatos;charset=utf8", 'root', '');
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
}

?>