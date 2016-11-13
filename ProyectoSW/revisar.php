<?php
session_start();

$identificador=$_SESSION['identificador'];
$email=$_SESSION['usuario'];
$rol=$_SESSION['rol'];

if($email==NULL || $identificador == NULL)
    header('location:layout.php');
else
    if(strcmp($rol, 'profesor')!=0)
        header('location:layout.php');

?>
<!DOCTYPE html>
    <html>
<head>
    <meta charset="UTF-8">
    <title>Revisar Pregunta</title>
    <link rel="stylesheet"
          href="diseno.css"/>
    <script src="scripts/jquery-2.1.4.js"></script>
    <script type="text/javascript">
        a= new XMLHttpRequest();
        b= new XMLHttpRequest();
        a.onreadystatechange= function () {
            if (a.readyState == 4)
                document.getElementById("preguntas").innerHTML=a.responseText;
                //$(#preguntas).innerHTML = a.responseText;
        };
        b.onreadystatechange= function () {
            if (b.readyState == 4)
                document.getElementById("respuestas").innerHTML=b.responseText;
                //$(#respuestas).innerHTML = b.responseText;
        };
        function editar() {
            //var id= $(#selec).val();
            var id = document.getElementById("selec").value;
            //var pregunta= $(#preguntas).val();
            //var respuesta= $(#respuestas).val();
            //var complejidad= $(#complejidad).val();
            var pregunta = document.getElementById("pregunta").value;
            var respuesta = document.getElementById("respuesta").value;
            var complejidad = document.getElementById("complejidad").value;
            b.open("POST","actualizar.php",true);
            b.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            b.send("pregunta="+pregunta+"&respuesta="+respuesta+"&complejidad="+complejidad+"&id="+id);


        }
        function pedir() {
            var id = document.getElementById("selec").value;
            //var id= $(#selec).val();
            a.open("POST","modificarPregunta.php",true);
            a.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            a.send("id="+id);


        }

    </script>
</head>
<body>
<div align="center">
<h1>REVISANDO PREGUNTAS</h1>
<ul>
    <li>
        <label">Selecciona un pregunta:</label></br>
        <?php include 'funciones.php';
getEditarPreguntas();
?>
    </li>
        <div id="preguntas"></div>
        <div id="respuestas"></div>

</ul>
    </div>
</body>
</html>
