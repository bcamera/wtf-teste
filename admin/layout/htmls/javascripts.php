<!-- <script type="text/javascript" src="js/bootstrap.min.js"></script> -->
<!-- <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script> -->
<!-- <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script> -->

<!-- Reutiliza o arquivo de funções -->

<!-- <script type="text/javascript" src="layout/js/funcoes.js"></script> -->
<!-- <script src="http://code.jquery.com/jquery-1.8.2.js"></script> -->
<!-- <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script> -->
<!-- <script type="text/javascript" src="https://jquery-blog-js.googlecode.com/files/SetCase.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" /> -->
<!-- <script type="text/javascript" src="js/jquery.mask.min.js"></script> -->
<!-- <script type="text/javascript" src="js/jquery.validate.min.js"></script> -->
<!-- <script type="text/javascript" src="js/dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="js/lightbox-2.6.min.js"></script> -->

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" />



 <script type="text/javascript">
	$(document).ready(function()
	{
		//var table = $('#example').DataTable();
		var table = $('#example').dataTable
		({
			responsive: true,
			"oLanguage":
			{
				"sEmptyTable": "Nenhum registro encontrado",
				"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
				"sInfoFiltered": "(Filtrados de _MAX_ registros)",
				"sInfoPostFix": "",
				"sInfoThousands": ".",
				"sLengthMenu": "_MENU_ resultados por página",
				"sLoadingRecords": "Carregando...",
				"sProcessing": "Processando...",
				"sZeroRecords": "Nenhum registro encontrado",
				"sSearch": "Pesquisar",
				"oPaginate": {
					"sNext": "Próximo",
					"sPrevious": "Anterior",
					"sFirst": "Primeiro",
					"sLast": "Último"
				},
				"oAria": {
					"sSortAscending": ": Ordenar colunas de forma ascendente",
					"sSortDescending": ": Ordenar colunas de forma descendente"
				}
			},
			"order": [[ 0, "asc" ]],
	        buttons: ['print']
		});
		


		
		
	});

var orientation = '';
        var count = 0;
        $("#agendamentos.dataTable").find('thead tr:first-child th').each(function () {
            count++;
        });
        if (count > 6) {
            orientation = 'landscape';
        } else {
            orientation = 'portrait';
        }

		var table = $('#agendamentos').DataTable
    ({   
    	dom: 'Bfrtip',
        buttons: [
            ,{ extend: 'colvis', text: 'Selecionar Colunas',
            	columns: ':gt(0)' },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible thead th:not(.noExport)'
                }
            },
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                exportOptions: {
                    columns: ':visible thead th:not(.noExport)' 
                }
            },
            {
                extend: 'print', text: 'Imprimir',
                orientation: 'landscape',
                exportOptions: {
                    columns: ':visible thead th:not(.noExport)'
                }                
            }            
        ],
        "oLanguage":
        {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        "order": [[ 0, "desc" ]]
    });   

</script>
