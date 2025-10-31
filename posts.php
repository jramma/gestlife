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

// --- PAGINACIÓN ---
$perPage = 10; // posts por página
$totalPosts = count($posts);
$totalPages = ceil($totalPosts / $perPage);

// Página actual
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages));

// Índices de corte
$start = ($currentPage - 1) * $perPage;
$visiblePosts = array_slice($posts, $start, $perPage);

ob_start();
?>
<div class="posts-container">
    <h2>Posts desde la API</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php else: ?>
        <ul>
            <?php foreach ($visiblePosts as $post): ?>
                <li>
                    <h3><?= htmlspecialchars($post['title']) ?></h3>
                    <p><?= htmlspecialchars(substr($post['body'], 0, 100)) ?>...</p>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Paginación -->
        <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?page=1">&laquo; Primera</a>
                <a href="?page=<?= $currentPage - 1 ?>">Anterior</a>
            <?php endif; ?>

            <?php
            // Saltos de 5 en 5
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $startPage + 4);
            for ($i = $startPage; $i <= $endPage; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= $i === $currentPage ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1 ?>">Siguiente</a>
                <a href="?page=<?= $totalPages ?>">Última &raquo;</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();
include 'layout.php';
?>