<?php


function Cargar ($o) { echo "<pre>"; print_r($o); echo "</pre>"; }

$data = file_get_contents("php://input");

$data = json_decode($data); 

//Se declaran las variables para establecer la comunicación
$servidor = "localhost";
$usuario = "id3227848_root";
$contrasena = "Public#1212";
$base = "id3227848_estacionmeteorologica";

//Se crea y verifica la conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $base);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql2 = "INSERT INTO Datos (indice,Temperatura,LLuvia,Viento) VALUES ($data->Indice, $data->Temperatura, $data->Lluvia, $data->Viento)";

$resultado = $conn->query($sql2);



?>
