<?php
include('conec.php');

$conn = getConnection();

<<<<<<< HEAD
// Consulta para obtener los clientes y sus pagos
=======
$search = isset($_GET['search']) ? $_GET['search'] : ''; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;   
$limit = 10; 
$offset = ($page - 1) * $limit;

$searchTerm = "%$search%";

// Contar total de resultados
$countSql = "
    SELECT COUNT(*) as total
    FROM clientes c
    LEFT JOIN pagos p ON c.ID_Cliente = p.ID_Cliente
    WHERE c.Nombre LIKE ? OR p.No_Comprobante LIKE ?
";
$stmtCount = $conn->prepare($countSql);
$stmtCount->bind_param('ss', $searchTerm, $searchTerm);
$stmtCount->execute();
$countResult = $stmtCount->get_result();
$total = $countResult->fetch_assoc()['total'];
$totalPages = ($total > 0) ? ceil($total / $limit) : 1;

// Consulta principal
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
$sql = "
    SELECT 
        c.ID_Cliente, 
        c.Nombre AS Nombre_Cliente, 
        p.ID_pagos, 
        p.Fecha_de_pago, 
        p.No_Comprobante, 
        p.ID_Contrato, 
        p.No_Cuota, 
        p.Tipo_de_Cuota, 
        p.Moneda, 
        p.Tipo_de_Cambio, 
        p.Monto_recibido, 
        p.Pago_dolares, 
        p.Pago_bolivianos
    FROM clientes c
    LEFT JOIN pagos p ON c.ID_Cliente = p.ID_Cliente
<<<<<<< HEAD
    ORDER BY c.ID_Cliente, p.ID_pagos
";

$result = $conn->query($sql);

$clientes = [];
if ($result->num_rows > 0) {
=======
    WHERE c.Nombre LIKE ? OR p.No_Comprobante LIKE ?
    ORDER BY c.ID_Cliente, p.ID_pagos
    LIMIT ? OFFSET ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssii', $searchTerm, $searchTerm, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$clientes = [];
if ($result && $result->num_rows > 0) {
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<<<<<<< HEAD
    
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
    
    <title>Informacion de Pagos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Informacion de Clientes y Pagos</h1>

=======
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion de Pagos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <style>
        .btn-back {
            padding: 10px 20px; 
            font-size: 16px; 
            background-color: #333; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div style="text-align: left; margin: 20px;">
        <button onclick="regresarInicio()" class="btn-back">Inicio</button>
    </div>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Informacion de Clientes y Pagos</h1>

        <!-- Buscador -->
        <form method="GET" class="mb-4">
            <div class="input-group">
                <button type="button" onclick="clearFilters()" class="btn-back" style="margin-right:10px;">←</button>
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
        <!-- Botones para abrir las ventanas modales -->
        <div class="mb-4 text-center">
            <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#modalCliente">Añadir Cliente</button>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPago">Añadir Pago</button>
        </div>

        <!-- Tabla de datos -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Cliente</th>
                    <th>Nombre del Cliente</th>
                    <th>ID Pago</th>
                    <th>Fecha de Pago</th>
                    <th>Nro Comprobante</th>
                    <th>ID Contrato</th>
                    <th>Nro Cuota</th>
                    <th>Tipo de Cuota</th>
                    <th>Moneda</th>
                    <th>Tipo de Cambio</th>
                    <th>Monto Recibido</th>
                    <th>Pago en Dólares</th>
                    <th>Pago en Bolivianos</th>
<<<<<<< HEAD
                    <th>Acciones</th> <!-- Nueva columna para botones -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= $cliente['ID_Cliente'] ?></td>
                        <td><?= $cliente['Nombre_Cliente'] ?></td>
                        <td><?= $cliente['ID_pagos'] ?: 'N/A' ?></td>
                        <td><?= $cliente['Fecha_de_pago'] ?: 'N/A' ?></td>
                        <td><?= $cliente['No_Comprobante'] ?: 'N/A' ?></td>
                        <td><?= $cliente['ID_Contrato'] ?: 'N/A' ?></td>
                        <td><?= $cliente['No_Cuota'] ?: 'N/A' ?></td>
                        <td><?= $cliente['Tipo_de_Cuota'] ?: 'N/A' ?></td>
                        <td><?= $cliente['Moneda'] ?: 'N/A' ?></td>
                        <td><?= $cliente['Tipo_de_Cambio'] ?: 'N/A' ?></td>
                        <td><?= $cliente['Monto_recibido'] ?: 'N/A' ?></td>
                        <td><?= $cliente['Pago_dolares'] ?: 'N/A' ?></td>
                        <td><?= $cliente['Pago_bolivianos'] ?: 'N/A' ?></td>
                        <td>
                            <!-- Botón para editar -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $cliente['ID_Cliente'] ?>">Editar</button>
                            <!-- Botón para eliminar -->
                            <a href="eliminar_cliente.php?id_cliente=<?= $cliente['ID_Cliente'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                        </td>
                    </tr>
                    <!-- Modal de edición para este cliente -->
                    <div class="modal fade" id="modalEditar<?= $cliente['ID_Cliente'] ?>" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="editar_cliente.php">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditarLabel">Editar Información</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="ID_Cliente" value="<?= $cliente['ID_Cliente'] ?>">
                                        <input type="hidden" name="ID_pagos" value="<?= $cliente['ID_pagos'] ?>">

                                        <div class="mb-3">
                                            <label for="Nombre_Cliente" class="form-label">Nombre del Cliente</label>
                                            <input type="text" class="form-control" id="Nombre_Cliente" name="Nombre_Cliente" value="<?= $cliente['Nombre_Cliente'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Fecha_de_pago" class="form-label">Fecha de Pago</label>
                                            <input type="date" class="form-control" id="Fecha_de_pago" name="Fecha_de_pago" value="<?= $cliente['Fecha_de_pago'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="No_Comprobante" class="form-label">Nro Comprobante</label>
                                            <input type="text" class="form-control" id="No_Comprobante" name="No_Comprobante" value="<?= $cliente['No_Comprobante'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="ID_Contrato" class="form-label">ID Contrato</label>
                                            <input type="number" class="form-control" id="ID_Contrato" name="ID_Contrato" value="<?= $cliente['ID_Contrato'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="No_Cuota" class="form-label">No Cuota</label>
                                            <input type="number" class="form-control" id="No_Cuota" name="No_Cuota" value="<?= $cliente['No_Cuota'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="Tipo_de_Cuota" class="form-label">Tipo de Cuota</label>
                                            <input type="text" class="form-control" id="Tipo_de_Cuota" name="Tipo_de_Cuota" value="<?= $cliente['Tipo_de_Cuota'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="Moneda" class="form-label">Moneda</label>
                                            <select class="form-select" id="Moneda" name="Moneda">
                                                <option value="USD" <?= $cliente['Moneda'] == 'USD' ? 'selected' : '' ?>>USD</option>
                                                <option value="BOL" <?= $cliente['Moneda'] == 'BOL' ? 'selected' : '' ?>>BOL</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Tipo_de_Cambio" class="form-label">TC (Tipo de Cambio)</label>
                                            <input type="number" class="form-control" id="Tipo_de_Cambio" name="Tipo_de_Cambio" step="0.01" value="<?= $cliente['Tipo_de_Cambio'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="Monto_recibido" class="form-label">Monto Recibido</label>
                                            <input type="number" class="form-control" id="Monto_recibido" name="Monto_recibido" step="0.01" value="<?= $cliente['Monto_recibido'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para añadir cliente -->
    <div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalClienteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="procesar_cliente.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalClienteLabel">Añadir Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Nombre_Cliente" class="form-label">Nombre del Cliente</label>
                            <input type="text" class="form-control" id="Nombre_Cliente" name="Nombre_Cliente" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para añadir pago -->
<div class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPagoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="procesar_pago.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPagoLabel">Añadir Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ID_Cliente" class="form-label">ID Cliente</label>
                        <input type="number" class="form-control" id="ID_Cliente" name="ID_Cliente" required>
                    </div>
                    <div class="mb-3">
                        <label for="Fecha_de_pago" class="form-label">Fecha de Pago</label>
                        <input type="date" class="form-control" id="Fecha_de_pago" name="Fecha_de_pago" required>
                    </div>
                    <div class="mb-3">
                        <label for="Monto_recibido" class="form-label">Monto Recibido</label>
                        <input type="number" class="form-control" id="Monto_recibido" name="Monto_recibido" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="No_Comprobante" class="form-label">Nro Comprobante</label>
                        <input type="text" class="form-control" id="No_Comprobante" name="No_Comprobante" required>
                    </div>
                    <div class="mb-3">
                        <label for="ID_Contrato" class="form-label">ID Contrato</label>
                        <input type="number" class="form-control" id="ID_Contrato" name="ID_Contrato" required>
                    </div>
                    <div class="mb-3">
                        <label for="No_Cuota" class="form-label">No Cuota</label>
                        <input type="number" class="form-control" id="No_Cuota" name="No_Cuota" required>
                    </div>
                    <div class="mb-3">
                        <label for="Tipo_de_Cuota" class="form-label">Tipo de Cuota</label>
                        <input type="text" class="form-control" id="Tipo_de_Cuota" name="Tipo_de_Cuota" required>
                    </div>
                    <div class="mb-3">
                        <label for="Estado" class="form-label">Estado</label>
                        <select class="form-select" id="Estado" name="Estado" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="pagado">Pagado</option>
                            <option value="vencido">Vencido</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Moneda" class="form-label">Moneda</label>
                        <select class="form-select" id="Moneda" name="Moneda" required>
                            <option value="USD">USD</option>
                            <option value="BOL">BOL</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Tipo_de_Cambio" class="form-label">TC (Tipo de Cambio)</label>
                        <input type="number" class="form-control" id="Tipo_de_Cambio" name="Tipo_de_Cambio" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
=======
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['ID_Cliente']) ?></td>
                            <td><?= htmlspecialchars($cliente['Nombre_Cliente']) ?></td>
                            <td><?= $cliente['ID_pagos'] ? htmlspecialchars($cliente['ID_pagos']) : 'N/A' ?></td>
                            <td><?= $cliente['Fecha_de_pago'] ? htmlspecialchars($cliente['Fecha_de_pago']) : 'N/A' ?></td>
                            <td><?= $cliente['No_Comprobante'] ? htmlspecialchars($cliente['No_Comprobante']) : 'N/A' ?></td>
                            <td><?= $cliente['ID_Contrato'] ? htmlspecialchars($cliente['ID_Contrato']) : 'N/A' ?></td>
                            <td><?= $cliente['No_Cuota'] ? htmlspecialchars($cliente['No_Cuota']) : 'N/A' ?></td>
                            <td><?= $cliente['Tipo_de_Cuota'] ? htmlspecialchars($cliente['Tipo_de_Cuota']) : 'N/A' ?></td>
                            <td><?= $cliente['Moneda'] ? htmlspecialchars($cliente['Moneda']) : 'N/A' ?></td>
                            <td><?= $cliente['Tipo_de_Cambio'] ? htmlspecialchars($cliente['Tipo_de_Cambio']) : 'N/A' ?></td>
                            <td><?= $cliente['Monto_recibido'] ? htmlspecialchars($cliente['Monto_recibido']) : 'N/A' ?></td>
                            <td><?= $cliente['Pago_dolares'] ? htmlspecialchars($cliente['Pago_dolares']) : 'N/A' ?></td>
                            <td><?= $cliente['Pago_bolivianos'] ? htmlspecialchars($cliente['Pago_bolivianos']) : 'N/A' ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $cliente['ID_Cliente'] ?>">Editar</button>
                                <a href="eliminar_cliente.php?id_cliente=<?= urlencode($cliente['ID_Cliente']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este cliente?');">Eliminar</a>
                            </td>
                        </tr>

                        <!-- Modal de edición para este cliente -->
                        <div class="modal fade" id="modalEditar<?= $cliente['ID_Cliente'] ?>" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="editar_cliente.php">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditarLabel">Editar Información</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="ID_Cliente" value="<?= htmlspecialchars($cliente['ID_Cliente']) ?>">
                                            <input type="hidden" name="ID_pagos" value="<?= htmlspecialchars($cliente['ID_pagos'] ?? '') ?>">

                                            <div class="mb-3">
                                                <label for="Nombre_Cliente" class="form-label">Nombre del Cliente</label>
                                                <input type="text" class="form-control" id="Nombre_Cliente" name="Nombre_Cliente" value="<?= htmlspecialchars($cliente['Nombre_Cliente']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Fecha_de_pago" class="form-label">Fecha de Pago</label>
                                                <input type="date" class="form-control" id="Fecha_de_pago" name="Fecha_de_pago" value="<?= htmlspecialchars($cliente['Fecha_de_pago'] ?? '') ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="No_Comprobante" class="form-label">Nro Comprobante</label>
                                                <input type="text" class="form-control" id="No_Comprobante" name="No_Comprobante" value="<?= htmlspecialchars($cliente['No_Comprobante'] ?? '') ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="ID_Contrato" class="form-label">ID Contrato</label>
                                                <input type="number" class="form-control" id="ID_Contrato" name="ID_Contrato" value="<?= htmlspecialchars($cliente['ID_Contrato'] ?? '') ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="No_Cuota" class="form-label">No Cuota</label>
                                                <input type="number" class="form-control" id="No_Cuota" name="No_Cuota" value="<?= htmlspecialchars($cliente['No_Cuota'] ?? '') ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="Tipo_de_Cuota" class="form-label">Tipo de Cuota</label>
                                                <input type="text" class="form-control" id="Tipo_de_Cuota" name="Tipo_de_Cuota" value="<?= htmlspecialchars($cliente['Tipo_de_Cuota'] ?? '') ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="Moneda" class="form-label">Moneda</label>
                                                <select class="form-select" id="Moneda" name="Moneda">
                                                    <option value="USD" <?= (isset($cliente['Moneda']) && $cliente['Moneda'] == 'USD') ? 'selected' : '' ?>>USD</option>
                                                    <option value="BOL" <?= (isset($cliente['Moneda']) && $cliente['Moneda'] == 'BOL') ? 'selected' : '' ?>>BOL</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="Tipo_de_Cambio" class="form-label">TC (Tipo de Cambio)</label>
                                                <input type="number" class="form-control" id="Tipo_de_Cambio" name="Tipo_de_Cambio" step="0.01" value="<?= htmlspecialchars($cliente['Tipo_de_Cambio'] ?? '') ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="Monto_recibido" class="form-label">Monto Recibido</label>
                                                <input type="number" class="form-control" id="Monto_recibido" name="Monto_recibido" step="0.01" value="<?= htmlspecialchars($cliente['Monto_recibido'] ?? '') ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="14" class="text-center">No se encontraron resultados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Modal para añadir cliente -->
        <div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalClienteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="procesar_cliente.php">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalClienteLabel">Añadir Cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="Nombre_Cliente" class="form-label">Nombre del Cliente</label>
                                <input type="text" class="form-control" id="Nombre_Cliente" name="Nombre_Cliente" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal para añadir pago -->
        <div class="modal fade" id="modalPago" tabindex="-1" aria-labelledby="modalPagoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="procesar_pago.php">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPagoLabel">Añadir Pago</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="ID_Cliente" class="form-label">ID Cliente</label>
                                <input type="number" class="form-control" id="ID_Cliente" name="ID_Cliente" required>
                            </div>
                            <div class="mb-3">
                                <label for="Fecha_de_pago" class="form-label">Fecha de Pago</label>
                                <input type="date" class="form-control" id="Fecha_de_pago" name="Fecha_de_pago" required>
                            </div>
                            <div class="mb-3">
                                <label for="Monto_recibido" class="form-label">Monto Recibido</label>
                                <input type="number" class="form-control" id="Monto_recibido" name="Monto_recibido" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="No_Comprobante" class="form-label">Nro Comprobante</label>
                                <input type="text" class="form-control" id="No_Comprobante" name="No_Comprobante" required>
                            </div>
                            <div class="mb-3">
                                <label for="ID_Contrato" class="form-label">ID Contrato</label>
                                <input type="number" class="form-control" id="ID_Contrato" name="ID_Contrato" required>
                            </div>
                            <div class="mb-3">
                                <label for="No_Cuota" class="form-label">No Cuota</label>
                                <input type="number" class="form-control" id="No_Cuota" name="No_Cuota" required>
                            </div>
                            <div class="mb-3">
                                <label for="Tipo_de_Cuota" class="form-label">Tipo de Cuota</label>
                                <input type="text" class="form-control" id="Tipo_de_Cuota" name="Tipo_de_Cuota" required>
                            </div>
                            <div class="mb-3">
                                <label for="Estado" class="form-label">Estado</label>
                                <select class="form-select" id="Estado" name="Estado" required>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="pagado">Pagado</option>
                                    <option value="vencido">Vencido</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Moneda" class="form-label">Moneda</label>
                                <select class="form-select" id="Moneda" name="Moneda" required>
                                    <option value="USD">USD</option>
                                    <option value="BOL">BOL</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="Tipo_de_Cambio" class="form-label">TC (Tipo de Cambio)</label>
                                <input type="number" class="form-control" id="Tipo_de_Cambio" name="Tipo_de_Cambio" step="0.01" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Pago</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Paginación siempre visible -->
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
>>>>>>> 76ca9cc (iniciobuscarybotonesposteriores)
