<?php
include('conec.php');
$conn = getConnection();
<<<<<<< HEAD
$contratos = getContratos($conn);
closeConnection($conn);
=======

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Construimos la parte base del SQL con filtro
$sqlBase = "FROM contratos WHERE 1=1";
if (!empty($search)) {
    $escapedSearch = $conn->real_escape_string($search);
    $sqlBase .= " AND (Nombre LIKE '%$escapedSearch%' OR ID_Contrato LIKE '%$escapedSearch%')";
}

// Contar el total de resultados
$sqlCount = "SELECT COUNT(*) AS total $sqlBase";
$resultCount = $conn->query($sqlCount);
$totalRows = ($resultCount && $resultCount->num_rows > 0) ? (int)$resultCount->fetch_assoc()['total'] : 0;
$totalPages = ($totalRows > 0) ? ceil($totalRows / $limit) : 1;

// Obtener los datos con LIMIT y OFFSET
$sql = "
    SELECT 
        ID_Contrato, 
        ID_Cliente, 
        Nombre, 
        ID_Proyecto, 
        ID_Vivienda, 
        Modelo, 
        Piso, 
        Ubicacion, 
        M2, 
        Precio_por_M2, 
        Precio_de_Venta, 
        Cuota_inicial, 
        Saldo_plan_de_pagos
    $sqlBase
    LIMIT $limit OFFSET $offset
";

$result = $conn->query($sql);
$contratos = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $contratos[] = $row;
    }
}

$conn->close();
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contratos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<<<<<<< HEAD
=======
    <style>
        .btn-back {
            padding: 10px 20px; 
            font-size: 16px; 
            background-color: #333; 
            color: white; 
            border: none; 
            border-radius: 5px; 
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
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Contratos</h1>

<<<<<<< HEAD
        <div style="text-align: left; margin: 20px;">
            <button onclick="regresarInicio()" style="
                padding: 10px 20px; 
                font-size: 16px; 
                background-color: #333; 
                color: white; 
                border: none; 
                border-radius: 5px; 
                cursor: pointer;">
                Inicio
            </button>
        </div>

        <!-- Tabla de datos -->
=======
        <div style="text-align: left; margin-bottom: 20px;">
            <button class="btn-back" onclick="regresarInicio()">Inicio</button>
        </div>

        <form method="GET" class="mb-4">
            <div class="input-group">
                <button type="button" onclick="clearFilters()" class="btn-back" style="margin-right:10px;">←</button>
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Buscar por nombre o ID de contrato..." 
                    value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>

>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Contrato</th>
                    <th>ID Cliente</th>
                    <th>Nombre</th>
                    <th>ID Proyecto</th>
                    <th>ID Vivienda</th>
                    <th>Modelo</th>
                    <th>Piso</th>
                    <th>Ubicación</th>
                    <th>M2</th>
                    <th>$ por M2</th>
                    <th>Precio de Venta</th>
                    <th>Cuota Inicial</th>
                    <th>Saldo Plan de Pagos</th>
                </tr>
            </thead>
            <tbody>
<<<<<<< HEAD
                <?php foreach ($contratos as $contrato): ?>
                    <tr>
                        <td><?= $contrato['ID_Contrato'] ?></td>
                        <td><?= $contrato['ID_Cliente'] ?></td>
                        <td><?= $contrato['Nombre'] ?></td>
                        <td><?= $contrato['ID_Proyecto'] ?></td>
                        <td><?= $contrato['ID_Vivienda'] ?></td>
                        <td><?= $contrato['Modelo'] ?></td>
                        <td><?= $contrato['Piso'] ?></td>
                        <td><?= $contrato['Ubicacion'] ?></td>
                        <td><?= $contrato['M2'] ?></td>
                        <td><?= $contrato['Precio_por_M2'] ?></td>
                        <td><?= $contrato['Precio_de_Venta'] ?></td>
                        <td><?= $contrato['Cuota_inicial'] ?></td>
                        <td><?= $contrato['Saldo_plan_de_pagos'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function regresarInicio() {
            // Redirecciona a la página principal (inicio.php o index.php)
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>
=======
                <?php if (!empty($contratos)): ?>
                    <?php foreach ($contratos as $contrato): ?>
                        <tr>
                            <td><?= htmlspecialchars($contrato['ID_Contrato']) ?></td>
                            <td><?= htmlspecialchars($contrato['ID_Cliente']) ?></td>
                            <td><?= htmlspecialchars($contrato['Nombre']) ?></td>
                            <td><?= htmlspecialchars($contrato['ID_Proyecto']) ?></td>
                            <td><?= htmlspecialchars($contrato['ID_Vivienda']) ?></td>
                            <td><?= htmlspecialchars($contrato['Modelo']) ?></td>
                            <td><?= htmlspecialchars($contrato['Piso']) ?></td>
                            <td><?= htmlspecialchars($contrato['Ubicacion']) ?></td>
                            <td><?= htmlspecialchars($contrato['M2']) ?></td>
                            <td><?= htmlspecialchars($contrato['Precio_por_M2']) ?></td>
                            <td><?= htmlspecialchars($contrato['Precio_de_Venta']) ?></td>
                            <td><?= htmlspecialchars($contrato['Cuota_inicial']) ?></td>
                            <td><?= htmlspecialchars($contrato['Saldo_plan_de_pagos']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="13" class="text-center">No se encontraron resultados.</td>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
