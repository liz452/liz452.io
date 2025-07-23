<?php
$conexion = new mysqli("localhost", "root", "", "movile_house");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Ejecutar la consulta
$resultado = $conexion->query("SELECT * FROM compra");

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    echo "<h1>Listado de Compras</h1>";
    echo "<table border='1' cellpadding='8'>";
    echo "<tr>
            <th>ID Compra</th>
            <th>ID Cliente</th>
            <th>ID Producto</th>
            <th>Nombre</th>
            <th>Localidad</th>
            <th>Nº Productos</th>
            <th>Tarjeta</th>
          </tr>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['idCompra']}</td>
                <td>{$fila['idCliente']}</td>
                <td>{$fila['idProducto']}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['localidad']}</td>
                <td>{$fila['numProductos']}</td>
                <td>{$fila['numTarjeta']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<h2>No hay registros de compras.</h2>";
}

// Cerrar conexión
$conexion->close();
?>
