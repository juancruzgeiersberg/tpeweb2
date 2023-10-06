<?php
/* Smarty version 4.3.4, created on 2023-10-06 23:11:12
  from 'C:\xampp\htdocs\ProyectoWeb2\tpeweb2\templates\login.phtml' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_652077f00ba3b3_66895133',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fdfd4a55b28bf314a875449f0f009125c78ca95' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ProyectoWeb2\\tpeweb2\\templates\\login.phtml',
      1 => 1696626651,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_652077f00ba3b3_66895133 (Smarty_Internal_Template $_smarty_tpl) {
?><form class="container form-control" method="POST" action="access">
    <h1>Iniciar Sesión</h1>
    <div class="form-group mb-3">
        <label for="user" class="form-label">Username: </label>
        <input class="form-control" type="text" name="user" placeholder="Username" required>
    </div>
    <div class="form-group mb-3">
        <label for="contraseña" class="form-label">Password: </label>
        <input class="form-control" type="password" name="password" placeholder="Password" required>
    </div>
    <?php echo '<?php'; ?>
 if(!empty($error)){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>$error</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    } <?php echo '?>'; ?>

    <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
    <p>¿No tienes una cuenta? <a href="register">Regístrate</a></p>
</form><?php }
}
