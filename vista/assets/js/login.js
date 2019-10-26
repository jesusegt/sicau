function validar(obj){
	        
	        var usuario=obj.user.value;
	        var user='admin';
	        var contraseña=obj.pw.value;
	        var password= 'admin123';
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
	        /*if(usuario != user || contraseña != password){
	        		alert('Usuario o contraseña incorrectos');
	        		obj.user.focus();
	        		return false;
	        }*/
}