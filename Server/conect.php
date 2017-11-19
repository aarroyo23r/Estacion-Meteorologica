
 
  <?php
    //Conexion
    $server='localhost';
    $user='id3227848_root';
    $pass='Public#1212';
    $DB ="id3227848_estacionmeteorologica";

    //Conexion a la base de datos
    $conect=mysqli_connect($server,$user,$pass);

    mysqli_select_db($conect,$DB) OR DIE ("Error: No es posible establecer la conexión");
?>

<?php
  //Sacar Datos
  $Arreglo=array();
  $i=0;

  //Lectura de la DB
  $consulta = "SELECT * FROM Datos"; // Adquiere los datos de la base y los guarda en result
  $ejecutar = $conect->query($consulta);
  while($fila = $ejecutar-> fetch_array()): 

    //Genera el arreglo con la DB
    $Arreglo[$i]=$fila;
    //Impresion de los datos en la tabla
    $i++;
  endwhile;
?>




  <?php
    //Conexion
    $serverA='localhost';
    $userA='id3227848_root';
    $passA='Public#1212';
    $DBA ="id3227848_estacionmeteorologica";

    //Conexion a la base de datos
    $conectA=mysqli_connect($server,$user,$pass);

    mysqli_select_db($conectA,$DB) OR DIE ("Error: No es posible establecer la conexión");
?>

<?php
  //Sacar Datos
  $ArregloA=array();
  $iA=0;

  //Lectura de la DB
  $consultaA = "SELECT * FROM Alarma"; // Adquiere los datos de la base y los guarda en result
  $ejecutarA = $conectA->query($consultaA);
  while($filaA = $ejecutarA-> fetch_array()):

    //Genera el arreglo con la DB
    $ArregloA[$iA]=$filaA;
    //Impresion de los datos en la tabla
    $iA++;
  endwhile;


?>



