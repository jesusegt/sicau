function validarcontrasena(f) {
	
	var contrasena_actual = f.contrasena_actual.value;
	var contrasena = f.contrasena.value;
	var pwc = f.pwc.value;

	if (!contrasena_actual) {
		alert ('Ingrese la contraseña actual.');
		f.contrasena_actual.focus();
		return false;
	}

	if (!contrasena) {
		alert ('Ingrese una nueva contraseña.');
		f.contrasena.focus();
		return false;
	}

	if (!pwc) {
		alert ('Debe confirmar la nueva contraseña.');
		f.pwc.focus();
		return false;
	}

	if (contrasena != pwc) {
		alert ('Las nuevas contraseñas no coinciden.');
		f.pwc.focus();
		return false;
	}

}