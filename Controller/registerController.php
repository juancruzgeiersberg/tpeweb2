<?php
require_once './Model/ErrorModel.php';
require_once './view/registerView.php';

class RegisterController{

    private $registerModel;
    private $registerView;
    private $errorModel;
    //Constructor del modelo y la vista
    public function __construct()
    {
        $this->registerModel = new UserModel();
        $this->registerView = new RegisterView();
        $this->errorModel = new ErrorModel();
    }
    //Verifica el usuario que se quiere registrar y luego envía los datos al modelo
    public function newUser(){
        if(!empty($_POST['user']) && !empty($_POST['password'])){
            if($this->registerModel->verifyInsert($_POST['user']) == 0){
                $this->registerModel->saveUser([$_POST['user'],password_hash($_POST['password'], PASSWORD_BCRYPT),2]);
                header("Location:". BASE_URL . "home");
            }else{
                $_SESSION['error'] = $this->errorModel->errorUserExists();
                header("Location:". BASE_URL . "register");
            }
        }else{
            $_SESSION['error'] = $this->errorModel->errorRegister();
            header("Location:". BASE_URL . "register");
        }
    }

    public function registerView(){
        $this->registerView->showRegister();
    }

    
}