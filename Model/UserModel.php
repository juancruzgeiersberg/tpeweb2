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

}