<?php
include('conec.php');

$conn = getConnection();

// Consulta para obtener los proyectos
$sql = "
    SELECT 
        ID_item, 
        ID_Proyecto, 
        No, 
        Piso, 
        Tipo, 
        Ubicacion, 
        M2, 
        ID_vivienda, 
        Estado, 
        Modelo
    FROM proyectos
";

$result = $conn->query($sql);

$proyectos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $proyectos[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
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
        <h1 class="text-center mb-4">Proyectos</h1>

        <!-- Tabla de datos -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Item</th>
                    <th>ID Proyecto</th>
                    <th>Número</th>
                    <th>Piso</th>
                    <th>Tipo</th>
                    <th>Ubicación</th>
                    <th>M2</th>
                    <th>ID Vivienda</th>
                    <th>Estado</th>
                    <th>Modelo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proyectos as $proyecto): ?>
                    <tr>
                        <td><?= $proyecto['ID_item'] ?></td>
                        <td><?= $proyecto['ID_Proyecto'] ?></td>
                        <td><?= $proyecto['No'] ?></td>
                        <td><?= $proyecto['Piso'] ?></td>
                        <td><?= $proyecto['Tipo'] ?></td>
                        <td><?= $proyecto['Ubicacion'] ?></td>
                        <td><?= $proyecto['M2'] ?></td>
                        <td><?= $proyecto['ID_vivienda'] ?></td>
                        <td><?= $proyecto['Estado'] ?></td>
                        <td><?= $proyecto['Modelo'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>