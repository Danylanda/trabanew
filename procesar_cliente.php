<?php
// Verificar si el formulario fue enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar que se recibieron todos los campos necesarios
    if (isset($_POST['Nombre_Cliente']) && !empty($_POST['Nombre_Cliente']) &&
        isset($_POST['CI']) && !empty($_POST['CI']) &&
        isset($_POST['Extension']) && !empty($_POST['Extension']) &&
        isset($_POST['Año']) && !empty($_POST['Año']) &&
        isset($_POST['Mes']) && !empty($_POST['Mes']) &&
        isset($_POST['Telefono']) && !empty($_POST['Telefono']) &&
        isset($_POST['Correo_electronico']) && !empty($_POST['Correo_electronico']) &&
        isset($_POST['Direccion']) && !empty($_POST['Direccion']) &&
        isset($_POST['Puntaje_Infocred']) && !empty($_POST['Puntaje_Infocred'])) {
        
        // Obtener los datos del formulario
        $nombre_cliente = $_POST['Nombre_Cliente'];
        $ci = $_POST['CI'];
        $extension = $_POST['Extension'];
        $año = $_POST['Año'];
        $mes = $_POST['Mes'];
        $telefono = $_POST['Telefono'];
        $correo_electronico = $_POST['Correo_electronico'];
        $direccion = $_POST['Direccion'];
        $puntaje_infocred = $_POST['Puntaje_Infocred'];

        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'root', '', 'sistema_pagos');

        // Comprobar la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Insertar el nuevo cliente
        $sql = "INSERT INTO clientes (Nombre, CI, Extension, Año, Mes, Telefono, Correo_electronico, Direccion, Puntaje_Infocred) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param('sssiisssd', $nombre_cliente, $ci, $extension, $año, $mes, $telefono, $correo_electronico, $direccion, $puntaje_infocred);

        if ($stmt->execute()) {
            echo "Cliente añadido correctamente.";
        } else {
            echo "Error al añadir cliente: " . $conexion->error;
        }

        $stmt->close();
        $conexion->close();
    } else {
        echo "Error: Todos los campos son obligatorios.";
    }
} else {
    echo "Método no permitido.";
}
?>