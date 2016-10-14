<?php
/**
 * Created by PhpStorm.
 * User: egibar
 * Date: 23/09/2016
 * Time: 12:06
 */
function getBD(){

  //  return (mysqli_connect("localhost","root","","Quiz"));
    return mysqli_connect("mysql.hostinger.es","u566940088_asier","egibar","u566940088_quiz");
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
        $password=$result['Password'];
    }
    if ($cont == 1) {
        if (strcmp($password, $pass) == 0) {
            $_SESSION['usuario'] = $email;
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