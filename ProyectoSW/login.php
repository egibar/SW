<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
    <link rel="stylesheet"
          href="diseno.css"/>
</head>
<body>
<form id='login' method="post" action="login.php">

    <h1>LOGIN</h1>

    <div class="column">

        <ul>
            <li>
                <label for="email">Direccion de correo:</label>
                <input type="text" name="email" id="email" placeholder="aeguibar006@ikasle.ehu.eus" required
                       class="form-input"/>

            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required class="form-input"/>
            </li>
            <div align="right">
                <a href="layout.php">
                <button type="button" name="volver" id="volver" class="form-btn" rigth="20%">Volver</button>
            </a>
            <button type="submit" name="boton" id="enviar" class="form-btn">Enviar</button>
            </br>
            <a href="recuperarpass.php">
                ¿Olvido su contraseña?
            </a>
                </div>
        </ul>
    </div>
</form>
</body>
<?php

include "funciones.php";

if (isset($_POST['email'])) {
    if (login()) {
        if (strcmp($_SESSION['rol'], 'alumno') == 0)
            header('location:GestionPreguntas.php');
        elseif (strcmp($_SESSION['rol'], 'profesor') == 0)
            header('location:revisar.php');
    }
}
?>



