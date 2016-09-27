<?php
/**
 * Created by PhpStorm.
 * User: egibar
 * Date: 26/09/2016
 * Time: 17:21
 */

$link=mysqli_connect    ("localhost", "root", "", "sw");
$usuarios =mysqli_query  ($link, "select * from datos" );
echo '<table border=1> <tr> <th> Nombre </th> <th> Email </th> <th> Password </th> <th> Telefono </th> <th> Especialidad </th> <th> Interes </th>
</tr>';
while ($row =    mysqli_fetch_array    ( $usuarios )) {

echo '<tr><td>'.$row['name']. '</td> <td>'.$row['email'].'</td><td>'.$row['password'].'</td><td>'.$row['telefono'].'</td><td>'.$row['especialidad'].'</td><td>'.$row['interes'].'</td></tr>';
}
echo '</table>';
$usuarios->close();
mysqli_close($link);
?>