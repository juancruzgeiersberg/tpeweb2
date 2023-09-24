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
    //Si el usuario ingresado es correcto lo retorna
    public function authUser($user, $password) {
        $userBD = $this->verifyUser($user);
        if (!empty($userBD) && password_verify($password, $userBD->contraseña)) {
            return $userBD;
        }
        return false;
    }
    //Registra el usuario ingresado después de validarlo.
    public function registerUser(){
        $arr = [$_POST['user'],password_hash($_POST['password'], PASSWORD_BCRYPT)];
        $rol = 2;
    
        if($this->verifyInsert($arr[0])){
            $this->saveUser($arr,$rol);
            header("Location:". BASE_URL . "home");
        }else{
            session_start();
            $_SESSION['error'] = "El usuario ingresado ya existe.";
            header("Location:". BASE_URL . "register");
        }
    }
    //Verifíca que el usuario no exista
    public function verifyInsert($user){
        $checkQuery = "SELECT COUNT(*) FROM usuario WHERE nombre = ?";
        $query = $this->pdo->prepare($checkQuery);
        $query->execute(array($user));
        if($query->fetchColumn() == 0){
            return true;
        }else{
            return false;
        }
    }
    //Guarda el usuario en la base de datos
    public function saveUser($arr, $rol){
        $query = $this->pdo->prepare("INSERT INTO `usuario` (`nombre`, `contraseña`, `id_rol`) VALUES (?,?,?)");
        $query->execute(array($arr[0],$arr[1],$rol));
    }

}