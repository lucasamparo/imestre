<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_GET['id'])){
		$d = new Disciplina();
		$d->setIdDisciplina($_GET['id']);
		$disc = $d->retornaDisciplinaPorId();
		if(isset($_GET['e'])){
			$a = new Assunto();
			$a->setIdAssunto($_GET['e']);
			$a->deletarAssunto();
			header('Location: assuntos.php?id='.$_GET['id']);
		}		
		if(isset($_POST['nomeAssunto'])){
			$a = new Assunto();
			$a->setIdDisciplina($disc->getIdDisciplina());
			$a->setNomeAssunto($_POST['nomeAssunto']);
			$a->inserirAssunto();
		}
	} else {
		header('Location: disciplinas.php');
	}
?>
<html>
<head>
<title>iMestre :: Controle de Assuntos - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('cadDisciplina')">
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
			<h4 class="text-center">Controle de Assuntos - Disciplina "<?= $disc->getNomeDisciplina()?>"</h4>
			<form method="post">
				<fieldset>
					<legend>Novo Assunto</legend>
					<div class="large-9 columns">
						<input type="text" name="nomeAssunto" required>
					</div>
					<div class="large-1 columns">&nbsp;</div>
					<div class="large-2 columns">
						<input type="submit" name="submeter" value="Adicionar" class="button tiny">
					</div>
				</fieldset>
			</form>
			<form method="post">
				<fieldset>
					<legend>Assuntos Cadastrados</legend>
						<table class="large-12">
							<thead>
								<th width="90%">Nome</th>
								<th width="10%" class="text-center"><img src="img/deletar.png" width="25"></th>					
							</thead>
							<tbody>
								<?php 
									$a = new Assunto();
									$a->setIdDisciplina($disc->getIdDisciplina());
									$as = $a->retornaTodosAssuntosPorDisciplina();
									foreach($as as $a){
										echo '<tr>';
											echo '<td>'.$a->getNomeAssunto().'</td>';
											echo '<td class="text-center"><a href="?id='.$disc->getIdDisciplina().'&e='.$a->getIdAssunto().'"><img src="img/deletar.png" width="25"></a></td>';
										echo '</tr>';
									}
								?>
							</tbody>
						</table>
				</fieldset>
			</form>
			<form method="post" action="disciplinas.php" style="display: none;" id="formEd">
				<fieldset>
					<legend>Editar Disciplina</legend>
					<div class="large-9 columns">
						<input type="text" name="nomeDisciplinaEd" id="nomeDisciplinaEd">
						<input type="hidden" name="idDisciplina" id="idDisciplina">
					</div>
					<div class="large-1 columns">&nbsp;</div>
					<div class="large-2 columns">
						<input type="submit" name="submeterEd" value="Adicionar" class="button tiny">
					</div>
				</fieldset>
			</form>
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