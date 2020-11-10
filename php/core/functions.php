<?php
	require_once('functions/utils.php');
	require_once('functions/auth.php');



	
	


	function informacoes_status_tabela ($link, $ano_apresentacao) {

		$ano_apresentacao = ($ano_apresentacao != "todos") ? "year(data_cadastro) = $ano_apresentacao &&" : "";

		$query = "SELECT * FROM ( SELECT COUNT(id) AS total_cr FROM cadastrados WHERE $ano_apresentacao cota = 'cr') AS total_cr, 
		(SELECT COUNT(id) AS total_ac FROM cadastrados WHERE $ano_apresentacao cota = 'ac') AS total_ac, 
		(SELECT COUNT(id) AS total_cd FROM cadastrados WHERE $ano_apresentacao cota = 'cd') AS total_cd,
		(SELECT COUNT(id) AS total_fcm FROM cadastrados WHERE $ano_apresentacao cota = 'fcm') AS total_fcm,
		(SELECT COUNT(id) AS total_aprovados FROM cadastrados WHERE $ano_apresentacao status_aprovacao = 'aprovado') AS total_aprovados, 
		(SELECT COUNT(id) AS total_reprovados FROM cadastrados WHERE $ano_apresentacao status_aprovacao = 'reprovado') AS total_reprovados, 
		(SELECT COUNT(id) AS total_pendentes FROM cadastrados WHERE $ano_apresentacao status_aprovacao = 'pendente') AS total_pendentes, 
		(SELECT COUNT(id) AS total_ac_aprovados FROM cadastrados WHERE $ano_apresentacao cota = 'ac' && status_aprovacao = 'aprovado') AS total_ac_aprovados, 
		(SELECT COUNT(id) AS total_cr_aprovados FROM cadastrados WHERE $ano_apresentacao cota = 'cr' && status_aprovacao = 'aprovado') AS total_cr_aprovados, 
		(SELECT COUNT(id) AS total_cd_aprovados FROM cadastrados WHERE $ano_apresentacao cota = 'cd' && status_aprovacao = 'aprovado') AS total_cd_aprovados, 
		(SELECT COUNT(id) AS total_fcm_aprovados FROM cadastrados WHERE $ano_apresentacao cota = 'fcm' && status_aprovacao = 'aprovado') AS total_fcm_aprovados, 

		(SELECT COUNT(id) AS total_ac_reprovados FROM cadastrados WHERE $ano_apresentacao cor_raca != 'PRETO' && possui_deficiencia = 0 && status_aprovacao = 'reprovado') AS total_ac_reprovados, 
		(SELECT COUNT(id) AS total_cr_reprovados FROM cadastrados WHERE $ano_apresentacao cor_raca = 'PRETO' && status_aprovacao = 'reprovado') AS total_cr_reprovados, 
		(SELECT COUNT(id) AS total_cd_reprovados FROM cadastrados WHERE $ano_apresentacao possui_deficiencia != 0 && status_aprovacao = 'reprovado') AS total_cd_reprovados,
		(SELECT COUNT(id) AS total_fcm_reprovados FROM cadastrados WHERE $ano_apresentacao fcm = '1' && status_aprovacao = 'reprovado') AS total_fcm_reprovados, 

		-- (SELECT COUNT(id) AS total_ac_reprovados FROM cadastrados WHERE $ano_apresentacao cota = 'ac' && status_aprovacao = 'reprovado') AS total_ac_reprovados, 
		-- (SELECT COUNT(id) AS total_cr_reprovados FROM cadastrados WHERE $ano_apresentacao cota = 'cr' && status_aprovacao = 'reprovado') AS total_cr_reprovados, 
		-- (SELECT COUNT(id) AS total_cd_reprovados FROM cadastrados WHERE $ano_apresentacao cota = 'cd' && status_aprovacao = 'reprovado') AS total_cd_reprovados,
		-- (SELECT COUNT(id) AS total_fcm_reprovados FROM cadastrados WHERE $ano_apresentacao cota = 'fcm' && status_aprovacao = 'reprovado') AS total_fcm_reprovados, 

		(SELECT COUNT(id) AS total_ac_pendentes FROM cadastrados WHERE $ano_apresentacao cota != 'cr' && possui_deficiencia = 0 && status_aprovacao = 'pendente') AS total_ac_pendentes, 
		(SELECT COUNT(id) AS total_cr_pendentes FROM cadastrados WHERE $ano_apresentacao cota = 'cr' && status_aprovacao = 'pendente') AS total_cr_pendentes, 
		(SELECT COUNT(id) AS total_cd_pendentes FROM cadastrados WHERE $ano_apresentacao possui_deficiencia != 0 && status_aprovacao = 'pendente') AS total_cd_pendentes,
		(SELECT COUNT(id) AS total_fcm_pendentes FROM cadastrados WHERE $ano_apresentacao fcm = '1' && status_aprovacao = 'pendente') AS total_fcm_pendentes";
		


		$ggQuery = mysqli_query($link,$query);

		return mysqli_fetch_object($ggQuery);

	}

	
	