<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Pago</title>
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Añadir Pago</h1>
        <form method="POST" action="procesar_pago.php">
            <div class="mb-3">
                <label for="id_cliente" class="form-label">ID Cliente:</label>
                <input type="number" class="form-control" id="id_cliente" name="id_cliente" required>
            </div>

            <div class="mb-3">
                <label for="fecha_pago" class="form-label">Fecha de Pago:</label>
                <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" required>
            </div>

            <div class="mb-3">
                <label for="monto_recibido" class="form-label">Monto Recibido:</label>
                <input type="number" class="form-control" id="monto_recibido" name="monto_recibido" required>
            </div>

            <div class="mb-3">
                <label for="nro_comprobante" class="form-label">Nro Comprobante:</label>
                <input type="text" class="form-control" id="nro_comprobante" name="nro_comprobante" required>
            </div>

            <div class="mb-3">
                <label for="id_contrato" class="form-label">ID Contrato:</label>
                <input type="number" class="form-control" id="id_contrato" name="id_contrato" required>
            </div>

            <div class="mb-3">
                <label for="nro_cuota" class="form-label">No Cuota:</label>
                <input type="number" class="form-control" id="nro_cuota" name="nro_cuota" required>
            </div>

            <div class="mb-3">
                <label for="tipo_cuota" class="form-label">Tipo de Cuota:</label>
                <input type="text" class="form-control" id="tipo_cuota" name="tipo_cuota" required>
            </div>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="pendiente">Pendiente</option>
                    <option value="pagado">Pagado</option>
                    <option value="vencido">Vencido</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="moneda" class="form-label">Moneda:</label>
                <select class="form-control" id="moneda" name="moneda" required>
                    <option value="USD">USD</option>
                    <option value="BOL">BOL</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="tc" class="form-label">TC (Tipo de Cambio):</label>
                <input type="number" class="form-control" id="tc" name="tc" step="0.01" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar Pago</button>
                <a href="index.php" class="btn btn-secondary">Volver a Principal</a>
            </div>
        </form>
    </div>
</body>
</html>
=======
</head>
<body>
    <h1>Añadir Pago</h1>
    <form method="POST" action="procesar_pago.php">
        <label for="id_cliente">ID Cliente:</label>
        <input type="number" id="id_cliente" name="id_cliente" required>

        <label for="fecha_pago">Fecha de Pago:</label>
        <input type="date" id="fecha_pago" name="fecha_pago" required>

        <label for="monto_recibido">monto recibido:</label>
        <input type="number" id="monto_recibido" name="monto_recibido" required>

        <!-- Nuevo campo: Nro Comprobante -->
        <label for="nro_comprobante">Nro Comprobante:</label>
        <input type="text" id="nro_comprobante" name="nro_comprobante" required>

        <!-- Nuevo campo: ID Contrato -->
        <label for="id_contrato">ID Contrato:</label>
        <input type="number" id="id_contrato" name="id_contrato" required>

        <!-- Nuevo campo: No Cuota -->
        <label for="nro_cuota">No Cuota:</label>
        <input type="number" id="nro_cuota" name="nro_cuota" required>

        <!-- Nuevo campo: Tipo de Cuota -->
        <label for="tipo_cuota">Tipo de Cuota:</label>
        <input type="text" id="tipo_cuota" name="tipo_cuota" required>

        <!-- Nuevo campo: Estado -->
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="pendiente">Pendiente</option>
            <option value="pagado">Pagado</option>
            <option value="vencido">Vencido</option>
        </select>

        <!-- Nuevo campo: Moneda -->
        <label for="moneda">Moneda:</label>
        <select id="moneda" name="moneda" required>
            <option value="USD">USD</option>
            <option value="BOL">BOL</option>
            </select>

        <!-- Nuevo campo: TC (Tipo de Cambio) -->
        <label for="tc">TC (Tipo de Cambio):</label>
        <input type="number" id="tc" name="tc" step="0.01" required>

        <button type="submit">Guardar Pago</button>
    </form>
    <a href="infoclientes.php">Volver a Principal</a>
</body>
</html>
>>>>>>> 678d3ebc9945cd060d21d2e2579da4bb76892b65
