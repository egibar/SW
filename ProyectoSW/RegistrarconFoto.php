<?php
/**
 * Created by PhpStorm.
 * User: egibar
 * Date: 02/10/2016
 * Time: 22:47
 */
include "funciones.php";
$db = getBD();


//$db =mysqli_connect("localhost","root","","sw");

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

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {

        echo '("Foto")';

        $tmpName = $_FILES['image']['tmp_name'];
        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        $data = addslashes($data);
        fclose($fp);

        $sql = "INSERT INTO `usuario` (`name`, `email`, `password`, `telefono`, `especialidad`, `interes`, `image`) VALUES ('$name', '$email', '$pass', '$tel', '$esp',' $interes', '$data')";

        if (!$db->query($sql)) {

            die('Error: ' . $link->connect_error);

        } else {

            echo "1 record added";

            echo "</br><p><a href='VerUsuariosConFoto.php'>Ver Usuarios</a></p>";

        }

        print "Thank you, your file has been uploaded.";

    } else {


    $sql = "INSERT INTO `usuario` (`name`, `email`, `password`, `telefono`, `especialidad`, `interes`) VALUES ('$name', '$email', '$pass', '$tel', '$esp',' $interes')";


    if (!mysqli_query($db, $sql)) {

        die('Error: ' . $db->connect_error);

    } else {

        echo "1 record added";

        echo "</br><p><a href='VerUsuarios.php'>Ver Usuarios</a></p>";

    }

    }
}

$db->close();


?>