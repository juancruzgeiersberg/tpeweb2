<?php
require_once './libs/smarty-4.3.4/libs/Smarty.class.php';

class LoginView{
    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }

    //Vista del login
    public function showLogin($error = null){
        require_once 'templates/header.phtml';
    
        require_once 'templates/login.phtml';
    
        require_once 'templates/footer.phtml';
    }
    
    
}


?>