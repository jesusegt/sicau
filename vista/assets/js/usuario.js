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