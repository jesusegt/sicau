$(document).ready(function() {
    $('#tabla').DataTable( {
    	"language": {
		    "decimal":        "",
		    "emptyTable":     "No hay datos disponibles",
		    "info":           "Mostrando _START_ a _END_ de _TOTAL_ de entradas",
		    "infoEmpty":      "Mostrando 0 a 0 de 0 de entradas",
		    "infoFiltered":   "(Filtrado de _MAX_ entradas)",
		    "infoPostFix":    "",
		    "thousands":      ",",
		    "lengthMenu":     "Mostrar _MENU_ entradas",
		    "loadingRecords": "Cargando...",
		    "processing":     "Procesando...",
		    "search":         "_INPUT_",
		    "searchPlaceholder": "Buscar",
		    "zeroRecords":    "No se encontraron registros coincidentes",
		    "paginate": {
		        "next":       ">",
		        "previous":   "<"
		    },
		    "aria": {
		        "sortAscending":  ": activate to sort column ascending",
		        "sortDescending": ": activate to sort column descending"
		    }
		},

		"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todas"] ],
		"pageLength": 10,
		"columnDefs": [ {
	    	"targets": "actions",
	    	"searchable": false,
	    	"orderable": false}
	    ],
	    "order": []
	    

    } );
});