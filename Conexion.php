<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $db_host = "localhost";
    $db_name = "empresa";
    $db_user = "root";
    $db_password = "";

    $conexion = mysqli_connect($db_host,$db_user,$db_password.$db_name);

    if(mysqli_connect_errno()){
        echo "No se pudo realizar la conexión al base de datos";
        exit();
    }
    $consulta = "SELECT * FROM productos";

    $resultado=mysqli_query($conexion,$consulta);

    $fila = mysqli_fetch_row($resultado);

    echo $fila[0] . "";
    echo $fila[1] . "";
    echo $fila[2] . "";
    echo $fila[3] . "";
    ?>
</body>
</html>