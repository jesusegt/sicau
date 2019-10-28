<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'>
		<title>SICAU-SG</title>
		<link rel='stylesheet' type='text/css' href='../../assets/css/trabajadores.css'>
		<script type="text/javascript" src="../../assets/js/usuario.js"></script>
		
	</head>
	<body>

		<div class='contenedor'>
			<h1 class='page-title'>
				<i></i>
				Añadir Usuario
			</h1>
			<a href='../../../controlador/ctr_usuario.php?list=1' class='btn btn-warning'>
				<i></i>
				<span>Volver a la lista</span>
			</a>
			
		</div>

		<div class='contenedor'>
			<div class='panel panel-bordered'>
				<form name='formulario' class='formulario' id='formulario' onsubmit='return usuario(this)' method='post' action='../../../controlador/ctr_usuario.php'>
					<div class='panel-body'>
						<div class='form-group'>
							<label for='cedula'>Cédula</label>
							<input type='text' class='form-control' name='cedula' placeholder='...' value='' autocomplete='off' onkeypress='return soloNumeros(event)' maxlength='10'>
						</div>
						<div class='form-group'>
							<label for='nombre'>Nombre</label>
							<input type='text' class='form-control' name='nombre' placeholder='...' value='' autocomplete='off' onkeypress='return soloLetras(event)' onblur='limpia()' id='miInput' maxlength='50'>
						</div>
						<div class='form-group'>
							<label for='apellido'>Apellido</label>
							<input type='text' class='form-control' name='apellido' placeholder='...' value='' autocomplete='off' onkeypress='return soloLetras(event)' onblur='limpia()' id='miInput' maxlength='50'>
						</div>
						<div class='form-group'>
							<label for='tipo'>Tipo</label>
							<select class='form-control' name='tipo' id='tipo'>
								<option value=''>...</option> 
								<option value='adm'>Administrador</option>
								<option value='enc'>Encargado</option>
							</select>
						</div>
						<div class='form-group'>
							<label for='nombre_usu'>Usuario</label>
							<input type='text' class='form-control' name='nombre_usu' placeholder='...' value='' autocomplete='off' id='miInput'>
						</div>
						<div class='form-group'>
							<label for='contrasena'>Contraseña</label>
							<input type='password' class='form-control' name='contrasena' placeholder='...' value='' autocomplete='off' onkeypress='return soloNumeros(event)' onblur='limpia()' id='contrasena' maxlength='12'>
							<label>        
						        <input type="checkbox" name="radio" id="VerPass" onClick="CambiaTipo(document.formulario);" /> 
						     </label>
						</div>
						<div class='form-group'>
							<label for='pw'>Confirmar Contraseña</label>
							<input type='password' class='form-control' name='pw' placeholder='...' value='' autocomplete='off'  onblur='limpia()' id='miInput' maxlength='75'>
								<label>        
          							<input type="checkbox" name="radio" id="VerPass" onClick="CambiaTipo(document.formulario);" /> 
      							</label>
						</div>
					</div>

					<div class='panel-footer'>
						<input type='submit' class='btn btn-primary save' name='guardar' value='Guardar'>
					</div>
				</form>
				</div>
			</div>
<form id="Formulario" name="Formulario" >  
<table>
<tr>
<td>
      <input class="entrada" name="PassNew" type="password" id="PassNew" value="" size="15" maxlength="50" title="Introduzca su nueva clave" /><i class='far fa-eye-slash toggle-password' id="ojo" onmousedown='Mostrar(document.Formulario); ojo();' onmouseup='Quitar(document.Formulario);'></i>
      <label>        
           <input type="checkbox" name="radio" id="VerPass" onClick="CambiaTipo(document.Formulario);" /> 
      </label>
</td>  
</tr>
</table>
</form>
<script type='text/javascript' src='../assets/js/jquery.min.js'></script>
<script type='text/javascript' src='../assets/js/all.js'></script>
<script>
        /*function CambiaTipo(Frm)
        {
            var Campo=Frm.contrasena;
            if(Campo.type=='password')
                Frm.contrasena.type='text';
            else    
                Frm.contrasena.type='password';
        }
        function Mostrar(Frm){
        	Frm.PassNew.type='text';
        }
        function Quitar(Frm){
        	Frm.PassNew.type='password';
        }*/

$(document).on('mousedown', '.toggle-password', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#PassNew");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
$(document).on('mouseup', '.toggle-password', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#PassNew");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});

</script>
		</body>
</html>