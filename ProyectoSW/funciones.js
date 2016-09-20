/**
 * Created by egibar on 20/09/2016.
 */

function revisar(elemento) {
    if (elemento.value==""){
        elemento.className='error';
    }
    else elemento.className='form-input';
}
function revisaremail(elemento) {
    exp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!exp.test(elemento.value)) {
        elemento.className='error';
        alert("Error: La dirección de correo " + elemento.value + " es incorrecta.");
    }
    else elemento.className='form-input';
}
function revisarpass(elemento) {
//    exp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (elemento.value==""){
        elemento.className='error';
    }
    else elemento.className='form-input';
}
function revisartel(elemento) {
    valor = elemento.value;
    if( !(/^\d{9}$/.test(valor)) ) {
        elemento.className='error';
        alert("Tiene que escribir un teléfono de 9 dígitos");
    }
    else elemento.className='form-input';
}
function revisaresp(elemento) {
    if (elemento.selectedOptions==0){
        elemento.className='error';
    }
    else elemento.className='form-input';
}
