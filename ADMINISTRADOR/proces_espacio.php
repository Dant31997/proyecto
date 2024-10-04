<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "bd_parkingsq");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Procesar el formulario para agregar un nuevo objeto de inventario
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $persona_encargada = "-";
    $fecha_prestamo = "-";
    $hora_entrega= "0";
    $fecha_entrega= "0";
    $hora_regreso= "0";
    $fecha_regreso= "0";

    $sql = "INSERT INTO espacios (nom_espacio, estado_espacio, placa, hora_llegada, hora_salida, fecha, cobro) VALUES (?, ?, ?, ?, ?, ?,?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('sssssss', $nombre, $estado, $persona_encargada, $hora_entrega,  $hora_regreso, $fecha_entrega, $fecha_regreso);

    if ($stmt->execute()) {
        echo"<script>alert('El espacio fue agregado con éxito.');</script>";
    } else {
        echo "Error al agregar el espacio. " . $stmt->error;
    }
}
?>
<meta http-equiv="Refresh" content="1; url='http://localhost/proyecto/ADMINISTRADOR/espacios.php'" />