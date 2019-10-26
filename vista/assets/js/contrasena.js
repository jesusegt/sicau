function validarcontrasena(f){
			var contrasena = f.contrasena.value;
	        
	        if(!contrasena){
	                alert('Ingrese la contraseña actual');
	                f.contrasena.focus();
	                return false;
	        }
}
function validarcontrasena2(f){
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