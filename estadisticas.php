<?php
include('conec.php');
$conn = getConnection();

// Obtener los parámetros de filtro
$proyecto = isset($_POST['proyecto']) ? $_POST['proyecto'] : 'Todos';
$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : 'Todos';
$cuota = isset($_POST['cuota']) ? $_POST['cuota'] : 'Todas';

// Construir la consulta SQL con los filtros
$sql = "
    SELECT 
        YEAR(p.Fecha_de_pago) AS anio,
        SUM(p.Monto_recibido) AS pagos_totales,
        SUM(CASE WHEN p.Tipo_de_Cuota = 'Interes' THEN p.Monto_recibido ELSE 0 END) AS pagos_interes,
        SUM(CASE WHEN p.Tipo_de_Cuota = 'Capital' THEN p.Monto_recibido ELSE 0 END) AS pagos_capital
    FROM pagos p
    JOIN contratos c ON p.ID_Contrato = c.ID_Contrato
    JOIN clientes cl ON c.ID_Cliente = cl.ID_Cliente
    WHERE 1=1
";

if ($proyecto != 'Todos') {
    $sql .= " AND c.ID_Proyecto = '$proyecto'";
}

if ($cliente != 'Todos') {
    $sql .= " AND cl.Nombre = '$cliente'";
}

if ($cuota != 'Todas') {
    $sql .= " AND p.Tipo_de_Cuota = '$cuota'";
}

$sql .= " GROUP BY YEAR(p.Fecha_de_pago)";

$result = $conn->query($sql);

$anios = [];
$pagos_totales = [];
$pagos_interes = [];
$pagos_capital = [];

while ($row = $result->fetch_assoc()) {
    $anios[] = $row['anio'];
    $pagos_totales[] = $row['pagos_totales'];
    $pagos_interes[] = $row['pagos_interes'];
    $pagos_capital[] = $row['pagos_capital'];
}

closeConnection($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Pagos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin: 20px 0;
        }
        .container {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .panel {
            background-color: #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            width: 30%;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .panel canvas {
            margin: 0 auto;
        }
        .barra {
            background-color: #e0e0e0;
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            width: 90%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
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
    <h1>Pago Anual</h1>
    
    <form method="POST" action="procesar_filtro.php">
        <div class="filter-container">
            <!-- Filtro de Proyecto -->
            <div>
                <label for="proyecto">Proyecto:</label>
                <select name="proyecto" id="proyecto">
                    <option value="Todos" <?= $proyecto == 'Todos' ? 'selected' : '' ?>>Todos</option>
                    <option value="J1" <?= $proyecto == 'J1' ? 'selected' : '' ?>>J1</option>
                    <option value="J2" <?= $proyecto == 'J2' ? 'selected' : '' ?>>J2</option>
                    <option value="J3" <?= $proyecto == 'J3' ? 'selected' : '' ?>>J3</option>
                </select>
            </div>
            <!-- Filtro de Cliente -->
            <div>
                <label for="cliente">Cliente:</label>
                <select name="cliente" id="cliente">
                    <option value="Todos" <?= $cliente == 'Todos' ? 'selected' : '' ?>>Todos</option>
                    <option value="Cliente1" <?= $cliente == 'Cliente1' ? 'selected' : '' ?>>Cliente 1</option>
                    <option value="Cliente2" <?= $cliente == 'Cliente2' ? 'selected' : '' ?>>Cliente 2</option>
                    <option value="Cliente3" <?= $cliente == 'Cliente3' ? 'selected' : '' ?>>Cliente 3</option>
                </select>
            </div>
            <!-- Filtro de Cuota -->
            <div>
                <label for="cuota">Cuota:</label>
                <select name="cuota" id="cuota">
                    <option value="Todas" <?= $cuota == 'Todas' ? 'selected' : '' ?>>Todas</option>
                    <option value="Cuota1" <?= $cuota == 'Cuota1' ? 'selected' : '' ?>>Cuota 1</option>
                    <option value="Cuota2" <?= $cuota == 'Cuota2' ? 'selected' : '' ?>>Cuota 2</option>
                    <option value="Cuota3" <?= $cuota == 'Cuota3' ? 'selected' : '' ?>>Cuota 3</option>
                </select>
            </div>
        </div>
        <button type="submit">Filtrar</button>
    </form>    

    <script>
        function regresarInicio() {
            // Redirecciona a la página principal (inicio.php o index.php)
            window.location.href = 'index.php';
        }
    </script>

    <div class="container">
        <!-- Medidor Pagos Totales -->
        <div class="panel">
            <h2>Pagos Totales</h2>
            <canvas id="chartPagosTotales" width="200" height="200"></canvas>
        </div>

        <!-- Medidor Pagos a Interés -->
        <div class="panel">
            <h2>Pagos a Interés</h2>
            <canvas id="chartPagosInteres" width="200" height="200"></canvas>
        </div>

        <!-- Medidor Pagos a Capital -->
        <div class="panel">
            <h2>Pagos a Capital</h2>
            <canvas id="chartPagosCapital" width="200" height="200"></canvas>
        </div>
    </div>

    <div class="barra">
        <h2>Pagos Totales $ por Año</h2>
        <canvas id="chartBarras" width="600" height="400"></canvas>
    </div>

    <script>
        // Datos desde PHP
        const anios = <?php echo json_encode($anios); ?>;
        const pagosTotales = <?php echo json_encode($pagos_totales); ?>;
        const pagosInteres = <?php echo json_encode($pagos_interes); ?>;
        const pagosCapital = <?php echo json_encode($pagos_capital); ?>;

        // Función para crear un medidor semicircular
        function crearMedidor(ctx, valor, total, color) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [valor, total - valor],
                        backgroundColor: [color, '#E0E0E0'],
                        borderWidth: 0
                    }]
                },
                options: {
                    rotation: -Math.PI,
                    circumference: Math.PI,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    },
                    cutout: '75%',
                }
            });
        }

        // Crear medidores
        crearMedidor(
            document.getElementById('chartPagosTotales'),
            pagosTotales.reduce((a, b) => a + b, 0),
            pagosTotales.reduce((a, b) => a + b, 0) * 1.2,
            '#333333'
        );
        crearMedidor(
            document.getElementById('chartPagosInteres'),
            pagosInteres.reduce((a, b) => a + b, 0),
            pagosTotales.reduce((a, b) => a + b, 0),
            '#FFD700'
        );
        crearMedidor(
            document.getElementById('chartPagosCapital'),
            pagosCapital.reduce((a, b) => a + b, 0),
            pagosTotales.reduce((a, b) => a + b, 0),
            '#808080'
        );

        // Gráfica de barras apiladas
        new Chart(document.getElementById('chartBarras'), {
            type: 'bar',
            data: {
                labels: anios,
                datasets: [
                    {
                        label: 'Pagos Totales',
                        data: pagosTotales,
                        backgroundColor: '#333333'
                    },
                    {
                        label: 'Pagos Interés',
                        data: pagosInteres,
                        backgroundColor: '#FFD700'
                    },
                    {
                        label: 'Pagos Capital',
                        data: pagosCapital,
                        backgroundColor: '#808080'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    x: { stacked: true },
                    y: { stacked: true }
                }
            }
        });
    </script>
</body>
</html>