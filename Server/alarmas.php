<?php include "escribir.php" ?>
<!doctype html>
<html lang="es">
    <head>
      <meta charset="utf-8" />
      <title>Estación meteorológica</title>
      <meta name="description" content="">
      <meta name "viewport" content="width=device-width, user-scalable=no,initial-scale 1.0, maximun-scale=1.0, minimun-scale=1.0"/>
      <link rel="stylesheet" href="stylesheet.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script type="text/javascript">

      function mostrarOculto(ID1,ID2){

      var id1=ID1;
      var id2=ID2;

      if (document.formulario_alarmas.TemperaturaCB.checked == true) {
      document.getElementById(id1).style.display='block';
      document.getElementById(id2).style.display='block';
      } else {
      document.getElementById(id1).style.display='none';
      document.getElementById(id2).style.display='none';
      }
      }
      </script>

    </head>

<body>



  <div class="contenedor">
  		<header>
  			<div class="logo">
  				<img src="Pictures/PlanetT.png" width="150" alt="">

  			</div>

  			<nav>
  				<a href="monitoreo.php">Monitoreo</a>
  				<a href="alarmas.php">Alarmas</a>
  				<a href="contacto.php">Información</a>
  				<a href="descargas.php">Descargas</a>
  			</nav>

  		</header>




  		<section class="main">



          <article>
    				<h2 class="titulo">Programar nueva alarma </h2>
    			</article>

        <div class="contenedor-formulario">

          <form method="post" action="alarmas.php" >

          <div class="input-group checkbox">
            <input type="checkbox" name="TemperaturaCB" id="TemperaturaCB" value="TemperaturaCB" >
            <label for="TemperaturaCB">Programar nueva alarma a una Temperatura en específico  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span></span> </label>

          </div>


          <div class="input-group">
            <label class="label" id='Temp' for="Temperatura">Inserte la temperatura: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" name="Temperatura"  min="0" max="100" placeholder="0"  >
            <label class="label" id='TempU' for="Temperatura"> &nbsp;(± 0.5°C)  </label>
          </div>
   

          <article>
    				<h2 class="titulo"> </h2>
    			</article>


            <input type="checkbox" name="HumedadCB" id="HumedadCB" value="HumedadCB">
            <label for="HumedadCB">Programar nueva alarma a un porcentaje de lluvia en específico   &nbsp;&nbsp;&nbsp;&nbsp;  <span></span> </label>

          <div class="input-group">
            <label class="label" id='Hum' name='Hum' for="Humedad">Inserte el Porcentaje de lluvia:&nbsp; </label>
            <input type="number" id="Humedad" name="Humedad" min="0" max="100" placeholder="0">
            <label class="label" id='HumU' name='HumU' for="Humedad">  &nbsp; (%) &nbsp;</label>
          </div>

     
          <article>
    				<h2 class="titulo"> </h2>
    			</article>

          <div class="input-group checkbox">
            <input type="checkbox" name="VientoCB" id="VientoaCB" value="VientoCB" >
            <label for="VientoCB">Programar nueva alarma a una Velocidad de Viento en específico  &nbsp;&nbsp; <span></span> </label>

          </div>


          <div class="input-group">
            <label class="label" for="Viento">Inserte la velocidad:  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="number" id="Viento" name="Viento" min="0" max="100" placeholder="0">
            <label class="label" for="Viento"> &nbsp; (km/h)</label>
          </div>
            
       



          <div class="Buttom">
            <input type="submit"   id="but" name="but" value="Confirmar Alarma " onclick="actualizar()">

          </div>

          </form>


          <article>
            <h2 class="titulo"> </h2>
          </article>

          <article>
            <h2 class="titulo">Alarmas Activas </h2>
          </article>

          <!-- Actualiza los datos de la tabla de Alarmas-->
          <div id="tablaA"><?php include "tablaAlarmas.php";?></div>

          <script type="text/javascript">

              var tablaA = $("#tablaA");

              setInterval(function () {
              tablaA.load('tablaAlarmas.php');
            }, 300);
          </script>


          <article>
            <h2 class="titulo"></h2>
          </article>




  		</section>



  		<footer>
  			<section class="links">
          <a href="monitoreo.php">Monitoreo</a>
  				<a href="alarmas.php">Alarmas</a>
  				<a href="contacto.php">Información</a>
  				<a href="descargas.php">Descargas</a>
  			</section>






        </script>

</body>
</html>
