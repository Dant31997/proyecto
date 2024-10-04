<!DOCTYPE html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nombre'])) {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "bd_parkingsq");

    // Verifica la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    global $nombre_admin;
    $nombre_admin = $_GET['nombre'];
}
?>

<html>
<head>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <title>Panel de Administrador</title>

    <style>
            html{background: linear-gradient(to bottom, rgb(177, 176, 176),70%, #ffffff ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            margin-bottom: 48%;
        }
        
        .form-group {
            margin-bottom: 20px;

        }
        .logout-button {
            background-color: gray;
            color: black;
            font-size: small;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            position: absolute;
            top: 35px; left: 89%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logout-button:hover {
            background-color: #ced4da;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .panel-box {
            max-width: 800px;
            height: 370px;
            position: absolute;
            top: 25%; left:3%;
            padding: 20px;
            width: 325px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .panel-box-admin {
            width: 360px;
            height: 65px;
            position: absolute;
            top: 5%; left:39%;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .lista {
            background-color: gray;
            color: black;
            font-size: small;
            padding: 10px 20px;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            position: absolute;
            top: 82%; left: 33%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .lista:hover {
            background-color: #ced4da;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .crear_usu {
            background-color: gray;
            color: black;
            font-size: small;
            padding: 10px 20px;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            position: absolute;
            top: 68%; left: 35%;
        }

        .crear_usu:hover {
            background-color: #ced4da;
            color: white;
        }
        h2 {
            
            text-align: center;
        }

        h3 {
            text-align: center;
        }   

        .espacios-button2 {
            padding: 10px 20px;
            background-color: gray;
            color: black;
            text-align: center;
            border: none;
            width: 295px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 75%; left: 32.2% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .espacios-button2:hover {
            background-color: #ced4da;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .rol{
            left: 50%;
        }


    .logo-espacios{
        position: absolute;
        width: 300px;
        border-radius: 10px;
        top: 25%; left: 32%;
    }

    .reg_empleados-button {
            padding: 10px 20px;
            background-color: gray;
            color: black;
            text-align: center;
            border: none;
            width: 260px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 75%; left: 79% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .reg_empleados-button:hover {
            background-color: #ced4da;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo-regempleados{
        position: absolute;
        width: 300px;
        border-radius: 10px;
        top: 27%; left: 77%;
    }
    .logo-usu{
        position: absolute;
        border-radius: 10px;
        top: 25%; left: 14%;
    }

    .cobros-button {
            padding: 10px 20px;
            background-color: gray;
            color: black;
            text-align: center;
            border: none;
            width: 260px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 75%; left: 57% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cobros-button:hover {
            background-color: #ced4da;
            color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo-cobros{
        position: absolute;
        border-radius: 10px;
        top: 25%; left: 56%;
    }
    </style>
</head>
<body>
<img src="imagenes/espacios2.png" alt="logo-espacios" class="logo-espacios">
    <div class="panel-box-admin">
        <h2>Bienvenido Administrador!</h2>
        
    </div>
        <a href="cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>

    <div class="panel-box">
        
        <!-- Formulario para crear un nuevo usuario -->
        <br>
        <br>
        <h3>Crear Nuevo Usuario</h3>
        <form action="crear_usuario.php" method="POST">
            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            <div class="form-group">
                <label for="nombre">nombre completo:  &nbsp;&nbsp; </label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="rol">
                <label for="rol"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rol:</label>
                <select id="rol" name="rol">
                
                    <!--<option disabled selected default>Rol</option>--->
                    <option value="Supervisor">Supervisor</option>
                    <option value="Administrador">Administrador</option>
                    
                </select>
            </div>
            <input class="crear_usu" type="submit" value="Crear Usuario" >

            <div>
            <br>
                <a class ="lista" href='listar_usuarios.php' class="lista">Lista de Usuarios</a>
            </div>
        </form>
    </div> 
    <form action="espacios.php" method="POST">
        <input class="espacios-button2" name="inv" type="submit" value="ESPACIOS">
    </form>
    <form action="reg_empleados.php" method="POST">
        <input class="reg_empleados-button" name="reg" type="submit" value="REGISTRO DE EMPLEADOS">
    </form>

    <img src="imagenes/regempleados.png" alt="logo-regempleados" class="logo-regempleados">

    <img src="imagenes/usu.png" class="logo-usu">

    <form action="cobros.php" method="POST">
        <input class="cobros-button" name="cobros" type="submit" value="COBROS">
    </form>
    <img src="imagenes/cobros.png" class="logo-cobros">
</body>
</html>
