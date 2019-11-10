function validar(obj){
	        
	        var usuario=obj.user.value;
	        var contraseña=obj.pw.value;
	        if(!usuario){
	                alert('Debe ingresar el usuario');
	                obj.user.focus();
	                return false;
	        }
	        if(!contraseña){
	                alert('Debe ingresar la contraseña');
	                obj.pw.focus();
	                return false;
	        }
}