<?php
// agregar-cliente.php

// Datos de conexión
$host = "localhost";
$usuario = "root";
$contrasena = "";  // Contraseña vacía sin espacio
$basededatos = "movile_house";

// Crear conexión
$conn = new mysqli($host, $usuario, $contrasena, $basededatos);


// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar que el formulario envió todos los datos necesarios
if (
    isset($_POST['ID_Cliente'], $_POST['nombre'], $_POST['apellidoPat'], $_POST['apellidoMat'], $_POST['telefono'], $_POST['edad'], $_POST['direccion'])
) {
    // Recibir y limpiar datos con tipos correctos
    $ID_Cliente = (int) $_POST['ID_Cliente'];
    $nombre = trim($_POST['nombre']);
    $apellidoPat = trim($_POST['apellidoPat']);
    $apellidoMat = trim($_POST['apellidoMat']);
    $telefono = (int) $_POST['telefono'];
    $edad = trim($_POST['edad']);  // varchar
    $direccion = trim($_POST['direccion']);

    // Validar campos obligatorios
    if ($ID_Cliente <= 0 || empty($nombre) || empty($apellidoPat) || $telefono <= 0 || empty($edad) || empty($direccion)) {
        die("Por favor completa todos los campos obligatorios correctamente.");
    }

    // Preparar consulta
    $stmt = $conn->prepare("INSERT INTO cliente (ID_Cliente, nombre, apellidoPat, apellidoMat, telefono, edad, direccion) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Asociar parámetros (i=integer, s=string)
    $stmt->bind_param("isssiis", $ID_Cliente, $nombre, $apellidoPat, $apellidoMat, $telefono, $edad, $direccion);

    // Ejecutar consulta
    if ($stmt->execute()) {
        echo "Cliente agregado correctamente.";
    } else {
        echo "Error al agregar cliente: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No se recibieron todos los datos del formulario.";
}

$conn->close();
?>