<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "bd_parkingsq");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}

// Obtiene los datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];
$nombre = $_POST['nombre'];
$rol = $_POST['rol'];

try{
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, contrasena, nombre, rol) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $nombre_usuario, $contrasena, $nombre, $rol);
    
    
    if ($stmt->execute()) {
        echo"<script>alert('Usuario creado exitosamente.');</script>";
    } else {
        echo"No se puede crear este usuario";
    }
    $stmt->close();
    $conexion->close();

} catch (mysqli_sql_exception $e) {
    // Manejo de la excepción 
    echo"<script>alert('Nombre de usuario ya usado, vuelva a intentar.');</script>". $e->getMessage() ."";
}
?>
<meta http-equiv="Refresh" content="0; url='admin_panel.php'" />