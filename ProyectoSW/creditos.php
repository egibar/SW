<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <title>Quiz</title>
    <link rel="stylesheet"
          href="diseno.css"/>
    <script src="scripts/jquery-2.1.4.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBm4pXOZVmTF30Tnh6RlxtjERL6qvbjciM&callback=initMap"    async defer></script>


    <script type="text/javascript">
        var URL = "http://www.freegeoip.net/json/31.170.165.197";
        var lat;
        var lon;
        $.getJSON(URL, function (datos) {
            lat = datos.latitude;
            lon = datos.longitude;
            mostrarGoogleMaps();
        });


        function mostrarGoogleMaps() {
            var punto = new google.maps.LatLng(lat, lon);
            var myOptions = {
                zoom: 4, center: punto, mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("mostrarMapa"), myOptions);
            var marker = new google.maps.Marker({
                position: punto,
                map: map,
                title: "Servidor"
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (objPosition) {
                    var lon = objPosition.coords.longitude;
                    var lat = objPosition.coords.latitude;

                    var punto = new google.maps.LatLng(lat, lon);
                    var marker = new google.maps.Marker({
                        position: punto,
                        map: map,
                        title: "Cliente"
                    });


                }, function (objPositionError) {
                    switch (objPositionError.code) {
                        case objPositionError.PERMISSION_DENIED:
                            alert("No se ha permitido el acceso a la posición del usuario.");
                            break;
                        case objPositionError.POSITION_UNAVAILABLE:
                            alert("No se ha podido acceder a la información de su posición.");
                            break;
                        case objPositionError.TIMEOUT:
                            alert("El servicio ha tardado demasiado tiempo en responder.");
                            break;
                        default:
                            alert("Error desconocido.");
                    }
                }, {
                    maximumAge: 75000,
                    timeout: 15000
                });
            }
            else {
                alert("Su navegador no soporta la API de geolocalización.");
            }
        }
    </script>
</head>
<body>


<h1>CREDITOS</h1>

<div id="box" class="creditos">


    <label>Nombre y apellidos: </br>  Asier Eguibar</label> </br>

    <label>Especialidad: </br>   Ingenieria del software</label> </br>
    <label>Foto: </label></br><img class="foto" src="imagen/Asier.jpeg"></br>
    <a href="layout.php">
        <button type="button" name="volver" class="form-btn">Volver</button>
    </a>
    <div id="mostrarMapa" style="width: 450px; height: 350px; left: 35%"/>
    <br/>





</div>

</body>
</html>

