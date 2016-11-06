<?php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	$server = new soap_server;
	$ns = "passValidator";

	$server->configureWSDL('comprobar',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;

	$server->register('comprobar',array('pass'=>'xsd:string'),array('msg'=>'xsd:string'));

	function comprobar($pass){
        $fichero = fopen ("toppasswords.txt", "r");

        if (!$fichero) {
            return "ERROR";
        }
        while (!feof ($fichero)) {
            $linea = fgets ($fichero);
            if (strcmp (trim($linea),$pass) == 0){
                return 'INVALIDA';
            }
        }
        fclose($fichero);
        return "VALIDA";

    }

//	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)? $HTTP_RAW_POST_DATA:'';
//	$server->service($HTTP_RAW_POST_DATA);
  $rawPostData = file_get_contents("php://input");
  $server->service($rawPostData);


?>