<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Preguntas</title>
    <link rel="stylesheet"
          href="diseno.css" />
</head>
<body>
<form id='login' method="post" action="insertarPreguntas.php">

    <h1>PREGUNTAS</h1>

    <div class="column">

        <ul>
            <li>
                <label for="pregunta">Pregunta:</label>
                <input type="text" name="pregunta" id="pregunta" required class="form-input"/>

            </li>
            <li>
                <label for="respuesta">Respuesta:</label>
                <input type="text" name="respuesta" id="respuesta" required class="form-input"/>

            </li>
            <li>
                <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" required class="form-input"/>

            </li>
            <li>
                <label for="complejidad">Complejidad:</label>
                <input type="number" name="complejidad" id="complejidad" required pattern="[1-5]" class="form-input"/>

            </li>

            <a href="layout.php"><button type="button" name="volver" id="volver" class="form-btn" rigth="20%">Volver</button></a>
            <button  type="submit" name="boton" id="enviar"  class="form-btn">Enviar</button>
        </ul>
    </div>
</form>
</body>
<?php
include 'funciones.php';

session_start();

$mail=$_SESSION['usuario'];

if($mail==NULL){
    header('location:layout.php');
}
else {
    $pregunta = $_POST['pregunta'];
    $respuesta = $_POST["respuesta"];
    $complejidad = $_POST["complejidad"];
    $subject=$_POST['subject'];
    if (isset($pregunta) && isset($respuesta) && isset($complejidad) && isset($subject))
        insertarPregunta();
}

?>