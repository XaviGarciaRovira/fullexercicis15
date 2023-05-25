<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Averia+Sans+Libre&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
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

    <div id="overlay" class="hidden">
        <div id="buscador">
            <div>
                <input type="text" id="buscar" placeholder="Que vols buscar?">
                <div id="fotos">
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

                    $sql = "SELECT foto FROM produccions LIMIT 9";

                    $resultat = mysqli_query($conn, $sql);

                    $datos = array();

                    if (mysqli_num_rows($resultat) > 0) {
                        while ($row = mysqli_fetch_assoc($resultat)) {
                            $datos[] = $row['foto'];

                        }

                    }

                    foreach ($datos as $dato) {
                        // Hacer algo con cada dato
                        echo "<img class='busc' src=' " . $dato . "' >";

                    }

                    ?>
                </div>

            </div>
            <a id="creueta"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <div id="panelprincipal">

        <h1>Inception</h1>
        <p>
            Dom Cobb is a thief capable of entering people's dreams and taking their secrets. However, now he has to
            carry out a different mission from what he has always done: carry out an inception to implant an idea in the
            subconscious of a person. The plan is complicated by the intervention of someone who seems to predict Cobb's
            every move, someone only he can take on.

        </p>

    </div>

    <h2 class="titols">Pel·lícules Recomanades</h2>

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

    $pelis = "SELECT produccions.foto
    FROM Produccions
    LEFT JOIN Ha_consumit ON Produccions.id_produccio = Ha_consumit.id_produccio
    WHERE produccions.tipus = 0
    GROUP BY Produccions.id_produccio
    ORDER BY COUNT(Ha_consumit.id_compte) DESC
    LIMIT 8;";

    $series = "SELECT produccions.foto
    FROM Produccions
    LEFT JOIN Ha_consumit ON Produccions.id_produccio = Ha_consumit.id_produccio
    WHERE produccions.tipus = 1
    GROUP BY Produccions.id_produccio
    ORDER BY COUNT(Ha_consumit.id_compte) DESC
    LIMIT 8;";


    $foto1 = "";
    $foto2 = "";
    $foto3 = "";
    $foto4 = "";
    $foto5 = "";
    $foto6 = "";
    $foto7 = "";
    $foto8 = "";

    $resultat = mysqli_query($conn, $pelis);
    $resultat2 = mysqli_query($conn, $series);

    $datos = array();
    $datosseries = array();



    if (mysqli_num_rows($resultat) > 0) {
        while ($row = mysqli_fetch_assoc($resultat)) {
            $datos[] = $row['foto'];

        }

    }

    if (mysqli_num_rows($resultat2) > 0) {
        while ($row = mysqli_fetch_assoc($resultat2)) {
            $datosseries[] = $row['foto'];

        }

    }

    ?>

    <div class="slider-container">
        <a id="left"><i class='fa fa-chevron-left'></i></a>
        <section id="section1_1">
            <?php

            $cont = 0;

            foreach ($datos as $dato) {
                // Hacer algo con cada dato
                echo "<img class='slider-item foto' src='" . $dato . "' >";
                $cont++;
                if ($cont == 4) {
                    break;
                }
            }
            ?>

        </section>
        <section id="section1_2">
            <?php

            $cont = 0;

            foreach ($datos as $dato) {
                // Hacer algo con cada dato
                if ($cont >= 4) {
                    echo "<img class='slider-item foto' src='" . $dato . "' >";

                } else {
                    $cont++;
                }

            }
            ?>

        </section>
        <a id="right"><i class="fa fa-chevron-right"></i></a>
    </div>

    <h2 class="titols">Series recomanades</h2>

    <div class="slider-container">
        <a id="left2"><i class='fa fa-chevron-left'></i></a>
        <section id="section2_1">
            <?php

            $cont = 0;

            foreach ($datosseries as $dato) {
                // Hacer algo con cada dato
                echo "<img class='slider-item foto' src='" . $dato . "' >";
                $cont++;
                if ($cont == 4) {
                    break;
                }
            }
            ?>

        </section>
        <section id="section2_2">
            <?php

            $cont = 0;

            foreach ($datosseries as $dato) {
                // Hacer algo con cada dato
                if ($cont >= 4) {
                    echo "<img class='slider-item foto' src='" . $dato . "' >";

                } else {
                    $cont++;
                }

            }
            ?>

        </section>
        <a id="right2"><i class="fa fa-chevron-right"></i></a>
        <script>

            $('.foto').each(function () {
                $(this).click(function () {
                    var foto = $(this).attr('src');
                    console.log(foto);

                    $.ajax({
                        url: 'views/infoprod.view.php',
                        type: 'POST',
                        data: { nomfoto: foto },
                        success: function (resposta) {
                            var url = 'infoprod.php?foto=' + foto;
                            window.location.href = url;
                        },
                        error: function (xhr, status, error) {
                            console.log("mal");
                        }
                    });
                });
            });




        </script>
    </div>

    <footer>
        <p>Feta per Arnau i Xavi</p>
    </footer>

</body>

</html>