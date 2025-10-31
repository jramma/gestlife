<?php
// Inicializar variables
$nombre = "";
$email = "";
$mensaje = "";
$errores = [];
$exito = "";

// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $mensaje = trim($_POST["mensaje"]);

    // Validaciones
    if (empty($nombre)) {
        $errores[] = "El nombre no puede estar vacío.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    if (strlen($mensaje) < 10) {
        $errores[] = "El mensaje debe tener al menos 10 caracteres.";
    }

    // Si no hay errores, mostrar mensaje de éxito
    if (empty($errores)) {
        $exito = "✅ Gracias por tu mensaje, $nombre. Te responderemos pronto.";
        // Aquí podrías guardar los datos en una base de datos o enviar un correo
    }
}
?>
<div class="form-card">
<h2>Formulario de Contacto</h2>

<?php if (!empty($errores)): ?>
    <div class="errores">
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($exito): ?>
    <div class="exito"><?= htmlspecialchars($exito) ?></div>
<?php endif; ?>

<form method="POST" action="contacto.php">
    <label for="nombre">Nombre completo:</label>
    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($nombre) ?>">

    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>">

    <label for="mensaje">Mensaje:</label>
    <textarea id="mensaje" name="mensaje" rows="4"><?= htmlspecialchars($mensaje) ?></textarea>

    <button type="submit">Enviar</button>
</form>
</div>
<?php
$content = ob_get_clean();
include 'layout.php';
?>