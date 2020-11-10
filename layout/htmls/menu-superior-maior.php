<!-- main / large navbar -->

<nav class="navbar navbar-default navbar-fixed bootstrap-admin-navbar bootstrap-admin-navbar-under-small not-print" role="navigation" style="top: 0px; margin-bottom: 0px;">
<div class="container">
	
	<div class="printer navbar-header">
		<div class="col-xs-2">
			<button type="button" class="float-left navbar-toggle visible-xs-block"><a href="../../../admin/sistema/home/index.php"><span class="glyphicon glyphicon-home" style="color:black;"></span></a></button>
		</div>
		<div class="pull-right col-xs-2">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-navbar-collapse">
				<span class="sr-only"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
	</div>
	
	<div class="printer collapse navbar-collapse main-navbar-collapse">
		<div class="row">
		<ul class="nav navbar-nav" style="width: 100%;">
			<li class="hidden-md hidden-sm hidden-xs">
				<a href="../../../admin/sistema/home/index.php"><span class="glyphicon glyphicon-home"></a>
			</li>
<!-- 			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-hover="dropdown"><i></i>&nbsp;Cadastro<b class="caret"></b></a>
				<ul class="dropdown-menu">
					< <li><a href="../cadastrar/prefeitura.php">Prefeitura Bairro</a></li> 
					<li><a href="../cadastrar/cursos.php">Cursos</a></li>
					<li><a href="../cadastrar/vagas.php">Vagas</a></li>
					<li><a href="../cadastrar/instituicao.php">Instituição</a></li>
					< <li><a href="../cadastrar/turno.php">Turno</a></li> 
					< <li><a href="../recadastramento/index.php">Recadastramento</a></li> 
				</ul>
			</li>	 -->		
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-hover="dropdown"><i class="glyphicon glyphicon-calendar"></i>&nbsp;Consultas<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="../cadastrados/listarcadastrados.php">Listar Agendamentos</a></li>
					<!-- <li><a href="../cadastrados/listarporbairro.php">Relatório por bairro</a></li> -->
					<!-- <li><a href="../recadastramento/index.php">Recadastramento</a></li> -->
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-hover="dropdown">Cadastros<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="../cadastrar/ramos.php">Ramos de Atividades</a></li>
					<li><a href="../cadastrar/orgaos.php">Parceiros</a></li>
					<li><a href="../cadastrar/servicos.php">Serviços</a></li>
					<li><a href="../cadastrar/orgao_servicos.php">Serviços dos Parceiros</a></li>
					<li><a href="../cadastrar/periodo.php">Perído do Agendamento</a></li>					
				</ul>
			</li>			
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-hover="dropdown">Usuários<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="../usuarios/index.php">Ver Todos</a></li>
					<li><a href="../usuarios/cadastrar.php">Cadastrar</a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-hover="dropdown">Enviar Email<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="../email/index.php">Email Lembrete</a></li>
				</ul>
			</li>												
			<li class="dropdown pull-right-md">
				<a href="#" class="dropdown-toggle" data-hover="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<span class="fa fa-user" aria-hidden="true"></span><span> <?php  echo strtoupper( $_SESSION['nome'] ); ?></span><span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="../../../admin/php/logout.php">Sair</a></li>
				</ul>
			</li>	
		</ul>
		</div>

	</div><!-- /.navbar-collapse -->
</div>
</nav>

