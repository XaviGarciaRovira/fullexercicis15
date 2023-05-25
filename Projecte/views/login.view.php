<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Averia+Sans+Libre&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/functions.js"></script>
    <title>FilmFlow</title>
</head>

<body>
    <header>

        <a href="index.php" ><img src="img/logo.jpg" alt="logo" id="logo"></a>

        <nav id="menu">

            <a href="index.php">Inici</a>
            <a href="pelis.php">Pelis</a>
            <a href="series.php">Series</a>
            <a href="login.php">Log In</a>

        </nav>

    </header>

    <div id="register">
        <br>


        <form id="inputs" method="post">
            <h1 id="titol">Log In</h1>

            <i class="fa fa-user icons icons2"></i><input type="text" placeholder="Usuari" name="usuari"
                value="<?php if (isset($_COOKIE["usr"])) {
                    echo $_COOKIE["usr"];
                } ?>">
            <br>
            <i class="fa fa-lock icons icons3"></i><input type="password" placeholder="Contrasenya" name="contrasenya"
                value="<?php if (isset($_COOKIE["contra"])) {
                    echo $_COOKIE["contra"];
                } ?>">

            <p id="link">No tens un compte creat? <a href="registrar.php">Entra aquí</a></p>

            <input type="submit" value="Enviar" id="enviar">

            <?php

            // Establecer la conexión con la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "1dam2223";
            $dbname = "filmflow";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar si hay errores en la conexión
            if ($conn->connect_error) {
                die("Error en la conexión: " . $conn->connect_error);
            }

            session_start();

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Obtener los valores del formulario
            
                $usuari = $_POST["usuari"];
                $contrasenya = $_POST["contrasenya"];

                // Preparar la consulta SQL
            
                $comprova = "SELECT id_compte FROM compte WHERE usuari = '$usuari' AND contrassenya = '$contrasenya'";
                $idclient = "SELECT id_client FROM compte WHERE usuari = '$usuari' AND contrassenya = '$contrasenya'";

                $resultat = mysqli_query($conn, $idclient);

                if (mysqli_num_rows($resultat) > 0) {
                    while ($row = mysqli_fetch_assoc($resultat)) {
                        $idclient = $row['id_client'];
                        
                    }
                }

                // Ejecutar la consulta SQL
                if ($conn->query($comprova)->num_rows > 0) {

                    setcookie(
                        "usr",
                        $usuari,
                    );
                    setcookie(
                        "contra",
                        $contrasenya,
                    );


                    $_SESSION['id_client'] = $idclient;
                    $_SESSION['sessio'] = TRUE;
                    $_SESSION['usuari'] = $usuari;
                    header("Location:index.php");
                    exit();

                } else {
                    $_SESSION['sessio'] = FALSE;
                    echo "<div style='font-size: 2rem; text-align: center; color: white;'>Usuari o contrassenya malament</div>";
                }


            }
            // Cerrar la conexión con la base de datos
            $conn->close();
            ?>


        </form>

    </div>

    <footer>
        <p>Feta per Arnau i Xavi</p>
    </footer>

</body>



</html>