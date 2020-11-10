<script>
	
	$(document).ready(function()
	{

	    $('.confirmation').on('click', function () {
	        return confirm('Confirma a exclusão?');
	    });

	    $('.debloquear').on('click', function () {
	        return confirm('Confirma o desbloqueio?');
	    });

	    $('.bloquear').on('click', function () {
	        return confirm('Confirma o bloqueio?');
	    });	    	    
	});
</script>