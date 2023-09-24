<?php


require_once 'templates/db.php';

class UserModel {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=gestiondedatos;charset=utf8", 'root', '');
    }

    public function verifyUser($user) {
        $sentence = $this->pdo->prepare('SELECT * FROM usuario WHERE nombre = ?');
        $sentence->execute([$user]);
        return $sentence->fetch(PDO::FETCH_OBJ);
    }

    public function authUser($user, $password) {
        $userBD = $this->verifyUser($user);
        if (!empty($userBD) && password_verify($password, $userBD->contraseña)) {
            return $userBD;
        }
        return false;
    }
}