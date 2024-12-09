<?php
include('conec.php');
$conn = getConnection();

// Consulta para obtener los pagos
$sql = "
    SELECT 
        p.ID_pagos, 
        p.Fecha_de_pago, 
        p.No_Comprobante, 
        p.ID_Cliente, 
        c.Nombre AS Nombre_Cliente
    FROM pagos p
    JOIN clientes c ON p.ID_Cliente = c.ID_Cliente
    ORDER BY p.ID_pagos
";

$result = $conn->query($sql);

$pagos = [];
if ($result->num_rows > 0) {
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
            // Redirecciona a la página principal (inicio.php o index.php)
            window.location.href = 'index.php';
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Pagos</h1>

        <!-- Tabla de datos -->
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>