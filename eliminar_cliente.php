<?php
header("Content-Type: text/html; charset=UTF-8");

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "movile_house");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si se recibió el ID_Cliente
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ID_Cliente'])) {
    $id = $_POST['ID_Cliente'];

    if (!empty($id)) {
        $stmt = $conexion->prepare("DELETE FROM cliente WHERE ID_Cliente = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<h2>✅ Cliente eliminado correctamente.</h2>";
        } else {
            echo "<h2>❌ Error al eliminar: " . $stmt->error . "</h2>";
        }

        $stmt->close();
    } else {
        echo "<h2>⚠️ El ID del cliente está vacío.</h2>";
    }
} else {
    echo "<h2>⚠️ No se recibió ningún ID de cliente.</h2>";
}

$conexion->close();
?>
