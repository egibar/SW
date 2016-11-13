<?php
	@session_start();
	include 'funciones.php';

	$identificador=$_SESSION['identificador'];
	$mail=$_SESSION['usuario'];
	$rol=$_SESSION['rol'];

	if($mail==NULL || $identificador==NULL){
        header('location:layout.php');
    }else{

        if(strcmp($rol,'profesor')!=0){
            header('location:layout.php');
        }else{
            actualizarPregunta($_POST['pregunta'],$_POST['respuesta'],$_POST['complejidad'],$_POST['id']);
        }
    }
?>