
<?php include "conect.php";?>
<?php
  
$UltimoElemento=count ($Arreglo);

if ($Arreglo[$UltimoElemento-1]["Temperatura"] >= $ArregloA[$iA-1]["Temperatura"] ||  $Arreglo[$UltimoElemento-1]["Lluvia"] >= $ArregloA[$iA-1]["Lluvia"]   ||$Arreglo[$UltimoElemento-1]["Viento"] >= $ArregloA[$iA-1]["Viento"])

    echo '<script type="text/javascript">
            alert("Alarma Programada sobrepasada");
        </script>
        ';
?>