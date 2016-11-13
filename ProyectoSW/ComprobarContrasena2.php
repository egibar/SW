<?php
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');

	$server = new soap_server;
	$ns = "passValidator";
	$server->configureWSDL('comprobar',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;

	$server->register('comprobar',array('key'=>'xsd:int','pass'=>'xsd:string'),array('msg'=>'xsd:string'));

	function comprobar($key,$pass){

        $fichero = fopen ("toppasswords.txt", "r");
        $fichero2 = fopen ("tickets.txt", "r");
        if(strlen($key)!=4){
            return "USUARIO NO AUTORIZADO";
        }
        if (!$fichero2) {
            return "ERROR";
        }
        while (!feof ($fichero2)) {
            $linea = fgets ($fichero2);
            if (strcmp (trim($linea),$key) == 0){

                if (!$fichero) {
                    return "ERROR";
                }
                while (!feof ($fichero)) {
                    $linea2 = fgets ($fichero);
                    if (strcmp (trim($linea2),$pass) == 0){
                        return 'INVALIDA';
                    }
                }
                fclose($fichero);
                return "VALIDA";
            }
        }
        fclose($fichero2);
        return "USUARIO NO AUTORIZADO";

    }

	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA)? $HTTP_RAW_POST_DATA:'';
	$server->service($HTTP_RAW_POST_DATA);
//$rawPostData = file_get_contents("php://input");
//$server->service($rawPostData);
?>