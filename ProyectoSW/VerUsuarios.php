<?php
include "funciones.php";

$db = getBD();
$usuarios = mysqli_query($db, "SELECT * FROM `usuario`");
echo '
		    <table border=1>
		    <tr>
		        <th> NOMBRE </th>
		        <th> EMAIL </th>
		        <th> PASSWORD </th>
		        <th> TELEFONO </th>
		        <th> ESPECIALIDAD </th>
		        <th> INTERESES </th>
		       	<th> IMAGEN </th>
		    </tr>';
while ($result = mysqli_fetch_array($usuarios)) {
    echo '
		        <tr>
		            <td>' . $result['name'] . '</td>
		            <td>' . $result['email'] . '</td>
		            <td>' . $result['password'] . '</td>
		            <td>' . $result['telefono'] . '</td>
		            <td>' . $result['especialidad'] . '</td>
		            <td>' . $result['interes'] . '</td></tr>';
}
echo '</table>';
$usuarios->close();
mysqli_close($db);

?>



