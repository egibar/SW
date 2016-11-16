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
<h2>Quiz: el juego de las preguntas</h2>
</header>