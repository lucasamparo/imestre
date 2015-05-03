<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['id'])){
		$idDisciplina = $_GET['id'];
		$d = new Disciplina();
		$d->setIdDisciplina($idDisciplina);
		$disc = $d->retornaDisciplinaPorId();
	}
?>
<html>
<head>
<title>iMestre :: Cadastro de Ementas - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
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
		<div class="large-2 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-10 columns" style="border-left-style: solid; border-width: 1px;">
			<h4 class="text-center">Cadastro de Ementas - Disciplina <?= $disc->getNomeDisciplina();?></h4>
			<fieldset>
				<legend>Ementas Já Cadastradas</legend>
				<table class="large-12">
					<thead>
						<th>Ano</th>
						<th>Itens</th>
						<th class="text-center"><img src="img/visualizar.png" width="20px"></th>
					</thead>
					<tbody>
						<?php 
							$ementas = $disc->getEmenta();
							if(count($ementas) > 0){
								foreach($ementas as $e){
									echo '<tr>';
										echo '<td>'.$e->getAno().'</td>';
										echo '<td>'.count($e->getItemEmenta()).'</td>';
										echo '<td class="text-center"><a href="verEmenta.php?id='.$e->getIdEmenta().'"><img src="img/visualizar.png" width="20px"></a></td>';
									echo '</tr>';
								}
							} else {
								echo '<tr>';
									echo '<td colspan="3">Nenhuma Ementa Cadastrada</td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
				<div class="row collapse">
					<div class="large-12 columns text-right">
						<a href="cadEmenta.php?id=<?= $disc->getIdDisciplina();?>" class="large-4 button">Nova Ementa</a>
					</div>
				</div>				
			</fieldset>
		</div>
	<hr>
	</div>
	<div class="large-12 columns">
			<?php include('footer.php')?>
	</div>	
</body>
<script>
  $(document).foundation();
</script>
</html>