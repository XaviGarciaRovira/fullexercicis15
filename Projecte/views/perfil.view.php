<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Averia+Sans+Libre&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/functions.js"></script>
    <title>Filmflow</title>
</head>

<body id="cos">

    <header>

        <a href="index.php" ><img src="img/logo.jpg" alt="logo" id="logo"></a>

        <nav id="menu">

            <a id="lupa"><i class="fa fa-search"></i></a>
            <a href="index.php">Inici</a>
            <a href="pelis.php">Pelis</a>
            <a href="series.php">Series</a>
            <?php



            session_start();

            $usr = "";
            $usr = $_SESSION['usuari'];

            if (isset($_SESSION['sessio'])) {
                // Si el usuario ha iniciado sesión
            
                echo '<a id="perfil" onclick="desplegar()"><i class="fa fa-user icons icons2"></i> ' . $_SESSION['usuari'] . '</a>';
            } else {
                // Si el usuario no ha iniciado sesión
                echo '<a href="login.php">Log In</a>';
            }
            ?>

        </nav>

    </header>

    <div id="blocllista">
        <div id="llista">
            <a href="perfil.php"><i class="fa fa-user"></i> Perfil</a>
            <a href="vip.php">Vistes i <br>Preferides</a>
            <a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a>
        </div>
    </div>

    <div id="cap">
        <i class="fa fa-user perfil"></i>
        <?php echo "<a id='user'>" . $_SESSION['usuari'] . "</a>" ?>
    </div>

    <div id="all">
        <div id="seccions">

            <a onclick="perfil()">Perfil</a>
            <a onclick="cartera()">Cartera</a>
            <a onclick="plan()">Plan</a>

        </div>

        <?php

        $servername = "localhost";
        $username = "root";
        $password = "1dam2223";
        $dbname = "filmflow";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar si hay errores en la conexión
        if ($conn->connect_error) {
            die("Error en la conexión: " . $conn->connect_error);
        }

        $nom = "";
        $dni = "";
        $data = "";
        $email = "";
        $telefon = "";
        $adresa = "";
        $usuari = "";
        $contra = "";
        $idclient = "";
        $idclient = $_SESSION['id_client'];

        $sql = "SELECT Nom,DNI,edat_data_naixement,adresa,adresa,email,telefon FROM clients WHERE id_client='$idclient'";
        $sql2 = "SELECT usuari,contrassenya FROM compte WHERE id_client='$idclient'";
        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);

        if (mysqli_num_rows($result) > 0) {
            // Itera a través de los resultados y guarda los datos en variables
            while ($row = mysqli_fetch_assoc($result)) {
                $nom = $row['Nom'];
                $dni = $row['DNI'];
                $data = $row['edat_data_naixement'];
                $adresa = $row['adresa'];
                $email = $row['email'];
                $telefon = $row['telefon'];


            }
        }

        if (mysqli_num_rows($result2) > 0) {
            while ($row = mysqli_fetch_assoc($result2)) {
                $usuari = $row['usuari'];
                $contra = $row['contrassenya'];
            }
        }


        ?>

        <div id="formulari">

            <form id="inputsperfil" method="post">
                <i class="fa fa-drivers-license icons"></i><input type="text" placeholder="Nom" name="nom" <?php if (isset($nom)) { ?> value="<?php echo $nom; ?><?php } ?>">
                <i class="fa fa-at icons icons2"></i><input type="text" placeholder="DNI" name="dni" <?php if (isset($dni)) { ?> value="<?php echo $dni; ?><?php } ?>">
                <br>
                <i class="fa fa-at icons icons2"></i><input type="text" placeholder="Email" name="email" <?php if (isset($email)) { ?> value="<?php echo $email; ?><?php } ?>">
                <i class="fa fa-mobile-phone icons phone"></i><input type="text" placeholder="Telefon" name="telefon"
                    <?php if (isset($telefon)) { ?> value="<?php echo $telefon; ?><?php } ?>">

                <br>
                <i class="fa fa-calendar icons calendari"></i><input type="text"
                    placeholder="Data de naixement (any/mes/dia)" name="data_naixement" <?php if (isset($data)) { ?>
                        value="<?php echo $data; ?><?php } ?>">
                <i class="fa fa-user icons icons2"></i><input type="text" placeholder="Adreça" name="adreça" <?php if (isset($adresa)) { ?> value="<?php echo $adresa; ?><?php } ?>">

                <br>
                <i class="fa fa-user icons icons2"></i><input type="text" placeholder="Usuari" name="usuari" <?php if (isset($usuari)) { ?> value="<?php echo $usuari; ?><?php } ?>">
                <i class="fa fa-lock icons icons3"></i><input type="password" placeholder="Contrasenya"
                    name="contrasenya" <?php if (isset($contra)) { ?> value="<?php echo $contra; ?><?php } ?>">
                <br>

                <input type="submit" value="Guardar" id="enviar">

                <?php

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
                    $dni = $_POST["dni"];
                    $email = $_POST["email"];
                    $telefon = $_POST["telefon"];
                    $data_naixement = $_POST["data_naixement"];
                    $adresa = $_POST["adreça"];
                    $usuari = $_POST["usuari"];
                    $contrasenya = $_POST["contrasenya"];
                    $idc = "";
                    $idc = $_SESSION['id_client'];

                    // Preparar la consulta SQL
                    $sql = "UPDATE clients SET Nom='$nom', DNI='$dni', email='$email', adresa='$adresa', telefon='$telefon', edat_data_naixement='$data_naixement' WHERE id_client='$idc' ";
                    $sql2 = "UPDATE compte SET usuari='$usuari', contrassenya='$contra'  WHERE id_client='$idc'";

                    // Ejecutar la consulta SQL
                    if ($conn->query($sql) === FALSE || $conn->query($sql2) === FALSE) {
                        echo "<div style='font-size: 2rem; text-align: center; color: white;'>Error: " . $conn->error . "</div>";
                    } else {
                        echo "<div style='font-size: 2rem; text-align: center; color: white;'>Dades guardades correctament!</div>";
                        $_SESSION['usuari'] = $usuari;
                    }
                }
                $conn->close();

                ?>

            </form>
        </div>

        <div id="cartera" style="display: none;">

            <?php

            $servername = "localhost";
            $username = "root";
            $password = "1dam2223";
            $dbname = "filmflow";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar si hay errores en la conexión
            if ($conn->connect_error) {
                die("Error en la conexión: " . $conn->connect_error);
            }

            $numt = "";
            $numb = "";
            $nac = "";


            $idclient = "";
            $idclient = $_SESSION['id_client'];

            $sql3 = "SELECT num_tarjeta,num_compte_banc,nacionalitat FROM clients WHERE id_client='$idclient'";
            $result3 = mysqli_query($conn, $sql3);

            if (mysqli_num_rows($result3) > 0) {
                // Itera a través de los resultados y guarda los datos en variables
                while ($row = mysqli_fetch_assoc($result3)) {
                    $numt = $row["num_tarjeta"];
                    $numb = $row["num_compte_banc"];
                    $nac = $row["nacionalitat"];

                }
            }

            $conn->close();

            ?>

            <form id="inputsperfil2" method="post">
                <i class="fa fa-drivers-license icons"></i><input type="text" placeholder="Nacionalitat"
                    name="nacionalitat" <?php if (isset($nac)) { ?> value="<?php echo $nac; ?><?php } ?>">
                <br>
                <i class="fa fa-credit-card icons icons2"></i><input type="text" placeholder="Número de la tarjeta"
                    name="num_tarjeta" <?php if (isset($numt)) { ?> value="<?php echo $numt; ?><?php } ?>">
                <br>
                <i class="fa fa-credit-card icons icons2"></i><input type="text" placeholder="Número Bancari"
                    name="num_compte_banc" <?php if (isset($numb)) { ?> value="<?php echo $numb; ?><?php } ?>">

                <br>

                <input type="submit" value="Guardar" id="enviar2">

                <?php

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
                    $numt = $_POST["num_tarjeta"];
                    $numb = $_POST["num_compte_banc"];
                    $nac = $_POST["nacionalitat"];
                    $idc = "";
                    $idc = $_SESSION['id_client'];

                    // Preparar la consulta SQL
                    $sql3 = "UPDATE clients SET nacionalitat='$nac', num_tarjeta='$numt', num_compte_banc='$numb' WHERE id_client='$idc' ";

                    // Ejecutar la consulta SQL
                    if ($conn->query($sql3) === FALSE) {
                        echo "<div style='font-size: 2rem; text-align: center; color: white;'>Error: " . $conn->error . "</div>";
                    } else {
                        echo "<div style='font-size: 2rem; text-align: center; color: white;'>Dades guardades correctament!</div>";
                    }
                }
                $conn->close();

                ?>

        </div>

        <?php

        $servername = "localhost";
        $username = "root";
        $password = "1dam2223";
        $dbname = "filmflow";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar si hay errores en la conexión
        if ($conn->connect_error) {
            die("Error en la conexión: " . $conn->connect_error);
        }



        $sql = "";
        $sql = "SELECT id_modalitat FROM compte WHERE usuari='$usr'";

        $resultat = mysqli_query($conn, $sql);

        $modalitat = "";

        if (mysqli_num_rows($resultat) > 0) {
            while ($row = mysqli_fetch_assoc($resultat)) {
                $modalitat = $row['id_modalitat'];

            }

        }

        $_SESSION['modalitat'] = $modalitat;


        ?>

        <div id="plan">
            <ul id="gratis" class="price">
                <li class="header">Gratuit</li>
                <li class="grey">0.00 € / any</li>
                <li class="oferta">Pelis fins al 2015</li>
                <li class="oferta">Series fins al 2015</li>
                <li class="grey">
                    <?php

                    if ($_SESSION['modalitat'] == 1) {
                        echo "<i id='botogratis' class='fa fa-check button2'></i>";
                    } else {
                        echo "<a onclick='planselec1()' class='button'>Seleccionar</a>";
                    }
                    ?>
                </li>
            </ul>
            <ul id="basic" class="price">
                <li class="header">Basic</li>
                <li class="grey"> 8.90 € / any</li>
                <li class="oferta">Pelis fins al 2020</li>
                <li class="oferta">Series fins al 2020</li>
                <li class="grey">
                    <?php

                    if ($_SESSION['modalitat'] == 2) {
                        echo "<i id='botobasic' class='fa fa-check button2'></i>";
                    } else {
                        echo "<a onclick='planselec2()' class='button'>Seleccionar</a>";
                    }
                    ?>
                </li>
            </ul>
            <ul id="premium" class="price">
                <li class="header">Premium</li>
                <li class="grey"> 12.99 € / any</li>
                <li class="oferta">Totes les pelis</li>
                <li class="oferta">Totes les series</li>
                <li class="grey">
                    <?php

                    if ($_SESSION['modalitat'] == 3) {
                        echo "<i id='botopremium' class='fa fa-check button2'></i>";
                    } else {
                        echo "<a onclick='planselec3()' class='button'>Seleccionar</a>";
                    }
                    ?>
                </li>
            </ul>
        </div>

    </div>

    <script>

            var modalitat = "<?php echo $modalitat; ?>";

            function planselec1(){
            // Realizar la solicitud Ajax
            $.ajax({
                url: "actualitzar.php",  // URL del script PHP que actualizará el campo en la base de datos
                method: "POST",  // Método de la solicitud
                data: { id_modalitat: 1 },  // Datos que se enviarán al servidor
                success: function (response) {
                    // Manejar la respuesta del servidor si es necesario
                    <?php $modalitat = 1 ?>
                    window.location.href = "perfil.php";
                },
                error: function (xhr, status, error) {
                    // Manejar los errores de la solicitud
                    console.error(error);
                }
            });
            }

            function planselec2(){
            // Realizar la solicitud Ajax
            $.ajax({
                url: "actualitzar.php",  // URL del script PHP que actualizará el campo en la base de datos
                method: "POST",  // Método de la solicitud
                data: { id_modalitat: 2 },  // Datos que se enviarán al servidor
                success: function (response) {
                    // Manejar la respuesta del servidor si es necesario
                    <?php $modalitat = 2 ?>
                    window.location.href = "perfil.php";
                },
                error: function (xhr, status, error) {
                    // Manejar los errores de la solicitud
                    console.error(error);
                }
            });
            }

            function planselec3(){
            // Realizar la solicitud Ajax
            $.ajax({
                url: "actualitzar.php",  // URL del script PHP que actualizará el campo en la base de datos
                method: "POST",  // Método de la solicitud
                data: { id_modalitat: 3 },  // Datos que se enviarán al servidor
                success: function (response) {
                    // Manejar la respuesta del servidor si es necesario
                    <?php $modalitat = 3 ?>
                    window.location.href = "perfil.php";
                },
                error: function (xhr, status, error) {
                    // Manejar los errores de la solicitud
                    console.error(error);
                }
            });
            }


        </script>


    <footer>
        <p>Feta per Arnau i Xavi</p>
    </footer>

</body>

</html>