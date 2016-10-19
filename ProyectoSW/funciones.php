<?php
/**
 * Created by PhpStorm.
 * User: egibar
 * Date: 23/09/2016
 * Time: 12:06
 */
function getBD(){

    //return (mysqli_connect("localhost","root","","quiz"));
    return mysqli_connect("mysql.hostinger.es","u566940088_asier","egibar","u566940088_quiz");
}
function GetIP(){
    if(!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}
function conexion(){

    @session_start();

    $db = getBD();

    if($db->connect_errno){

        echo "Fallo al conectar a MySQL: ".$db->connect_error;

    }

    $email = $_SESSION['usuario'];

    $fecha_login = date('Y-m-d H:i:s');
    $sql = "SELECT * FROM Conexiones";
    $sth = $db->query($sql);
    $cont = $sth->num_rows;
    $contador = $cont + 1;

    $sql= "INSERT INTO `Conexiones` (`ID`,`Email`, `Hora`) VALUES ('$contador','$email','$fecha_login')";

    if(!$db->query($sql)){
        die('Error: '.$db->error);
    }

    $sql= "SELECT id FROM Conexiones WHERE Email='$email' and Hora='$fecha_login'";

    if(!$sth=$db->query($sql)){
        die('Error: '.$db->error);
    }

    $fila = $sth->fetch_row();
    $identificador = $fila[0];
    $_SESSION['identificador'] = $identificador;

    $sth->close();
    $db->close();
}
function accion($tipo){

    @session_start();
    $db = getBD();
    $fecha = date('Y-m-d H:i:s');
    $ip=GetIp();
    $sql = "SELECT * FROM Acciones";
    $sth = $db->query($sql);
    $cont = $sth->num_rows;
    $contador = $cont + 1;
    if(isset( $_SESSION['usuario']) && isset($_SESSION['identificador']) ){
        $mail=$_SESSION['usuario'];
        $identificador=$_SESSION['identificador'];

        $sql="INSERT INTO `Acciones` (`ID`,`Conexion`, `Email`, `Tipo`, `Hora`, `Ip`) VALUES ('$contador','$identificador','$mail','$tipo', '$fecha', '$ip')";
    }else{
        $sql="INSERT INTO `Acciones` (`ID`,`Tipo`, `Hora`, `Ip`) VALUES ('$contador', '$tipo', '$fecha', '$ip')";
    }




    if(!$db->query($sql)){

        die('Error: '.$db->error);

    }

    $db->close();

}

function login(){
    session_start();
    $db = getBD();
    if($db->connect_errno){
        echo "Fallo al conectar a MySQL: ".$db->connect_error;

    }
    $email= $_POST['email'];
    $pass=sha1($_POST['password']);
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $sth= $db->query($sql);
    $cont=$sth->num_rows;
    while( $result=mysqli_fetch_array($sth)) {
        $password=$result['password'];
    }
    if ($cont == 1) {
        if (strcmp($password, $pass) == 0) {
            $_SESSION['usuario'] = $email;
            conexion();
            return true;
        }
        else{
            echo("<p class='link'><FONT COLOR=RED>El usuario no existe</FONT></p>");
            return false;
        }
    }
    $sth->close();
    $db->close();

}