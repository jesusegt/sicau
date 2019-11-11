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

function validarsub(f){

	var area = document.getElementById('area');
	var subarea = f.nombre.value;

	if (area.selectedIndex==false) {
		alert('Debe seleccionar un Area.');
		f.area.focus();
		return (false);
	}

	if(!subarea) {
		alert ('Ingrese un Subarea.');
		f.nombre.focus();
		return (false);
	}

}

function validarferiado(f){

	var motivo = f.motivo.value;
	var fechai = f.fecha_inicial.value;
	var fechaf = f.fecha_final.value;

	if (!motivo){
		alert ('Ingrese un Motivo.');
		f.motivo.focus();
		return (false);
	}

	if (!fechai){
		alert ('Seleccione una Fecha Inicial.');
		f.fecha_inicial.focus();
		return (false);
	}

	if (!fechaf){
		alert ('Seleccione una Fecha Final.');
		f.fecha_final.focus();
		return (false);
	}

	if (fechai>fechaf){
		alert ('La Fecha Inicial debe ser menor a la Fecha Final.')
		f.fecha_inicial.focus();
		return (false);
	}
}

function validarpermiso(f){

	var ci = f.cedula.value;
	var motivo = f.motivo.value;
	var fechai = f.fecha_inicial.value;
	var fechaf = f.fecha_final.value;

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

	if (!motivo){
		alert ('Ingrese un motivo.');
		f.motivo.focus();
		return (false);
	}

	if (!fechai){
		alert ('Seleccione una fecha inicial');
		f.fecha_inicial.focus();
		return (false);
	}

	if (!fechaf){
		alert ('Seleccione una fecha final');
		f.fecha_final.focus();
		return (false);
	}

	if (fechai>fechaf){
		alert ('La Fecha Inicial debe ser menor a la Fecha Final.')
		f.fecha_inicial.focus();
		return (false);
	}
}

function validartiposol(f){
	var name = f.nombre.value;

	if(!name){
		alert('Ingrese un Nombre para el Tipo de Solicitud.');
		f.nombre.focus();
		return (false);
	}
	if(name.length < 4){
		alert('Nombre del Tipo de Solicitud muy corto.');
		f.nombre.focus();
		return (false);
	}
}



function validarsoli(f){
	var ci = f.cedula.value;
	var motivo = f.motivo.value; 
	var tipo = document.getElementById('id_tipo');
	var area = document.getElementById('area');
	var subarea = document.getElementById('id_subarea');

	if(!ci){
		alert('Ingrese una cédula.');
		f.cedula.focus();
		return (false);
	}

	if (ci.length < 6) {
		alert('Faltan digitos a la Cédula');
		f.cedula.focus();
		return (false);
    }

	if(!motivo){
		alert('Ingrese un Motivo.');
		f.motivo.focus();
		return (false);
	}

	if (tipo.selectedIndex==false){
		alert('Debe seleccionar un Tipo.');
		f.id_tipo.focus();
		return (false);
	}

	if (area.selectedIndex==false){
		alert('Debe seleccionar un Area.');
		f.area.focus();
		return (false);
	}

	if (subarea.selectedIndex==false){
		alert('Debe seleccionar un Subarea.');
		f.id_subarea.focus();
		return (false);
	}

}

function validarasistencia(f) {
	
	var ci = f.cedula.value;

	if (!ci){
		alert ('Ingrese una cédula.');
		f.cedula.focus();
		return (false);
	}

	if (cedula.length < 6){
		alert ('Faltan digitos a la cédula.');
		f.cedula.focus();
		return (false);
	}
}

function validaractividad (f){

	var ci = f.cedula.value;

	if (!ci){
		alert ('Ingrese una cédula.');
		f.cedula.focus();
		return (false);
	}

	if (cedula.length < 6){
		alert ('Faltan digitos a la cédula.');
		f.cedula.focus();
		return (false);
	}

}

function soloNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = '0123456789';
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

function soloTelefono(e){
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

function soloFecha(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = '';
       especiales = '37-39';

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

function soloAlfanumerico(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = 'áéíóúabcdefghijklmnñopqrstuvwxyz0123456789-/ ';
       especiales = '8-32-37-39-46';

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

function soloUsuario(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = 'abcdefghijklmnopqrstuvwxyz0123456789-_.';
       especiales = '8-32-37-39-46';

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

function mayusculainicial(solicitar){
	var index;
	var tmpStr;
	var tmpChar;
	var preString;
	var postString;
	var strlen;
	tmpStr = solicitar.value.toLowerCase();
	strLen = tmpStr.length;
	if (strLen > 0)
	{
		for (index = 0; index < strLen; index++)
		{
			if (index == 0)
			{
				tmpChar = tmpStr.substring(0,1).toUpperCase();
				postString = tmpStr.substring(1,strLen);
				tmpStr = tmpChar + postString;
			}else{
				tmpChar = tmpStr.substring(index, index+1);
				if (tmpChar == " " && index < (strLen-1))
				{
				tmpChar = tmpStr.substring(index+1, index+2).toUpperCase();
				preString = tmpStr.substring(0, index+1);
				postString = tmpStr.substring(index+2,strLen);
				tmpStr = preString + tmpChar + postString;
				}
			}
		}
	}
solicitar.value = tmpStr;
}