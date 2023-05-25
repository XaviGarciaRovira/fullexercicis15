<?php
// Obtener el valor enviado por la solicitud Ajax
$modalitat = $_POST["id_modalitat"];

// Realizar las operaciones necesarias para actualizar el campo en la base de datos
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

$idc = $_SESSION["id_client"];


// Realizar la actualización en la base de datos
$sql = "UPDATE compte SET id_modalitat = '$modalitat' WHERE id_client = $idc "; // Cambia 'tabla' y 'id' según tu estructura de base de datos
if ($conn->query($sql) === TRUE) {
    echo "Campo actualizado correctamente";
} else {
    echo "Error al actualizar el campo: " . $conn->error;
}

$conn->close();
?>