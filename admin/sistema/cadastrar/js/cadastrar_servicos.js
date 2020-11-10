<script>
	
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
		
		function validaCampoSelect( idCampo )
		{
			
			
		    if( $('#' + idCampo ).val() == null )
		    {
		    	
		        $('#' + idCampo ).parent().css('border', 'solid 1px red');
		        return false;
		    }
		    else
		    {
		    	
		        $('#' + idCampo ).parent().css('border', 'solid 1px green');
		        return true;
		    }
		}
		
		
		$('#pb_criar_gravar').click(function()
		{
			if
			( 
				! validaCampoVazio( 'descricao' ) || ! validaCampoVazio( 'nome' ) || ! validaCampoVazio( 'atendentes' ) || ! validaCampoVazio( 'periodo' ))
			{
				$('#pb_criar_mensagem_erro').show().html("Há campos obrigatórios não preenchidos.");
				return false;
			}
			else
			{	
				$('#pb_criar_mensagem_erro').hide();
				
				
				$('#pb_criar_formulario').submit();
			}
		});
	});

</script>