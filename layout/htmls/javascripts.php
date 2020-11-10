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
			"order": [[ 0, "asc" ]]
		});
		


		
		
	});
</script>
