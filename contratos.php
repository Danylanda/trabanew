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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script>
    function regresarInicio() {
        // Redirecciona a la página principal (inicio.php o index.php)
        window.location.href = 'index.php';
    }
</script>

</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Contratos</h1>

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
                        <td><?= $contrato['id_contrato'] ?></td>
                        <td><?= $contrato['id_cliente'] ?></td>
                        <td><?= $contrato['nombre'] ?></td>
                        <td><?= $contrato['id_proyecto'] ?></td>
                        <td><?= $contrato['id_vivienda'] ?></td>
                        <td><?= $contrato['modelo'] ?></td>
                        <td><?= $contrato['piso'] ?></td>
                        <td><?= $contrato['ubicacion'] ?></td>
                        <td><?= $contrato['m2'] ?></td>
                        <td><?= $contrato['precio_por_m2'] ?></td>
                        <td><?= $contrato['precio_venta'] ?></td>
                        <td><?= $contrato['cuota_inicial'] ?></td>
                        <td><?= $contrato['saldo_plan_pagos'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<<<<<<< HEAD
    <script>
        function regresarInicio() {
            // Redirecciona a la página principal (inicio.php o index.php)
            window.location.href = 'index.php';
        }
    </script>
</body>
</html>
=======
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
>>>>>>> 678d3ebc9945cd060d21d2e2579da4bb76892b65
