<!DOCTYPE html>
<html lang="en">
    <title>Cobros</title>
    <style>
        html{background: linear-gradient(to bottom, rgb(177, 176, 176),70%, #ffffff ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }
    body{
        font-family: Arial, sans-serif;
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
            top: 90.5%; left: 45%;
        }
        .regresar:hover {
            background-color: #ced4da;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
       
        th {
            text-align: center;
        }
        tr {
            text-align: center;
        }
        table {     
            
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 14px;
            position: absolute; 
            top: 20%; left: 5%;
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
        margin-left: 5%;
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
        width: 190px;
        height: 65px;
        position: absolute;
        top: 2%; left:42%;
        background-color: #fff;
        border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }
        

    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
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
    $sql = "SELECT * FROM registro LIMIT $offset, $registrosPorPagina";
    $resultado = $conexion->query($sql);
    
    // Consulta SQL para obtener el número total de registros
    $totalRegistros = $conexion->query("SELECT COUNT(*) as total FROM registro")->fetch_assoc()['total'];
    
    // Calcular el número total de páginas
    $numTotalPaginas = ceil($totalRegistros / $registrosPorPagina);

if ($resultado->num_rows > -1) {
    echo "<div class='panel-box-admin'>";
    echo "<h2 align='center'>COBROS</h2>";
    echo "</div>";
    echo "<table class='tabla1' border='1'>";
    echo "<tr class= 'encabezado'>
    <th style=width:100px; > Placa </th>
    <th style=width:200px;> Hora de entrada </th>
    <th style=width:200px;> Hora de salida </th>
    <th style=width:200px;> Espacio ocupado</th>
    <th style=width:200px;> Pago</th>
    <th style=width:200px;> Fecha </th>
    </tr>";
    

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['placa'] . "</td>";
        echo "<td>" . $fila['hora_llegada'] . "</td>";
        echo "<td>" . $fila['hora_salida'] . "</td>";
        echo "<td>" . $fila['espacio_ocupado'] . "</td>";
        echo "<td>" . $fila['tarifa_pagada'] . "</td>";
        echo "<td>" . $fila['fecha'] . "</td>";
        
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
            echo "<a class='$claseActiva' href='cobros.php?pagina=$i'>$i</a>";
        }
        ?>
</div>
<br>

<?php
    $paginavolver = "";
        if (isset($_POST['inv'])) {
            $paginavolver = "http://localhost/proyecto/ADMINISTRADOR/admin_panel.php";
        }
    ?>
    <a class ="regresar" href="admin_panel.php">Regresar</a>
    
</body>
</html>