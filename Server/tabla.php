<?php include "conect.php";?>
<table>
  <tr>
    <th>Tiempo </th>
    <th>Temperatura  (± 0.5°C)</th>
    <th>Lluvia (%)</th>
    <th>Velocidad del Viento (km/h)</th>
  </tr>
  <?php
    $cont=0;
    while($cont != $i):

      //Impresion de los datos en la tabla
  ?>
  <tr>
    <td> <?php echo "Minuto  ",$Arreglo[$cont]["indice"] ?> </td>
    <td><?php echo $Arreglo[$cont]["Temperatura"] ?></td>
    <td><?php echo $Arreglo[$cont]["Lluvia"] ?></td>
    <td><?php echo $Arreglo[$cont]["Viento"] ?></td>
  </tr>
<?php $cont++; endwhile; ?>
</table>
