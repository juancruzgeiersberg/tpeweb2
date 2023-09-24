<?php
require_once './Model/UserModel.php';
require_once './view/loginView.php';

class LoginController{

    private $userModel;
    private $loginView;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->loginView = new LoginView();
    }

    public function showLogin(){
        $this->loginView->loginView();
    }


    public function authUser(){
        if(!empty($_POST['user']) && !empty($_POST['password'])){
            $user = $_POST['user'];
            $password = $_POST['password'];
            $userBD = $this->userModel->verifyUser($user);
            if (!empty($userBD) && password_verify($password, ($userBD->contraseña))){
                $_SESSION['id_usuario'] = $userBD->id_usuario;
                $_SESSION['nombre'] = $userBD->nombre;
                $_SESSION['rol'] = $userBD->id_rol;
                header("Location: home");
            }else{
                $this->loginView->loginView("User or Password Incorrect.");
            }
        }else{
            $this->loginView->loginView("You must enter Username and Password.");
        }
    }

    public function disconect(){
        session_destroy();
        header("Location:". BASE_URL . "login");
    }

    public function newRegister(){
        if(!empty($_POST['user']) && !empty($_POST['password'])){
            $this->userModel->registerUser([$_POST['user'],password_hash($_POST['password'], PASSWORD_BCRYPT)],2);
        }
    }





}