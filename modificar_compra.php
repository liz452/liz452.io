<?php 
$conexion = new mysqli("localhost", "root", "", "movile_house");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST['modificar'])) {
    $idCompra = isset($_POST['idCompra']) ? $_POST['idCompra'] : '';
    $idCliente = isset($_POST['idCliente']) ? $_POST['idCliente'] : '';
    $idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : '';
    $numProductos = isset($_POST['numProductos']) ? $_POST['numProductos'] : '';
    $numTarjeta = isset($_POST['numTarjeta']) ? $_POST['numTarjeta'] : '';

    if ($idCompra > 0) {
$stmt = $conexion->prepare("UPDATE compra SET nombre=?, localidad=?, numProductos=?, numTarjeta=?, idCliente=?, idProducto=? WHERE idCompra=?");
        
        if (!$stmt) {
            die("Error en prepare(): " . $conexion->error);
        }
        
        // Ajusta tipos en bind_param según el tipo real de tus columnas
        $stmt->bind_param("sssiiii", $nombre, $localidad, $numProductos, $numTarjeta, $idCliente, $idProducto, $idCompra);

        if ($stmt->execute()) {
            echo "Cliente modificado correctamente.<br>";
        } else {
            echo "Error al modificar: " . $stmt->error . "<br>";
        }
        $stmt->close();
    } else {
        echo "Por favor, ingresa un ID válido para modificar.<br>";
    }
}
?>
