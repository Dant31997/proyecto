<?php
// Función para conectar a la base de datos
function conectarBaseDatos() {
    $conexion = new mysqli("localhost", "root", "", "bd_parkingsq");
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
    return $conexion;
}

// Función para obtener datos de la tabla "inventario"
function obtenerDatosInventario($cod_espacio) {
    $conexion = conectarBaseDatos();
    
    $sql = "SELECT nom_espacio, estado_espacio, placa, hora_llegada, hora_salida, fecha, cobro FROM espacios WHERE cod_espacio = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $cod_espacio);
    $stmt->execute();
    $stmt->bind_result( $nom_inventario, $estado, $nombre_persona, $hora_entrega, $fecha_entrega, $hora_regreso, $fecha_regreso);
    $stmt->fetch();
    $stmt->close();
    
    return [
        'nom_espacio' => $nom_inventario,
        'estado_espacio' => $estado,
        'placa'=>$nombre_persona,
        'hora_llegada' => $hora_entrega,
        'hora_salida' => $fecha_entrega,
        'fecha' => $hora_regreso,
        'cobro' => $fecha_regreso
    ];
}

// Obtener el código de espacio desde la URL
$cod_espacio = isset($_GET['cod_espacio']) ? $_GET['cod_espacio'] : null;

// Obtener datos de la tabla "inventario" si hay un código de espacio
$datos_inventario = null;
if ($cod_espacio) {
    $datos_inventario = obtenerDatosInventario($cod_espacio);
}

?>
<style>
       html{background: linear-gradient(to bottom, white,70%, #FADBD8 ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }

    body{
        font-family: Arial, sans-serif;
            
    }
            /* Estilos para el modal */
            #myModal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
                padding-top: 60px;
            }
            .modal-content {
                background-color: #fefefe;
                margin: 5% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }

    .regresar {
            display: inline-block;
            padding: 10px 20px;
            background-color: red;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 90%; left:44%;
           
        }
        .regresar:hover {
            background-color: #D62828;
        }
        .custom-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: red;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 35%;
        }
        .custom-button:hover {
            background-color: #D62828;
        }
       
        th {
            text-align: center;
        }
        tr {
            text-align: center;
        }
        table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 12px;
            margin-left: 60px;       
            border-collapse: collapse; 
        }
        th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: #b9c9fe;
            border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #039; }

        td {    padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
            color: #669;    border-top: 1px solid transparent; }

        tr:hover td { background: #d0dafd; color: #339; }

        .title1 {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        }

        .login-box {
            width: 380px;
            height: 468px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
        }

        .btno {
            display: inline-block;
            padding: 10px 20px;
            background-color: red;
            color: #FFF;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 30%;
            
        }
        .btno:hover {
            background-color: #D62828;
        }

        .inputcentrado {
            text-align: center;
        }

</style>
<br>
<div class="login-box">
    <h3>Editar Espacio</h3>
    <br>
    <form action="cambio_espacio.php" method="POST">
        <div class="form-group">
            <label for="cod_espacio">Cod. Espacio:</label>
            <input class="inputcentrado" type="number" style="width: 50px; height:  20px" id="cod_espacio" name="cod_espacio" value="<?php echo $cod_espacio; ?>">
        </div>
        <br>

        <div class="form-group">
            <label for="nom_inventario"> Nombre del dispositivo</label>
            <input class="" type="text" name="nom_espacio" id="nom_espacio" value="<?php echo $datos_inventario['nom_espacio']; ?>">
        </div>
        <br>
        <div class="form-group">
            <label for="placa"> Placa</label>
            <input class="" type="text" name="placa" id="placa" value="<?php echo $datos_inventario['placa']; ?>">
        </div>
        <br>
        
        <div class="form-group">
                <label for="estado_espacio">Estado Actual:</label>
                <input disabled type="text" style="width : 80px; heigth : 20px" id="estado_espacio" name="estado_espacio" value="<?php echo $datos_inventario['estado_espacio']; ?>">
        </div>
        <br>
        <div class="form-group">
                <label for="estado_espacio">Estado:</label>
                <select id="estado_espacio" name="estado_espacio" >
                    <option value="libre">Libre</option>
                    <option value="ocupado">Ocupado</option>
                </select>
        </div>
        <br>
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $datos_inventario['fecha']; ?>" required>
        </div>
        
        <br>
        <div class="form-group">
            <label for="hora_llegada">Hora de llegada:</label>
            <input type="time" id="hora_llegada" name="hora_llegada" value="<?php echo $datos_inventario['hora_llegada']; ?>" required>
        </div>
        <br>
        
        <div class="form-group">
            <label for="hora_salida">Hora de salida:</label>
            <input type="time" id="hora_salida" name="hora_salida" value="<?php echo $datos_inventario['hora_salida']; ?>" required>
        </div>
        <br>
        <div class="form-group">
            <label for="cobro">A cobrar:</label>
            <input type="decimal" id="cobro" name="cobro" value="<?php echo $datos_inventario['cobro']; ?>" required>
        </div>
        <br>
        <!-- Otros campos del formulario ... -->

        <input class="btno" type="submit" name="editar" value="Editar Espacio">
    </form>
</div>
<br>
<a class="regresar" href="espacios.php">Volver al listado</a>
