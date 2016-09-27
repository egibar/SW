/**
 * Created by egibar on 20/09/2016.
 */
function revisarname(elemento) {
    var ok = true;
//    var nombre = document.getElementById('name');
    exp =/^[a-zA-Z]+ [a-zA-Z]+ [a-zA-Z]/g;
    if (!exp.test(elemento.value)){
        elemento.className='error';
        ok=false;
        alert("El formato del nombre no es el correcto")
    }
    else elemento.className='form-input';
    return ok;
}

function revisaremail(elemento) {
    var ok = true;
    exp =/^[a-zA-Z]+\d{3}\@ikasle.ehu\.(eus|es)/g;
    if (!exp.test(elemento.value)) {
        elemento.className='error';
        alert("Error: La dirección de correo " + elemento.value + " es incorrecta.");
        ok=false;

    }
    else elemento.className='form-input';

    return ok;
}

function revisarpass(elemento) {
    var ok=true;
    exp = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,15}/g;
    if (!(exp.test(elemento.value))) {
        elemento.className = 'error';
        ok=false;
        alert("la contraseña no tiene al menos 6 caracteres");
    }
    else  elemento.className = 'form-input';

    return ok;
}

function revisartel(elemento) {
    exp=/^\d{9}$/;
    ok=true;
    if( !(exp.test(elemento.value)) ) {
        elemento.className='error';
        ok=false;
        alert("Tiene que escribir un teléfono de 9 dígitos");
    }
    else {elemento.className='form-input';
        }
}

function camposObigatorios(){
    var ok = true;
    var frm = document.getElementById("registro");
    for(i=0;i<frm.elements.length - 4;i++){
        var elem =frm.elements[i].value;
        if(elem.length==0){
            alert("No todos los campos obligatorios estan rellenos");
            ok = false;
        }
    }
    return ok;
}
function revisaresp(obj){
    if(obj.value=="Otra"){
        var td = obj.parentNode;
        var tr = td.parentNode;
        tr.removeChild(td);
       // document.getElementById("especialidad").removeChild(tr);
        var textBox = document.createElement("input");
        textBox.setAttribute("type", "text");
        textBox.setAttribute("name", "especialidad");
       // textBox.insertChildAfter(document.getElementById("especialidad"));
        textBox.setAttribute("onblur", "revisaresp(this)");
        var ntd = document.createElement("td");
        ntd.appendChild(textBox);
        tr.appendChild(ntd);
    }else if(obj.value==""){
        var td = obj.parentNode;
        var tr = td.parentNode;
        td.removeChild(obj);
        var select = document.createElement("select");
        select.setAttribute("name","especialidad");
        select.setAttribute("onchange", "revisaresp(this)");
        var is = document.createElement("option");
        var istxt = document.createTextNode("Ingeniería del Software");
        is.appendChild(istxt);
        var ic = document.createElement("option");
        var ictxt = document.createTextNode("Ingeniería de Computadores");
        ic.appendChild(ictxt);
        var c = document.createElement("option");
        var ctxt = document.createTextNode("Computación");
        c.appendChild(ctxt);
        var o = document.createElement("option");
        var otxt = document.createTextNode("Otra");
        o.appendChild(otxt);
        select.appendChild(is);
        select.appendChild(ic);
        select.appendChild(c);
        select.appendChild(o);
        td.appendChild(select);
    }
}


function vervalores() {
    var sAux = "";
    var frm = document.getElementById("registro");
    var nombre = document.getElementById('name');
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var telefono = document.getElementById("telefono");

    revisarname(nombre);
    revisaremail(email);
    revisarpass(password);
    revisartel(telefono);
    revisaresp();
    if (errorname & errormail & errorpass & errortel) {
        for (i = 0; i < frm.elements.length - 2; i++) {
            sAux += "NOMBRE: " + frm.elements[i].name + " ";
            sAux += "VALOR: " + frm.elements[i].value + "\n";
        }
        alert(sAux);
    }
    else return false;
}




