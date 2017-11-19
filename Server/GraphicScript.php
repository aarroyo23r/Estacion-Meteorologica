<?php include "conect.php";?>


<script>

var db=<?php echo json_encode($Arreglo); ?>;
var elementosTotales=<?php echo json_encode($i); ?>;

var ejeY1 ="Temperatura";
var ejeY2 ="Lluvia";
var ejeY3 ="Velocidad del Viento";
var ejeX=[];

var datosY1=[];
var datosY2=[];
var datosY3=[];

var i=0;

while (i!=elementosTotales){
ejeX=ejeX.concat(db[i][0]);

datosY1=datosY1.concat(db[i][1]);
datosY2=datosY2.concat(db[i][2]);
datosY3=datosY3.concat(db[i][3]);

i++;
}



var ctx = document.getElementById("CanvaGraphic").getContext('2d');
var myChart = new Chart(ctx, {
type: 'line',


data: {
    labels: ejeX,
    datasets: [{
        label: ejeY1,
        data: datosY1,
        yAxesGroup: "1",
        backgroundColor: [
            'rgba(60, 255, 132, 0.7)'
        ],
        },{

        label: ejeY2,
        data: datosY2,
        yAxesGroup: "2",


        backgroundColor: [
            'rgba(255, 99, 90, 0.7)',
        ],
        },

        {

        label: ejeY3,
        data: datosY3,
        yAxesGroup: "3",
        backgroundColor: [
            'rgba(32, 72, 90, 0.7)',

        ],


        borderWidth: 1
    }]
},
options: {


    scales: {
        yAxes: [{
            ticks: {
                beginAtZero:true
            }
        }]
    }
}

});


</script>
