<?php
include 'funciones.php';

@session_start();

$identificador = $_SESSION['identificador'];
$mail = $_SESSION['usuario'];

if ($mail == NULL || $identificador == NULL) {
    header('location:layout.php');
}
$db = getBD();
$sql = "SELECT * FROM Preguntas WHERE Email='$mail'";
$sth = $db->query($sql);
$cont1 = $sth->num_rows;

$sql = "SELECT * FROM Preguntas";
$sth = $db->query($sql);
$cont2 = $sth->num_rows;

$sth->close();
$db->close();

echo 'Mis preguntas/Total preguntas: ' . $cont1 . ' / ' . $cont2 . '';

?>