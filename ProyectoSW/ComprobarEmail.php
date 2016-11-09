<?php
require_once ('lib/nusoap.php');
require_once ('lib/class.wsdlcache.php');




if(isset($_POST['email'])){
    $soapclient= new nusoap_client('http://cursodssw.hol.es/comprobarmatricula.php?wsdl',true);
    $result=$soapclient->call('comprobar',array('x'=>$_POST['email']));
    echo $result;

}

?>
