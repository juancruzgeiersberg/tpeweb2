<?php


//Hay que cambiar el formato de la vista del registro, esto solo es para poder ver sin que dé error.

class RegisterView{

    public function showRegister($error=""){
        require_once 'templates/header.php';
    
        require_once 'templates/register.php';
    
        require_once 'templates/footer.php';
    }

}


?>