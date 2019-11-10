		function seleccionado(){
		    var opt = $('#tipo_rep').val();
		    
		   // alert(opt);
		    if(opt=="" | opt=="1" | opt=="3"){
		        $('#perso').removeClass("mostrar").addClass("ocultar");
		        $('#perso2').removeClass("mostrar").addClass("ocultar");
		        $('#mess').removeClass("mostrar").addClass("ocultar");
		    }else{
		        if(opt=="2"){
		            $('#perso').removeClass("mostrar").addClass("ocultar");
		            $('#perso2').removeClass("mostrar").addClass("ocultar");
		            $('#mess')..removeClass("ocultar").addClass("mostrar");
		        }else{
		            $('#perso')..removeClass("ocultar").addClass("mostrar");
		            $('#perso2')..removeClass("ocultar").addClass("mostrar");
		            $('#mess').removeClass("mostrar").addClass("ocultar");
		        }
		    }
		}

function reporte(f){
	var tipo_rep = document.getElementById('tipo_rep');
	var fechaini = document.getElementByClassName('fechaini mostrar').value;
	var fechafin = document.getElementByClassName('fechafin mostrar').value;
	var mes = document.getElementByClassName('mes mostrar');

	if (tipo_rep.selectedIndex==false){
		alert('Debe seleccionar un Tipo de Periodo.');
		f.tipo_rep.focus();
		return (false);
	}

	if (!fechaini) {
		alert('Debe seleccionar una fecha inicial.');
		document.getElementByClassName('fechaini mostrar').focus();
		return (false)
	}

	if (!fechafin) {
		alert('Debe seleccionar una fecha final.');
		document.getElementByClassName('fechafin mostrar').focus();
		return (false)
	}

	if (mes.selectedIndex==false){
		alert('Debe seleccionar un Mes.');
		f.mes.focus();
		return (false);
	}

}