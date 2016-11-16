<?php

include "funciones.php";
$db = getBD();



if($db->connect_errno){
    echo "Fallo al conectar a MySQL: ".$db->connect_error;

}

$name = $_POST['name'];
$email=$_POST["email"];
$pass=$_POST["password"];
$tel=$_POST["telefono"];
$esp=$_POST["especialidad"];
$interes=$_POST["interes"];

if($db->connect_errno){
    echo "Fallo al conectar a MySQL: ".$db->connect_error;

}
$buscarUsuario = "SELECT * FROM usuario WHERE email = '$email'  ";
if ($result = mysqli_query($db,$buscarUsuario))
{
$count = mysqli_num_rows($result);
    printf("Result set has %d rows.\n",$count);
    // Free result set
    mysqli_free_result($result);
}

if ($count == 1)
    echo '<script language="javascript">alert("Correo ya existente");</script>';
else {

        $sql = "INSERT INTO `usuario` (`name`, `email`, `password`, `telefono`, `especialidad`, `interes`) VALUES ('$name', '$email', '$pass', '$tel', '$esp',' $interes')";


        if (!mysqli_query($db, $sql)) {

            die('Error: ' . $db->connect_error);

        } else {

            echo "1 record added";

            echo '</br><p><a href="VerUsuariosConFoto.php">Ver Usuarios</a></p>
                                <a href="layout.php"><button type="button" name="volver" id="volver" class="form-btn" rigth="20%">Volver</button></a>

';

        }

    //}
}

$db->close();


?>