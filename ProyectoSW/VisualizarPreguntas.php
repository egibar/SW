<html>
<head>
    <meta charset="UTF-8">
    <title>Gestion Preguntas</title>
    <link rel="stylesheet"
          href="diseno.css"/>
</head>
<body>
<h1>VISUALIZAR PREGUNTAS</h1>
<div align="center">
    <?php

    include "funciones.php";

    $db = getBD();
    $preguntas = mysqli_query($db, "SELECT * FROM `Preguntas`");
    echo '
		    <table border=1>
		    <tr> 
		        <th> Complejidad </th>
		        <th> Pregunta </th>
		        <th> Autor </th>
		    </tr>';
    while ($result = mysqli_fetch_array($preguntas)) {
        echo '
		        <tr>
		            <td>' . $result['Complejidad'] . '</td>
		            <td>' . $result['Pregunta'] . '</td>
		            <td>' . $result['Email'] . '</td></tr>';


    }
    echo '</table>';
    $preguntas->close();
    mysqli_close($db);
    accion("visualizarpreguntas");
    ?>
    <a href="layout.php">
        <button type="button" name="volver" class="form-btn" id="volver" rigth="20%">Volver</button>
    </a>
</div>
</body>
</html>
