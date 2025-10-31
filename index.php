<?php
$title = "Inicio de Sesión";

ob_start(); // Captura el contenido del body
?>
<div class="form-card">
    <h2>Iniciar Sesión</h2>
    <form action="#" method="post" class="login-form">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar sesión</button>
    </form>
</div>
<?php
$content = ob_get_clean(); // Guarda el contenido en una variable
include 'layout.php'; // Renderiza dentro del layout
?>