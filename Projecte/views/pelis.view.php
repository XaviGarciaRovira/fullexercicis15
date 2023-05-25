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

        <a href="index.php"><img src="img/logo.jpg" alt="logo" id="logo"></a>

        <nav id="menu">

            <a id="lupa"><i class="fa fa-search"></i></a>
            <a href="index.php">Inici</a>
            <a href="pelis.php">Pelis</a>
            <a href="series.php">Series</a>
            <?php

            session_start();

            $servername = "localhost";
            $username = "root";
            $password = "1dam2223";
            $dbname = "filmflow";

            $conn = new mysqli($servername, $username, $password, $dbname);


            if (isset($_SESSION['sessio'])) {
                // Si el usuario ha iniciado sesión
            
                echo '<a id="perfil" onclick="desplegar()"><i class="fa fa-user icons icons2"></i> ' . $_SESSION['usuari'] . '</a>';
            } else {
                // Si el usuario no ha iniciado sesión
                echo '<a href="login.php">Log In</a>';
            }

            $pelis = "SELECT produccions.foto FROM produccions
            INNER JOIN pertany ON produccions.id_produccio = pertany.id_produccio
            WHERE id_categoria=1 AND produccions.tipus=0 LIMIT 8;";

            $pelis2 = "SELECT produccions.foto FROM produccions
            INNER JOIN pertany ON produccions.id_produccio = pertany.id_produccio
            WHERE id_categoria=3 AND produccions.tipus=0 LIMIT 8;";

            $pelis3 = "SELECT produccions.foto FROM produccions
            INNER JOIN pertany ON produccions.id_produccio = pertany.id_produccio
            WHERE id_categoria=4 AND produccions.tipus=0 LIMIT 8;";

            $pelis4 = "SELECT produccions.foto FROM produccions
            INNER JOIN pertany ON produccions.id_produccio = pertany.id_produccio
            WHERE id_categoria=6 AND produccions.tipus=0 LIMIT 8;";


            $resultat = mysqli_query($conn, $pelis);
            $resultat2 = mysqli_query($conn, $pelis2);
            $resultat3 = mysqli_query($conn, $pelis3);
            $resultat4 = mysqli_query($conn, $pelis4);

            $datos = array();
            $datos2 = array();
            $datos3 = array();
            $datos4 = array();



            if (mysqli_num_rows($resultat) > 0) {
                while ($row = mysqli_fetch_assoc($resultat)) {
                    $datos[] = $row['foto'];

                }

            }

            if (mysqli_num_rows($resultat2) > 0) {
                while ($row = mysqli_fetch_assoc($resultat2)) {
                    $datos2[] = $row['foto'];

                }

            }

            if (mysqli_num_rows($resultat3) > 0) {
                while ($row = mysqli_fetch_assoc($resultat3)) {
                    $datos3[] = $row['foto'];

                }

            }

            if (mysqli_num_rows($resultat4) > 0) {
                while ($row = mysqli_fetch_assoc($resultat4)) {
                    $datos4[] = $row['foto'];

                }

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

            </div>
            <a id="creueta"><i class="fa fa-times"></i></a>
        </div>
    </div>

    <h1 id="titolseccions">Pel·lícules</h1>

    <h2 class="titols">Pel·lícules Acció</h2>

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

    <h2 class="titols">Pel·lícules Comedia</h2>

    <div class="slider-container">
        <a id="left2"><i class='fa fa-chevron-left'></i></a>
        <section id="section2_1">
            <?php

            $cont = 0;

            foreach ($datos2 as $dato) {
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

            foreach ($datos2 as $dato) {
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
    </div>

    <h2 class="titols">Pel·lícules Drama</h2>

    <div class="slider-container">
        <a id="left3" onclick="retrocederFoto3()"><i class='fa fa-chevron-left'></i></a>
        <section id="section3_1">
            <?php

            $cont = 0;

            foreach ($datos3 as $dato) {
                // Hacer algo con cada dato
                echo "<img class='slider-item foto' src='" . $dato . "' >";
                $cont++;
                if ($cont == 4) {
                    break;
                }
            }
            ?>
        </section>
        <section id="section3_2">
            <?php

            $cont = 0;

            foreach ($datos3 as $dato) {
                // Hacer algo con cada dato
                if ($cont >= 4) {
                    echo "<img class='slider-item foto' src='" . $dato . "' >";

                } else {
                    $cont++;
                }

            }
            ?>
        </section>
        <a id="right3" onclick="pasarFoto3()"><i class="fa fa-chevron-right"></i></a>
    </div>

    <h2 class="titols">Pel·lícules Ciencia Ficció</h2>

    <div class="slider-container">
        <a id="left4" onclick="retrocederFoto4()"><i class='fa fa-chevron-left'></i></a>
        <section id="section4_1">
            <?php

            $cont = 0;

            foreach ($datos4 as $dato) {
                // Hacer algo con cada dato
                echo "<img class='slider-item foto' src='" . $dato . "' >";
                $cont++;
                if ($cont == 4) {
                    break;
                }
            }
            ?>
        </section>
        <section id="section4_2">
            <?php

            $cont = 0;

            foreach ($datos4 as $dato) {
                // Hacer algo con cada dato
                if ($cont >= 4) {
                    echo "<img class='slider-item foto' src='" . $dato . "' >";

                } else {
                    $cont++;
                }

            }
            ?>
        </section>
        <a id="right4" onclick="pasarFoto4()"><i class="fa fa-chevron-right"></i></a>
        <script>

            $('.foto').each(function () {
                $(this).click(function () {
                    console.log("click");
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