<?php



class LoginController{

    private $model;
    private $view;

    public function __construct()
    {
        $this->$model = new UsuerModel();
        $this->$view = new LoginView();
    }












}