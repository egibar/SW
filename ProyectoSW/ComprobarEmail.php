<?php
require_once ('lib/nusoap.php');
require_once ('lib/class.wsdlcache.php');




if(isset($_POST['email'])){
    $soapclient= new nusoap_client('http://sw14.hol.es/ServiciosWeb/comprobarmatricula.php?wsdl',true);
    $result=$soapclient->call('comprobar',array('x'=>$_POST['email']));
    echo "<script type='text/javascript'>alert('$result');</script>";
    echo $result;

}

?>
