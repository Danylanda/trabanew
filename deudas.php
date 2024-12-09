<?php
// Conexión a la base de datos
$host = 'localhost'; // Cambiar si es necesario
$user = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña de la base de datos
$database = 'sistema_pagos'; // Nombre de la base de datos

$conexion = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para identificar cuotas con No_Cuota > 3
$sql = "
    SELECT 
        p.ID_Cliente, 
        c.Nombre AS Nombre_Cliente, 
        MAX(p.Fecha_de_pago) AS Ultima_Fecha_Pago
    FROM 
        pagos p
    JOIN 
        clientes c ON p.ID_Cliente = c.ID_Cliente
    WHERE 
        p.No_Cuota > 3
    GROUP BY 
        p.ID_Cliente, c.Nombre
";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
    <title>Deudas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .highlight {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Clientes con Deudas</h1>
    <table>
        <thead>
            <tr>
                <th>ID Cliente</th>
                <th>Nombre del Cliente</th>
                <th>Última Fecha de Pago</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr class='highlight'>";
                    echo "<td>{$fila['ID_Cliente']}</td>";
                    echo "<td>{$fila['Nombre_Cliente']}</td>";
                    echo "<td>{$fila['Ultima_Fecha_Pago']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron clientes con deudas.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<script>
    function regresarInicio() {
        // Redirecciona a la página principal (inicio.php o index.php)
        window.location.href = 'index.php';
    }
</script>
<?php
// Cerrar la conexión
$conexion->close();
?>