<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Preguntas</title>
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
                <label for="complejidad">Complejidad:</label>
                <input type="number" name="complejidad" id="complejidad" required class="form-input"/>

            </li>

            <a href="layout.html"><button  type="button" name="volver" id="volver"  class="form-btn" rigth="20%">Volver</button></a>
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

    $db = getBD();

    if ($db->connect_errno) {

        echo "Fallo al conectar a MySQL: " . $link->connect_error;

    }
    $sql = "SELECT * FROM Preguntas";
    $sth= $db->query($sql);
    $cont=$sth->num_rows;
    $contador= $cont+1;
    $sql = "INSERT INTO `Preguntas` (`Contador`,`Pregunta`, `Respuesta`, `Complejidad`, `Email`) VALUES ('$contador','$_POST[pregunta]', '$_POST[respuesta]', '$_POST[complejidad]', '$mail')";


    if (!$db->query($sql)) {

        die('Error: ' . $link->error);

    } else
        echo "$contador";
    echo "1 Question Added";
}
    $sth->close();
    $db->close();
?>