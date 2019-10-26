function validar (f){

			//////////////////// VARIABLES ////////////////////

				var nombre = f.nombre.value;
				var apellido = f.apellido.value;
				var cedula = f.cedula.value;
                var motivo = f.motivo.value;
				var tipo = document.getElementById('tipo');
				var lugar = document.getElementById('lugar');
                var cliente1 = '27166703';
                var cliente2 = '27529516';

			//////////////////// PROCESOS ////////////////////

            //////////////////// CEDULA ////////////////////

                if(cedula == cliente1 | cedula == cliente2){
                if(cedula == cliente1){
                    f.nombre.value = 'Heleana';
                    f.apellido.value = 'Hammad';
                }
                if(cedula == cliente2){
                    f.nombre.value = 'Jesús';
                    f.apellido.value = 'González';
                }
                }else{
                    f.nombre.value = '';
                    f.apellido.value = '';
                    f.nombre.focus();
                    return false;
                }

                if (!cedula) {
                    alert('Ingrese una Cédula');
                    f.cedula.focus();
                    return false;
                }

                if ( isNaN(cedula) ) {
                    alert('Escriba solo numeros en el campo de la Cédula');
                    f.cedula.focus();
                    return false;
                }

                if (cedula.length < 6) {
                    alert('Faltan digitos a la Cédula');
                    f.cedula.focus();
                    return false;
                }

			//////////////////// NOMBRE ////////////////////

				if (!nombre) {
					alert('Ingrese un Nombre');
					f.nombre.focus();
					return false;
				}

			//////////////////// APELLIDO ////////////////////

				if (!apellido) {
					alert('Ingrese un Apellido');
					f.apellido.focus();
					return false;
				}


            //////////////////// MOTIVO ////////////////////

                if (!motivo) {
                    alert('Ingrese un Motivo');
                    f.motivo.focus();
                    return false;
                }

			//////////////////// TIPO ////////////////////

				if (tipo.selectedIndex==false){
					alert('Debe seleccionar un Tipo');
					f.tipo.focus();
					return (false);
				}

			//////////////////// LUGAR ////////////////////

				if (lugar.selectedIndex==false){
					alert('Debe seleccionar un Area');
					f.lugar.focus();
					return (false);
				}


                alert('Solicitud Registrada');
                return 0;


}

function cargarlugar2(valor)
{
    /*
     * Este array contiene los valores del segundo select
     * Los valores del mismo son:
     *  - hace referencia al value del primer select. Es para saber que valores
     *  mostrar una vez se haya seleccionado una opcion del primer select
     *  - value que se asignara
     *  - texto que se asignara
     */
    var arrayValores=new Array(
        new Array(1,1,'A'),
        new Array(1,2,'B'),
        new Array(1,3,'C'),
        new Array(2,1,'Principales'),
        new Array(2,2,'Secundarias'),
        new Array(3,1,'Administracion'),
        new Array(3,2,'Audiologia'),
        new Array(3,3,'Enfermeria'),
        new Array(3,4,'Informatica')        
    );
    if(valor==0 | valor==2 | valor==3)
    {
        // desactivamos el segundo select
        document.getElementById('lugar2').style.display='none';
        document.getElementById('lugar3').style.display='none';
        if (valor ==2 | valor ==3) {
        // eliminamos todos los posibles valores que contenga el select2
        document.getElementById('lugar4').options.length=0;
 
        // añadimos los nuevos valores al select2
        document.getElementById('lugar4').options[0]=new Option('...');
        for(i=0;i<arrayValores.length;i++)
        {
            // unicamente añadimos las opciones que pertenecen al id seleccionado
            // del primer select
            if(arrayValores[i][0]==valor)
            {
                document.getElementById('lugar4').options[document.getElementById('lugar4').options.length]=new Option(arrayValores[i][2], arrayValores[i][1]);
            }
        }
 
        // habilitamos el select
        document.getElementById('lugar4').style.display='inline';
        }else{
        document.getElementById('lugar4').style.display='none';
        }
    }else{


    	document.getElementById('lugar4').style.display='none';
        // eliminamos todos los posibles valores que contenga el select2
        document.getElementById('lugar2').options.length=0;
 
        // añadimos los nuevos valores al select2
        document.getElementById('lugar2').options[0]=new Option('...');
        for(i=0;i<arrayValores.length;i++)
        {
            // unicamente añadimos las opciones que pertenecen al id seleccionado
            // del primer select
            if(arrayValores[i][0]==valor)
            {
                document.getElementById('lugar2').options[document.getElementById('lugar2').options.length]=new Option(arrayValores[i][2], arrayValores[i][1]);
            }
        }
 
        // habilitamos el select
        document.getElementById('lugar2').style.display='inline';
    }
}

function cargarlugar3(valor)
{
    
    var arrayValores=new Array(
        new Array(1,1,'01'),
        new Array(1,2,'02'),
        new Array(1,3,'03'),
        new Array(1,4,'04'),
        new Array(1,5,'05'),
        new Array(2,1,'01'),
        new Array(2,2,'02'),
        new Array(2,3,'031'),
        new Array(2,4,'04'),
        new Array(2,5,'05'),
        new Array(3,1,'01'),
        new Array(3,2,'02'),
        new Array(3,3,'03'),
        new Array(3,4,'041'),
        new Array(3,5,'05')

    );
    if(valor==0)
    {
        document.getElementById('lugar3').style.display='none';
    }else{

        document.getElementById('lugar3').options.length=0;
 
        document.getElementById('lugar3').options[0]=new Option('...', '0');
        for(i=0;i<arrayValores.length;i++)
        {

            if(arrayValores[i][0]==valor)
            {
                document.getElementById('lugar3').options[document.getElementById('lugar3').options.length]=new Option(arrayValores[i][2], arrayValores[i][1]);
            }
        }
 
        document.getElementById('lugar3').style.display='inline';
    }

}
