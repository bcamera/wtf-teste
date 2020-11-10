<script>
function validaCampoSelect( idCampo )
{
	if( $('#' + idCampo ).val() == "" )
	{
		$('#' + idCampo ).parent().css('border', 'solid 2px red');
		return false;
	}
	else
	{
		$('#' + idCampo ).parent().css('border', 'solid 1px green');
		return true;
	}
}
	$(document).ready(function()
	{
		
		
		function validaCampoVazio( id )
		{
			if ( $("#" + id).val() == "" )
			{
				$("#" + id).css("border", "solid 1px red");
				return false;
			}
			else
			{
				$('#' + id).css("border", "solid 1px #CCC");
				return true;
			}
		}
		
		
		
		$('#pb_editar_botao').click(function()
		{
			if
			( 
				! validaCampoVazio( 'descricao' ) || ! validaCampoVazio( 'nome' ))
			{
				$('#pb_editar_mensagem_erro').show().html("Há campos obrigatórios não preenchidos.");
				return false;
			}
			else
			{	
				
				$('#pb_editar_mensagem_erro').hide();

				$('#pb_editar_formulario').submit();
			}
		});
	});
</script>