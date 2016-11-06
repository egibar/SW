<?php

include "funciones.php";
@session_start();



$identificador=$_SESSION['identificador'];
$mail=$_SESSION['usuario'];

if($mail==NULL || $identificador==NULL){
    header('location:layout.php');
}

if (isset($_POST['pregunta']) && isset($_POST['subject']) && isset($_POST['complejidad']) && isset($_POST['respuesta'])){
    insertarPregunta();
}

?>