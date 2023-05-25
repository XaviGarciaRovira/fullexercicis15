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
    <div id="info">
        <div id="info2">
            <?php

            $servername = "localhost";
            $username = "root";
            $password = "1dam2223";
            $dbname = "filmflow";

            $conn = new mysqli($servername, $username, $password, $dbname);



            if (isset($_GET['foto'])) {
                $foto = $_GET['foto'];

                $consulta = "SELECT tipus FROM produccions WHERE foto='$foto'";

                $resultat1 = mysqli_query($conn, $consulta);



                $num = "";


                if (mysqli_num_rows($resultat1) > 0) {
                    while ($row = mysqli_fetch_assoc($resultat1)) {
                        $num = $row['tipus'];


                    }
                }


                if ($num == 0) {
                    $sql = "SELECT nom, nacionalitat, anys, durada FROM produccions
                    INNER JOIN pelicules ON produccions.id_produccio = pelicules.id_produccio
                    WHERE foto='$foto'";

                    $resultat = mysqli_query($conn, $sql);



                    $nom = "";
                    $nac = "";
                    $anys = "";
                    $durada = "";

                    if (mysqli_num_rows($resultat) > 0) {
                        while ($row = mysqli_fetch_assoc($resultat)) {
                            $nom = $row['nom'];
                            $nac = $row['nacionalitat'];
                            $anys = $row['anys'];
                            $durada = $row['durada'];


                        }
                    }
                    
                    echo "<img src='" . $foto . "'></div>";
                    $html = "<div id='infotext'>";
                    $html .= "<h1 class='infopeli'>" . $nom . "</h1>";
                    $html .= "<h2 class='infopeli'>" . $durada . " min</h2>";
                    $html .= "<h2 class='infopeli'>" . $nac . "</h2>";
                    $html .= "<h3 class='infopeli'>" . $anys . "</h3>";
                    echo $html;

                } elseif ($num == 1) {
                    $sql = "SELECT produccions.nom, nacionalitat, anys, COUNT(episodi.id_produccio) as episodis FROM produccions
                    INNER JOIN episodi ON produccions.id_produccio = episodi.id_produccio
                    WHERE foto='$foto'";

                    $resultat = mysqli_query($conn, $sql);



                    $nom = "";
                    $nac = "";
                    $anys = "";
                    $episodis = "";

                    if (mysqli_num_rows($resultat) > 0) {
                        while ($row = mysqli_fetch_assoc($resultat)) {
                            $nom = $row['nom'];
                            $nac = $row['nacionalitat'];
                            $anys = $row['anys'];
                            $episodis = $row['episodis'];


                        }
                    }

                    var_dump($nom);
                    var_dump($nac);
                    var_dump($anys);
                    var_dump($episodis);

                    echo "<img src='" . $foto . "'></div>";
                    $html = "<div id='infotext'>";
                    $html .= "<h1 class='infopeli'>" . $nom . "</h1>";
                    $html .= "<h2 class='infopeli'>" . $episodis . " capítols</h2>";
                    $html .= "<h2 class='infopeli'>" . $nac . "</h2>";
                    $html .= "<h3 class='infopeli'>" . $anys . "</h3>";

                    echo $html;
                } else {
                    echo "mal";
                }

                $idc = $_SESSION['id_client'];

                $consulta2 = "SELECT ha_consumit.num_visualitzacio,ha_consumit.preferit FROM ha_consumit
                INNER JOIN compte ON ha_consumit.id_compte = compte.id_compte
                INNER JOIN produccions ON ha_consumit.id_produccio = produccions.id_produccio
                WHERE foto='$foto' AND compte.id_client=$idc";

                    $resultat3 = mysqli_query($conn, $consulta2);



                    $vist = "";
                    $preferit = "";
                    

                    if (mysqli_num_rows($resultat3) > 0) {
                        while ($row = mysqli_fetch_assoc($resultat3)) {
                            $vist = $row['num_visualitzacio'];
                            $preferit = $row['preferit'];
                            


                        }


                $html = "<div id='botons'>";

                if ($vist > 0) {
                    $html .= "<button id='vist' onclick='novist()'><i class='fa fa-eye'></i> Vist</button>";
                }else {
                    $html .= "<button id='vist' onclick='vist()'><i class='fa fa-eye-slash'></i> Vist</button>";
                }

                
                if ($preferit == 1) {
                    $html .= "<button id='preferit' onclick='nopreferit()'><i class='fa fa-star'></i> Preferit</button>";
                }else if ($preferit == 0) {
                    $html .= "<button id='preferit' onclick='preferit()'><i class='fa fa-star-o'></i> Preferit</button>";
                }

                $html .= "</div>";

                echo $html;
                }
            }

            ?>
            <script>var foto = $foto;</script>


        </div>
    </div>

    </div>

    <footer>
        <p>Feta per Arnau i Xavi</p>
    </footer>

</body>

</html>