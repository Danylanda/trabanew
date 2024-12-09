<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Cliente</title>
<<<<<<< HEAD
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Añadir Cliente</h1>
        <form method="POST" action="procesar_cliente.php">
            <div class="mb-3">
                <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
            </div>

            <div class="mb-3">
                <label for="ci" class="form-label">CI</label>
                <input type="text" class="form-control" id="ci" name="ci" required>
            </div>

            <div class="mb-3">
                <label for="extension" class="form-label">Extensión</label>
                <input type="text" class="form-control" id="extension" name="extension" required>
            </div>

            <div class="mb-3">
                <label for="año" class="form-label">Año</label>
                <input type="number" class="form-control" id="año" name="año" required>
            </div>

            <div class="mb-3">
                <label for="mes" class="form-label">Mes</label>
                <input type="number" class="form-control" id="mes" name="mes" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>

            <div class="mb-3">
                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" required>
            </div>

            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>

            <div class="mb-3">
                <label for="puntaje_infocred" class="form-label">Puntaje Infocred</label>
                <input type="number" step="0.01" class="form-control" id="puntaje_infocred" name="puntaje_infocred" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                <a href="index.php" class="btn btn-secondary">Volver a Principal</a>
            </div>
        </form>
    </div>
</body>
</html>
=======
</head>
<body>
    <h1>Añadir Cliente</h1>
    <form method="POST" action="procesar_cliente.php">
        <label for="nombre_cliente">Nombre del Cliente:</label>
        <input type="text" id="nombre_cliente" name="nombre_cliente" required>
        <button type="submit">Guardar Cliente</button>
    </form>
    <a href="infoclientes.php">Volver a Principal</a>
</body>
</html>
>>>>>>> 678d3ebc9945cd060d21d2e2579da4bb76892b65
