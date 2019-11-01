function usuario(f){

				var ci = f.cedula.value;
				var nombre = f.nombre.value;
				var apellido = f.apellido.value;
				var tipo = document.getElementById('tipo');
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


				if (tipo.selectedIndex==false){
					alert('Debe seleccionar un Tipo.');
					f.cargo.focus();
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

function validarcontrasena(f){
			var contrasena_actual = f.contrasena_actual.value;
			var contrasena = f.contrasena.value;
			var pwc = f.pwc.value;
	   		

	   		if(!contrasena_actual){
	                alert('Ingrese la contraseña actual');
	                f.contrasena_actual.focus();
	                return false;
	        }
	        if(!contrasena){
	                alert('Ingrese la nueva contraseña');
	                f.contrasena.focus();
	                return false;
	        }
	        if(!pw){
	                alert('Debe confirmar la nueva contraseña');
	                f.pw.focus();
	                return false;
	        }
	        if(contrasena != pw){
	                alert ('Las nuevas contraseñas no coinciden');
	                f.contrasena.focus();
	                return false;
	       
	        }
}

/*function CambiaTipo(Frm)
        {
            var Campo=Frm.contrasena;
            if(Campo.type=='password')
                Frm.contrasena.type='text';
            else    
                Frm.contrasena.type='password';
        }

function CambiaTipo2(Frm)
        {
            var Campo=Frm.pw;
            if(Campo.type=='password')
                Frm.pw.type='text';
            else    
                Frm.pw.type='password';
        }*/

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