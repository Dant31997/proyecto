<!DOCTYPE html>
<html>
<head>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

    <title>Supervisor</title>
    <style>
        html{background: linear-gradient(to bottom, rgb(177, 176, 176),70%, #ffffff ); margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; 
        }
        
        body {
            margin-bottom: 43%;
            font-family: Arial, sans-serif;
        }
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
        .custom-button  {
            padding: 10px 20px;
            background-color: red;
            color: #fff;
            font-size: 50px;
            border: none;
            width: 295px;
            height: 50px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 70%; left: 7% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .custom-button:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: flash;
            animation-duration: 2s;
        }

        .custom-button2 {
            padding: 10px 20px;
            background-color: red;
            color: #fff;
            font-size: 50px;
            text-align: center;
            border: none;
            width: 295px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 70%; left: 38% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button2:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: flash;
            animation-duration: 2s;
        }

    
        .custom-button3 {
            padding: 10px 20px;
            background-color: red;
            color: #fff;
            font-size: 50px;
            border: none;
            width: 300px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 70%; left: 68% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-button3:hover {
            background-color: #D62828;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: flash;
            animation-duration: 2s;
        }
        .title1 {
            margin-left: 120px;
        }
        .title2 {
            margin-left: 220px;
        }
        
        .logout-button {
            background-color: gray;
            color: #fff;
            font-size: small;
            padding: 10px 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 1px;
            position: absolute;
            top: 35px; left: 89%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logout-button:hover {
            background-color: #ced4da; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .panel-box-admin {
            width: 390px;
            height: 65px;
            position: absolute;
            top: 5%; left:35%;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px; /* Ajusta el valor para cambiar la curvatura de las esquinas */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2{
            text-align: center;
            top: 20px;
            color: black;
        }
        .imginv {
            position: absolute;
            top: 30%; left:10%;
        }
        .imginv:hover {
            width: 20px ;
            height: 20px;
            position: absolute;
            animation: pulse;
            animation-duration: 2s;

            
        }

        .imgesp {
            position: absolute;
            top: 30%; left:40%;
        }

        .imgesp:hover {
            width: 20px ;
            height: 20px;
            position: absolute;
            animation: pulse;
            animation-duration: 2s;
        }

        .imgpet {
            position: absolute;
            top: 29%; left:65%;
        }

        .imgpet:hover {
            position: absolute;
            animation: pulse;
            animation-duration: 2s;

        }

        .espacios-button2 {
            padding: 10px 20px;
            background-color: gray;
            color: #fff;
            text-align: center;
            border: none;
            width: 295px;
            height: 50px;
            border-radius: 5px;
            text-decoration: none;
            position: absolute;
            top: 75%; left: 22.2% ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .espacios-button2:hover {
            background-color: #ced4da;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo-espacios{
        position: absolute;
        width: 300px;
        border-radius: 10px;
        top: 25%; left: 22%;
    }

    .cobros-button {
            padding: 10px 20px;
            background-color: gray;
            color: white;
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
    <div class="panel-box-admin">
<div class="container">
    <h2>Bienvenido Supervisor</h2>
</div>
</div>
        <a href="cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>
        <form action="espacios.php" method="POST">
        <input class="espacios-button2" name="inv" type="submit" value="ESPACIOS">
        <img src="imagenes/espacios2.png" alt="logo-espacios" class="logo-espacios">
    </form>

    <form action="cobros.php" method="POST">
        <input class="cobros-button" name="cobros" type="submit" value="COBROS">
    </form>
    <img src="imagenes/cobros.png" class="logo-cobros">
     
</body>
</html>
