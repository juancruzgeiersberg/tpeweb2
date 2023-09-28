<?php

class LoginView{

    //Vista del login
    public function showLogin($error = ""){
        require_once 'templates/header.php';
    
        require_once 'templates/login.php';
    
        require_once 'templates/footer.php';
    }
    
    
}


?>