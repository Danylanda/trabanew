<?php
// Función para establecer la conexión a la base de datos
function getConnection() {
    $servername = "localhost"; // Servidor de la base de datos
    $username = "root";        // Usuario de la base de datos
    $password = "";            // Contraseña de la base de datos
    $dbname = "sistema_pagos"; // Nombre de la base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}

// Función para obtener los pagos de la tabla `pagos`
function getPagos($conn) {
    $sql = "
        SELECT 
            MONTH(fecha_pago) AS mes, 
            YEAR(fecha_pago) AS anio, 
            SUM(monto_recibido) AS total,
<<<<<<< HEAD
            SUM(pago_dolares) AS interes,
            SUM(pago_bolivianos) AS capital
=======
            SUM(pago_en_dolares) AS interes,
            SUM(pago_en_bolivianos) AS capital
>>>>>>> 678d3ebc9945cd060d21d2e2579da4bb76892b65
        FROM pagos 
        WHERE YEAR(fecha_pago) = 2024
        GROUP BY mes, anio
    ";

    $result = $conn->query($sql);
    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

// Función para obtener todos los clientes
function getClientes($conn) {
    $sql = "SELECT * FROM clientes ORDER BY ID_Cliente";
    $result = $conn->query($sql);
    $clientes = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
    }
    return $clientes;
}

// Función para obtener todos los contratos
function getContratos($conn) {
    $sql = "SELECT * FROM contratos ORDER BY ID_Contrato";
    $result = $conn->query($sql);
    $contratos = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $contratos[] = $row;
        }
    }
    return $contratos;
}

// Función para obtener todos los planes de pago
function getPlanesDePago($conn) {
    $sql = "SELECT * FROM planes_de_pago ORDER BY ID_plan_pagos";
    $result = $conn->query($sql);
    $planes = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $planes[] = $row;
        }
    }
    return $planes;
}

// Función para obtener todos los proyectos
function getProyectos($conn) {
    $sql = "SELECT * FROM proyectos ORDER BY ID_item";
    $result = $conn->query($sql);
    $proyectos = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $proyectos[] = $row;
        }
    }
    return $proyectos;
}

// Función para obtener todos los pagos a cuenta
function getPagosACuenta($conn) {
    $sql = "SELECT * FROM pago_a_cuenta ORDER BY ID_pagos";
    $result = $conn->query($sql);
    $pagos = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pagos[] = $row;
        }
    }
    return $pagos;
}

// Función para cerrar la conexión
function closeConnection($conn) {
    $conn->close();
}
?>
?>
