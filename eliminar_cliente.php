<?php
include('conec.php');
$conn = getConnection();

// Verificar si se recibió el ID del cliente
if (isset($_GET['id_cliente']) && !empty($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];

    // Eliminar el cliente
    $sql = "DELETE FROM clientes WHERE ID_Cliente = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id_cliente);

    if ($stmt->execute()) {
        header("Location: infoclientes.php");
        exit;
    } else {
        echo "Error al eliminar cliente: " . $conn->error;
    }

    $stmt->close();
    closeConnection($conn);
} else {
    echo "Error: ID del cliente no proporcionado.";
}
?>  