function validarsolicitante (f){
	// body...
	var ci = f.cedula.value;
	var name = f.nombre.value;
	var apellido = f.apellido.value;
	var sexo = document.getElementsByName('sexo');
	var cargo = document.getElementById('cargo');
	var telefono = f.telefono.value;
	var correo = f.correo.value;


	if(!ci){
		alert('Ingrese una Cédula.');
		f.cedula.focus();
		return false;
	}
	if (ci.length < 6) {
		alert('Faltan digitos a la Cédula.');
		f.cedula.focus();
		return false;
    }


    if(!name){
		alert('Ingrese un Nombre.');
		f.nombre.focus();
		return false;
	}
	if (name.length < 3) {
		alert('Nombre muy corto.');
		f.nombre.focus();
		return false;
    }


	if(!apellido){
		alert('Ingrese un Apellido.');
		f.apellido.focus();
		return false;
	}
	if (apellido.length < 3) {
		alert('Apellido muy corto.');
		f.apellido.focus();
		return false;
    }

    if (sexo[0].checked==false && sexo[1].checked==false){
		alert('Debe seleccionar un Sexo.');
		return (false);
	}

    if (cargo.selectedIndex==false){
		alert('Debe seleccionar un Cargo.');
		f.cargo.focus();
		return (false);
	}


	if(!telefono){
		alert('Ingrese un Telefono.');
		f.telefono.focus();
		return false;
	}
	if (telefono.length < 11) {
		alert('Faltan digitos al telefono');
		f.telefono.focus();
		return false;
    }
	if (telefono){
		if (!/^\d{4}\-\d{7}$/.test(telefono)){   
		alert('Escriba un Telefono como este Ej:0000-1112233');
		f.telefono.focus();
		return false;
		}
	}


	/*if(!correo){
		alert('Ingrese un Correo.');
		f.correo.focus();
		return false;
	}*/
	if (correo){
		if (!/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/.test(correo)){   
		alert('Ingrese una dirección de correo como esta nombre@dominio.extencion');
		f.correo.focus();
		return false;
		}
	}

}


function validarcargo (f){

	var name = f.nombre.value;

	if(!name){
		alert('Ingrese un Nombre para el Cargo.');
		f.nombre.focus();
		return false;
	}
	if(name.length < 4){
		alert('Nombre del Cargo muy corto.');
		f.nombre.focus();
		return false;
	}

}

function validararea (f){
	var nombre = f.nombre.value;

	if(!nombre){
		alert('Ingrese un nombre.');
		f.nombre.focus();
		return false;
	}
}

function validarsubarea (f){
	var area = document.getElementById('area');
	var subarea = f.subarea.value;

	if (area.selectedIndex==false){
		alert('Debe seleccionar un Area.');
		f.area.focus();
		return (false);
	}

	if(!subarea){
		alert('Ingrese un Subarea.');
		f.subarea.focus();
		return false;
	}

}

function usuario(f){

				var ci = f.cedula.value;
				var nombre = f.nombre.value;
				var apellido = f.apellido.value;
				var nombre_usu = f.nombre_usu.value;
				var contrasena = f.contrasena.value;
				var pw = f.pw.value;

				if(!ci){
					alert('Ingrese una cédula.');
					f.cedula.focus();
					return false;
				}
				if (ci.length < 6) {
					alert('Faltan digitos a la Cédula');
					f.cedula.focus();
					return false;
			    }

				if(!nombre){
					alert('Ingrese un Nombre.');
					f.nombre.focus();
					return false;
				}
				if (nombre.length < 3) {
					alert('Nombre muy corto');
					f.nombre.focus();
					return false;
			    }


				if(!apellido){
					alert('Ingrese un Apellido.');
					f.apellido.focus();
					return false;
				}
				if (apellido.length < 3) {
					alert('Apellido muy corto');
					f.apellido.focus();
					return false;
			    }


				if(!tipo){
					alert('Ingrese un Tipo.');
					f.tipo.focus();
					return false;
				}

				if(!usuario){
					alert('Ingrese un Usuario.');
					f.usuario.focus();
					return false;
				}

				if(!contrasena){
					alert('Ingrese una Contraseña.');
					f.pw.focus();
					return false;
				}
				if(!pw){
					alert('Debe confirmar la Contraseña.');
					f.pw.focus();
					return false;
				}
				if(contrasena != pw){
				alert ('Las contraseñas no coinciden.');
				f.contrasena.focus();
				 return false;
				       
				}

			}

function validartiposol(f){
	var name = f.nombre.value;

	if(!name){
		alert('Ingrese un Nombre para el Tipo de Solicitud.');
		f.nombre.focus();
		return false;
	}
	if(name.length < 4){
		alert('Nombre del Tipo de Solicitud muy corto.');
		f.nombre.focus();
		return false;
	}
}



function validarsolicitud(f){
	var ci = f.cedula.value;
	var name = f.nombre.value;
	var apellido = f.apellido.value;
	var motivo = f.motivo.value;
	var lugar = f.lugar.value;
	var tipo = document.getElementById('tipo');

	if(!ci){
		alert('Ingrese una cédula.');
		f.cedula.focus();
		return false;
	}

	if (ci.length < 6) {
		alert('Faltan digitos a la Cédula');
		f.cedula.focus();
		return false;
    }


    if(!name){
		alert('Ingrese un Nombre.');
		f.nombre.focus();
		return false;
	}


	if(!apellido){
		alert('Ingrese un Apellido.');
		f.apellido.focus();
		return false;
	}

	if(!motivo){
		alert('Ingrese un Motivo.');
		f.motivo.focus();
		return false;
	}

	if (tipo.selectedIndex==false){
		alert('Debe seleccionar un Tipo');
		f.tipo.focus();
		return (false);
	}

	if(!lugar){
		alert('Ingrese un Lugar.');
		f.lugar.focus();
		return false;
	}

	alert ('Solicitud Registrada.');
	return 0;

}

function validarpw1(f){

			var contrasena = f.contrasena.value;
	        
	        if(!contrasena){
	                alert('Ingrese la contraseña actual');
	                f.contrasena.focus();
	                return false;
	        }
}
function validarpw(f){

			var contrasena = f.contrasena.value;
			var pwc = f.pwc.value;
	        
	        if(!contrasena){
	                alert('Ingrese la nueva contraseña');
	                f.contrasena.focus();
	                return false;
	        }

	        
	        if(!pwc){
	                alert('Debe confirmar la nueva contraseña');
	                f.pwc.focus();
	                return false;
	        }
	        
	        
	        if(contrasena != pwc){
	                alert ('Las nuevas contraseñas no coinciden');
	                f.contrasena.focus();
	                return false;
	       
	        }
}


function validarperfil (f){
	var name = f.nombre.value;
	var apellido = f.apellido.value;


    if(!name){
		alert('Ingrese un Nombre.');
		f.nombre.focus();
		return false;
	}
	if(name.length < 3){
		alert('Nombre muy corto.');
		f.nombre.focus();
		return false;
	}


	if(!apellido){
		alert('Ingrese un Apellido.');
		f.apellido.focus();
		return false;
	}
	if(apellido.length < 4){
		alert('Apellido muy corto.');
		f.apellido.focus();
		return false;
	}
}

function validarbuscar(f){

	var ci = f.cedula.value;

	if(!ci){
		alert('Ingrese cedula');
		f.cedula.focus();
		return false;
	}
	if(ci.length < 6){
		alert('Faltan digitos a la cedula');
		f.cedula.focus();
		return false;
	}
}

function validarbuscar2(f){

	var buscar = f.buscar.value;

	if(!buscar){
		alert('Debe rellenar el campo buscar');
		f.buscar.focus();
		return false;
	}
}




function soloNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = '0123456789-';
       especiales = '8-37-39-46';

       tecla_especial = false;
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

       tecla_especial = false;
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

