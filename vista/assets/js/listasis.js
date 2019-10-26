function listas(valor){

	if (valor == 1) {
		document.getElementById('semanal').style.display='none'
		document.getElementById('hoy').style.display='block'		
	}else{

		document.getElementById('semanal').style.display='block'
		document.getElementById('hoy').style.display='none'
	}


}