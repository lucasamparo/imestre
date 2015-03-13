<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	$p = new Professor();
	$p->setIdProfessor($_SESSION['idProfessor']);
	$professor = $p->retornaProfessorPorId();
	$nome = explode(" ",$professor->getNome());
?>

<html>
<head>
<title>iMestre :: Início - Professor <?php echo $professor->getNome();?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
</head>
<body>
	<div class="row"><!-- Linha do header -->
		<?php include('header.php');?>
	</div>
	<div class="row"><!-- Linha do Menu -->
		<div class="large-12 columns">
			<?php include('menu.php')?>
		</div>
		<div class="large-12 columns">
			<hr>
		</div>
	</div>
	<div class="row"><!-- Linha do Content -->
		<div class="large-4 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-8 columns" style="border-left-style: solid; border-width: 1px;">
			<div class="row collapse">
				<div class="large-6 columns">
					&nbsp;
					<!-- futuro ad -->
				</div>
				<div class="large-6 columns">
					&nbsp;
					<!-- futuro ad -->
				</div>
			</div>
			<div class="row collapse">
				<div class="large-6 columns text-center">
					<h4>Próximas Avaliações</h4>
					<table class="large-12">
						<thead>
							<th>Data</th>
							<th>Turma</th>
						</thead>
						<tbody>
							<tr>
								<td>01/01/2015</td>
								<td>3º A</td>
							</tr>
							<tr>
								<td>05/01/2015</td>
								<td>1º A</td>
							</tr>							
						</tbody>
					</table>
				</div>
				<div class="large-6 columns text-center">
					<h4>Próximas Aulas</h4>
					<table class="large-12">
						<thead>
							<th>Data</th>
							<th>Turma</th>
							<th>Horário</th>
						</thead>
						<tbody>
							<tr>
								<td>01/01/2015</td>
								<td>3º A</td>
								<td>1 e 2</td>
							</tr>
							<tr>
								<td>01/01/2015</td>
								<td>1º A</td>
								<td>3 e 4</td>
							</tr>							
						</tbody>
					</table>
				</div>
				<div class="large-12 columns">
					<h4 class="text-center">Mensagens</h4>
					<table class="large-12">
						<thead>
							<th>#</th>
							<th>Assunto</th>
							<th>Para</th>
							<th>Data</th>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Reunião de Pais</td>
								<td>Pais do 3º Ano</td>
								<td>01/01/2015</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		<hr>			
		</div>
		<div class="large-12 columns">
			<?php include('footer.php')?>
		</div>		
	</div>
</body>
<script>
  $(document).foundation();
</script>
</html>