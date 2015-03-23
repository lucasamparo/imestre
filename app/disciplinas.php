<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['nomeDisciplina'])){
		$d = new Disciplina();
		$d->setNomeDisciplina($_POST['nomeDisciplina']);
		$d->inserirDisciplina();
	}
	
	if(isset($_POST['nomeDisciplinaEd'])){
		$d = new Disciplina();
		$d->setIdDisciplina($_POST['idDisciplina']);
		$d->setNomeDisciplina($_POST['nomeDisciplinaEd']);
		$d->atualizarDisciplina();
		header('Location: disciplinas.php');
	}
?>
<html>
<head>
<title>iMestre :: Cadastro de Instituição - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
function completaEdicao(codigo, nome){
	$('#nomeDisciplinaEd').val(nome);
	$('#idDisciplina').val(codigo);
	$('#formEd').css('display','inline');
}
</script>
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
		<div class="large-4 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-8 columns" style="border-left-style: solid; border-width: 1px;">
			<h4 class="text-center">Controle de Disciplinas</h4>
			<form method="post" action="disciplinas.php">
				<fieldset>
					<legend>Nova Disciplina</legend>
					<div class="large-9 columns">
						<input type="text" name="nomeDisciplina">
					</div>
					<div class="large-1 columns">&nbsp;</div>
					<div class="large-2 columns">
						<input type="submit" name="submeter" value="Adicionar" class="button tiny">
					</div>
				</fieldset>
			</form>
			<form method="post">
				<fieldset>
					<legend>Disciplinas já Cadastradas</legend>
						<table class="large-12">
							<thead>
								<th width="90%">Nome</th>
								<th width="10%" class="text-center"><img src="img/editar.png" width="20"></th>
							</thead>
							<tbody>
								<?php 
									$d1 = new Disciplina();
									$disciplinas = $d1->retornaTodasDisciplinas();
									foreach ($disciplinas as $d){
										echo '<tr>';
											echo '<td>'.$d->getNomeDisciplina().'</td>';
											echo '<td class="text-center"><img src="img/editar.png" width="20" style="cursor: pointer;" onclick="'."completaEdicao('".$d->getIdDisciplina()."','".$d->getNomeDisciplina()."')".'"></td>';
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