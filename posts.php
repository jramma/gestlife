<?php
$title = "Lista de Posts desde API";

$apiUrl = "https://jsonplaceholder.typicode.com/posts";
$posts = [];
$error = null;

// OBTENER DATOS DE LA API
try {
    $response = @file_get_contents($apiUrl); // el @ evita warnings si falla

    if ($response === FALSE) {
        $error = "No se pudo conectar con la API.";
    } else {
        $posts = json_decode($response, true);

        if (!is_array($posts)) {
            $error = "Error al decodificar la respuesta JSON.";
        }
    }
} catch (Exception $e) {
    $error = "Error al consumir la API: " . $e->getMessage();
}

ob_start();
?>
<div class="posts-container">
    <h2>Posts desde la API</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php else: ?>
        <ul>
            <?php foreach (array_slice($posts, 0, 10) as $post): ?>
                <li><?= htmlspecialchars($post['title']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
include 'layout.php';
?>