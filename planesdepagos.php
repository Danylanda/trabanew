<?php
include('conec.php');
$conn = getConnection();

<<<<<<< HEAD
// Consulta para obtener los planes de pagos
=======
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

// Construcción de la consulta base con filtrado
$sqlBase = "FROM planes_de_pago pp WHERE 1=1";
if (!empty($search)) {
    $escapedSearch = $conn->real_escape_string($search);
    $sqlBase .= " AND (pp.No_Cuota_plan LIKE '%$escapedSearch%' OR pp.ID_Contrato LIKE '%$escapedSearch%')";
}

// Contar el total de resultados
$sqlCount = "SELECT COUNT(*) AS total $sqlBase";
$resultCount = $conn->query($sqlCount);
$totalRows = ($resultCount && $resultCount->num_rows > 0) ? (int)$resultCount->fetch_assoc()['total'] : 0;
$totalPages = ($totalRows > 0) ? ceil($totalRows / $limit) : 1;

// Consulta con paginación
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
$sql = "
    SELECT 
        pp.ID_plan_pagos, 
        pp.ID_Contrato, 
        pp.No_Cuota_plan, 
        pp.Fecha_Plan_de_pagos, 
        pp.Cuota_Fija, 
        pp.Cuota_Variable, 
        pp.Abono_a_Precio_Venta, 
        pp.Saldo
<<<<<<< HEAD
    FROM planes_de_pago pp
    ORDER BY pp.ID_plan_pagos
";

$result = $conn->query($sql);

$planesdepagos = [];
if ($result->num_rows > 0) {
=======
    $sqlBase
    ORDER BY pp.ID_plan_pagos
    LIMIT $limit OFFSET $offset
";

$result = $conn->query($sql);
$planesdepagos = [];
if ($result && $result->num_rows > 0) {
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
    while ($row = $result->fetch_assoc()) {
        $planesdepagos[] = $row;
    }
}

closeConnection($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes de Pagos</title>
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
        <h1 class="text-center mb-4">Planes de Pagos</h1>

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
        <h1 class="text-center mb-4">Planes de Pagos</h1>

        <form method="GET" class="mb-4">
            <div class="input-group">
                <button type="button" onclick="clearFilters()" class="btn-back" style="margin-right:10px;">←</button>
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Buscar por N° Cuota Plan o ID Contrato..." 
                    value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>

>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Plan de Pagos</th>
                    <th>ID Contrato</th>
                    <th>N° Cuota Plan</th>
                    <th>Fecha Plan de Pagos</th>
                    <th>Cuota Fija</th>
                    <th>Cuota Variable</th>
                    <th>Abono Precio de Venta</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
<<<<<<< HEAD
                <?php foreach ($planesdepagos as $plan): ?>
                    <tr>
                        <td><?= $plan['ID_plan_pagos'] ?></td>
                        <td><?= $plan['ID_Contrato'] ?></td>
                        <td><?= $plan['No_Cuota_plan'] ?></td>
                        <td><?= $plan['Fecha_Plan_de_pagos'] ?></td>
                        <td><?= $plan['Cuota_Fija'] ?></td>
                        <td><?= $plan['Cuota_Variable'] ?></td>
                        <td><?= $plan['Abono_a_Precio_Venta'] ?></td>
                        <td><?= $plan['Saldo'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
=======
                <?php if (!empty($planesdepagos)): ?>
                    <?php foreach ($planesdepagos as $plan): ?>
                        <tr>
                            <td><?= htmlspecialchars($plan['ID_plan_pagos']) ?></td>
                            <td><?= htmlspecialchars($plan['ID_Contrato']) ?></td>
                            <td><?= htmlspecialchars($plan['No_Cuota_plan']) ?></td>
                            <td><?= htmlspecialchars($plan['Fecha_Plan_de_pagos']) ?></td>
                            <td><?= htmlspecialchars($plan['Cuota_Fija']) ?></td>
                            <td><?= htmlspecialchars($plan['Cuota_Variable']) ?></td>
                            <td><?= htmlspecialchars($plan['Abono_a_Precio_Venta']) ?></td>
                            <td><?= htmlspecialchars($plan['Saldo']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No se encontraron resultados.</td>
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
