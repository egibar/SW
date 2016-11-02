<!DOCTYPE html>
<?php

include 'funciones.php';

session_start();

$identificador=$_SESSION['identificador'];
$mail=$_SESSION['usuario'];

if($mail==NULL || $identificador==NULL){
    header('location:layout.php');
}

if (isset($_POST['pregunta']) && isset($_POST['respuesta'])) {
    insertarPregunta();
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion Preguntas</title>
    <link rel="stylesheet"
          href="diseno.css" />
    <script src="scripts/jquery-2.1.4.js"></script>
    <script>
        x = new XMLHttpRequest();
        p = new XMLHttpRequest();

        $.get("ContadorPreguntas.php");$.get( "ContadorPreguntas.php", function( data ) {
            $('#contador').fadeIn(1000).html(data);
        });

        x.onreadystatechange = function () {
            if (x.readyState == 4) {
                document.getElementById("preguntas").innerHTML = x.responseText;
            }
        };

        p.onreadystatechange = function () {
            if (p.readyState == 4) {
                document.getElementById("resultado").innerHTML = p.responseText;
            }
        };

        function pedirDatos() {
            x.open("GET", "VisualizarPreguntas.php", true);
            x.send();
        }

        function enviarDatos() {
            p.open("POST", "InsertarPreguntasinInterfaz.php", true);
            p.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var pregunta = document.getElementById("pregunta").value;
            var respuesta = document.getElementById("respuesta").value;
            var complejidad = document.getElementById("complejidad").value;
            var tematica = document.getElementById("subject").value;
            var message = "pregunta=" + pregunta + "&respuesta=" + respuesta + "&complejidad=" + complejidad + "&subject=" + subject;
            p.send(message);
        }



        function getContador(){
            $.get("ContadorPreguntas.php");$.get( "ContadorPreguntas.php", function( data ) {
                $('#contador').fadeIn(1000).html(data);
            });
        }

        setInterval(getContador,5000);


    </script>
</head>
<body>
<div align="center">
    <div id = column></div>
    <div id="contador"></div>
    </br>
    <form>
        <h2>Registro de Pregunta</h2>
        <p> Pregunta: <input type="text" required id="pregunta" size="21" value=""></p>
        <p> Respuesta: <input type="text" required id="respuesta" size="21" value=""></p>
        <p> Complejidad: <input type="number" required id="complejidad" size="4" value=""></p>
        <p> Tem&aacute;tica: <input type="text" required id="subject" size="21" value=""></p>
    </form>
    <button onclick="pedirDatos()">Cargar Preguntas</button>
    <button onclick="enviarDatos()">Insertar Preguntas</button>
</div>
<div id="resultado" align="center"></div>
<div id="preguntas" align="center"></div>
</body>
</html>