<?php



class UserModel {
    //Variable privada
    private $pdo;
    //Constructor con la conexión a la base de datos
    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=gestiondedatos;charset=utf8", 'root', '');
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