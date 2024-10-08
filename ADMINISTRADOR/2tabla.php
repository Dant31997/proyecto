<?php
$fecha_entrega = $_POST['fecha_entrega'];
$fecha_regreso = $_POST['fecha_regreso'];
$hora_entrega = $_POST['hora_entrega'];
$hora_regreso = $_POST['hora_regreso'];
$cod_espacio = $_POST['espacio'];
$nom_profesor = $_POST['profesor'];

$hora_entrega = validarYLimpiarTiempo($hora_entrega);
$hora_regreso = validarYLimpiarTiempo($hora_regreso);
$fecha_entrega = validarYLimpiarFecha($fecha_entrega);
$fecha_regreso = validarYLimpiarFecha($fecha_regreso);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basededatos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$hora_actual = date('H:i:s');

$sql_estado_actual = "SELECT estado_espacio, hora_regreso FROM espacios WHERE cod_espacio = ?";
$stmt_estado_actual = $conn->prepare($sql_estado_actual);
$stmt_estado_actual->bind_param("s", $cod_espacio);
$stmt_estado_actual->execute();
$stmt_estado_actual->bind_result($estado_actual, $hora_regreso_actual);
$fetch_result = $stmt_estado_actual->fetch();
$stmt_estado_actual->close();

if ($fetch_result === false) {
    die("Error al obtener la hora de regreso actual: " . $stmt_estado_actual->error);
}

echo "Estado actual: $estado_actual, Hora regreso actual: $hora_regreso_actual, Hora actual: $hora_actual<br>";

if ($estado_actual == "ocupado" && $hora_actual >= $hora_regreso_actual) {
    $sql_cambio_estado = "UPDATE espacios SET estado_espacio = 'libre', persona_encargada = NULL WHERE cod_espacio = ?";
    $stmt_cambio_estado = $conn->prepare($sql_cambio_estado);
    $stmt_cambio_estado->bind_param("s", $cod_espacio);
    $stmt_cambio_estado->execute();
    $stmt_cambio_estado->close();

    echo "¡El espacio ha vuelto a estar disponible!";
} elseif ($estado_actual == "ocupado") {
    echo "El espacio está ocupado y no se puede modificar en este momento.";
} else {
    $sql_disponibilidad = "SELECT * FROM espacios WHERE cod_espacio <> ? AND ((fecha_entrega = ? AND hora_entrega BETWEEN ? AND ?) OR (fecha_regreso = ? AND hora_regreso BETWEEN ? AND ?))";
    $stmt_disponibilidad = $conn->prepare($sql_disponibilidad);
    $stmt_disponibilidad->bind_param("sssssss", $cod_espacio, $fecha_entrega, $hora_entrega, $hora_regreso, $fecha_regreso, $hora_entrega, $hora_regreso);

    $stmt_disponibilidad->execute();
    $result_disponibilidad = $stmt_disponibilidad->get_result();

    if ($result_disponibilidad->num_rows > 0) {
        echo "Lo siento, el espacio ya está reservado en ese horario por otro espacio.";
    } else {
        $sql_modificacion = "UPDATE espacios SET hora_entrega = ?, hora_regreso = ?, fecha_entrega = ?, fecha_regreso = ?, estado_espacio = 'ocupado', persona_encargada = ? WHERE cod_espacio = ?";
        $stmt_modificacion = $conn->prepare($sql_modificacion);
        $stmt_modificacion->bind_param("ssssss", $hora_entrega, $hora_regreso, $fecha_entrega, $fecha_regreso, $nom_profesor, $cod_espacio);

        if ($stmt_modificacion->execute()) {
            echo "¡Modificación exitosa!";
        } else {
            echo "Error al realizar la modificación: " . $stmt_modificacion->error;
        }

        $stmt_modificacion->close();
    }

    $stmt_disponibilidad->close();
}

$conn->close();

function validarYLimpiarTiempo($tiempo)
{
    return date('H:i:s', strtotime($tiempo));
}

function validarYLimpiarFecha($fecha)
{
    return date('Y-m-d', strtotime($fecha));
}
?>
<script>
    window.history.go(-1);
    window.history.back();
</script>