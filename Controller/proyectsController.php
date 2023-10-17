<?php

require_once './Model/proyectModel.php';
require_once './view/proyectsView.php';
require_once './helpers/auth.php';

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
    //Muestra el Home
    public function showHome(){
        $this->proyectView->home();
    }
    //Muestra los proyectos
    public function showProyects($id="", $id_rol=""){
            AuthHelper::verify($_SESSION['id_usuario']);
            if($id_rol == 1){
                //Si es Admin muestra todos los proyectos en la tabla
                $this->proyectView->getProyectsView($this->proyectModel->getProyects(),$id_rol);
            }else{
                //Si es usuario normal muestra solo sus proyectos
                $this->proyectView->getProyectsView($this->proyectModel->getProyectsByID($id),$id_rol);
            }
    }
    //Muestra todos los proyectos creados por todos los usuarios
    public function showAllProyects($id_rol=""){
        if(!empty($id_rol)){
            if($this->userModel->getRolID($id_rol) === 'admin'){
                $this->proyectView->getAllProyectsView($this->proyectModel->getProyects(),$id_rol);
            }else{
                $this->proyectView->getAllProyectsView($this->proyectModel->getProyects());
            }
        }else{
            $this->proyectView->getAllProyectsView($this->proyectModel->getProyects());
        }
    }
    //Muestra la vista para crear un proyecto
    public function newProyect(){
        AuthHelper::verify();
        $this->proyectView->new_proyect();
    }
    //Muestra la vista para editar un proyecto
    public function editProyect(){
        AuthHelper::verify();
        $this->proyectView->edit_proyect($this->proyectModel->editByID([$_POST['id_proyect']]),"");
    }
    //Envia los datos al ProyectModel para editarlos
    public function saveEditProyect(){
        AuthHelper::verify();
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
            AuthHelper::init();
            $this->proyectModel->addProyect([$_POST['name_proyect'],$_POST['description'],$_SESSION['id_usuario']]);
            $this->proyectModel->linkProyect([$_SESSION['id_usuario'],$this->proyectModel->lastInsertId()]);
            header("Location:" . BASE_URL . "proyects");
        }else{
            $this->proyectView->new_proyect($this->errorModel->errorProyect());
        }
    }
    //Envía a el modelo el proyecto a eliminar
    public function deleteProyect(){
        $this->proyectModel->delete([$_POST['id_proyecto']]);
        header("Location:". BASE_URL . "proyects");
    }
    //Muestra la vista para agregar un usuario al proyecto
    public function addUserToProyect($id_proyect){
        AuthHelper::init();
        $_SESSION['id_proyect'] = $id_proyect;
        $this->proyectView->addUserView();
    }
    //verifica que exista el usuario y que no esté vinculado al proyecto y luego lo vincula
    public function linkUserProyect($id_user){
        AuthHelper::init();
        $id_proyect = $_SESSION['id_proyect'];
        if($this->userModel->verifyInsert($id_user) != 0){
            if($this->proyectModel->verifyLink([$this->userModel->getUserID($id_user),$id_proyect]) == 0){
                $this->proyectModel->linkProyect([$this->userModel->getUserID($id_user),$id_proyect]);
                header("Location:" . BASE_URL . "proyects");
            }else{
                $this->proyectView->addUserView($this->errorModel->errorLink());
            }
        }else{
            $this->proyectView->addUserView($this->errorModel->errorUserNotExists());
        }
    }
    //Muestra la vista para desvindular un usuario con un proyecto
    public function unlinkUser($id_proyect){
        $_SESSION['id_proyect'] = $id_proyect;
        $this->proyectView->unlinkView();
    }
    //Verifica que haya ingresado un usuario y que el usuario esté vinculado con el proyecto.
    public function removeUser($id_user){
        $id_proyect = $_SESSION['id_proyect'];
        if($this->userModel->verifyInsert($id_user) != 0){
            if($this->proyectModel->verifyLink([$this->userModel->getUserID($id_user),$id_proyect]) != 0){
                $this->proyectModel->unlinkProyect([$this->userModel->getUserID($id_user),$id_proyect]);
                header("Location:" . BASE_URL . "proyects");
            }else{
                $this->proyectView->unlinkView($this->errorModel->errorUnlink());
            }
        }else{
            $this->proyectView->unlinkView($this->errorModel->errorUserNotExists());
        }
    }
    //Muestra la Vista de los miembros de un proyecto
    public function allMembers($id_proyect){
        if($this->proyectModel->verifyProyectExistence($id_proyect) != 0){
            $this->proyectView->seeMembers("",$this->userModel->allMembers($id_proyect),$this->proyectModel->editByID([$id_proyect]));
        }else{
            $this->proyectView->seeMembers($this->errorModel->error404(),"","");
        }
    }
    //Muestra error si no encuntra el action
    public function errorNotFound(){
        $this->errorModel->error404();
    }
}