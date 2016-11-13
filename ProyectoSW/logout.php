<?php
session_start();

$identificador=$_SESSION['identificador'];
$mail=$_SESSION['usuario'];

if($mail==NULL || $identificador == NULL)
    header('location:layout.php');
else{
    session_destroy();
    header('location:layout.php');
}

?>