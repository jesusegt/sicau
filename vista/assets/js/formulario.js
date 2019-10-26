function validar(f) {
	// body...

	var nombre = f.nombre.value;
	var apellido = f.apellido.value;
	var cedula = f.cedula.value;
	var cargo = document.getElementById('cargo');
	var telefono = f.telefono.value;
	var correo = f.correo.value;
  	var id = f.id.value;
  	var usuario = f.usuario.value;


	if (!cedula) {
		alert('Ingrese una Cédula');
		f.cedula.focus();
		return false;
	}

	if (cedula.length < 6) {
		alert('Faltan digitos en la Cédula');
		f.cedula.focus();
		return false;
	}

  	if (!id) {
    	alert('Ingrese ID');
    	f.id.focus();
    	return false;
  	}

  	if (!nombre) {
    	alert('Ingrese el Nombre');
    	f.nombre.focus();
    	return false;
  	}

  	if (!apellido) {
    	alert('Ingrese el Apellido');
    	f.apellido.focus();
    	return false;
  	}

  	if (!telefono) {
    	alert('Ingrese el Número Telefónico');
    	f.telefono.focus();
    	return false;
  	}

  	if (!Cargo) {
    	alert('Seleccione el Cargo');
    	f.telefono.focus();
    	return false;
  	}


  	if (!correo) {
    	alert('Ingrese el Correo Electrónico');
    	f.correo.focus();
    	return false;
  	}

  	if (!usuario) {
    	alert('Ingrese el Usuario');
    	f.usuario.focus();
    	return false;
  	}

}


function soloNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = '0123456789-';
       especiales = '8-37-39-46';

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }


function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = 'áéíóúabcdefghijklmnñopqrstuvwxyz';
       especiales = '8-37-39-46';

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
}

function limpia() {
    var val = document.getElementById('miInput').value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById('miInput').value = '';
    }
}