<?php

class LoginView{


    public function loginView($error = ""){
        require_once 'templates/header.php';
    
        require_once 'templates/login.php';
    
        require_once 'templates/footer.php';
    }
    
    public function registerView(){
        require_once 'templates/header.php';
    
        require_once 'templates/register.php';
    
        require_once 'templates/footer.php';
    }
    
}


?>