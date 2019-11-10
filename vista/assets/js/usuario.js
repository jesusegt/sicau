function validarusuario(f) {

	var cedula = f.cedula.value;
	var nombre = f.nombre.value;
	var apellido = f.apellido.value;
	var tipo = document.getElementById('tipo');
	var nombre_usu = f.nombre_usu.value;
	var contrasena = f.contrasena.value;
	var pw = f.pw.value;

	if (!cedula) {
		alert ('Ingrese una cédula.');
		f.cedula.focus();
		return (false);
	}

	if (cedula.length < 6) {
		alert ('Faltan digitos en la cédula.');
		f.cedula.focus();
		return (false);
	}

	if (!nombre) {
		alert ('Ingrese un nombre.');
		f.nombre.focus();
		return (false);
	}

	if (nombre.length < 3){
		alert('Nombre muy corto.');
		f.nombre.focus();
		return (false);
	}

	if (!apellido) {
		alert ('Ingrese un apellido.');
		f.apellido.focus();
		return (false);
	}

	if (apellido.length < 3) {
		alert ('Apellido muy corto.');
		f.apellido.focus();
		return (false);
	}

	if (tipo.selectedIndex==false) {
		alert ('Seleccione un tipo.');
		f.tipo.focus();
		return (false);
	}

	if (!nombre_usu) {
		alert ('Ingrese un nombre de usuario.');
		f.nombre_usu.focus();
		return (false);
	}

	if (!contrasena) {
		alert ('Ingrese una contraseña.');
		f.contrasena.focus();
		return (false);
	}

	if (!pw) {
		alert ('Debe confirmar la contraseña.');
		f.pw.focus();
		return (false);
	}

	if (contrasena != pw) {
		alert ('Las contraseñas no coinciden.');
		f.contrasena.focus();
		return (false);
	}

}

function editarusuario(f) {

	var cedula = f.cedula.value;
	var nombre = f.nombre.value;
	var apellido = f.apellido.value;
	var tipo = document.getElementById('tipo');

	if (!cedula) {
		alert ('Ingrese una cédula.');
		f.cedula.focus();
		return (false);
	}

	if (cedula.length < 6) {
		alert ('Faltan digitos en la cédula.');
		f.cedula.focus();
		return (false);
	}

	if (!nombre) {
		alert ('Ingrese un nombre.');
		f.nombre.focus();
		return (false);
	}

	if (nombre.length < 3){
		alert('Nombre muy corto.');
		f.nombre.focus();
		return (false);
	}

	if (!apellido) {
		alert ('Ingrese un apellido.');
		f.apellido.focus();
		return (false);
	}

	if (apellido.length < 3) {
		alert ('Apellido muy corto.');
		f.apellido.focus();
		return (false);
	}

	if (tipo.selectedIndex==false) {
		alert ('Seleccione un tipo.');
		f.tipo.focus();
		return (false);
	}
}
 
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

function validarlogin(obj){
	        
	        var usuario=obj.nombre_usu.value;
	        var contrasena=obj.contrasena.value;
	        if(!usuario){
	                alert('Debe ingresar el usuario.');
	                obj.nombre_usu.focus();
	                return (false);
	        }
	        if(!contraseña){
	                alert('Debe ingresar la contraseña.');
	                obj.contrasena.focus();
	                return (false);
	        }
}

function editarperfil(f){

	var nombre = f.nombre.value;
	var apellido = f.apellido.value;
	var usuario = f.nombre_usu.value;

	if (!nombre) {
		alert ('Debe ingresar un nombre.');
		f.nombre.focus();
		return (false);
	}

	if (nombre.length < 3){
		alert ('Nombre muy corto.');
		f.nombre.focus();
		return (false);
	}

	if (!apellido) {
		alert ('Debe ingresar un apellido.');
		f.apellido.focus();
		return (false);
	}

	if (apellido.length < 3){
		alert ('Apellido muy corto.');
		f.apellido.focus();
		return (false);
	}

	if(!usuario){
		alert('Debe ingresar el usuario.');
		f.nombre_usu.focus();
		return (false);
	}

	if (usuario.length < 3){
		alert ('Nombre de usuario muy corto.');
		f.nombre_usu.focus();
		return (false);
	}

}



//input 1
	$(document).on('mousedown', '.ojo', function() {

	    $(this).toggleClass("fa-eye fa-eye-slash");
	    
	    var input = $("#contrasena");
	    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});
	$(document).on('mouseup', '.ojo', function() {

	    $(this).toggleClass("fa-eye fa-eye-slash");
	    
	    var input = $("#contrasena");
	    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});
	
//input 2
	$(document).on('mousedown', '.ojo2', function() {

	    $(this).toggleClass("fa-eye fa-eye-slash");
	    
	    var input = $("#pw");
	    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});
	$(document).on('mouseup', '.ojo2', function() {

	    $(this).toggleClass("fa-eye fa-eye-slash");
	    
	    var input = $("#pw");
	    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});

//input 3
	$(document).on('mousedown', '.ojo3', function() {

	    $(this).toggleClass("fa-eye fa-eye-slash");
	    
	    var input = $("#contrasena_actual");
	    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});
	$(document).on('mouseup', '.ojo3', function() {

	    $(this).toggleClass("fa-eye fa-eye-slash");
	    
	    var input = $("#contrasena_actual");
	    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});

//input 2
	$(document).on('mousedown', '.ojo4', function() {

	    $(this).toggleClass("fa-eye fa-eye-slash");
	    
	    var input = $("#pwc");
	    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});
	$(document).on('mouseup', '.ojo4', function() {

	    $(this).toggleClass("fa-eye fa-eye-slash");
	    
	    var input = $("#pwc");
	    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
	});