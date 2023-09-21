<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="<?php echo BASE_URL ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<header class="container">
    <ul class="container nav nav-pills">
            <?php
            session_start();
            if(!empty($_SESSION['id_usuario'])){
                echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="home">Home</a></li>';
                echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="proyectos">Proyectos</a></li>';
                echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="new_proyect">Nuevo Proyecto</a></li>';
                echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="disconect"><span class="badge bg-danger">Usuario:' . $_SESSION['nombre'] . ' Disconect</span></a></li>';
            }else{
                echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="home">Home</a></li>';
                echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="login">Login</a></li>';
                echo '<li class="nav-item"><a class="nav-link" aria-current="page" href="register">Register</a></li>';
            }
            ?>
        <span></span>
    </ul>
</header>
    
