<title>ESPACIOS</title>
<style>
    html{background: linear-gradient(to bottom, rgb(177, 176, 176),70%, #ffffff ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }
    body{
        font-family: Arial, sans-serif;
            margin-top: 3%;
            margin-right: 7%;
    }
    .regresar {
            display: inline-block;
            padding: 10px 20px;
            background-color: gray;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 90.5%; left: 55%;
        }
        .regresar:hover {
            background-color: #ced4da;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .custom-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: gray;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            position: absolute;
            top: 90.5%; left: 35%;
        }
        .custom-button:hover {
            background-color: #ced4da;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       
        th {
            text-align: center;
        }
        tr {
            text-align: center;
        }
        table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 14px;
            margin-left: 120px;       
            border-collapse: collapse; 
        }

        th {     font-size: 13px;     font-weight: normal;     padding: 8px;     background: gray;
            border-top: 4px solid gray;    border-bottom: 1px solid #fff; color: white; font-weight: bold; }

        td {    padding: 8px;     background: white;     border-bottom: 1px solid #fff;
            color: black;    border-top: 1px solid transparent; border-color: black; }

        tr:hover td { background: #d0dafd; color: #339; }

        .pagination {
        text-align: center;
        margin-top: 2%;
        margin-left: 10%;
    }

    .pagination a {
        display: inline-block;
        padding: 5px 10px;
        margin-left: 1%;
        border: 1px solid #d0dafd;
        text-decoration: none;
        color: #000;
    }

    .pagination a.active {
        background-color: gray;
        color: #fff;
        border: 1px solid #000;
    }
    .panel-box-admin {
        width: 270px;
        height: 60px;
        position: absolute;
        top: 2%; left:39%;
        background-color: #fff;
        border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }
        .tabla1 {
            margin-top: 7%;
        }

</style>
<?php
echo "<div class='tabla2'>";
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "bd_parkingsq");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }
    
    $registrosPorPagina = 5;
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    
    // Consulta SQL con LIMIT para obtener registros de la página actual
    $offset = ($paginaActual - 1) * $registrosPorPagina;
    $sql = "SELECT * FROM espacios LIMIT $offset, $registrosPorPagina";
    $resultado = $conexion->query($sql);
    
    // Consulta SQL para obtener el número total de registros
    $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM espacios")->fetch_assoc()['total'];
    
    // Calcular el número total de páginas
    $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);

if ($resultado->num_rows > 0) {
    echo "<div class='panel-box-admin'>";
    echo "<h2 class ='title2' align='center'>ESPACIOS</h2>";
    echo "</div>";
    echo "<table class='tabla1' border='1'>";
    echo "<tr class= 'encabezado'>
    <th>Cód.espacio</th>
    <th style=width:200px; > Nombre del espacio </th>
    <th style=width:80px;> Estado </th>
    <th style=width:100px;> Placa</th>
    <th style=width:100px;> Hora de llegada </th>
    <th style=width:100px;> Hora de salida </th>
    <th style=width:100px;> fecha </th>
    <th style=width:100px;> Cobro </th>
    <th style=width:100px>Acciones</th>
    </tr>";
    

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['cod_espacio'] . "</td>";
        echo "<td>" . $fila['nom_espacio'] . "</td>";
        echo "<td>" . $fila['estado_espacio'] . "</td>";
        echo "<td>" . $fila['placa'] . "</td>";
        echo "<td>" . $fila['hora_llegada'] . "</td>";
        echo "<td>" . $fila['hora_salida'] . "</td>";
        echo "<td>" . $fila['fecha'] . "</td>";
        echo "<td>" . $fila['cobro'] . "</td>";
        echo "<td><a href='editar_espacio.php?cod_espacio=" . $fila['cod_espacio'] . "&nom_espacio=" . $fila['nom_espacio'] ."&placa=" . $fila['placa']. "&estado_espacio=" . $fila['estado_espacio'] . "&hora_llegada=" . $fila['hora_llegada']. "&hora_salida=" . $fila['hora_salida'] . "&fecha=" .$fila['fecha'] ."&cobro=" . $fila['cobro'] ."'><img src='imagenes/editar.png' /></a><h>--</h><a href='eliminar_espacio.php?cod_espacio=" . $fila['cod_espacio'] . "'><img src='imagenes/eliminar.png' /></a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}

$conexion->close();

?>
<!-- Crear los enlaces de paginación -->
    
<div class="pagination">
        <?php
        for ($i = 1; $i <= $numTotalPaginas; $i++) {
            $claseActiva = ($i == $paginaActual) ? "active" : "";
            echo "<a class='$claseActiva' href='espacios.php?pagina=$i'>$i</a>";
        }
        ?>
</div>
<br>
<a class="custom-button" href="agregarespacio.php">Agregar Espacio</a>
<?php
    $paginavolver = "";
        if (isset($_POST['inv'])) {
            $paginavolver = "http://localhost/proyecto/ADMINISTRADOR/admin_panel.php";
        }
    ?>
    <a class ="regresar" href="admin_panel.php">Regresar</a>
