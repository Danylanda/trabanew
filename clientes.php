<?php
include('conec.php');

$conn = getConnection();

<<<<<<< HEAD
// Consulta para obtener los clientes
=======
$search = isset($_GET['search']) ? $_GET['search'] : ''; 
$page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1; // Asegura que $page sea al menos 1
$limit = 10; // Registros por página
$offset = ($page - 1) * $limit; // Cálculo del desplazamiento

// Consulta para obtener el total de registros con filtrado
$sqlCount = "
    SELECT COUNT(*) as total
    FROM clientes
    WHERE Nombre LIKE ? OR No LIKE ?
";
$stmtCount = $conn->prepare($sqlCount);
$searchParam = "%$search%";
$stmtCount->bind_param("ss", $searchParam, $searchParam);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();
$rowCount = $resultCount->fetch_assoc();
$totalRecords = $rowCount['total'];
$totalPages = ceil($totalRecords / $limit); // Calcula el número total de páginas
$stmtCount->close();

// Consulta para obtener los clientes con filtrado y paginación
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
$sql = "
    SELECT 
        ID_Cliente, 
        No, 
        Nombre, 
        CI, 
        Extension, 
        Año, 
        Mes, 
        Telefono, 
        Correo_electronico, 
        Direccion, 
        Puntaje_Infocred
    FROM clientes
<<<<<<< HEAD
";

$result = $conn->query($sql);
=======
    WHERE Nombre LIKE ? OR No LIKE ?
    LIMIT ? OFFSET ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $searchParam, $searchParam, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)

$clientes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

<<<<<<< HEAD
=======
$stmt->close();
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<<<<<<< HEAD

=======
</head>
<body>
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
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
    <script>
        function regresarInicio() {
<<<<<<< HEAD
            // Redirecciona a la página principal (inicio.php o index.php)
            window.location.href = 'index.php';
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Clientes</h1>

=======
            window.location.href = 'index.php';
        }

        function clearFilters() {
            window.location.href = '?page=1';
        }
    </script>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Clientes</h1>

        <form method="GET" class="mb-4">
            <div class="input-group">
                <button type="button" onclick="clearFilters()" style="
                    padding: 10px 20px; 
                    font-size: 16px; 
                    background-color: #333; 
                    color: white; 
                    border: none; 
                    border-radius: 5px; 
                    cursor: pointer;">
                    ← 
                </button>
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Buscar por nombre de cliente o Nro de comprobante..." 
                    value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-primary" type="submit">Buscar</button>
            </div>
        </form>

>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
        <!-- Tabla de datos -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Cliente</th>
                    <th>Número</th>
                    <th>Nombre</th>
                    <th>CI</th>
                    <th>Extensión</th>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Dirección</th>
                    <th>Puntaje Infocred</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
<<<<<<< HEAD
                        <td><?= $cliente['ID_Cliente'] ?></td>
                        <td><?= $cliente['No'] ?></td>
                        <td><?= $cliente['Nombre'] ?></td>
                        <td><?= $cliente['CI'] ?></td>
                        <td><?= $cliente['Extension'] ?></td>
                        <td><?= $cliente['Año'] ?></td>
                        <td><?= $cliente['Mes'] ?></td>
                        <td><?= $cliente['Telefono'] ?></td>
                        <td><?= $cliente['Correo_electronico'] ?></td>
                        <td><?= $cliente['Direccion'] ?></td>
                        <td><?= $cliente['Puntaje_Infocred'] ?></td>
=======
                        <td><?= htmlspecialchars($cliente['ID_Cliente']) ?></td>
                        <td><?= htmlspecialchars($cliente['No']) ?></td>
                        <td><?= htmlspecialchars($cliente['Nombre']) ?></td>
                        <td><?= htmlspecialchars($cliente['CI']) ?></td>
                        <td><?= htmlspecialchars($cliente['Extension']) ?></td>
                        <td><?= htmlspecialchars($cliente['Año']) ?></td>
                        <td><?= htmlspecialchars($cliente['Mes']) ?></td>
                        <td><?= htmlspecialchars($cliente['Telefono']) ?></td>
                        <td><?= htmlspecialchars($cliente['Correo_electronico']) ?></td>
                        <td><?= htmlspecialchars($cliente['Direccion']) ?></td>
                        <td><?= htmlspecialchars($cliente['Puntaje_Infocred']) ?></td>
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
<<<<<<< HEAD
=======

        <!-- Paginación -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end"> 
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= htmlspecialchars($search) ?>">Anterior</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= htmlspecialchars($search) ?>">Siguiente</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>