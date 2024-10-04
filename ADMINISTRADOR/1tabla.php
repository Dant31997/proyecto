<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "basededatos");

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
// Consulta a la base de datos para obtener roles de profesor
$sql = "SELECT id, nombre FROM usuarios WHERE rol = 'profesor'";
$resultado = $conexion->query($sql);

$sql1 = "SELECT cod_espacio, nom_espacio FROM espacios WHERE estado_espacio = 'Libre'";
$resultado1 = $conexion->query($sql1);


// Comprueba si hay resultados
if ($resultado->num_rows > 0) {
    // Imprime la etiqueta de conexión
    echo "Conectado";

    // Imprime el formulario HTML
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Tabla</title>
        <style>
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
        </style>
    </head>
    <body>
        <form action="2tabla.php" method="POST">
            <div class="rol">
                <label for="profesor">Profesor:</label>
                <select id="profesor" name="profesor">
                    <option value="0" disabled selected>------</option>
                    <?php
                    // Genera dinámicamente las opciones del select
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<option value='{$fila['nombre']}'>{$fila['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="espacio">
                <label for="espacio">Espacio:</label>
                <select id="espacio" name="espacio">
                    <option value="0" disabled selected>------</option>
                    <?php
                    // Genera dinámicamente las opciones del select
                    while ($fila1 = $resultado1->fetch_assoc()) {
                        echo "<option value='{$fila1['cod_espacio']}'>{$fila1['nom_espacio']}</option>";
                    }
                    ?>
                </select>
               
            </div>
            <div>
                <button type="button" onclick="mostrarModal()">Elegir Fechas y Horas</button>
            </div>
            <!-- Modal -->
            <div id="myModal" class="modal" onclick="ocultarModal()">
                <div class="modal-content" onclick="event.stopPropagation();">
                    <label for="fecha_entrega">Fecha de Entrega:</label>
                    <input type="date" id="fecha_entrega" name="fecha_entrega" required>
                    <label for="hora_entrega">Hora de Entrega:</label>
                    <input type="time" id="hora_entrega" name="hora_entrega" required>
                    <br>
                    <label for="fecha_regreso">Fecha de Regreso:</label>
                    <input type="date" id="fecha_regreso" name="fecha_regreso" required>
                    <label for="hora_regreso">Hora de Regreso:</label>
                    <input type="time" id="hora_regreso" name="hora_regreso" required>
                    <br>
                    <button type="button" onclick="ocultarModal()">Guardar Fechas y Horas</button>
                </div>
            </div>
            <script>
                function mostrarModal() {
                    document.getElementById('myModal').style.display = 'block';
                }

                function ocultarModal() {
                    document.getElementById('myModal').style.display = 'none';
                }
            </script>
    <input class="btno" type="submit" name="editar"  value="Editar Espacio">

        </form>
    </body>
    </html>
    <?php
} else {
    echo "No se encontraron roles de profesor en la base de datos.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
