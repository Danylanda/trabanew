<?php
include('conec.php');
$conn = getConnection();

<<<<<<< HEAD
// Consulta para obtener los pagos
=======
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Construcción de la consulta base con filtrado
$sqlBase = "
    FROM pagos p
    JOIN clientes c ON p.ID_Cliente = c.ID_Cliente
    WHERE 1=1
";

if (!empty($search)) {
    $escapedSearch = $conn->real_escape_string($search);
    $sqlBase .= " AND (c.Nombre LIKE '%$escapedSearch%' OR p.No_Comprobante LIKE '%$escapedSearch%')";
}

// Contamos el total de resultados
$sqlCount = "SELECT COUNT(*) AS total $sqlBase";
$resultCount = $conn->query($sqlCount);
$totalRows = ($resultCount && $resultCount->num_rows > 0) ? (int)$resultCount->fetch_assoc()['total'] : 0;
$totalPages = ($totalRows > 0) ? ceil($totalRows / $limit) : 1;

// Consulta con paginación
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
$sql = "
    SELECT 
        p.ID_pagos, 
        p.Fecha_de_pago, 
        p.No_Comprobante, 
        p.ID_Cliente, 
        c.Nombre AS Nombre_Cliente
<<<<<<< HEAD
    FROM pagos p
    JOIN clientes c ON p.ID_Cliente = c.ID_Cliente
    ORDER BY p.ID_pagos
";

$result = $conn->query($sql);

$pagos = [];
if ($result->num_rows > 0) {
=======
    $sqlBase
    ORDER BY p.ID_pagos
    LIMIT $limit OFFSET $offset
";

$result = $conn->query($sql);
$pagos = [];
if ($result && $result->num_rows > 0) {
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
    while ($row = $result->fetch_assoc()) {
        $pagos[] = $row;
    }
}

closeConnection($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<<<<<<< HEAD

    <div style="text-align: left; margin: 20px;">
        <button onclick="regresarInicio()" style="
=======
    <style>
        .btn-back {
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
            padding: 10px 20px; 
            font-size: 16px; 
            background-color: #333; 
            color: white; 
            border: none; 
            border-radius: 5px; 
<<<<<<< HEAD
            cursor: pointer;">
            Inicio
        </button>
    </div>
    <script>
        function regresarInicio() {
            // Redirecciona a la página principal (inicio.php o index.php)
            window.location.href = 'index.php';
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Pagos</h1>

        <!-- Tabla de datos -->
=======
            cursor: pointer;
        }
    </style>
    <script>
        function regresarInicio() {
            window.location.href = 'index.php';
        }

        function clearFilters() {
            const baseUrl = window.location.origin + window.location.pathname;
            document.querySelector('input[name="search"]').value = '';
            window.location.replace(baseUrl);
        }
    </script>
</head>
<body>
    <div style="text-align: left; margin: 20px;">
        <button onclick="regresarInicio()" class="btn-back">Inicio</button>
    </div>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Pagos</h1>

        <form method="GET" class="mb-4">
            <div class="input-group">
                <button type="button" onclick="clearFilters()" class="btn-back" style="margin-right:10px;">←</button>
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Buscar por nombre de cliente o N° de comprobante..." 
                    value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>

>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Pagos</th>
                    <th>Fecha de Pago</th>
                    <th>N° Comprobante</th>
                    <th>ID Cliente</th>
                    <th>Nombre del Cliente</th>
                </tr>
            </thead>
            <tbody>
<<<<<<< HEAD
                <?php foreach ($pagos as $pago): ?>
                    <tr>
                        <td><?= $pago['ID_pagos'] ?></td>
                        <td><?= $pago['Fecha_de_pago'] ?></td>
                        <td><?= $pago['No_Comprobante'] ?></td>
                        <td><?= $pago['ID_Cliente'] ?></td>
                        <td><?= $pago['Nombre_Cliente'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
=======
                <?php if (!empty($pagos)): ?>
                    <?php foreach ($pagos as $pago): ?>
                        <tr>
                            <td><?= htmlspecialchars($pago['ID_pagos']) ?></td>
                            <td><?= htmlspecialchars($pago['Fecha_de_pago']) ?></td>
                            <td><?= htmlspecialchars($pago['No_Comprobante']) ?></td>
                            <td><?= htmlspecialchars($pago['ID_Cliente']) ?></td>
                            <td><?= htmlspecialchars($pago['Nombre_Cliente']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No se encontraron resultados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-end">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Anterior</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Siguiente</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<<<<<<< HEAD
</html>
=======
</html>

>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
