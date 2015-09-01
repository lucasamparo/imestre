<?php
	require_once('../models/bootstrap.php');
	session_start();
	$mensagem = "";
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['peso'])){
		$a = new Avaliacao();
		$a->setIdTurma($_POST['turma']);
		$a->setPeso($_POST['peso']);
		$a->setDataAvaliacao($_POST['data']);
		$a->inserirAvaliacao();
		if(!is_null($a->getIdAvaliacao())){
			$mensagem = "Avaliação Inserida com sucesso!";
		}
	}
?>
<html>
<head>
<title>iMestre :: Currículo - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('cadAvaliacao')">
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
			<form method="post" action="cadAvaliacao.php">
				<h4 class="text-center">Cadastro de Avaliação</h4>
				<div id="retorno"><?= $mensagem?></div>
				<fieldset>
					<legend>Nova Avaliação</legend>
					<div class="large-4 columns">
						<label>Turma:</label>
							<select name="turma">
								<?php 
								$p = new Professor();
								$p->setIdProfessor($_SESSION['idProfessor']);
								$p = $p->retornaProfessorPorId();
								$i = $p->getInstituicao();
								$turmas = null;
								foreach($i as $i1){
									if(count($i1->getTurma()) != 0){
										$turmas[] = $i1->getTurma();
									}								
								}
								if(count($turmas) == 0){
									echo '<option value="0">Nenhuma Turma Cadastrada</option>';
								} else {
									foreach($turmas as $t1){
										foreach($t1 as $t){
											echo '<option value="'.$t->getIdTurma().'">'.$t->getNomeTurma().'</option>';
										}										
									}	
								}
								?>
							</select>
					</div>
					<div class="large-4 columns">
						<label>Peso:</label>
							<input type="number" name="peso">
					</div>
					<div class="large-4 columns">
						<label>Data:</label>
							<input type="date" name="data">
					</div>
					<div class="large-12 columns text-right">
						<input type="submit" value="Salvar" class="large-4 button">
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