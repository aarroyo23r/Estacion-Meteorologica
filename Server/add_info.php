<?php
$host = "localhost";
$user = "id3227848_root";
$password = "Public#1212";
$db = "id3227848_estacionmeteorologica";

$con = mysqli_connect($host,$user,$password,$db);

$indice = $_POST["indice"];
$Temperatura = $_POST["Temperatura"];
$Lluvia = $_POST["Lluvia"];
$Viento = $_POST["Viento"];


$sql =  "SET FOREIGN_KEY_CHECKS = 0;";
$sql .= "TRUNCATE table Alarma;";
$sql .= "SET FOREIGN_KEY_CHECKS = 1;";
$sql .= "insert into Alarma values('$indice','$Temperatura','$Lluvia','$Viento');";

if (mysqli_multi_query($con,$sql)){
  echo "<br><h3>Se elimino la tabla y se añadió una fila...... </h3>";
}
else{
  echo "<br><h3>No se pudo hacer la inserción".mysqli_error($con);
}

mysqli_close($con);

 ?>
