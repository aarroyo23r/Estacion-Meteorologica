
<!doctype html>
<html lang="es">
    <head>
      <meta charset="utf-8" />
      <title>Estación meteorológica</title>
      <meta name="description" content="">
      <meta name "viewport" content="width=device-width, user-scalable=no,initial-scale 1.0, maximun-scale=1.0, minimun-scale=1.0"/>
      <link rel="stylesheet" href="stylesheet.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.js"></script>
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
  				<h2 class="titulo">Monitoreo </h2>
  			</article>


        <canvas id="CanvaGraphic" width="25" height="10"></canvas>

        <div id="CanvaRecarga"><?php include "GraphicScript.php";?></div>

        <script type="text/javascript">

            var $CanvaRecarga = $("#CanvaRecarga");

            setInterval(function () {
            $CanvaRecarga.load('GraphicScript.php');
          }, 30000);
        </script>





        <article>
            <h3 class="titulo"> </h3>
        </article>



        <!-- Actualiza los datos de la tabla -->
        <div id="tabla"><?php include "tabla.php";?></div>

        <script type="text/javascript">
            var $tabla = $("#tabla");

            setInterval(function () {
            $tabla.load('tabla.php');
            }, 3000);
        </script>







      <footer>
  			<section class="links">
          <a href="monitoreo.php">Monitoreo</a>
  				<a href="alarmas.php">Alarmas</a>
  				<a href="contacto.php">Información</a>
  				<a href="descargas.php">Descargas</a>
  			</section>

</body>
</html>
