<?php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	//$soapclient = new nusoap_client('http://localhost/SW/ProyectoSW/ComprobarContrasena2.php?wsdl',true);
	$soapclient = new nusoap_client('http://egibarsw.esy.es/ProyectoSW/ComprobarContrasena2.php?wsdl',true);

	if(isset($_POST['password'])){

        $result=$soapclient->call('comprobar',array('key'=>1111,'pass'=>$_POST['password']));
        echo $result;
    }
?>