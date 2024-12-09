<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $proyecto = $_POST['proyecto'] ?? 'Todos';
    $cliente = $_POST['cliente'] ?? 'Todos';
    $cuota = $_POST['cuota'] ?? 'Todas';

    // Redirigir a la página de estadísticas con los parámetros de filtro
    header("Location: estadisticas.php?proyecto=$proyecto&cliente=$cliente&cuota=$cuota");
    exit;
} else {
    echo "Método no permitido.";
}
?>