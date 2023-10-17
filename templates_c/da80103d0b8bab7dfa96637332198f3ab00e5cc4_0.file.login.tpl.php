<?php
/* Smarty version 4.3.4, created on 2023-10-09 22:23:48
  from 'C:\xampp\htdocs\ProyectoWeb2\tpeweb2\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_6524615465ca37_15327355',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da80103d0b8bab7dfa96637332198f3ab00e5cc4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\ProyectoWeb2\\tpeweb2\\templates\\login.tpl',
      1 => 1696882994,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./template/header.phtml' => 1,
    'file:./template/footer.phtml' => 1,
  ),
),false)) {
function content_6524615465ca37_15327355 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:./template/header.phtml", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form class="container form-control" method="POST" action="access">
    <h1>Iniciar Sesión</h1>
    <div class="form-group mb-3">
        <label for="user" class="form-label">Username: </label>
        <input class="form-control" type="text" name="user" placeholder="Username" required>
    </div>
    <div class="form-group mb-3">
        <label for="contraseña" class="form-label">Password: </label>
        <input class="form-control" type="password" name="password" placeholder="Password" required>
    </div>
    <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
    <p>¿No tienes una cuenta? <a href="register">Regístrate</a></p>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:./template/footer.phtml", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
