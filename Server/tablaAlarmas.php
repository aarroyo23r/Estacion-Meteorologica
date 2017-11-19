<?php include "conect.php";?>

<table>
  <tr>
    <th>Temperatura (± 0.5°C)</th>
    <th>Lluvia (%)</th>
    <th>Velocidad del Viento (km/h)</th>
  </tr>
  <?php
    $contA=0;
    while($contA != $iA):

      //Impresion de los datos en la tabla
  ?>
  <tr>
    <td><?php echo $ArregloA[$contA]["Temperatura"] ?></td>
    <td><?php echo $ArregloA[$contA]["Lluvia"] ?></td>
    <td><?php echo $ArregloA[$contA]["Viento"] ?></td>
  </tr>
<?php $contA++; endwhile; ?>
</table>
