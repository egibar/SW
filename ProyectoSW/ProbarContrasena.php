<?php
require_once ('lib/nusoap.php');
require_once ('lib/class.wsdlcache.php');




if(isset($_POST['password'])){
    $soapclient= new nusoap_client('http://http://localhost/SW/ProyectoSW/ComprobarContrasena.php?wsdl',true);
    $result=$soapclient->call('comprobar',array('pass'=>$_POST['password']));
    echo "<script type='text/javascript'>alert('$result');</script>";
    echo $result;

}

?>