<?php
include('conec.php');
$conn = getConnection();
$contratos = getContratos($conn);
closeConnection($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contratos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Contratos</h1>

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