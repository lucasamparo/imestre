<?php
	require_once('../models/bootstrap.php');
	session_start();
	if(!($_SESSION['logado'])){
		header('Location: index.php');
	}
	
	if(isset($_POST['nomeDisciplina'])){
		$d = new Disciplina();
		$d->setNomeDisciplina($_POST['nomeDisciplina']);
		$d->setIdAreaMenor($_POST['areaMenor']);
		$d->setIdProfessor($_SESSION['idProfessor']);
		$d->inserirDisciplina();
	}
	
	if(isset($_POST['nomeDisciplinaEd'])){
		$d = new Disciplina();
		$d->setIdDisciplina($_POST['idDisciplina']);
		$d->setNomeDisciplina($_POST['nomeDisciplinaEd']);
		$d->setIdAreaMenor($_POST['areaMenorEd']);
		$d->atualizarDisciplina();
		header('Location: disciplinas.php');
	}
?>
<html>
<head>
<title>iMestre :: Cadastro de Disciplinas - Professor <?php echo $_SESSION['nomeProfessor'];?></title>
<link rel="stylesheet" type="text/css" href="css/foundation.css">
<link rel="stylesheet" type="text/css" href="css/basic_simplemodal.css">
<script language="JScript" src="js/vendor/jquery.js"></script>
<script language="JScript" src="js/vendor/modernizr.js"></script>
<script language="JScript" src="js/foundation.min.js"></script>
<script language="JScript" src='js/jquery.simplemodal.js'></script>
<script language="JScript" src='js/imestre.js'></script>
<script language="JScript">
function completaEdicao(codigo, nome, idArea){
	$('#nomeDisciplinaEd').val(nome);
	$('#idDisciplina').val(codigo);
	$('#areaMenorEd').val(idArea);
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
		<div class="large-2 columns">
			<?php include('sidebar.php');?>
		</div>
		<div class="large-10 columns" style="border-left-style: solid; border-width: 1px;">
			<h4 class="text-center">Controle de Disciplinas</h4>
			<form method="post" action="disciplinas.php">
				<fieldset>
					<legend>Nova Disciplina</legend>
					<div class="large-5 columns">
						<label>Nome:</label>
						<input type="text" name="nomeDisciplina" required>
					</div>
					<div class="large-5 columns">
						<label>�rea de Atua��o:</label>
						<select name="areaMenor" required>
							<?php 
								$a1 = new Areamaior();
								$a1 = $a1->retornaTodasAreas();
								foreach($a1 as $a){
									echo '<optgroup label="'.$a->getNomeArea().'">';
									$a2 = $a->getAreamenor();
									$selected = "";
									foreach($a2 as $aa){
										if(false){
											$selected = 'selected';
										}
										echo '<option value="'.$aa->getIdAreamenor().'" '.$selected.'>'.$aa->getNomeArea().'</option>';
									}
									echo '</optgroup>';
								}
							?>
						</select>
					</div>
					<div class="large-2 columns">
						<label>&nbsp;</label>
						<input type="submit" name="submeter" value="Adicionar" class="button tiny">
					</div>
				</fieldset>
			</form>
			<form method="post">
				<fieldset>
					<legend>Disciplinas j� Cadastradas</legend>
						<table class="large-12">
							<thead>
								<th width="70%">Nome (�rea de Atua��o)</th>
								<th width="10%">Assuntos</th>
								<th width="10%">Ementas</th>
								<th width="10%" class="text-center"><img src="img/editar.png" width="20"></th>					
							</thead>
							<tbody>
								<?php 
									$p = new Professor();
									$p->setIdProfessor($_SESSION['idProfessor']);
									$p = $p->retornaProfessorPorId();
									$disciplinas = $p->getDisciplina();
									foreach ($disciplinas as $d){
										echo '<tr>';
											echo '<td>'.$d->getNomeDisciplina().' ('.$d->getAreaMenor()->getNomeArea().')</td>';
											echo '<td><a href="assuntos.php?id='.$d->getIdDisciplina().'">Assuntos</a></td>';
											echo '<td><a href="ementas.php?id='.$d->getIdDisciplina().'">Ementas</a></td>';
											echo '<td class="text-center"><img src="img/editar.png" width="20" style="cursor: pointer;" onclick="'."completaEdicao('".$d->getIdDisciplina()."','".$d->getNomeDisciplina()."','".$d->getAreaMenor()->getIdAreaMenor()."')".'"></td>';
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
					<div class="large-4 columns">
						<label>Nome:</label>
						<input type="text" name="nomeDisciplinaEd" id="nomeDisciplinaEd">
						<input type="hidden" name="idDisciplina" id="idDisciplina">
					</div>
					<div class="large-5 columns">
						<label>�rea de Atua��o:</label>
						<select name="areaMenorEd" id="areaMenorEd" required>
							<?php 
								$a1 = new Areamaior();
								$a1 = $a1->retornaTodasAreas();
								foreach($a1 as $a){
									echo '<optgroup label="'.$a->getNomeArea().'">';
									$a2 = $a->getAreamenor();
									$selected = "";
									foreach($a2 as $aa){
										echo '<option value="'.$aa->getIdAreamenor().'">'.$aa->getNomeArea().'</option>';
									}
									echo '</optgroup>';
								}
							?>
						</select>
					</div>
					<div class="large-1 columns">&nbsp;</div>
					<div class="large-2 columns">
						<label>&nbsp;</label>
						<input type="submit" name="submeterEd" value="Atualizar" class="button tiny">
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