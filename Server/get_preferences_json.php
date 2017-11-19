<?php

$host = "localhost";
$user = "id3227848_root";
$password = "Public#1212";
$db = "id3227848_estacionmeteorologica";

$sql = "select * from Alarma;";

$con = mysqli_connect($host,$user,$password,$db);

$result = mysqli_query($con,$sql);

$response = array();

while ($row = mysqli_fetch_array($result)) {

array_push($response,array("indice"=>$row[0], "Temperatura"=>$row[1],"Lluvia"=>$row[2], "Viento"=>$row[3]));

}

echo json_encode(array("server_response"=>$response));

mysqli_close($con);

 ?>
