<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <base href="<?php echo BASE_URL ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header>
    <ul>
        <li><a href="home">Home</a></li>
            <?php
            session_start();
            if(!empty($_SESSION['id_usuario'])){
                echo '<li><a href="proyectos">Proyectos</a></li>';
                echo '<li><a href="disconect">Disconect</a></li>';
            }else{
                echo '<li><a href="login">Login</a></li>';
                echo '<li><a href="register">Register</a></li>';
            }
            ?>
        
    </ul>
</header>
    
