<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "movile_house");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se recibió el formulario por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idCompra = $_POST["idCompra"];
    $idCliente = $_POST["idCliente"];
    $idProducto = $_POST["idProducto"];
    $nombre = $_POST["nombre"];
    $localidad = $_POST["localidad"];
    $numProductos = $_POST["numProductos"];
    $numTarjeta = $_POST["numTarjeta"];

    // Insertar en la base de datos
    $sql = "INSERT INTO compra ( idCompra, idCliente, idProducto, nombre, localidad, numProductos, numTarjeta)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iiissis", $idCompra, $idCliente, $idProducto, $nombre, $localidad, $numProductos, $numTarjeta);

    if ($stmt->execute()) {
        echo "Compra registrada correctamente.";
    } else {
        echo " Error al registrar compra: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Acceso no permitido.";
}
?>
