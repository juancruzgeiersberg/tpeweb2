<?php
require_once './Model/UserModel.php';
require_once './view/loginView.php';
require_once './Model/ErrorModel.php';
require_once './helpers/auth.php';

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
    //Verifica que el usuario y la contraseña ingresados no sean vacios
    public function authUser(){
        if(!empty($_POST['user']) && !empty($_POST['password'])){
            $user = $_POST['user'];
            $password = $_POST['password'];
            $userBD = $this->userModel->verifyUser($user);
            //Verifica que el usuario exista y la contraseña sea correcta, de ser así crea una sesion
            if (!empty($userBD) && password_verify($password, ($userBD->contraseña))){
                AuthHelper::init();
                $_SESSION['id_usuario'] = $userBD->id_usuario;
                $_SESSION['user'] = $userBD->nombre;
                $_SESSION['rol'] = $userBD->id_rol;
                header("Location: home");
            }else{
                $this->loginView->showLogin($this->errorModel->errorLoginIncorrect());
            }
        }else{
            $this->loginView->showLogin("You must enter Username and Password.");
        }
    }
    //Termina la sesion del usuario
    public function disconect(){
        AuthHelper::init();
        session_destroy();
        header("Location:". BASE_URL . "login");
    }
    //Muestra la vista del login
    public function loginView(){
        $this->loginView->showLogin();
    }







}