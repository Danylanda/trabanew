<?php
include('conec.php');

$conn = getConnection();

// Consulta para obtener los clientes
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
";

$result = $conn->query($sql);

$clientes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
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
        <h1 class="text-center mb-4">Clientes</h1>

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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>