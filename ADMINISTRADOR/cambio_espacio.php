<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "bd_parkingsq");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}


// Obtiene los datos del formulario
$nom_espacio = $_POST['nom_espacio'];
$estado_espacio = $_POST['estado_espacio'];
$persona_encargada = $_POST['placa'];
$fecha_entrega = $_POST['hora_llegada'];
$fecha_regreso = $_POST['hora_salida'];
$hora_entrega = $_POST['fecha'];
$hora_regreso = $_POST['cobro'];

// Inicializa la parte SET de la consulta SQL
$set = array();
$tipos = "";
$valores = array();

if (!empty($nom_espacio)) {
    $set[] = "nom_espacio = ?";
    $tipos .= 's';
    $valores[] = $nom_espacio;
}

if (!empty($estado_espacio)) {
    $set[] = "estado_espacio = ?";
    $tipos .= 's';
    $valores[] = $estado_espacio;
}

if (!empty($persona_encargada)){
    $set[] = "placa = ?";
    $tipos .= 's';
    $valores[] = $persona_encargada;
}

if (!empty($fecha_entrega)) {
    $set[] = "hora_llegada = ?";
    $tipos .= 's';
    $valores[] = $fecha_entrega;
}

if (!empty($fecha_regreso)) {
    $set[] = "hora_salida = ?";
    $tipos .= 's';
    $valores[] = $fecha_regreso;
}

if (!empty($hora_entrega)) {
    $set[] = "fecha= ?";
    $tipos .= 's';
    $valores[] = $hora_entrega;

} if (!empty($hora_regreso)){
    $set[] = "cobro = ?";
    $tipos .= 's';
    $valores[] = $hora_regreso;
}

// Consulta SQL para actualizar los campos especificados
$sql = "UPDATE espacios SET " . implode(", ", $set) . " WHERE nom_espacio = ?";
$tipos .= 'i'; // Agrega el tipo de dato para el ID
$valores[] = $nom_espacio   ;

$stmt = $conexion->prepare($sql);
$stmt->bind_param($tipos, ...$valores);

if ($stmt->execute()) {
    echo "Campos actualizados correctamente.";
} else {
    echo "Error al actualizar los campos: " . $stmt->error;
}

// Cierra la conexión
$conexion->close();
?>

<meta http-equiv="Refresh" content="1; url='http://localhost/proyecto/ADMINISTRADOR/admin_panel.php'" />