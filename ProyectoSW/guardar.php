<?php
/**
 * Created by PhpStorm.
 * User: egibar
 * Date: 26/09/2016
 * Time: 13:41
 */

$link=mysqli_connect("localhost","root","", "sw");
$name = $_POST['name'];
$email=$_POST["email"];
$pass=$_POST["password"];
$tel=$_POST["telefono"];
$esp=$_POST["especialidad"];
$interes=$_POST["interes"];
#$foto=$_POST;
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
$sql= "INSERT INTO datos(name,email,password,telefono,especialidad,interes) VALUES ('$name','$email','$pass','$tel','$esp','$interes')";
if (!mysqli_query($link ,$sql))
{
    die('Error: ' . mysqli_error($link));
}
echo "1 record added";
echo "<p> <a href='Verdatos.php'> Ver registros </a>
";
mysqli_close
($link);
?>