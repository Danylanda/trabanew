<?php
include('conec.php');
$conn = getConnection();

// Verificar si el formulario fue enviado mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar que se recibieron todos los campos necesarios
    if (isset($_POST['ID_Cliente']) && !empty($_POST['ID_Cliente']) &&
        isset($_POST['Fecha_de_pago']) && !empty($_POST['Fecha_de_pago']) &&
        isset($_POST['Monto_recibido']) && !empty($_POST['Monto_recibido']) &&
        isset($_POST['No_Comprobante']) && !empty($_POST['No_Comprobante']) &&
        isset($_POST['ID_Contrato']) && !empty($_POST['ID_Contrato']) &&
        isset($_POST['No_Cuota']) && !empty($_POST['No_Cuota']) &&
        isset($_POST['Tipo_de_Cuota']) && !empty($_POST['Tipo_de_Cuota']) &&
        isset($_POST['Moneda']) && !empty($_POST['Moneda']) &&
        isset($_POST['Tipo_de_Cambio']) && !empty($_POST['Tipo_de_Cambio'])) {
        
        // Obtener los datos del formulario
        $id_cliente = $_POST['ID_Cliente'];
        $fecha_pago = $_POST['Fecha_de_pago'];
        $monto_recibido = $_POST['Monto_recibido'];
        $nro_comprobante = $_POST['No_Comprobante'];
        $id_contrato = $_POST['ID_Contrato'];
        $nro_cuota = $_POST['No_Cuota'];
        $tipo_cuota = $_POST['Tipo_de_Cuota'];
        $moneda = $_POST['Moneda'];
        $tc = $_POST['Tipo_de_Cambio'];

        // Verificar que el ID_Contrato existe en la tabla contratos
        $check_contrato_sql = "SELECT ID_Contrato FROM contratos WHERE ID_Contrato = ?";
        $check_contrato_stmt = $conn->prepare($check_contrato_sql);
        $check_contrato_stmt->bind_param('i', $id_contrato);
        $check_contrato_stmt->execute();
        $check_contrato_result = $check_contrato_stmt->get_result();

        if ($check_contrato_result->num_rows > 0) {
            // Calcular los montos en dólares y bolivianos
            $pago_dolares = ($moneda == 'USD') ? $monto_recibido : $monto_recibido / $tc;
            $pago_bolivianos = ($moneda == 'BOL') ? $monto_recibido : $monto_recibido * $tc;

            // Insertar el nuevo pago
            $sql = "INSERT INTO pagos (ID_Cliente, Fecha_de_pago, No_Comprobante, ID_Contrato, No_Cuota, Tipo_de_Cuota, Moneda, Tipo_de_Cambio, Monto_recibido, Pago_dolares, Pago_bolivianos) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('isssisssddd', $id_cliente, $fecha_pago, $nro_comprobante, $id_contrato, $nro_cuota, $tipo_cuota, $moneda, $tc, $monto_recibido, $pago_dolares, $pago_bolivianos);

            if ($stmt->execute()) {
                header("Location: infoclientes.php");
                exit;
            } else {
                echo "Error al añadir pago: " . $conn->error;
            }

            $stmt->close();
        } else {
            echo "Error: El ID_Contrato proporcionado no existe en la tabla contratos.";
        }

        $check_contrato_stmt->close();
        closeConnection($conn);
    } else {
        echo "Error: Todos los campos son obligatorios.";
    }
} else {
    echo "Método no permitido.";
}
?>