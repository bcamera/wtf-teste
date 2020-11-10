<?php

    // funcoes PHP que estavam no cadastro de pessoas fisica e juridica, e atleta
    function generatePassword($qtyCaraceters = 60){

	    //Letras minúsculas embaralhadas
	    $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
	 
	    //Letras maiúsculas embaralhadas
	    $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
	 
	    //Números aleatórios
	    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
	    $numbers .= 1234567890;
	 
	    //Caracteres Especiais
	    $specialCharacters = str_shuffle('!@#$%*-');
	 
	    //Junta tudo
	    $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;
	 
	    //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
	    $password = substr(str_shuffle($characters), 0, $qtyCaraceters);
	 
	    //Retorna a senha
	    return $password;
    }
    
    function criaPasta($conn_id, $caminhoFinal){
		// dd(file_exists(ROOTPATH.$caminhoFinal));
		if (!file_exists(ROOTPATH.$caminhoFinal)){
			if (!(ftp_mkdir($conn_id, $caminhoFinal))){
			       return false;
			}
			return true;
        }
        else {
        	return true;
        }
    }
    
    function uploadFile($file , $tempName , $caminhoFinal , $ran , $tipo , $conn_id, $file_type){
		$allowed_filetypes = array('pdf', 'jpeg', 'jpg', 'png', 'vnd.ms-excel', 'vnd.ms-excel','vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// $allowed_filetypes = array('.pdf', '.jpeg', '.jpg');
		$max_filesize = 1024*100*30;
        /*var_dump($file_type);
        var_dump($allowed_filetypes);  */ 

		//echo($caminhoFinal);
		//if (!(is_dir("../../uploads/".$ran))){
		
		// define o destino a ser gravada a imagem ( caminho + pasta criada )
		if ( ! (ftp_chdir($conn_id, "/".$caminhoFinal))){
				ftp_chdir($conn_id, "/".$caminhoFinal);
		}

		if(($file == "") || ($tempName == "" ) ) {
			return false;
		}

						
		$ext = strtolower(substr($file, strpos($file,'.'), strlen($file)-1)); 
		if(!check_format($file_type, $allowed_filetypes)) {
            die();
			echo "<script>alert('Falha ao realizar o cadastro, arquivo em formato não permitido.');location.href='../../index.php'</script>";
			die();
		}

		if(filesize($tempName) > $max_filesize) {
			echo "<script>alert('Falha ao realizar o cadastro, arquivos acima do tamanho permitido.');location.href='../../index.php'</script>";
			die();
		}
		// echo($caminhoFinal);
		// $arquivos = scandir($caminhoFinal);
		//$arquivos = scandir($caminhoFinal);
		// $contador = substr_count ( implode( $arquivos ), $tipo )+1;
		$contents = count(ftp_nlist($conn_id, $caminhoFinal));
		$contents = $contents +1;
		// novo nome do arquivo
		// echo $contents;
		// $novoNome = $tipo.'_'.$ext ;
		$novoNome = $tipo;
		
		$enderecoGravacao = $novoNome;

		return ftp_put($conn_id, $novoNome , $tempName , FTP_BINARY) ? $enderecoGravacao : false;   
    }
    
    function fileError($file) {
        if($file['error'] != 0)
            return "";
        return true;
    }

    function retornaTipo($string){
        $add = '.';	
        $flag = 1;	
        for($tam = 0; $tam < strlen($string); $tam++){
            if($flag == 0)
                $add .= $string[$tam];
            if($string[$tam] == '/')
                $flag = 0;
        }
        return $add;
    }

    // ----------------------------------------------------------------------------------------------

    //Mostra as variáveis na tela e interrompe a aplicação
    function dd(){
        $arguments = func_get_args();

        foreach ($arguments as $key => $argument) {
            var_dump(json_encode($argument));
        }

        die();
    }
    
    function mssql_real_escape_string($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        
        return str_replace("'", "''", $str);
    }


    function sanitize3($link, $dado ){
        return (utf8_decode(trim(preg_replace('/\s+/', ' ',(strip_tags(mysqli_real_escape_string($link, $dado )))))));
    }

    function mssql_sanitize($data)
    {
        return strip_tags(mssql_real_escape_string($data));
    }
    function sanitize2( $link, $dado )
    {
        //return strtoupper(utf8_decode(trim(preg_replace('/\s+/', ' ',(strip_tags(mysql_real_escape_string( $dado )))))));
        return strtoupper(trim(preg_replace('/\s+/', ' ',(strip_tags(mysqli_real_escape_string( $link, $dado ))))));
    }

    function sanitize( $link, $param_name )
    {
        /*if ( isset($_GET[$param_name]) ) return utf8_decode(trim(preg_replace('/\s+/', ' ',(strip_tags(mysql_real_escape_string($_GET[$param_name]))))));
        else if ( isset($_POST[$param_name]) ) return utf8_decode(trim(preg_replace('/\s+/', ' ',(strip_tags(mysql_real_escape_string($_POST[$param_name]))))));
        else return null;*/
        if ( isset($_GET[$param_name]) ) return trim(preg_replace('/\s+/', ' ',(strip_tags(mysqli_real_escape_string($link, $_GET[$param_name])))));
        else if ( isset($_POST[$param_name]) ) return trim(preg_replace('/\s+/', ' ',(strip_tags(mysqli_real_escape_string($link, $_POST[$param_name])))));
        else return null;
    }

    function generateRandomString($size)
    {
        if ( $size % 2 != 0 ) throw new Exception("O parametro da funcao generateRandomString deve ser um numero par", 1);

        $size   = $size / 2;
        $bytes  = openssl_random_pseudo_bytes( $size );
        $random = bin2hex( $bytes );

        return $random;
    }


    function limpar_utf8($link, $dado)
    {
        return mysqli_escape_string($link,  trim( utf8_decode( $dado)  ) );
    }

    function dump( $dado )
    {
        echo '<pre>'; print_r( $dado ); echo '</pre>';
    }

    function sanitize_array( $array )
    {
        if ( !isset($_POST[$array])) return false;
        
        $resposta=$_POST[$array];


        if( ! is_array( $resposta )  ) return false;

        foreach($resposta as $key=>$value )
        {
            //echo $value;
            $resposta[$key] = sanitize2( $value );
        }
         
        return $resposta;
    }

    function array_has_empty_item( $array )
    {
        if( ! is_array( $array ) ) return true; //

        foreach( $array as $key => $value )
        {
            if ( empty ( $array[$key] ) ) return true;
        }

        return false;
    }

    function all_to_utf8($array)
    {
        if( ! is_array( $array ) ) return false;

        foreach( $array as $key => $value )
        {
            $array[$key] = utf8_decode( $array[$key] );
        }

        return $array;
    }


    function checarParaData ( $param){
        return ($param == '1' ) ? 'CURRENT_TIMESTAMP' : NULL;
    }


    function criarArrayDataLancamento( $array )
    {
        if( ! is_array( $array ) ) return false;

        foreach( $array as $key => $value )
        {
            $array[$key] = checarParaData( $array[$key] );
        }

        return $array;
    }


    function criarArrayDataParaBanco( $array )
    {
        if( ! is_array( $array ) ) return false;

        foreach( $array as $key => $value )
        {
            $array[$key] = dataParaBanco( $array[$key] );
        }

        return $array;
    }



    function criarArrayDataParaBr( $array )
    {
        if( ! is_array( $array ) ) return false;

        foreach( $array as $key => $value )
        {
            $array[$key] = dataParaBr( $array[$key] );
        }

        return $array;
    }


    function checarExistente ( $link,  $tabela ,$complemento  ){
        $queryBusca = "SELECT count(*) FROM ".$tabela." ".$complemento;
        //mysql_select_db('agentedaeducacao');
        $rsBusca = mysqli_query($link, $queryBusca);
        @$contadorBusca = mysqli_fetch_row($rsBusca);
        return $contadorBusca[0];
    }


    function checked ( $variavel ) {
        switch ( $variavel ) {
                case 0:
                    $checked = "unchecked";
                    break;
                case 1:
                    $checked = "checked";
                    break;
            }
        return $checked;
    }

    function rChecked ( $variavel ) {
        switch ( $variavel ) {
                case 0:
                    $checked = "checked";
                    break;
                case 1:
                    $checked = "unchecked";
                    break;
            }
        return $checked;
    }

    function checkNull ( $param_name )
    {
        if ( ! empty($param_name) ) return $param_name;
        else return 0;
    }


    function dataParaBanco( $data ){
        if ($data == '' )
            return null;
        $date = date_create_from_format('d/m/Y', $data);
        return date_format($date, 'Y-m-d');
    }

    function dataParaBanco2( $data ){
        if ($data == '' )
            return null;
        $date = date_create_from_format('d/m/Y H:i:s', $data);
        return date_format($date, 'Y-m-d H:i:s');
    }
    
    function dataParaBanco3( $data ){
        if ($data == '' )
            return null; 
        $data = str_replace('T', ' ', $data);
        $data .=":00";
        return $data;
    }

    function dataParaBr( $data ){
        if ($data == '' )
            return null;
        $date = date_create_from_format('Y-m-d', substr($data , 0 , 10));
        return date_format($date, 'd/m/Y');
    }
    function dataHoraParaBr( $data ){
        if ($data == '' )
            return null;
        $date = date_create_from_format('Y-m-d H:i:s', $data );
        return date_format($date, 'd/m/Y H:i:s');
    }


    function formatarInt ( $int){
        if( $int == "" )
            return 0;
        if ( intval($int) > 10 )
            return 10;
        else
            return intval($int);
    }


    // Função: Realizar uma consulta no banco ( ANTIGO ) 
    // function consultar($link, $tabela , $where ) {
    //     $resultQueryConsultar = mysqli_query($link, "SELECT * FROM ".$tabela." WHERE ".$onde);
    //     $resultado = 0;

    //     while ( $rowResultConsultar = mysqli_fetch_array($resultQueryConsultar) ){
    //         $resultado = $rowResultConsultar[$campo];
    //     }
    //     $resultado = utf8_encode($resultado);
    //     return $resultado;
    // }

    // Função: Realizar uma consulta no banco
    function consultar( $link , $campo , $tabela , $onde , $igual ) {
        $resultQueryConsultar = mysqli_query( $link , "SELECT ".$campo." FROM ".$tabela." WHERE ".$onde." = '$igual' ");
        $resultado = 0;

        while ( $rowResultConsultar = mysqli_fetch_array($resultQueryConsultar) ){
            $resultado = $rowResultConsultar[$campo];
        }
        return $resultado;
    }


    function gerarSelect($link, $tabela, $name, $selecionado = null){
        $select =  mysqli_query($link, "SELECT * FROM ".$tabela);

        $id = "id";
        $desc = "descricao";

        $resultado = '<select class="form-control" id="'.$name.'" name="'.$name.'" required>';
        $resultado .=   '<option value="">Selecione o Tipo de Deficiência...</option>';
        while ( $item = mysqli_fetch_array($select) ){
            $resultado .= '<option ';
            if($selecionado == $item[$id])
                $resultado .= 'selected';
            $resultado .= ' value="'.$item[$id].'">'.$item[$desc].'</option>';
        }
        $resultado .= '</select>';
        return $resultado;
    }


    function gerarSelect2($link, $tabela , $campo, $selecionado = null ) {
        $select = mysqli_query($link, "SELECT * FROM ".$tabela);
        $resultado = 0;

        $resultado =  '<select class="form-control" id="'.$tabela.'" name="'.$tabela.'">';
        $resultado .=   '<option value="">Selecione...</option>';

        while ( $item = mysqli_fetch_array($select) ){
            $resultado .= '<option ';
            if($selecionado == $item['id'])
                $resultado .= 'selected';
           $resultado .= ' value="'.$item['id'].'">'.$item[$campo].'</option>';
        }
        $resultado .= '</select>';
        return $resultado;
    }


    function exibirBotaoPorData( $dataCriado , $dataDiferenca){
        $dataEncerramento = strtotime($dataCriado.'+'.$dataDiferenca.' day');
        $dataHoje = strtotime(date('Y-m-d'));
        $diferenca = $dataHoje - $dataEncerramento;
        // if (($diferenca>0)&&($_SESSION['nivel'] != 1))

        if ($diferenca>0)
            echo 'style="display:none;"';
    }

    function exibirBotaoPorMes($dataCriado, $diaLimite){

        $mesCriado = substr($dataCriado, 5, 2);
        $diaCriado = substr($dataCriado, 8, 2);
        $anoCriado = substr($dataCriado, 0, 4);

        $diaAtual = date('d');
        $mesAtual = date('m');
        $anoAtual = date('Y');



        if( ($anoAtual == $anoCriado) && ($mesAtual > $mesCriado) && ($diaCriado < $diaLimite ) ){
            echo 'style="display:none;"';
        }

        if( ($anoAtual == $anoCriado) && ($mesAtual == $mesCriado) && ($diaCriado < $diaLimite ) ){
            echo 'style="display:none;"';
        }

    }



    // Função: exibirBotaoOm
    // Objetivo: Não exibir registros que são do próximo mês, após passarmos a data Limite
    function exibirBotaoOm($dataCriado, $tmpLimte){

        $mesCriado = substr($dataCriado, 5, 2);
        $diaCriado = substr($dataCriado, 8, 2);
        $anoCriado = substr($dataCriado, 0, 4);

        $diaAtual = date('d');
        $mesAtual = date('m');
        $anoAtual = date('y');

        $proxMes = $mesAtual + 1;

        $dataAtual = date('Y-m-d');
        $dataCriado = $anoCriado . '-' . $mesCriado . '-' . $diaCriado;


        // não é possivel editar depois da data do registro
        if( (strtotime($dataAtual)) > (strtotime($dataCriado)) ){
            echo 'style="display:none"';
        }

        // se o DIA ATUAL for maior que o DIA LIMITE , E o PROX MES for igual ao MES DO REGISTRO
        if( ($diaAtual > $tmpLimte ) && ( $proxMes == $mesCriado) ){
            echo 'style="display:none"';
        }

    }


    function exibirAlerta($param){
        if($param){
            echo "<div class='alert alert-warning'>
                    <h4>Atenção:</h4>
                    Você tem até <b>2 dias</b> para alterar este formulário depois de enviado
                    </div>";
        }

        else{
            echo "<div class='alert alert-warning'>
                    <h4>Atenção:</h4>
                    Você só pode alterar este formulário até o <b>dia 30</b> deste mês
                    </div>";
        }

    }


	function exibirBotaoPorPerm($action) {
		$nivel = $_SESSION['nivel_1'];
		$rotinaAudit = $_SESSION['rotina'];

		$queryPermissaoAudit = " WHERE DsIdeRotina = '$rotinaAudit' AND Niveis_CdIdeNivel = '$nivel' AND ".$action." = 1";
		//echo 'queryPermissaoAudit: '.$queryPermissaoAudit.'<br>';
		$contadorPermissaoAudit = checarExistente( "direitos" , $queryPermissaoAudit);
		//echo 'contador: '.$contadorPermissaoAudit.'<br>';
        //echo $contadorPermissaoAudit;
		if($contadorPermissaoAudit == 0){
			echo "style='display:none'";
		}


	}
		
	function dias_uteis($datainicial){
		$datafinal=date('Y-m-d h:i:s');
		if (!isset($datainicial)) return false;
		if (!isset($datafinal)) $datafinal=time();

		$segundos_datainicial = strtotime(preg_replace("#(\d{2})/(\d{2})/(\d{4})#","$3/$2/$1",$datainicial));
		$segundos_datafinal = strtotime(preg_replace("#(\d{2})/(\d{2})/(\d{4})#","$3/$2/$1",$datafinal));
		$dias = abs(floor(floor(($segundos_datafinal-$segundos_datainicial)/3600)/24 ) );
		$uteis=0;
		for($i=1;$i<=$dias;$i++){
		$diai = $segundos_datainicial+($i*3600*24);
		$w = date('w',$diai);
		if ($w==0){
		//echo date('d/m/Y',$diai)." é Domingo<br />";
		}elseif($w==6){
		//echo date('d/m/Y',$diai)." é Sábado<br />";
		}else{
		//echo date('d/m/Y',$diai)." é dia útil<br />";
		$uteis++;
		}
		}
		return $uteis;
	}

    function pegar_coordenadas($logradouro, $bairro){

        $logradouro= str_replace('ª', 'A', $logradouro);
        $address = $logradouro.','.$bairro.', salvador, bahia, brasil';

        $request_url = 'https://maps.googleapis.com/maps/api/geocode/xml?address='.urlencode(utf8_encode($address));
        //https://maps.googleapis.com/maps/api/geocode/xml?address='Praça Sete de Setembro - Belo Horizonte Minas Gerais'&key='AIzaSyBSvswTqs7fw7-uYutb8SOy5RZTrBeX4Ec
        //echo $request_url."</br>";

        $xml = simplexml_load_file($request_url) or die("url not loading");
        //echo '<pre>', var_dump($xml), '</pre>';
        $status = $xml->status;
        if (strcmp($status, "OK") == 0)
        { 

            $lat = $xml->result->geometry->location->lat;
            $lng = $xml->result->geometry->location->lng;

        }else{
            
            $lat = '';
            $lng = '';

        }
        //echo $lat.", ".$lng;
        return $lat.":".$lng;
    }

	
	function switchBD ( $link, $tipo, $tabela, $campoExtra = null ){
		$retorno = '';
        if($campoExtra == 'null')
            $campoExtra = "Sem Descrição"; 
		
        $select = "SELECT * FROM ".$tabela;
        $ggQuery = mysqli_query($link, $select);

        while ( $gg = mysqli_fetch_object($ggQuery) ) {
           if($tipo == $gg->id){
                if($tipo == 1)
                    return $gg->descricao .' - '.$campoExtra;
                else
                    return $gg->descricao;
           }
        }
		
	}

    function soNumero($str) {
        return preg_replace("/[^0-9]/", "", $str);
    }

    function ValorMoedaParaBancoDouble($valor) {
       $verificaPonto = ".";
       if(strpos("[".$valor."]", "$verificaPonto")):
           $valor = str_replace('.','', $valor);
           $valor = str_replace(',','.', $valor);
           else:
             $valor = str_replace(',','.', $valor);   
       endif;

       return $valor;
    }
    function BancoDobleParaReais($numero) {
        
        return number_format($numero, 2, ',', '.');
        
    }
    
    function idade($data){
        if(!$data)
            return 0;
        list($ano, $mes, $dia) = explode('/', $data);

        $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
        $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

        return $idade;
    }

    
//file uploads

function upload_file(array $file, $dir, $name){

        
    $fileType = explode('/', $file['type']);
    
    // dd($fileType);
    $target_file = $dir . '/' . $name . '.' . $fileType[1];
    $tmp_name = $file["tmp_name"];

    if (!check_file_exists($file["tmp_name"]))
        return 0;

    // dd($tmp_name, $target_file);
    if (move_uploaded_file($tmp_name, $target_file)) 
        return 1;
    
    return 0;
}


// Allow certain file formats
function check_file_formats(array $file, array $formats) {
    $imageFileType = explode('/', $file['type'])[1];

    // $imageFileType = strtolower(pathinfo($file['tmp_name'],PATHINFO_EXTENSION));
    foreach ($formats as $key => $value) {
        if ($imageFileType == $value)
            return 1;
    }

    return 0;
}

// Allow certain file formats
function check_format(string $format, array $formats) {
    $imageFileType = explode('/', $format)[1];

    // $imageFileType = strtolower(pathinfo($file['tmp_name'],PATHINFO_EXTENSION));
    foreach ($formats as $key => $value) {
        if ($imageFileType == $value)
            return 1;
    }

    return 0;
}

	
function new_sanitize ( $item ) {

	if(is_string($item))
		$item = trim($item);//so we are sure it is whitespace free at both ends

	//preserve newline for textarea answers
	$item=str_replace("\n","[NEWLINE]",$item); 

	//sanitise string
	$item = filter_var($item, FILTER_SANITIZE_STRING | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);

	//now replace the placeholder with the original newline
	$item = str_replace("[NEWLINE]","\n",$item);

	return $item;
	
}

    


    
