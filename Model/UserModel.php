<?php


require_once 'templates/db.php';

class UsuerModel {
    private $pdo;

    public function __construct($conexion) {
        $this->pdo = $conexion;
    }

    public function verifyUser($user) {
        $stmt = $this->pdo->prepare('SELECT * FROM usuario WHERE nombre = ?');
        $stmt->execute([$user]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function authUser($user, $password) {
        $userBD = $this->verifyUser($user);
        if (!empty($userBD) && password_verify($password, $userBD->contraseña)) {
            return $userBD;
        }
        return false;
    }
}