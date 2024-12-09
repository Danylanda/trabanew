<?php
include('conec.php');
$conn = getConnection();

// Consulta para obtener los planes de pagos
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
    FROM planes_de_pago pp
    ORDER BY pp.ID_plan_pagos
";

$result = $conn->query($sql);

$planesdepagos = [];
if ($result->num_rows > 0) {
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
        <h1 class="text-center mb-4">Planes de Pagos</h1>

        <!-- Tabla de datos -->
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>