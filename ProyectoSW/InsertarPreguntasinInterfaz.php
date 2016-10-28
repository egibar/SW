<?php

include "funciones.php";
@session_start();

$identificador=$_SESSION['identificador'];
$mail=$_SESSION['usuario'];

if($mail==NULL || $identificador==NULL){
    header('location:layout.php');
}

if (isset($_POST['preg']) && isset($_POST['tema']) && isset($_POST['comp']) && isset($_POST['resp'])){
    insertarPregunta();
}

?>