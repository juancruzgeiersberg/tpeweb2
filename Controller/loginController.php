<?php
require_once './Model/UserModel.php';
require_once './view/loginView.php';
require_once './Model/ErrorModel.php';

class LoginController{

    private $userModel;
    private $loginView;
    private $errorModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->loginView = new LoginView();
        $this->errorModel = new ErrorModel();
    }


    public function authUser(){
        if(!empty($_POST['user']) && !empty($_POST['password'])){
            $user = $_POST['user'];
            $password = $_POST['password'];
            $userBD = $this->userModel->verifyUser($user);
            if (!empty($userBD) && password_verify($password, ($userBD->contraseña))){
                session_start();
                $_SESSION['id_usuario'] = $userBD->id_usuario;
                $_SESSION['nombre'] = $userBD->nombre;
                $_SESSION['rol'] = $userBD->id_rol;
                header("Location: home");
            }else{
                $this->loginView->showLogin($this->errorModel->errorLoginIncorrect());
            }
        }else{
            $this->loginView->showLogin("You must enter Username and Password.");
        }
    }

    public function disconect(){
        session_destroy();
        header("Location:". BASE_URL . "login");
    }

    public function loginView(){
        $this->loginView->showLogin();
    }







}