
  <?php
  date_default_timezone_set('America/Costa_Rica');
  touch('tiempo.txt');
  $host = "localhost";
  $user = "id3227848_root";
  $password = "Public#1212";
  $db = "id3227848_estacionmeteorologica";

  $con = mysqli_connect($host,$user,$password,$db);

 



  if (empty($_POST["Temperatura"])){
      echo "";
      $sql =0;
  }

  else {
      
    $Temperatura = $_POST["Temperatura"];
    $Lluvia = $_POST["Humedad"];
    $Viento = $_POST["Viento"];
  
    $sql =  "SET FOREIGN_KEY_CHECKS = 0;";
    $sql .= "TRUNCATE table Alarma;";
    $sql .= "SET FOREIGN_KEY_CHECKS = 1;";
    $sql .= "insert into Alarma values('1','$Temperatura','$Lluvia','$Viento');";
  }

  if (mysqli_multi_query($con,$sql)){
    echo "<script>alert('Alarmas Programadas Correctamente');</script>";
  }


  mysqli_close($con);

   ?>
