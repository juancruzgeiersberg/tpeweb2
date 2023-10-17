<?php
/* Smarty version 4.3.4, created on 2023-10-18 00:18:53
  from 'C:\xampp\htdocs\ProyectoWeb2\tpeweb2\templates\header.phtml' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_652f084d837d07_19249101',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73f83c0570a3868b4969edb4f01c5a0920499d86' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ProyectoWeb2\\tpeweb2\\templates\\header.phtml',
      1 => 1697542148,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_652f084d837d07_19249101 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="<?php echo '<?php'; ?>
 echo BASE_URL <?php echo '?>'; ?>
">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="container">
<header class="container">
    <ul class="container nav nav-pills">
            <?php echo '<?php'; ?>

                echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="home">Home</a></li>';
                echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="allproyects">Todos los Proyectos</a></li>';
                AuthHelper::init();
            if(!empty($_SESSION['id_usuario'])){
                if($_SESSION['rol'] == 2){
                    echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="proyects">Proyectos propios</a></li>';
                }
                echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="new_proyect">Nuevo Proyecto</a></li>';
                echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="disconect"><span class="badge bg-danger">Usuario:' . $_SESSION['user'] . ' Disconect</span></a></li>';
            }else{
                echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="login">Login</a></li>';
                echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="register">Register</a></li>';
            }
            <?php echo '?>'; ?>

        <span></span>
    </ul>
</header>
    
<?php }
}
