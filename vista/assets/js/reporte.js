function seleccionado(){
		    var opt = $('#tipo_rep').val();
		    
		   // alert(opt);
		    if(opt=="" | opt=="1" | opt=="3"){
		        $('#perso').removeClass("mostrar").addClass("ocultar");
		        $('#perso2').removeClass("mostrar").addClass("ocultar");
		        $('#mess').removeClass("mostrar").addClass("ocultar");
		        $('#form').attr("onsubmit", "return validarreporte(this)");
		    }else{
		        if(opt=="2"){
		            $('#perso').removeClass("mostrar").addClass("ocultar");
		            $('#perso2').removeClass("mostrar").addClass("ocultar");
		            $('#mess').removeClass("ocultar").addClass("mostrar");
		            $('#form').attr("onsubmit", "return validarreportemes(this)");
		        }else{
		            $('#perso').removeClass("ocultar").addClass("mostrar");
		            $('#perso2').removeClass("ocultar").addClass("mostrar");
		            $('#mess').removeClass("mostrar").addClass("ocultar");
		            $('#form').attr("onsubmit", "return validarreporteperso(this)");
		        }
		    }
		}

function validarreporte(f){
	var reporte = document.getElementById('tipo_rep');

	if (reporte.selectedIndex==false) {
		alert ('Debe seleccionar un Periodo para el Reporte.');
		f.reporte.focus();
		return (false);
				}
			}
function validarreporteperso(f){

	var fechaini = f.fechaini.value;
	var fechafin = f.fechafin.value;


	if (!fechaini) {
		alert('Debe indicar una fecha inicial.');
		f.fechaini.focus();
		return (false);
	}
			
	if (!fechafin) {
		alert('Debe indicar una fecha final.');
		f.fechafin.focus();
		return (false);
	}

	if (fechaini>fechafin){
		alert('La Fecha Inicial debe ser menor a la Fecha Final.');
		f.fechaini.focus();
		return (false);
	}
}

function validarreportemes(f){

	var mes = document.getElementById('mes');

	if (mes.selectedIndex==false){
		alert ('Debe seleccionar un mes.');
		f.mes.focus();
		return (false);
	}
}