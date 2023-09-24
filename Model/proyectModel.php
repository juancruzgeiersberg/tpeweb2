<?php


class ProyectModel{

    private $pdo;

    //Constructor con la conexión a la base de datos
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=gestiondedatos;charset=utf8", 'root', '');
    }

    //Elimina un proyecto por id
    public function deleteProyect(){
        $id_proyect = [$_POST['id_proyecto']];
        $this->sqlExecute("DELETE FROM `proyecto` WHERE id_proyecto = ?", $id_proyect);
        header("Location:". BASE_URL . "proyects");
    }

    //Retorna el proyecto que el usuario quiere editar.
    public function editByID($id){
        $sqlexecute = $this->pdo->prepare("SELECT * FROM proyecto WHERE id_proyecto = ?");
        $sqlexecute->execute($id);
        return $sqlexecute->fetch(PDO::FETCH_OBJ);
    }

    //Guarda el proyecto editado por el usuario
    public function saveEdit(){
        $editProyect = [$_POST['edit_name_proyect'],$_POST['edit_description_proyect'],$_POST['id_proyecto']];
        $this->sqlExecute("UPDATE `proyecto` SET `nombre_proyecto`=?,`descripcion`=? WHERE id_proyecto = ?",$editProyect);
        header("Location:" . BASE_URL . "proyects");
    }

    //Agrega un nuevo proyecto
    public function addProyect(){
        session_start();
        $add = [$_POST['name_proyect'],$_POST['description'],$_SESSION['id_usuario']];
        $this->sqlExecute("INSERT INTO `proyecto`(`nombre_proyecto`, `descripcion`, `id_usuario`) VALUES (?,?,?)",$add);
        header("Location:" . BASE_URL . "proyects");
    }

    //Conecta un usuario con un proyecto en la tabla usuario_proyecto
    public function linkProyect(){
        
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
        INNER JOIN usuario ON proyecto.id_usuario = usuario.id_usuario
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

}

?>