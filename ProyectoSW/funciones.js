
 function vervalores(){
     var frm = document.getElementById("registro");
     var nombre = document.getElementById('name');
     var email = document.getElementById("email");
     var password = document.getElementById("password");
     var password2 = document.getElementById("password2");
     var telefono = document.getElementById("telefono");

     expname =/^[a-zA-Z]+ [a-zA-Z]+ ([a-zA-Z]*)/g;
     expemail =/^[a-zA-Z]+\d{3}\@ikasle.ehu\.(eus|es)/g;
     exppass = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,15}/g;
     exptel= /^\d{9}$/;

     if (!expname.test(nombre.value)){
         nombre.className='error';
     //    alert("El formato del nombre no es el correcto");
         return false;
     }
     else if (!expemail.test(email.value) && email.value.length>0) {
         elemento.className='error';
     //    alert("Error: La dirección de correo " + elemento.value + " es incorrecta.");
         return false;
     }
     else if (!exppass.test(password.value)) {
         password.className = 'error';
     //    alert("la contraseña no tiene al menos 6 caracteres");
         return false;
     }
     else if(password!=password2) {
         return false;
     }
    else if( !exptel.test(telefono.value) && telefono.value.length==9 ) {
         telefono.className = 'error';
         //     alert("Tiene que escribir un teléfono de 9 dígitos");
         return false;
     }
     if (!cmail){
         return false;
     }
     if (!cpass){
         return false;
     }
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



