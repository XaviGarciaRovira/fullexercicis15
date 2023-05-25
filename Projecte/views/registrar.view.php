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

        <a href="index.php"><img src="img/logo.jpg" alt="logo" id="logo"></a>

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
            <h1 id="titol">Sign Up</h1>

            <i class="fa fa-drivers-license icons"></i><input type="text" placeholder="Nom" name="nom">
            <br>
            <i class="fa fa-at icons icons2"></i><input type="text" placeholder="Email" name="email">
            <br>
            <i class="fa fa-mobile-phone icons phone"></i><input type="text" placeholder="Telefon" name="telefon">
            <br>
            <i class="fa fa-calendar icons calendari"></i><input type="text"
                placeholder="Data de naixement (any/mes/dia)" name="data_naixement">
            <br>
            <i class="fa fa-user icons icons2"></i><input type="text" placeholder="Usuari" name="usuari">
            <br>
            <i class="fa fa-lock icons icons3"></i><input type="password" placeholder="Contrasenya" name="contrasenya">
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

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Obtener los valores del formulario
                $nom = $_POST["nom"];
                $email = $_POST["email"];
                $telefon = $_POST["telefon"];
                $data_naixement = $_POST["data_naixement"];
                $usuari = $_POST["usuari"];
                $contrasenya = $_POST["contrasenya"];

                if ($nom == null) {
                    echo "<div style='font-size: 2rem; text-align: center; color: white;'>Afegeix un nom</div>";
                } else if ($email == null) {
                    echo "<div style='font-size: 2rem; text-align: center; color: white;'>Afegeix un email</div>";
                } else if ($telefon == null) {
                    echo "<div style='font-size: 2rem; text-align: center; color: white;'>Afegeix un telefon</div>";
                } else if ($data_naixement == null) {
                    echo "<div style='font-size: 2rem; text-align: center; color: white;'>Afegeix una data de naixement</div>";
                } else if ($usuari == null) {
                    echo "<div style='font-size: 2rem; text-align: center; color: white;'>Afegeix un usuari</div>";
                } else if ($contrasenya == null) {
                    echo "<div style='font-size: 2rem; text-align: center; color: white;'>Afegeix una contrasenya</div>";
                } else {

                    // Preparar la consulta SQL
                    $sql = "INSERT INTO clients (Nom, email, telefon, edat_data_naixement) VALUES ('$nom', '$email', '$telefon', '$data_naixement')";
                    $sql2 = "INSERT INTO compte (usuari, contrassenya, data_alta) VALUES ('$usuari','$contrasenya', NOW())";
                    $comprova = "SELECT usuari FROM compte WHERE usuari = '$usuari'";

                    // Ejecutar la consulta SQL
                    if ($conn->query($comprova)->num_rows > 0) {
                        echo "<div style='font-size: 2rem; text-align: center; color: white;'>Aquest usuari ja existeix</div>";
                    } else if ($conn->query($sql) === FALSE || $conn->query($sql2) === FALSE) {
                        echo "<div style='font-size: 2rem; text-align: center; color: white;'>Error: " . $conn->error . "</div>";
                    } else {
                        echo "<div style='font-size: 2rem; text-align: center; color: white;'>Compte creat correctament</div>";
                        header("Location: http://localhost/Projecte/login.php", TRUE, 301);
                        exit();
                    }
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