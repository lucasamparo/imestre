<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['nomeTurma'])){
		$turma = new Turma();
		$turma->setIdInstituicao($_POST['instituicao']);
		$turma->setIdDisciplina($_POST['disciplina']);
		$turma->setNomeTurma($_POST['nomeTurma']);
		$turma->setPeriodo($_POST['periodo']);
		$turma->setTurno($_POST['turno']);
		$turma->setCargaHoraria($_POST['cargaHoraria']);
		$turma->inserirTurma();
	}
?>
<html>
<head>
<title>iMestre :: Cadastro de Turmas - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
</head>
<body onload="arrumaMenu('cadTurma')">
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
			<h4 class="text-center">Cadastro de Turmas</h4>
			<form method="post" action="turmas.php">
				<fieldset>
					<legend>Inserir Nova Turma</legend>
					<div class="large-3 columns">
						<label>Instituição</label>
						<select name="instituicao" required>
							<option value="0">>Selecione<</option>
							<?php 
								$i = new Instituicao();
								$instituicoes = $i->retornaTodasInstituicoes();
								foreach($instituicoes as $i){
									echo '<option value="'.$i->getIdInstituicao().'">'.$i->getNomeInstituicao().'</option>';
								}
							?>
						</select>
					</div>
					<div class="large-3 columns">
						<label>Disciplina:</label>
						<select name="disciplina" required>
							<option value="0">>Selecione<</option>
							<?php 
								$d = new Disciplina();
								$disciplinas = $d->retornaTodasDisciplinas();
								foreach($disciplinas as $d){
									echo '<option value="'.$d->getIdDisciplina().'">'.$d->getNomeDisciplina().'</option>';
								}
							?>
						</select>
					</div>
					<div class="large-3 columns">
						<label>Período:</label>
						<select name="periodo" required>
							<option value="0">1º Semestre</option>
							<option value="1">2º Semestre</option>
							<option value="2">Anual</option>
						</select>
					</div>
					<div class="large-3 columns">
						<label>Turno:</label>
						<select name="turno" required>
							<option value="0">Matutino</option>
							<option value="1">Vespertino</option>
							<option value="2">Noturno</option>
						</select>
					</div>
					<div class="large-6 columns">
						<label>Nome da Turma:</label>
							<input type="text" name="nomeTurma" required>
					</div>
					<div class="large-3 columns">
						<label>Carga Horária:</label>
							<input type="number" name="cargaHoraria" required>
					</div>					
					<div class="large-3 columns">
						<label>&nbsp;</label>
						<input type="submit" name="salvar" value="Salvar" class="button tiny large-12">
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