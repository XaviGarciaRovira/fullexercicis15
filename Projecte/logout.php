<?php

    session_start();

    session_destroy();

    setcookie("usr",$usuari,time()-60);
    setcookie("contra",$contrasenya,time()-60);

    header("Location:index.php");
    exit();

?>