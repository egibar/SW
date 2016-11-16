<nav class='main' id='n1' role='navigation'>
    <span><a href='layout.php'>Inicio</a></span>
    <?php
    if (isset($_SESSION['usuario'])) {
        if ($_SESSION['rol'] == 'alumno')
            echo("<span><a href='GestionPreguntasJQuery.php'>Gestion Preguntas</a></span>");
        elseif ($_SESSION['rol'] == 'profesor')
            echo("<span><a href='revisar.php'>Revisar Preguntas</a></span>
	              <span><a href='ObtenerDatos.html'>Obtener Datos</a></spam>");
    }
    ?>
    <span><a href='VisualizarPreguntas.php'>Preguntas</a></span>
    <span><a href='verPreguntasXML.php'>Preguntas XML</a></span>
    <span><a href='creditos.php'>Creditos</a></span>
</nav>