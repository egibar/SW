<?php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

    $server = new soap_server;
	$ns = "passValidator";
	$server->configureWSDL('comprobar',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;

	$server->register('comprobar',array('pass'=>'xsd:string'),array('msg'=>'xsd:string'));


	function comprobar($pass){
        echo "<script type='text/javascript'>alert('entrando');</script>";
        $fichero = fopen ("toppasswords.txt", "r");
       echo "<script type='text/javascript'>alert('fichero abierto');</script>";

        if (!$fichero) {
            return "ERROR";
        }
        while (!feof ($fichero)) {
            echo "<script type='text/javascript'>alert('while');</script>";
            $linea = fgets ($fichero);
            echo "<script type='text/javascript'>console.log(\"La respuesta es:\", $linea);</script>";
            if (strcmp (trim($linea),$pass) == 0){
                return 'INVALIDA';
            }
        }
        fclose($fichero);
        return "VALIDA";

    }

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)? $HTTP_RAW_POST_DATA:'';
	$server->service($HTTP_RAW_POST_DATA);
  //$rawPostData = file_get_contents("php://input");
  //$server->service($rawPostData);


?>

