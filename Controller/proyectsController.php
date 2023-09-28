<?php

require_once './Model/proyectModel.php';
require_once './view/proyectsView.php';

class ProyectController{

    private $proyectModel;
    private $errorModel;
    private $userModel;
    private $proyectView;
    //Constructor del Modelo y la Vista
    public function __construct()
    {
        $this->proyectModel = new ProyectModel();
        $this->userModel = new UserModel();
        $this->errorModel = new ErrorModel();
        $this->proyectView = new ProyectsView();
    }
    //Muestra los proyectos
    public function showProyects($id, $id_rol){
        if($id_rol == 1){
            //Si es Admin muestra todos los proyectos en la tabla
            $this->proyectView->getProyectsView($this->proyectModel->getProyects());
        }else{
            //Si es usuario normal muestra solo sus proyectos
            $this->proyectView->getProyectsView($this->proyectModel->getProyectsByID($id));
        }
    }
    //Muestra la vista para crear un proyecto
    public function newProyect(){
        $this->proyectView->new_proyect();
    }
    //Muestra la vista para editar un proyecto
    public function editProyect(){
        $this->proyectView->edit_proyect($this->proyectModel->editByID([$_POST['id_proyecto']]),"");
    }
    //Envia los datos al ProyectModel para editarlos
    public function saveEditProyect(){
        if(!empty($_POST['edit_name_proyect'])){
            $this->proyectModel->saveEdit([$_POST['edit_name_proyect'],$_POST['edit_description_proyect'],$_POST['id_proyecto']]);
            header("Location:" . BASE_URL . "proyects");
        }else{
            $this->proyectView->edit_proyect($this->proyectModel->editByID([$_POST['id_proyecto']]),$this->errorModel->errorProyect());
        }
    }
    //Inserta un proyecto nuevo y lo vincula con el usuario
    public function insertProyect(){
        if(!empty($_POST['name_proyect'])){
            $this->proyectModel->addProyect([$_POST['name_proyect'],$_POST['description'],$_SESSION['id_usuario']]);
            $this->proyectModel->linkProyect([$_SESSION['id_usuario'],$this->proyectModel->lastInsertId()]);
            header("Location:" . BASE_URL . "proyects");
        }else{
            $this->proyectView->new_proyect($this->errorModel->errorProyect());
        }
    }
    //Elimina un proyecto
    public function deleteProyect(){
        $this->proyectModel->delete([$_POST['id_proyecto']]);
        header("Location:". BASE_URL . "proyects");
    }
    //Muestra la vista para agregar un usuario al proyecto
    public function addUserToProyect($id_proyect){
        $this->proyectView->addUserView($_POST['id_proyect']);
    }
    //verifica que exista el usuario y que no esté vinculado al proyecto y luego lo vincula
    public function linkUserProyect($id_proyect){
        if($this->userModel->verifyInsert($_POST['username']) != 0){
            if(empty($this->proyectModel->verifyLink([$_POST['username'],$id_proyect]))){
                $this->proyectModel->linkProyect([$this->userModel->getUserID($_POST['username'])->id_usuario,$id_proyect]);
                header("Location:" . BASE_URL . "proyects");
            }else{
                $this->proyectView->addUserView($id_proyect,$this->errorModel->errorLink());
            }
        }else{
            $this->proyectView->getProyectsView($this->errorModel->errorUserNotExists());
        }
    }

}