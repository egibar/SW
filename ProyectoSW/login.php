<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
</head>
<body>
<form id='login' method="post" action="login.php">

 <h1>LOGIN</h1>

            <div class="column">

                <ul>
            <li>
                <label for="email">Direccion de correo:</label>
                <input type="text" name="email" id="email" placeholder="aeguibar006@ikasle.ehu.eus" required class="form-input"/>

            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required class="form-input"/>
            </li>
            <a href="layout.html"><button  type="button" name="volver" id="volver"  class="form-btn" rigth="20%">Volver</button></a>
            <button  type="submit" name="boton" id="enviar"  class="form-btn" onsubmit="revisar()" >Enviar</button>
            </ul>
            </div>
            </form>
            </body>
<?php

include "funciones.php";

            if (isset($_POST['email'])){
                if(login())
                    header('location:insertarPreguntas.php');
            }
?>



