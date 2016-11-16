<?php
/**
 * Created by PhpStorm.
 * User: egibar
 * Date: 23/09/2016
 * Time: 12:06
 */
function getBD()
{

    return (mysqli_connect("localhost","root","","quiz"));
    //return mysqli_connect("mysql.hostinger.es", "u566940088_asier", "egibar", "u566940088_quiz");
}

function GetIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];
}

function conexion()
{

    @session_start();

    $db = getBD();

    if ($db->connect_errno) {

        echo "Fallo al conectar a MySQL: " . $db->connect_error;

    }

    $email = $_SESSION['usuario'];

    $fecha_login = date('Y-m-d H:i:s');
    $sql = "SELECT * FROM Conexiones";
    $sth = $db->query($sql);
    $cont = $sth->num_rows;
    $contador = $cont + 1;

    $sql = "INSERT INTO `Conexiones` (`id`,`Email`, `Hora`) VALUES ('$contador','$email','$fecha_login')";

    if (!$db->query($sql)) {
        die('Error: ' . $db->error);
    }

    $sql = "SELECT id FROM Conexiones WHERE Email='$email' and Hora='$fecha_login'";

    if (!$sth = $db->query($sql)) {
        die('Error: ' . $db->error);
    }

    $fila = $sth->fetch_row();
    $identificador = $fila[0];
    $_SESSION['identificador'] = $identificador;

    $sth->close();
    $db->close();
}

function accion($tipo)
{

    @session_start();
    $db = getBD();
    $fecha = date('Y-m-d H:i:s');
    $ip = GetIp();
    $sql = "SELECT * FROM Acciones";
    $sth = $db->query($sql);
    $cont = $sth->num_rows;
    $contador = $cont + 1;
    if (isset($_SESSION['usuario']) && isset($_SESSION['identificador'])) {
        $mail = $_SESSION['usuario'];
        $identificador = $_SESSION['identificador'];

        $sql = "INSERT INTO `Acciones` (`id`,`Conexion`, `Email`, `Tipo`, `Hora`, `Ip`) VALUES ('$contador','$identificador','$mail','$tipo', '$fecha', '$ip')";
    } else {
        $sql = "INSERT INTO `Acciones` (`id`,`Tipo`, `Hora`, `Ip`) VALUES ('$contador', '$tipo', '$fecha', '$ip')";
    }


    if (!$db->query($sql)) {

        die('Error: ' . $db->error);

    }

    $db->close();

}

function login()
{
    session_start();
    $db = getBD();
    if ($db->connect_errno) {
        echo "Fallo al conectar a MySQL: " . $db->connect_error;

    }
    $email = $_POST['email'];
    $pass = sha1($_POST['password']);
    $sql = "SELECT * FROM usuario WHERE email = '$email'";
    $sth = $db->query($sql);
    $cont = $sth->num_rows;
    while ($result = mysqli_fetch_array($sth)) {
        $rol= $result['rol'];
        $password = $result['password'];
        if($result['bloqueado']==1){
            echo ('<p color="red">El usuario esta bloquado</p>');
            return false;
        }
    }
    if ($cont == 1) {
        if (strcmp($password,$pass) == 0) {
            $_SESSION['usuario'] = $email;
            $_SESSION['rol'] = $rol;
            conexion();
            if(isset($_SESSION[$email])){
                $_SESSION[$email] = 0;
            }
            return true;
        } else {
            if (empty($_SESSION[$email])){
                $_SESSION[$email]=1;
                echo ('<p><FONT  color="red">Password incorrecta</FONT></p>');
            }
            else{
                $_SESSION[$email]++;
                echo ('<p><FONT  color="red">Password incorrecta</FONT></p>');
                if ($_SESSION[$email]==3){
                    $_SESSION[$email]==0;
                    bloquearUsuario($email);
                }

            }
            return false;
        }
    }
    $sth->close();
    $db->close();

}

function bloquearUsuario($email){
    $db= getBD();
    $sql = "UPDATE usuario SET bloqueado=1 WHERE email='$email'";
    if(!$db->query($sql))
        die('Error: '.$db->error);
    else{
        $row=$db->affected_rows;
        if($row==1)
            echo ('<p color="red">El usuario ha sido bloqueado</p>');
    }
    $db->close();
}

function logout(){
session_start();

$identificador=$_SESSION['identificador'];
$mail=$_SESSION['usuario'];
    session_destroy();

}

function insertarPregunta()
{

    session_start();

    $mail = $_SESSION['usuario'];

    if ($mail == NULL) {
        echo("<p  COLOR=RED>El usuario no esta logueado</p>");
    } else {

        $db = getBD();

        $xml = simplexml_load_file("preguntas.xml");

        if ($db->connect_errno) {

            echo "Fallo al conectar a MySQL: " . $db->connect_error;

        }

        $sql = "SELECT * FROM Preguntas";
        $sth = $db->query($sql);
        $cont = $sth->num_rows;
        $contador = $cont + 1;
        $sql = "INSERT INTO `Preguntas` (`id`,`Pregunta`, `Respuesta`, `Complejidad`, `Email`) VALUES ('$contador','$_POST[pregunta]', '$_POST[respuesta]', '$_POST[complejidad]', '$mail')";


        if (!$db->query($sql)) {

            die('Error: ' . $db->error);

        } else {
            $pregunta = $xml->addChild("assessmentItem");
            //    $pregunta->addAttribute("ID");
            $pregunta->addAttribute("complexity", $_POST['complejidad']);//probar /n para salto de linea
            $pregunta->addAttribute("subject", $_POST['subject']);
            $enun = $pregunta->addChild("itemBody");
            $preg = $enun->addChild("p", $_POST['pregunta']);
            $res = $pregunta->addChild("correctResponse");
            $resp = $res->addChild("value", $_POST['respuesta']);

            $xml->asXML("preguntas.xml");
            // echo ("<p  COLOR=RED>XML guardado correctamente</p>");
            //else{
            // echo ("<p  COLOR=RED>Error al guardar el XML</p>");

        }

        accion("insertar pregunta");
        echo "1 Question Added";

    }
}

function verPreguntasXML()
{

    $xml = simplexml_load_file("preguntas.xml");
    echo '
        <table border=1>
		    <tr> 
		        <th> Pregunta </th>
		        <th> Complejidad </th>
		        <th> Tema </th>
		    </tr>';
    foreach ($xml->children() as $pregunta) {
        $complejidad = $pregunta['complexity'];
        $tematica = $pregunta['subject'];
        $itembody = $pregunta->children();
        $enunciado = $itembody->children();
        echo '
		        <tr>
		            <td>' . $enunciado . '</td>
		            <td>' . $complejidad . '</td>
		            <td>' . $tematica . '</td></tr>';


    }
    echo '</table>';
}

function  actualizarPregunta($pregunta,$respuesta,$complejidad,$id){

$db = getBD();

    $sql="UPDATE Preguntas SET Pregunta='$pregunta',Respuesta='$respuesta',Complejidad='$complejidad' WHERE id='$id'";

		if(!$db->query($sql)){

            die('Error: '.$db->error);

        }else{
            echo("Resultado correcto");
        }

		$db->close();
	}
function getEditarPreguntas(){

    $db = getBD();
    $sql = "SELECT * FROM Preguntas";
    $sth = $db->query($sql);

    echo '<select id="selec" onchange="pedir()">';


    while( $result=mysqli_fetch_array($sth)) {
        echo '<option value="' . $result['id'] . '">' . $result['id'] . '</option>';

    } echo '</select>';

    $sth -> close();
    $db -> close();

}
function getPregunta($id){
    $db = getBD();
    $sql = 'SELECT * FROM Preguntas WHERE id="'.$id.'"';
    $sth = $db->query($sql);
    echo '<form id="formulario">';
    while( $result=mysqli_fetch_array($sth)) {
        echo'
    <li>
        <label>Pregunta:</label>
        <input type="text" id="pregunta" value="' . $result['Pregunta'] . '"/>
        </li>
        <li>
        <label">Respuesta:</label></br>
        <input type="text" id="respuesta" value="' . $result['Respuesta'] . '">
        </li>
        <li>
        <label">Complejidad:</label></br>
        <input type="number" id="complejidad" value="' . $result['Complejidad'] . '">
        </li>
        <li>
        <label">Email:</label></br>
        <input type="text" id="usuario" disabled="true" value="' . $result['Email'] . '">
        
    </li>
';
       // echo'<input type="text" id="pregunta" value="' . $result['Pregunta'] . '"></input>';
       // echo('</br>');
       // echo'<input type="text" id="respuesta" value="' . $result['Respuesta'] . '"></input>';
       // echo('</br>');
       // echo'<input type="number" id="complejidad" value="' . $result['Complejidad'] . '"></input>';
       // echo('</br>');
       //echo'<input type="text" id="usuario" disabled="true" value="' . $result['Email'] . '"></input>';
    }
    echo '</form>';
    echo '<button onclick="editar()">Editar</button>';
    $sth -> close();
    $db -> close();
    accion("ver preguntas");
}
function actualizarUsuario($email,$pass,$telefono){

    $db = getBD();

    $password = sha1($pass);



    $sql="UPDATE usuario SET Password='$password' WHERE Email='$email' AND Telefono='$telefono'";

    if(!$db->query($sql)){

        echo("Resultado incorrecto");
        die('Error: '.$db->error);

    }else{
        $r = $db->affected_rows;
        if($r==0){
            echo("<p><FONT COLOR=RED>Alguno de los datos no es correcto</FONT></p>");
        }else if($r==1){
            echo("<p><FONT COLOR=RED>Se ha actualizado la contraseña correctamente</FONT></p>");
        }
    }

    $db->close();
}