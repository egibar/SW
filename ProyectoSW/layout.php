<!DOCTYPE html>
<html>
<head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
    <title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css'/>
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (min-width: 530px) and (min-device-width: 481px)'
          href='estilos/wide.css'/>
    <link rel='stylesheet'
          type='text/css'
          media='only screen and (max-width: 480px)'
          href='estilos/smartphone.css'/>

</head>
<body>
<div id='page-wrap'>
    <header class='main' id='h1'>
        <?php
        include 'funciones.php';
        @session_start();
        if (isset($_SESSION['usuario'])) {
            echo("<span class='right'><a href='logout.php'>Logout</a></span>");
        } else {
            echo('<span class="right"><a href="registro.html">Registrarse</a></span>
            <span class="right"><a id="login" href="login.php">Login</a></span>');
        }
        ?>
        <!--      		<span class="right"><a href="login.php">Login</a></span>
                      <span class="right" style="display:none;"><a href="logout">Logout</a></span>
        -->
        <h2>Quiz: el juego de las preguntas</h2>
    </header>
    <nav class='main' id='n1' role='navigation'>
        <span><a href='layout.php'>Inicio</a></span>
        <?php
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['rol'] == 'alumno')
                echo("<span><a href='insertarPreguntas.php'>Insertar Preguntas</a></span>");
            elseif ($_SESSION['rol'] == 'profesor')
                echo("<span><a href='reviar.php'>Revisar Preguntas</a></span>");
        }
        ?>
        <span><a href='VisualizarPreguntas.php'>Preguntas</a></span>
        <span><a href='creditos.php'>Creditos</a></span>
    </nav>
    <section class="main" id="s1">

        <div>
            Aqui se visualizan las preguntas y los creditos ...

        </div>
    </section>
    <footer class='main' id='f1'>
        <p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
        <a href='https://github.com/egibar/SW/tree/master/ProyectoSW'>Link GITHUB</a>
    </footer>
</div>
</body>
</html>
