function validar(obj) {
	
	var ci = obj.ci.value;
	var obrero = 27529516;

	if (!ci) {
		alert('Ingrese una cedula para poder registrar la asistencia.');
		obj.ci.focus();
		return false;
	}

	if (isNaN(ci)) {
		alert('Solo se permite ingresar numeros.');
		obj.ci.focus();
		return false;
	}

	if (ci.length < 6) {
		alert('Faltan digitos a la cedula');
		f.cedula.focus();
		return false;
	}

	if (ci != obrero){
		alert('La cedula ingresada no pertenece a ningun trabajador de la institución, por favor dirijase hacia la oficina de la asistente encargada para registrar sus datos.');
		obj.ci.focus();
		return false;
	}

	alert ('Asistencia registrada.');
	return 0;
}