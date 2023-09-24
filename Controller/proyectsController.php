<?php

require_once './Model/proyectModel.php';

class ProyectController{

    private $proyectModel;
    private $proyectView;

    public function __construct()
    {
        $this->proyectModel = new ProyectModel();
        $this->proyectView = new ProyectsView();
    }

    public function showProyects($id, $id_rol){
        if($id_rol == 1){
            $this->proyectView->getProyectsView($this->proyectModel->getProyects());
        }else{
            $this->proyectView->getProyectsView($this->proyectModel->getProyectsByID($id));
        }
    }

    public function editProyect(){
        $id = [$_POST['id_proyecto']];
        $this->proyectView->edit_proyect($this->proyectModel->editByID($id));
    }









}