<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recuperacion de password</title>
    <?php include "cabecera.html"?>
    <script src="scripts/jquery-2.1.4.js"></script>
    <script>
        var cpass=false;

        function comprobar(){
            var p = $("#password").val();
            var p2 = $("#password2").val();
            if(p==p2){
                return cpass;
            }else{
                return false;
            }

        }

        function comprobarPass() {
            var p = $("#password").val();
            $("#imp").remove();
            $("#pass").append("<img id='imp' width='20px' height='20px' src='imagen/loading.gif'> </img>");
            $.post("ProbarContrasena2.php", {password: p}, function (respuesta) {
                console.log("La respuesta es:", respuesta)
                if (respuesta == "VALIDA") {
                    $("#imp").remove();
                    $("#pass").append("<img id='imp' width='20px' height='20px' src='imagen/Green_check.png'> </img>");
                    cpass = true;
                } else {
                    $("#imp").remove();
                    $("#pass").append("<img id='imp' width='20px' height='20px' src='imagen/Red_check.png'> </img>");
                    cpass = false;

                }
            });
        }
    </script>
</head>

<body>
<form onsubmit="return comprobar()" action="recuperarpass.php" method="post">
<div class="column">


    <span class="campos_obligatorios">* Campos obligatorios</span>
    <ul>
        <li>
            <label for="email" id="mail">Direccion de correo<span>(*)</span>:</label>
            <input type="text" name="email" id="email" placeholder="aeguibar006@ikasle.ehu.eus" class="form-input"
                   onchange="comprobarMail()">
            <!--<input type="email" name="email" id="email"placeholder="aeguibar006@ikasle.ehu.eus" required/>   -->

        </li>
        <li>
            <label for="password" id="pass">Password<span>(*)</span>:</label>
            <input type="password" name="password" id="password"
                   placeholder="EgiBar56" class="form-input" pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,15}"
                   onchange="comprobarPass()" required>
        </li>
        <li>
            <label for="password2" id="pass2">Repita la password<span>(*)</span>:</label>
            <input type="password" name="password2" id="password2" placeholder="Repita la contraseña"
                   class="form-input" pattern="^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,15}" onchange="comprobar()">
        </li>
        <li>
            <label for="telefono">Numero de telefono<span>(*)</span>:</label>
            <input type="text" name="telefono" id="telefono" pattern="^\d{9}$" class="form-input" required/>
            <!--<input type="text" name="telefono" id="telefono" maxlength="9" minlength="9" required/>-->
        </li>

    </ul>
    <a href="layout.php">
        <button type="button" name="volver" class="form-btn" id="volver" rigth="20%">Volver</button>
    </a>
    <button type="submit" name="boton" id="enviar" class="form-btn">Enviar</button>
</div>

    </form>

</body>

</html>
<?php

include 'funciones.php';

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['telefono'])){
    actualizarUsuario($_POST['email'],$_POST['password'],$_POST['telefono']);
}
?>
